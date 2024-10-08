<?php 
namespace App\Models;
use CodeIgniter\Model;

class ServiciosModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'tbl_servicios';

    // Clave primaria de la tabla
    protected $primaryKey = 'Id_Servicio';

    // Campos permitidos para insertar o actualizar
    protected $allowedFields = ['Nombre_Servicio', 'Costo_Servicio', 'Id_Usuario'];

}