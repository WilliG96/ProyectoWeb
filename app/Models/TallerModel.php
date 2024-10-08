<?php 
namespace App\Models;
use CodeIgniter\Model;

class TallerModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'tbl_usuarios'; 

    // Clave primaria de la tabla
    protected $primaryKey = 'Id_Usuario';

    // Campos permitidos para insertar o actualizar
    protected $allowedFields = ['Nombre_Usuario','Apellido_Usuario','Direccion_Usuario','Correo_Usuario','Usuario_Asignado','Contraseña_Asignada','Estado'];

    // Método para verificar el usuario y contraseña
    public function verificarUsuario($usuario, $contraseña)
    {
        return $this->db->table('tbl_usuarios')
            ->where('Usuario_Asignado', $usuario)
            ->where('Contraseña_Asignada', $contraseña)
            ->get()
            ->getRow();  // Esto devuelve un objeto con la información del usuario, incluyendo el ID.
    }
    
    



}
