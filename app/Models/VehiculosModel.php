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

    // Método para obtener un vehículo por su ID
    public function obtenerVehiculoPorId($id)
    {
        return $this->find($id); // Encontrar vehículo por ID
    }

    // Método para agregar un nuevo vehículo
    public function agregarVehiculo($data)
    {
        return $this->insert($data);
    }

    // Método para actualizar un vehículo
    public function actualizarVehiculo($id, $data)
    {
        return $this->update($id, $data);
    }

    // Método para eliminar un vehículo
    public function eliminarVehiculo($id)
    {
        return $this->delete($id);
    }
}
