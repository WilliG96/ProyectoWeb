<?php 
namespace App\Models;
use CodeIgniter\Model;

class ServiciosModel extends Model
{
    
    protected $table = 'tbl_servicios';

    protected $primaryKey = 'Id_Servicio';

    protected $allowedFields = ['Nombre_Servicio', 'Costo_Servicio', 'Id_Usuario', 'Estado'];
    

}