<?php 
namespace App\Controllers;

use App\Models\TallerModel;
use App\Models\VehiculosModel;
use App\Models\TipoVehiculosModel;

use App\Models\MunicipioModel;
use App\Models\DepartamentoModel;
use App\Models\ClienteModel;

use CodeIgniter\Controller;

class TicketCrud extends Controller
{
    
    // Muestra la pantalla registro de ticket
    public function crearTicket()
    {
        return view('crear_ticket'); // vista del login
    }
}