<?php 
namespace App\Models;
use CodeIgniter\Model;

class ClienteModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'tbl_clientes';

    // Clave primaria de la tabla
    protected $primaryKey = 'Id_Cliente';

    // Campos permitidos para insertar o actualizar
    protected $allowedFields = ['Nombre_Cliente', 'Apellido_Cliente','Direccion_Cliente','Telefono_Cliente', 
    'DPI_CUI', 'Id_Municipio','Id_Departamento', 'Id_Usuario'];

    // Método para obtener todos los tipos de vehículos
    public function obtenerDepartamentos()
    {
        return $this->findAll(); // Obtener todos los tipos de vehículos
    }

    // Método para agregar un nuevo cliente
    public function agregarCliente($data)
    {
        return $this->insert($data);
    }

    // Método para eliminar un tipo de vehículo
    public function eliminarTipoVehiculo($id)
    {
        return $this->delete($id);
    }
}