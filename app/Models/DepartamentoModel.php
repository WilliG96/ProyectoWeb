<?php 
namespace App\Models;
use CodeIgniter\Model;

class DepartamentoModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'tbl_departamentos';

    // Clave primaria de la tabla
    protected $primaryKey = 'Id_Departamento';

    // Campos permitidos para insertar o actualizar
    protected $allowedFields = ['Nombre_Departamento'];

}