<?php 
namespace App\Controllers;

use App\Models\TallerModel;
use App\Models\VehiculosModel;
use App\Models\ServiciosModel;

use App\Models\ClienteModel;
use App\Models\TicketModel;
use CodeIgniter\Controller;

class Seguimiento extends Controller
{
  
    public function inicio(){
        return view('InicioCliente');
    }

    public function index2(){
        return view('Historial');
    }

    public function index(){
        return view('Tickets');
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
        return view('Tickets', $datos);
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

        // para ver los tickets por id
        public function verTicketsId2($id = null)
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
                tu.usuario_asignado AS usuario, tl.Nombre_Servicio AS servicio, tc.Id_Cliente as cliente, tc.DPI_CUI as dpi') 
                ->where('tc.Telefono_Cliente', $id)
                ->orderBy('ts.Id_Ticket', 'DESC') 
                ->get()
                ->getResultArray();
                
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($datos);
        } else {
            return view('Historial', $datos);
            }
        }

        public function buscarTicketPorId2() {
            $id = $this->request->getPost('buscar'); 
        return $this->verTicketsId2($id); 
        }
}