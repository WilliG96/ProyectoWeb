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
        $request = \Config\Services::request();
        
        $usuario = $request->getPost('usuario');
        $contraseña = $request->getPost('contraseña');
    
        // Cargar el modelo
        $model = new TallerModel();
    
        // Verificar el usuario
        $usuarioEncontrado = $model->verificarUsuario($usuario);
    
     
        if ($usuarioEncontrado) {
       
            if ($usuarioEncontrado->Estado == 0) {
        
                session()->setFlashdata('error', 'Su usuario está inactivo.');
                return redirect()->to('/login-user');
            }
    
         
            if (password_verify($contraseña, $usuarioEncontrado->Contraseña_Asignada)) {
         
                session()->set('usuario', [
                    'id_usuario' => $usuarioEncontrado->Id_Usuario, 
                    'username' => $usuarioEncontrado->Usuario_Asignado,  
                ]);
    
                return redirect()->to('/inicio-taller');  
            } else {

                return redirect()->to('/login-user')->with('error', 'Usuario o contraseña incorrectos.');
            }
        } 
    }
    
    
    public function logout()
    {
        // Destruir la sesión
        session()->destroy();
    

        return redirect()->to(base_url('/'))->with('headers', [
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT'
        ]);
    }
    
    public function inicio()
    {
        return view('inicio'); // vista del inicio
    }

public function irConfiguracion()
{
    $db = \Config\Database::connect();

    $TallerModel = new TallerModel();
    $data['usuarios'] = $TallerModel->findAll();
    return view('configuracion', $data); 
}

public function guardarAdmin()
{

    $validation = \Config\Services::validation();

    $validation->setRules([
        'nombre_usuario' => 'required',
        'apellido_usuario' => 'required',
        'direccion_usuario' => 'required',
        'correo_usuario' => 'required|valid_email', 
        'usuario_asignado' => 'required',
        'contraseña_asignada' => 'required',
        'telefono_usuario' => 'required' 
    ], 
    [

        'correo_usuario' => [
            'valid_email' => 'El correo electrónico debe ser válido.'
        ]
    ]);


    if (!$this->validate($validation->getRules())) {
    
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $TallerModel = new TallerModel();
    $data = [
        'Nombre_Usuario' => $this->request->getPost('nombre_usuario'), 
        'Apellido_Usuario' => $this->request->getPost('apellido_usuario'),
        'Direccion_Usuario' => $this->request->getPost('direccion_usuario'), 
        'Correo_Usuario' => $this->request->getPost('correo_usuario'),
        'Usuario_Asignado' => $this->request->getPost('usuario_asignado'),
        'Contraseña_Asignada' => password_hash($this->request->getPost('contraseña_asignada'), PASSWORD_DEFAULT), // Hashear la contraseña
        'Telefono' => $this->request->getPost('telefono_usuario'),
    ];

    // Guardar los datos en la base de datos
    try {
        $TallerModel->insert($data);
        return $this->response->redirect(site_url('configuraciones'));
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al guardar el usuario: ' . $e->getMessage());
    }
}


public function inhabilitar($idUsuario)
{
    // Cargar el modelo correspondiente
    $TallerModel = new TallerModel();

    // Verificar si el usuario existe
    $usuario = $TallerModel->find($idUsuario);
    if (!$usuario) {
        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }

    $data = [
        'Estado' => 0 
    ];

    // Actualiza el usuario en la base de datos
    $TallerModel->update($idUsuario, $data); 

    // Redirigir después de la actualización
    return redirect()->to(site_url('configuraciones'))->with('success', 'Usuario inhabilitado con éxito.');
}

public function activar($idUsuario)
{
    // Cargar el modelo correspondiente
    $TallerModel = new TallerModel();

    // Verificar si el usuario existe
    $usuario = $TallerModel->find($idUsuario);
    if (!$usuario) {
        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }

    $data = [
        'Estado' => 1 
    ];

    // Actualiza el usuario en la base de datos
    $TallerModel->update($idUsuario, $data); 

    // Redirigir después de la actualización
    return redirect()->to(site_url('configuraciones'))->with('success', 'Usuario inhabilitado con éxito.');
}

// Muestra los datos de un solo cliente para editar
public function singleUser($id = null) {
    $TallerModel = new TallerModel();
    $data['cliente_obj'] = $TallerModel->where('Id_Usuario', $id)->first();

    return view('edit_user', $data); // Cambia la vista a 'edit_cliente'
}


public function actualizarAdmin()
{
    // Acceder a la solicitud
    $request = \Config\Services::request();

    // Obtener datos del formulario
    $id = $request->getPost('id_usuario'); // Asegúrate de que el nombre del campo sea correcto
    $data = [
        'Nombre_Usuario' => $request->getPost('nombre_usuario'),
        'Apellido_Usuario' => $request->getPost('apellido_usuario'),
        'Direccion_Usuario' => $request->getPost('direccion_usuario'),
        'Correo_Usuario' => $request->getPost('correo_usuario'),
        'Telefono' => $request->getPost('telefono_usuario'),
        'Usuario_Asignado' => $request->getPost('usuario_asignado'),
    ];

    // Verificar si se proporcionó una nueva contraseña
    $nueva_contraseña = $request->getPost('contraseña_asignada');
    if (!empty($nueva_contraseña)) {
        $data['Contraseña_Asignada'] = password_hash($nueva_contraseña, PASSWORD_DEFAULT); // Solo actualizar si no está vacío
    }

    // Cargar el modelo
    $model = new TallerModel();

    // Actualizar los datos del usuario
    $model->update($id, $data);

    // Redirigir con mensaje de éxito
    return redirect()->to('configuraciones')->with('success', 'Usuario actualizado correctamente.');
}


    
}
