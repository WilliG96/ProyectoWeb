<?php 
namespace App\Controllers;

use App\Models\MunicipioModel;
use App\Models\DepartamentoModel;
use App\Models\ClienteModel;
use App\Models\TallerModel;
use CodeIgniter\Controller;

class ClienteCrud extends Controller
{

public function Cliente(){
    // Conectar a la base de datos
    $db = \Config\Database::connect();
 
    // Obtener tipos de departamento
    $municipioModel = new MunicipioModel();
    $datos['municipios'] = $municipioModel->findAll();

    // Obtener tipos de departamento
    $departamentoModel = new DepartamentoModel();
    $datos['departamentos'] = $departamentoModel->findAll();

    // Cargar la vista, pasando los datos
    return view('registro_cliente', $datos);
}


// Función para agregar un nuevo cliente
public function guardarCliente()
{
    $ClienteModel = new ClienteModel();

    // Obtener la sesión y el ID del usuario autenticado
    $session = session();
    $usuario = $session->get('usuario');

    $idUsuario = $usuario['id_usuario'];

    // Datos a insertar, incluyendo el Id_Usuario
    $data = [
        'Nombre_Cliente' => $this->request->getVar('nombre_cliente'),
        'Apellido_Cliente' => $this->request->getVar('apellido_cliente'),
        'Direccion_Cliente' => $this->request->getVar('direccion_cliente'),
        'Telefono_Cliente' => $this->request->getVar('telefono_cliente'),
        'Id_Departamento' => $this->request->getVar('id_departamento'),
        'Id_Municipio' => $this->request->getVar('id_municipio'),
        'DPI_CUI' => $this->request->getVar('dpi_cui'),
        'Id_Usuario' => $idUsuario, // Capturar el Id_Usuario automáticamente
    ];

    // Insertar los datos en la base de datos
    $ClienteModel->insert($data);

    // Redireccionar al formulario de registro de clientes
    return $this->response->redirect(site_url('registrar-cliente'));
}





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