<?php 
namespace App\Models;
use CodeIgniter\Model;

class TipoVehiculosModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'tbl_tipo_vehiculo';

    // Clave primaria de la tabla
    protected $primaryKey = 'Id_Tipo_Vehiculo';

    // Campos permitidos para insertar o actualizar
    protected $allowedFields = ['Nombre_Tipo_Vehiculo'];

}
