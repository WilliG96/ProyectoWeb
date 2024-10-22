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

    $db = \Config\Database::connect();

    $municipioModel = new MunicipioModel();
    $datos['municipios'] = $municipioModel->findAll();

    $departamentoModel = new DepartamentoModel();
    $datos['departamentos'] = $departamentoModel->findAll();

    return view('registro_cliente', $datos);
}

public function getMunicipios($idDepartamento)
{
    $db = \Config\Database::connect();
    $municipioModel = new MunicipioModel();
    
    // Obtener los municipios que corresponden al departamento seleccionado
    $municipios = $municipioModel->where('Id_Departamento', $idDepartamento)->findAll();

    // Retornar los municipios en formato JSON
    return $this->response->setJSON($municipios);
}


// Función para mostrar la lista de clientes
public function verCliente()
{
    $db = \Config\Database::connect();
    
    $builder = $db->table('tbl_clientes tc');
        
    $builder->join('tbl_departamentos td', 'tc.Id_Departamento = td.Id_Departamento', 'inner');
    $builder->join('tbl_municipios tm', 'tc.Id_Municipio = tm.Id_Municipio', 'inner');
    $builder->join('tbl_usuarios tu', 'tc.Id_Usuario = tu.Id_Usuario', 'inner');
    
    // Ordenar los resultados por el ID del cliente en orden ascendente
    $builder->orderBy('tc.Id_Cliente', 'ASC');

    $datos['clientes'] = $builder->select('tc.*, td.nombre_departamento AS nombre_departamento, tm.nombre_municipio AS nombre_municipio, tu.usuario_asignado AS nombre_usuario') 
                                 ->get()
                                 ->getResultArray();
        
    // Devolver los datos para su uso en la vista
    return view('vista_clientes', $datos);
}

    
    // Función para mostrar solo un cliente
    public function verClienteId($id = null)
    {
        $db = \Config\Database::connect();
        
        // Obtener el cliente con su departamento y municipio actual
        $builder = $db->table('tbl_clientes tc');
        $builder->join('tbl_departamentos td', 'tc.Id_Departamento = td.Id_Departamento', 'inner');
        $builder->join('tbl_municipios tm', 'tc.Id_Municipio = tm.Id_Municipio', 'inner');
        $builder->join('tbl_usuarios tu', 'tc.Id_Usuario = tu.Id_Usuario', 'inner');
        
        // Seleccionar el cliente y los nombres de los municipios y departamentos
        $datos['cliente'] = $builder->select('tc.*, td.Nombre_Departamento AS departamento, tm.Nombre_Municipio AS municipio, tu.Usuario_Asignado AS usuario')
                                    ->where('tc.Id_Cliente', $id)
                                    ->get()
                                    ->getResultArray();
        
        // Obtener todos los departamentos y municipios para las listas desplegables
        $departamentoModel = new DepartamentoModel();
        $datos['departamentos'] = $departamentoModel->findAll();  // Cargar todos los departamentos
    
        $municipioModel = new MunicipioModel();
        $datos['municipios'] = $municipioModel->findAll();  // Cargar todos los municipios
    
        // Devolver datos en formato JSON si es una solicitud AJAX
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($datos);
        } else {
            // Cargar la vista con los datos del cliente y las listas desplegables
            return view('edit_cliente', $datos);
        }
    }
    

    public function verClienteId2($id = null)
    {
        $db = \Config\Database::connect();
        
        // Obtener el cliente con su departamento y municipio actual
        $builder = $db->table('tbl_clientes tc');
        $builder->join('tbl_departamentos td', 'tc.Id_Departamento = td.Id_Departamento', 'inner');
        $builder->join('tbl_municipios tm', 'tc.Id_Municipio = tm.Id_Municipio', 'inner');
        $builder->join('tbl_usuarios tu', 'tc.Id_Usuario = tu.Id_Usuario', 'inner');
        
        // Seleccionar el cliente y los nombres de los municipios y departamentos
        $datos['clientes'] = $builder->select('tc.*, td.nombre_departamento AS nombre_departamento, tm.nombre_municipio AS nombre_municipio, tu.usuario_asignado AS nombre_usuario')
                                    ->where('tc.DPI_CUI', $id)
                                    ->get()
                                    ->getResultArray();
    
        // Devolver datos en formato JSON si es una solicitud AJAX
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($datos);
        } else {
            // Cargar la vista con los datos del cliente y las listas desplegables
            return view('vista_clientes', $datos);
        }
    }

    public function buscarClientePorId() {
        $id = $this->request->getPost('busqueda'); 
        return $this->verClienteId2($id); 
    }

