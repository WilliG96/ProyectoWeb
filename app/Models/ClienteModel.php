<?php 
namespace App\Models;
use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'tbl_clientes';


    protected $primaryKey = 'Id_Cliente';


    protected $allowedFields = ['Nombre_Cliente', 'Apellido_Cliente','Direccion_Cliente','Telefono_Cliente', 
    'DPI_CUI', 'Id_Municipio','Id_Departamento', 'Id_Usuario', 'Estado'];
}