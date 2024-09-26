<?php 
namespace App\Models;
use CodeIgniter\Model;

class TipoVehiculosModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'tbl_tipo_vehiculo';

    // Clave primaria de la tabla
    protected $primaryKey = 'Id_Tipo_Vehiculo';

    // Campos permitidos para insertar o actualizar
    protected $allowedFields = ['Nombre_Tipo_Vehiculo'];

    // Método para obtener todos los tipos de vehículos
    public function obtenerTiposVehiculos()
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
