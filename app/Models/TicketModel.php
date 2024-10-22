<?php 
namespace App\Models;
use CodeIgniter\Model;

class TicketModel extends Model
{
    
    protected $table = 'tickets_servicio';

    protected $primaryKey = 'Id_Ticket';

    protected $allowedFields = ['Año_Vehiculo',	'Placa_Vehiculo',	'Id_Vehiculo',	'Descripcion_Problema',
    'Id_Usuario',	'Estado',	'Id_Cliente',	'Id_Servicio'];

}