<?php 
namespace App\Models;
use CodeIgniter\Model;

class TallerModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'usuarios'; 

    // Clave primaria de la tabla
    protected $primaryKey = 'id';

    // Campos permitidos para insertar o actualizar
    protected $allowedFields = ['nombre', 'apellido', 'direccion', 'telefono', 'usuario', 'contraseña', 'estado'];

    // Método para verificar el usuario y contraseña
    public function verificarUsuario($usuario, $contraseña)
    {
        return $this->db->table('usuarios')
            ->where('usuario', $usuario)
            ->where('contraseña', $contraseña)
            ->get()
            ->getRow();  // Esto devuelve un objeto con la información del usuario, incluyendo el ID.
    }
    
    



}
