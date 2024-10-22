<?php 
namespace App\Models;
use CodeIgniter\Model;

class TipoVehiculosModel extends Model
{

    protected $table = 'tbl_tipo_vehiculo';

    protected $primaryKey = 'Id_Tipo_Vehiculo';

    protected $allowedFields = ['Nombre_Tipo_Vehiculo'];

}
