<?php 
namespace App\Controllers;
use App\Models\VehiculosModel;
use App\Models\TipoVehiculosModel;
use App\Models\TallerModel;
use CodeIgniter\Controller;

class VehiculosCrud extends Controller
{

    // Función para mostrar la lista de vehículos
public function verVehiculos()
{
    // Conectar a la base de datos
    $db = \Config\Database::connect();

    // Crear un constructor de consultas
    $builder = $db->table('tbl_vehiculo tv');
    
    // Realizar el JOIN con la tabla de tipos de vehículo
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
    // Conectar a la base de datos
    $db = \Config\Database::connect();
    
    // Crear un constructor de consultas
    $builder = $db->table('tbl_servicios ts');
    
    // Realizar el JOIN con la tabla de tipos de vehículo
    $builder->join('tbl_usuarios tu', 'ts.Id_Usuario = tu.Id_Usuario', 'left');

    // Obtener los resultados de vehículos
    $datos['servicios'] = $builder->select('ts.*, tu.Usuario_Asignado AS usuario')
                                   ->get()
                                   ->getResultArray();
        
    // Devolver los datos para su uso en la vista
    return view('servicios', $datos);

}


}

