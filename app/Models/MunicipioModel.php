<?php 
namespace App\Models;
use CodeIgniter\Model;

class MunicipioModel extends Model
{
    protected $table = 'tbl_municipios';

    protected $primaryKey = 'Id_Municipio';

    protected $allowedFields = ['Nombre_Municipio'];

}