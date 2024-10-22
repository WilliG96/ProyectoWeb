<?php 
namespace App\Controllers;

use App\Models\TallerModel;
use App\Models\VehiculosModel;
use App\Models\ServiciosModel;

use App\Models\ClienteModel;
use App\Models\TicketModel;
use CodeIgniter\Controller;

class TicketCrud extends Controller
{
    // para ver los tickets activos
    public function verTickets()
    {
        $db = \Config\Database::connect();
            
        $builder = $db->table('tickets_servicio ts');
            
        $builder->join('tbl_vehiculo tv', 'ts.Id_Vehiculo = tv.Id_Vehiculo', 'inner');
        $builder->join('tbl_clientes tc', 'ts.Id_Cliente = tc.Id_Cliente', 'inner');
        $builder->join('tbl_usuarios tu', 'ts.Id_Usuario = tu.Id_Usuario', 'inner');
        $builder->join('tbl_servicios tl', 'ts.Id_Servicio = tl.Id_Servicio', 'inner');
    
        // Filtrar por estado 1 o 2
        $builder->whereIn('ts.estado', [1, 2]);
    
        // Ordenar los resultados por el ID del ticket en orden ascendente
        $builder->orderBy('ts.Id_Ticket', 'ASC');
    
        $datos['tickets'] = $builder->select('ts.*, tv.Marca AS marca, tv.Linea AS linea, 
            tc.Nombre_Cliente AS nombre, tc.Apellido_Cliente AS apellido, 
            tc.Direccion_Cliente AS direccion, tc.Telefono_Cliente AS telefono, 
            tu.usuario_asignado AS usuario, tl.Nombre_Servicio AS servicio, tc.Id_Cliente as cliente') 
            ->get()
            ->getResultArray();
            
        // Devolver los datos para su uso en la vista
        return view('inicio', $datos);
    }

    // para ver los tickets por id
    public function verTicketsId($id = null)
    {
        $db = \Config\Database::connect();
            
        $builder = $db->table('tickets_servicio ts');
            
        $builder->join('tbl_vehiculo tv', 'ts.Id_Vehiculo = tv.Id_Vehiculo', 'inner');
        $builder->join('tbl_clientes tc', 'ts.Id_Cliente = tc.Id_Cliente', 'inner');
        $builder->join('tbl_usuarios tu', 'ts.Id_Usuario = tu.Id_Usuario', 'inner');
        $builder->join('tbl_servicios tl', 'ts.Id_Servicio = tl.Id_Servicio', 'inner');
    
    
        $datos['tickets'] = $builder->select('ts.*, tv.Marca AS marca, tv.Linea AS linea, 
            tc.Nombre_Cliente AS nombre, tc.Apellido_Cliente AS apellido, 
            tc.Direccion_Cliente AS direccion, tc.Telefono_Cliente AS telefono, 
            tu.usuario_asignado AS usuario, tl.Nombre_Servicio AS servicio, tc.Id_Cliente as cliente') 
            ->where('ts.Id_Ticket', $id)
            ->get()
            ->getResultArray();
            
    if ($this->request->isAJAX()) {
        return $this->response->setJSON($datos);
    } else {
        return view('inicio', $datos);
        }
    }


    public function buscarTicketPorId() {
        $id = $this->request->getPost('buscar'); 
    return $this->verTicketsId($id); 
    }


        // para ver los ticket modal
    public function ticketsModal($id = null)
    {
        $db = \Config\Database::connect();
                
        $builder = $db->table('tickets_servicio ts');
                
        $builder->join('tbl_vehiculo tv', 'ts.Id_Vehiculo = tv.Id_Vehiculo', 'inner');
        $builder->join('tbl_clientes tc', 'ts.Id_Cliente = tc.Id_Cliente', 'inner');
        $builder->join('tbl_usuarios tu', 'ts.Id_Usuario = tu.Id_Usuario', 'inner');
        $builder->join('tbl_servicios tl', 'ts.Id_Servicio = tl.Id_Servicio', 'inner');
        
        $datos['tickets'] = $builder->select('ts.*, tv.Marca AS marca, tv.Linea AS linea, 
                tc.Nombre_Cliente AS nombre, tc.Apellido_Cliente AS apellido, 
                tc.Direccion_Cliente AS direccion, tc.Telefono_Cliente AS telefono, 
                tu.usuario_asignado AS usuario, tl.Nombre_Servicio AS servicio, ts.Año_Vehiculo as vehiculo, tc.Id_Cliente as cliente') 
                ->where('ts.Id_Ticket', $id)
                ->get()
                ->getResultArray();
                
            if ($this->request->isAJAX()) {
                    return $this->response->setJSON($datos['tickets']);
            } else {
                 return view('inicio', $datos);
            }
                
        }


    // para ver los tickets inactivos
    public function ticketsInactivos()
    {
    $db = \Config\Database::connect();
                    
    $builder = $db->table('tickets_servicio ts');
                    
    $builder->join('tbl_vehiculo tv', 'ts.Id_Vehiculo = tv.Id_Vehiculo', 'inner');
    $builder->join('tbl_clientes tc', 'ts.Id_Cliente = tc.Id_Cliente', 'inner');
    $builder->join('tbl_usuarios tu', 'ts.Id_Usuario = tu.Id_Usuario', 'inner');
    $builder->join('tbl_servicios tl', 'ts.Id_Servicio = tl.Id_Servicio', 'inner');
            
    // Filtrar por estado 1 o 2
    $builder->whereIn('ts.estado', [0]);
            
    // Ordenar los resultados por el ID del ticket en orden ascendente
    $builder->orderBy('ts.Id_Ticket', 'ASC');
            
    $datos['tickets'] = $builder->select('ts.*, tv.Marca AS marca, tv.Linea AS linea, 
    tc.Nombre_Cliente AS nombre, tc.Apellido_Cliente AS apellido, 
    tc.Direccion_Cliente AS direccion, tc.Telefono_Cliente AS telefono, 
    tu.usuario_asignado AS usuario, tl.Nombre_Servicio AS servicio, tc.Id_Cliente as cliente') 
            ->get()
            ->getResultArray();
                    
    // Devolver los datos para su uso en la vista
    return view('inicio', $datos);
    }
    

    // para guardar ticket 
    public function Ticket()
    {
        $db = \Config\Database::connect();
    
        // Cargar modelos necesarios
        $vehiculoModel = new VehiculosModel();
        $clienteModel = new ClienteModel();
        $servicioModel = new ServiciosModel();
    
        // Obtener los datos
        $datos['vehiculos'] = $vehiculoModel->findAll();
        $datos['clientes'] = $clienteModel->findAll();
        $datos['servicios'] = $servicioModel->findAll();
    
        return view('crear_ticket', $datos);
    }
    

    // Función para guardar un nuevo ticket
    public function guardarTicket()
    {
    $TicketModel = new TicketModel(); // Asegúrate de que TicketModel está definido correctamente

    // Obtener la sesión y el ID del usuario autenticado
    $session = session();
    $usuario = $session->get('usuario');

    $idUsuario = $usuario['id_usuario'];

    // Preparar los datos del ticket
    $data = [
        'Id_Vehiculo' => $this->request->getVar('id_vehiculo'), // ID del vehículo seleccionado
        'Id_Servicio' => $this->request->getVar('id_servicio'), // ID del servicio seleccionado
        'Año_Vehiculo' => $this->request->getVar('anio_vehiculo'), // Año del vehículo
        'Placa_Vehiculo' => $this->request->getVar('placa_vehiculo'), // Placa del vehículo
        'Estado' => $this->request->getVar('estado'), // Estado del ticket
        'Id_Cliente' => $this->request->getVar('id_cliente'), // ID del cliente seleccionado
        'Descripcion_Problema' => $this->request->getVar('descripcion_problema'), // Descripción del problema
        'Id_Usuario' => $idUsuario, // Capturar el Id_Usuario automáticamente
    ];

    // Guardar los datos del ticket en la base de datos
    $TicketModel->insert($data);

    // Redirigir a la vista correspondiente después de guardar
    return $this->response->redirect(site_url('inicio-taller')); // Cambia 'ver-ticket' a la ruta que desees
    }

// para la imagen
    public function getLogoBase64() {
        $path = FCPATH . 'images/logo2.png'; // Cambia a la ruta de tu logo
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            return 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        return null; // O maneja el error de alguna manera
    }


    public function verServicioId2($id = null){

    $db = \Config\Database::connect();

    $builder = $db->table('tbl_servicios ts');

    $builder->join('tbl_usuarios tu', 'ts.Id_Usuario = tu.Id_Usuario', 'left');
    
    $datos['servicios'] = $builder->select('ts.*, tu.Usuario_Asignado AS usuario')
                                    ->where('ts.Id_Servicio', $id)
                                    ->get()
                                    ->getResultArray();
    
    if ($this->request->isAJAX()) {
        return $this->response->setJSON($datos);
    } else {
        return view('edit_servicios', $datos);
    }
}

    // para editar ticket
    public function ticketId($id = null)
    {
        $db = \Config\Database::connect();
                    
        $builder = $db->table('tickets_servicio ts');
                    
        $builder->join('tbl_vehiculo tv', 'ts.Id_Vehiculo = tv.Id_Vehiculo', 'inner');
        $builder->join('tbl_clientes tc', 'ts.Id_Cliente = tc.Id_Cliente', 'inner');
        $builder->join('tbl_usuarios tu', 'ts.Id_Usuario = tu.Id_Usuario', 'inner');
        $builder->join('tbl_servicios tl', 'ts.Id_Servicio = tl.Id_Servicio', 'inner');
            
        $datos['tickets'] = $builder->select('ts.*, tv.Marca AS marca, tv.Linea AS linea, 
                tc.Nombre_Cliente AS nombre, tc.Apellido_Cliente AS apellido, 
                tc.Direccion_Cliente AS direccion, tc.Telefono_Cliente AS telefono, 
                tu.usuario_asignado AS usuario, tl.Nombre_Servicio AS servicio, ts.Año_Vehiculo as vehiculo, tc.Id_Cliente as cliente') 
                ->where('ts.Id_Ticket', $id)
                ->get()
                ->getResultArray();
                    
        if ($this->request->isAJAX()) {
         return $this->response->setJSON($datos['tickets']);
        } else {
            return view('editTickte', $datos);
        }
                    
    }
    
    public function actualizarTicket()
    {
        // Acceder a la solicitud
        $request = \Config\Services::request();
    
        // Obtener datos del formulario
        $id = $request->getPost('id_ticket'); // Asegúrate de que el nombre del campo sea correcto
        $data = [
            'Placa_Vehiculo' => $request->getPost('placa_vehiculo'),
            'Año_Vehiculo' => $request->getPost('anio_vehiculo'),
            'Descripcion_Problema' => $request->getPost('descripcion_problema'),
            'Estado' => $request->getPost('estado'),
        ];
    
        // Cargar el modelo
        $model = new TicketModel(); // Cambia 'TicketsModel' por el nombre correcto de tu modelo
    
        // Actualizar los datos del ticket
        $model->update($id, $data);
    
        // Redirigir con mensaje de éxito
        return redirect()->to('inicio-taller')->with('success', 'Ticket actualizado correctamente.');
    }
    

}