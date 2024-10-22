<?php 
namespace App\Controllers;
use App\Models\VehiculosModel;
use App\Models\TipoVehiculosModel;
use App\Models\TallerModel;
use App\Models\ServiciosModel;
use CodeIgniter\Controller;

class VehiculosCrud extends Controller
{

    // Función para mostrar la lista de vehículos
public function verVehiculos()
{
    $db = \Config\Database::connect();

    $builder = $db->table('tbl_vehiculo tv');
    
    $builder->join('tbl_tipo_vehiculo tt', 'tv.Id_Tipo_Vehiculo = tt.Id_Tipo_Vehiculo', 'left');

    // Obtener los resultados de vehículos
    $datos['vehiculos'] = $builder->select('tv.*, tt.Nombre_Tipo_Vehiculo AS tipo_vehiculo_nombre')
                                   ->get()
                                   ->getResultArray();

    // Obtener tipos de vehículos
    $tipoVehiculosModel = new TipoVehiculosModel();
    $datos['tipos'] = $tipoVehiculosModel->findAll();

    // Cargar la vista, pasando los datos
    return view('vehiculos', $datos);
}

 // Función para agregar un nuevo tipo de vehículo
 public function agregarTipoVehiculo()
 {
    $TipoVehiculosModel = new TipoVehiculosModel();
    $data = ['Nombre_Tipo_Vehiculo' => $this->request->getVar('nombre_tipo'),
    ];
    $TipoVehiculosModel->insert($data);
    return $this->response->redirect(site_url('registro-vehiculo'));
 }


// Función para agregar un nuevo vehículo
public function agregarVehiculo()
{
    $VehiculosModel = new VehiculosModel();
    $data = [
        'Marca' => $this->request->getVar('marca'),
        'Linea'  => $this->request->getVar('linea'),
        'Id_Tipo_Vehiculo'  => $this->request->getVar('tipo_vehiculo'),
    ];
    $VehiculosModel->insert($data);
    return $this->response->redirect(site_url('registro-vehiculo'));

}

public function verServicios()
{
    $db = \Config\Database::connect();
    
    $builder = $db->table('tbl_servicios ts');
    
    $builder->join('tbl_usuarios tu', 'ts.Id_Usuario = tu.Id_Usuario', 'left');

    $datos['servicios'] = $builder->select('ts.*, tu.Usuario_Asignado AS usuario')
                                   ->get()
                                   ->getResultArray();
        
    // Devolver los datos para su uso en la vista
    return view('servicios', $datos);

}

public function verServicioId($id = null){

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
        return view('servicios', $datos);
    }
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

public function actualizarServicio()
{
    // Acceder a la solicitud
    $request = \Config\Services::request();

    // Obtener datos del formulario
    $id = $request->getPost('id_servicio'); // Asegúrate de que el nombre del campo sea correcto
    $data = [
        'Nombre_Servicio' => $request->getPost('nombre_servicio'),
        'Costo_Servicio' => $request->getPost('costo_servicio'),
    ];

    // Cargar el modelo
    $model = new ServiciosModel();

    // Actualizar los datos del usuario
    $model->update($id, $data);

    // Redirigir con mensaje de éxito
    return redirect()->to('servicios')->with('success', 'Servicio actualizado correctamente.');
}

public function buscarServicioPorId() {
    $id = $this->request->getPost('busqueda'); 
    return $this->verServicioId($id); 
}

// Guardar servicio
public function guardarServicio()
{
        // librería de validación
        $this->validate([
            'servicio' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Nombre Servicio es obligatorio.',
                ],
            ],
            'costo' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'El campo Costo Servicio es obligatorio.',
                    'numeric' => 'El campo Costo Servicio debe ser un número.',
                ],
            ],
        ]);
    
        if (!$this->validate([
            'servicio' => 'required',
            'costo' => 'required|numeric',
        ])) {

            $errors = $this->validator->getErrors();
    
            return view('servicios', ['errors' => $errors]);
        }

    $ServiciosModel = new ServiciosModel();
    
        $session = session();
        $usuario = $session->get('usuario');
    
        $idUsuario = $usuario['id_usuario'];

    $data = [
        'Nombre_Servicio' => $this->request->getVar('servicio'),
        'Costo_Servicio'  => $this->request->getVar('costo'),
        'Id_Usuario' => $idUsuario, // Capturar el Id_Usuario automáticamente
    ];
    $ServiciosModel->insert($data);
    return $this->response->redirect(site_url('servicios'));

}

// para los servicios 
public function inhabilitar($id)
{
    // Cargar el modelo correspondiente
    $ServiciosModel = new ServiciosModel();

    // Verificar si el usuario existe
    $servicio = $ServiciosModel->find($id);
    if (!$servicio) {
        return redirect()->back()->with('error', 'Servicio no encontrado.');
    }

    $data = [
        'Estado' => 0 
    ];

    // Actualiza el servicio en la base de datos
    $ServiciosModel->update($id, $data); 

    // Redirigir después de la actualización
    return redirect()->to(site_url('servicios'))->with('success', 'Inhabilitado con éxito.');
}

public function activar($id)
{
    // Cargar el modelo correspondiente
    $ServiciosModel = new ServiciosModel();

    $servicio = $ServiciosModel->find($id);
    if (!$servicio) {
        return redirect()->back()->with('error', 'Servicio no encontrado.');
    }

    $data = [
        'Estado' => 1 
    ];

    // Actualiza el servicio en la base de datos
    $ServiciosModel->update($id, $data); 


    // Redirigir después de la actualización
    return redirect()->to(site_url('servicios'))->with('success', 'Activado con éxito.');
}


// para los vehiculos 
public function inhabilitarV($id)
{
    // Cargar el modelo correspondiente
    $vehiculosModel = new VehiculosModel();

    // Verificar si el usuario existe
    $vehiculo = $vehiculosModel->find($id);
    if (!$vehiculo) {
        return redirect()->back()->with('error', 'Vehiculo no encontrado.');
    }

    $data = [
        'Estado' => 0 
    ];

    // Actualiza el vehiculo en la base de datos
    $vehiculosModel->update($id, $data); 

    // Redirigir después de la actualización
    return redirect()->to(site_url('registro-vehiculo'))->with('success', 'Inhabilitado con éxito.');
}

public function activarV($id)
{
    // Cargar el modelo correspondiente
    $vehiculosModel = new VehiculosModel();

    // Verificar si el usuario existe
    $vehiculo = $vehiculosModel->find($id);
    if (!$vehiculo) {
        return redirect()->back()->with('error', 'Vehiculo no encontrado.');
    }

    $data = [
        'Estado' => 1 
    ];

    // Actualiza el vehiculo en la base de datos
    $vehiculosModel->update($id, $data); 


    // Redirigir después de la actualización
    return redirect()->to(site_url('registro-vehiculo'))->with('success', 'Activado con éxito.');
}




}

