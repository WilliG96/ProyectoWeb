<?php 
namespace App\Models;
use CodeIgniter\Model;

class TallerModel extends Model
{
 
    protected $table = 'tbl_usuarios'; 

    protected $primaryKey = 'Id_Usuario';

    protected $allowedFields = ['Nombre_Usuario','Apellido_Usuario','Direccion_Usuario','Correo_Usuario','Usuario_Asignado','Contraseña_Asignada','Estado', 'Telefono'];

// Método para verificar el usuario
public function verificarUsuario($usuario)
{
    return $this->db->table('tbl_usuarios')
        ->where('Usuario_Asignado', $usuario)
        ->get()
        ->getRow(); 
}

}
