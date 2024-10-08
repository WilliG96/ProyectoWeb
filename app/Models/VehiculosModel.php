<?php 
namespace App\Models;
use CodeIgniter\Model;

class VehiculosModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'tbl_vehiculo';

    // Clave primaria de la tabla
    protected $primaryKey = 'Id_Vehiculo';

    // Campos permitidos para insertar o actualizar
    protected $allowedFields = ['Marca', 'Linea', 'Id_Tipo_Vehiculo'];

}
