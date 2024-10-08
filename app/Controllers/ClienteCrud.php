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


public function clientev(){

return view('hola');
}


// Función para mostrar la lista de clientes
public function verCliente()
{
    // Conectar a la base de datos
    $db = \Config\Database::connect();
    
    // Crear un constructor de consultas para la tabla de clientes
    $builder = $db->table('tbl_clientes tc');
        
    // Realizar los JOINs con las tablas de departamentos, municipios y usuarios
    $builder->join('tbl_departamentos td', 'tc.Id_Departamento = td.Id_Departamento', 'inner');
    $builder->join('tbl_municipios tm', 'tc.Id_Municipio = tm.Id_Municipio', 'inner');
    $builder->join('tbl_usuarios tu', 'tc.Id_Usuario = tu.Id_Usuario', 'inner'); // Agregar JOIN con la tabla de usuarios
    
    // Obtener los resultados de clientes, incluyendo el nombre del departamento, municipio y usuario
    $datos['clientes'] = $builder->select('tc.*, td.nombre_departamento AS nombre_departamento, tm.nombre_municipio AS nombre_municipio, tu.usuario_asignado AS nombre_usuario') // Seleccionar el nombre del usuario también
                                 ->get()
                                 ->getResultArray();
        
    // Devolver los datos para su uso en la vista
    return view('vista_clientes', $datos);
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
        'DPI_CUI' => $this->request->getVar('dpi_cui'),
        'Id_Departamento' => $this->request->getVar('id_departamento'),
        'Id_Municipio' => $this->request->getVar('id_municipio'),
        'DPI_CUI' => $this->request->getVar('dpi_cui'),
        'Id_Usuario' => $idUsuario, // Capturar el Id_Usuario automáticamente
    ];

    // Insertar los datos en la base de datos
    $ClienteModel->insert($data);

    // Redireccionar al formulario de registro de clientes
    return $this->response->redirect(site_url('ver-Cliente'));
}

}