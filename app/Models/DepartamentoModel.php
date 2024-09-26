<?php 
namespace App\Models;
use CodeIgniter\Model;

class DepartamentoModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'tbl_departamentos';

    // Clave primaria de la tabla
    protected $primaryKey = 'Id_Departamento';

    // Campos permitidos para insertar o actualizar
    protected $allowedFields = ['Nombre_Departamento'];

    // Método para obtener todos los tipos de vehículos
    public function obtenerDepartamentos()
    {
        return $this->findAll(); // Obtener todos los tipos de vehículos
    }

    // Método para agregar un nuevo tipo de vehículo
    public function agregarTipoVehiculo($data)
    {
        return $this->insert($data);
    }

    // Método para eliminar un tipo de vehículo
    public function eliminarTipoVehiculo($id)
    {
        return $this->delete($id);
    }
}