public function getMunicipiosByDepartamento($idDepartamento)
{
    $municipioModel = new MunicipioModel();

    // Obtener municipios basados en el Id_Departamento
    $municipios = $municipioModel->where('Id_Departamento', $idDepartamento)->findAll();

    // Devolver los municipios en formato JSON
    return $this->response->setJSON($municipios);
}


// Función para agregar un nuevo cliente
public function guardarCliente()
{
    $ClienteModel = new ClienteModel();

    // Obtener la sesión y el ID del usuario autenticado
    $session = session();
    $usuario = $session->get('usuario');

    $idUsuario = $usuario['id_usuario'];

    $data = [
        'Nombre_Cliente' => $this->request->getVar('nombre_cliente'),
        'Apellido_Cliente' => $this->request->getVar('apellido_cliente'),
        'Direccion_Cliente' => $this->request->getVar('direccion_cliente'),
        'Telefono_Cliente' => $this->request->getVar('telefono_cliente'),
        'DPI_CUI' => $this->request->getVar('dpi_cui'),
        'Id_Departamento' => $this->request->getVar('id_departamento'),
        'Id_Municipio' => $this->request->getVar('id_municipio'),
        'Id_Usuario' => $idUsuario, // Capturar el Id_Usuario automáticamente
    ];

    $ClienteModel->insert($data);

    return $this->response->redirect(site_url('ver-Cliente'));
}

// activar o inhabilitar cliente
public function inhabilitarC($id)
{
    // Cargar el modelo correspondiente
    $ClienteModel = new ClienteModel();

    // Verificar si el usuario existe
    $cliente = $ClienteModel->find($id);
    if (!$cliente) {
        return redirect()->back()->with('error', 'Cliente no encontrado.');
    }

    $data = [
        'Estado' => 0 
    ];

    // Actualiza el cliente en la base de datos
    $ClienteModel->update($id, $data); 

    // Redirigir después de la actualización
    return redirect()->to(site_url('ver-Cliente'))->with('success', 'Inhabilitado con éxito.');
}

public function activarC($id)
{
    // Cargar el modelo correspondiente
    $ClienteModel = new ClienteModel();

    // Verificar si el usuario existe
    $cliente = $ClienteModel->find($id);
    if (!$cliente) {
        return redirect()->back()->with('error', 'Cliente no encontrado.');
    }

    $data = [
        'Estado' => 1 
    ];

    // Actualiza el cliente en la base de datos
    $ClienteModel->update($id, $data);  

    // Redirigir después de la actualización
    return redirect()->to(site_url('ver-Cliente'))->with('success', 'Activado con éxito.');
}

public function actualizarCliente()
{
    // Acceder a la solicitud
    $request = \Config\Services::request();

    // Obtener datos del formulario
    $id = $request->getPost('id_cliente'); // Asegúrate de que el nombre del campo sea correcto
    $data = [
        'Nombre_Cliente' => $request->getPost('nombre_cliente'),
        'Apellido_Cliente' => $request->getPost('apellido_cliente'),
        'Telefono_Cliente' => $request->getPost('telefono_cliente'),
        'DPI_CUI' => $request->getPost('dpi_cui'),
        'Id_Departamento' => $request->getPost('id_departamento'),
        'Id_Municipio' => $request->getPost('id_municipio'),
        'Id_Departamento' => $this->request->getVar('id_departamento'),
        'Id_Municipio' => $this->request->getVar('id_municipio'),
        // Puedes agregar más campos aquí si es necesario
    ];

    // Cargar el modelo
    $model = new ClienteModel();

    // Actualizar los datos del cliente
    $model->update($id, $data);

    // Redirigir con mensaje de éxito
    return redirect()->to('ver-Cliente')->with('success', 'Cliente actualizado correctamente.');
}


}