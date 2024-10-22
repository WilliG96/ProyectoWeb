<?php 
namespace App\Models;
use CodeIgniter\Model;

class VehiculosModel extends Model
{

    protected $table = 'tbl_vehiculo';

    protected $primaryKey = 'Id_Vehiculo';

    protected $allowedFields = ['Marca', 'Linea', 'Id_Tipo_Vehiculo', 'Estado'];

}
