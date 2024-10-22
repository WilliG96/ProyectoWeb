<?php 
namespace App\Models;
use CodeIgniter\Model;

class DepartamentoModel extends Model
{
    protected $table = 'tbl_departamentos';

    protected $primaryKey = 'Id_Departamento';

    protected $allowedFields = ['Nombre_Departamento'];

}