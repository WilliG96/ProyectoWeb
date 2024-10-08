<?php 
namespace App\Models;
use CodeIgniter\Model;

class MunicipioModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'tbl_municipios';

    // Clave primaria de la tabla
    protected $primaryKey = 'Id_Municipio';

    // Campos permitidos para insertar o actualizar
    protected $allowedFields = ['Nombre_Municipio'];

}