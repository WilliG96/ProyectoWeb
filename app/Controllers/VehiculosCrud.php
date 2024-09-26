<?php 
namespace App\Controllers;
use App\Models\VehiculosModel;
use App\Models\TipoVehiculosModel;
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
     // Obtener el nombre del tipo de vehículo del formulario
     $nombreTipo = $this->request->getPost('nombre_tipo');
 
     // Validar el input (opcional pero recomendable)
     if (empty($nombreTipo)) {
         return redirect()->to('registro-vehiculo')->with('error', 'El nombre del tipo de vehículo es obligatorio.');
     }
 
     // Agregar el tipo de vehículo al modelo
     $tipoVehiculosModel = new \App\Models\TipoVehiculosModel();
     $tipoVehiculosModel->agregarTipoVehiculo(['Nombre_Tipo_Vehiculo' => $nombreTipo]);
 
     // Redirigir a la página de vehículos después de agregar
     return redirect()->to('registro-vehiculo')->with('success', 'Tipo de vehículo agregado exitosamente.');
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

}

