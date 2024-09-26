<?php 
namespace App\Models;
use CodeIgniter\Model;

class MunicipioModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'tbl_municipios';

    // Clave primaria de la tabla
    protected $primaryKey = 'Id_Municipio';

    // Campos permitidos para insertar o actualizar
    protected $allowedFields = ['Nombre_Municipio'];

    // Método para obtener todos los tipos de vehículos
    public function obtenerMunicipios()
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