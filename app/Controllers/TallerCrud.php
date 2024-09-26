<?php 
namespace App\Controllers;

use App\Models\TallerModel;
use App\Models\VehiculosModel;
use App\Models\TipoVehiculosModel;

use App\Models\MunicipioModel;
use App\Models\DepartamentoModel;
use App\Models\ClienteModel;

use CodeIgniter\Controller;

class TallerCrud extends Controller
{
    protected $VehiculosModel;
    protected $TipoVehiculosModel;

    public function __construct()
    {
        $this->VehiculosModel = new VehiculosModel();
        $this->TipoVehiculosModel = new TipoVehiculosModel();
    }

    // Muestra el login
    public function loginview()
    {
        return view('inicio_login'); // vista del login
    }

    public function login()
    {
        // Acceder a la solicitud
        $request = \Config\Services::request();
        
        // Obtener usuario y contraseña del formulario
        $usuario = $request->getPost('usuario');
        $contraseña = $request->getPost('contraseña');
    
        // Cargar el modelo
        $model = new TallerModel();
    
        // Verificar el usuario y contraseña
        $usuarioEncontrado = $model->verificarUsuario($usuario, $contraseña);
    
        // Verificar si el usuario existe
        if ($usuarioEncontrado) {
            // Establecer los datos del usuario en la sesión
            session()->set('usuario', [
                'id_usuario' => $usuarioEncontrado->id,  // Aquí almacenamos el ID del usuario
                'username' => $usuarioEncontrado->usuario,  // O cualquier otro campo que quieras usar
                // Puedes añadir más campos si lo deseas
            ]);
    
            // Redirigir a la página de inicio
            return redirect()->to('/inicio-taller');  // Cambia esto a la ruta correcta para tu vista de inicio
        } else {
            // Redirigir con un mensaje de error
            return redirect()->to('/login-user')->with('error', 'Usuario o contraseña incorrectos.');
        }
    }
    

    public function logout()
    {
        // Destruir la sesión
        session()->destroy();
        return redirect()->to(base_url('TallerCrud/login'));
    }

    public function inicio()
    {
        return view('inicio'); // vista del inicio
    }

    // Función para mostrar la vista con la lista de vehículos y tipos
    public function vehiculos()
    {
        // Obtener datos de vehículos con tipos
        $data['vehiculos'] = $this->VehiculosModel->obtenerVehiculosConTipos();
        
        // Obtener tipos de vehículos para el formulario de agregar vehículo
        $data['tipos'] = $this->TipoVehiculosModel->obtenerTiposVehiculos();
      
        // Cargar la vista, pasando los datos
        return view('registrar_vehiculo', $data);
    }

    // Función para agregar un nuevo tipo de vehículo
    public function agregarTipoVehiculo()
    {
        $nombreTipo = $this->request->getPost('nombre_tipo');
        
        // Asegúrate de que el campo sea el correcto en la base de datos
        $this->TipoVehiculosModel->agregarTipoVehiculo(['Nombre_Tipo_Vehiculo' => $nombreTipo]);

        // Redirigir a la página de vehículos después de agregar
        return redirect()->to('/TallerCrud/vehiculos');
    }

    // Función para agregar un nuevo vehículo
    public function agregarVehiculo()
    {
        $data = [
            'Marca' => $this->request->getPost('marca'), // Asegúrate de que el nombre del campo coincida
            'Linea' => $this->request->getPost('linea'),
            'Id_Tipo_Vehiculo' => $this->request->getPost('tipo_vehiculo'), // Cambié el nombre del campo para que coincida con la base de datos
        ];

        $this->VehiculosModel->agregarVehiculo($data);

        // Redirigir a la página de vehículos después de agregar
        return redirect()->to('/TallerCrud/vehiculos');
    }


    // Función para mostrar la lista de vehículos
public function indexVehiculos()
{
    $VehiculosModel = new VehiculosModel();
    $data['vehiculos'] = $VehiculosModel->orderBy('id', 'DESC')->findAll();
    return view('registrar_vehiculo', $data);
}










    // Muestra el formulario de crear cliente
    public function create(){
        return view('add_cliente'); // Cambia la vista a 'add_cliente'
    }
 
    // Insertar datos del cliente
    public function store() {
        $clienteModel = new ClienteModel();
        $data = [
            'nombre'    => $this->request->getVar('nombre'),
            'direccion' => $this->request->getVar('direccion'),
            'telefono'  => $this->request->getVar('telefono'),
            'email'     => $this->request->getVar('email'),
            'cui'       => $this->request->getVar('cui')
        ];
        $clienteModel->insert($data);
    
        // Establecer un mensaje en la sesión
        session()->setFlashdata('success', 'Registro guardado con éxito.');
    
        return $this->response->redirect(site_url('/clientes-list')); // Ajusta la ruta
    }

    // Muestra los datos de un solo cliente para editar
    public function singleCliente($id = null){
        $clienteModel = new ClienteModel();
        $data['cliente_obj'] = $clienteModel->where('id', $id)->first();
        return view('edit_cliente', $data); // Cambia la vista a 'edit_cliente'
    }

    // Actualiza los datos del cliente
    public function update(){
        $clienteModel = new ClienteModel();
        $id = $this->request->getVar('id');
        $data = [
            'nombre'    => $this->request->getVar('nombre'),
            'direccion' => $this->request->getVar('direccion'),
            'telefono'  => $this->request->getVar('telefono'),
            'email'     => $this->request->getVar('email'),
            'cui'       => $this->request->getVar('cui')
        ];
        $clienteModel->update($id, $data);
        return $this->response->redirect(site_url('/clientes-list')); // Ajusta la ruta
    }
 
   // Elimina el registro de un cliente
    public function delete($id = null){
        $clienteModel = new ClienteModel();
        $clienteModel->where('id', $id)->delete($id);
        return $this->response->redirect(site_url('/clientes-list')); // Ajusta la ruta
    }    
}
