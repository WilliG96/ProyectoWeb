<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->get('/', 'TallerCrud::loginview');        
$routes->post('login-chek', 'TallerCrud::login');   

//ruta para la ventana registrar vehiculo
$routes->get('registro-vehiculo', 'VehiculosCrud::verVehiculos');
$routes->post('agregar-TipoVehiculo', 'VehiculosCrud::agregarTipoVehiculo');
$routes->post('guardar-Vehiculo', 'VehiculosCrud::agregarVehiculo');
$routes->get('inhabilitar/(:num)', 'VehiculosCrud::inhabilitarV/$1');
$routes->get('activar/(:num)', 'VehiculosCrud::activarV/$1');

// para los servicios del taller
$routes->get('servicios', 'VehiculosCrud::verServicios');
$routes->post('guardar-servicio', 'VehiculosCrud::guardarServicio');
$routes->post('verPorId', 'VehiculosCrud::buscarServicioPorId');
$routes->get('inhabilitar/(:num)', 'VehiculosCrud::inhabilitar/$1');
$routes->get('activar/(:num)', 'VehiculosCrud::activar/$1');
$routes->get('obtenerServicio/(:num)', 'VehiculosCrud::verServicioId2/$1');
$routes->post('actualizar-servicio', 'VehiculosCrud::actualizarServicio');


// ruta para los clientes
$routes->get('registrar-cliente', 'ClienteCrud::Cliente');
$routes->get('get-municipios/(:num)', 'ClienteCrud::getMunicipios/$1');
$routes->post('guardar-Cliente', 'ClienteCrud::guardarCliente');
$routes->get('ver-Cliente', 'ClienteCrud::verCliente');
$routes->get('inhabilitarCliente/(:num)', 'ClienteCrud::inhabilitarC/$1');
$routes->get('activarCliente/(:num)', 'ClienteCrud::activarC/$1');
$routes->get('obtenerCliente/(:num)', 'ClienteCrud::verClienteId/$1');
$routes->post('verClientePorId', 'ClienteCrud::buscarClientePorId');
$routes->get('getMunicipiosByDepartamento/(:num)', 'ClienteCrud::getMunicipiosByDepartamento/$1');
$routes->post('editar-cliente', 'ClienteCrud::actualizarCliente');

// ruta para los tickets
$routes->get('crear-ticket', 'TicketCrud::Ticket');
$routes->post('guardar-ticket', 'TicketCrud::guardarTicket');
$routes->get('inicio-taller', 'TicketCrud::verTickets'); 
$routes->get('inicio-Inactivos', 'TicketCrud::ticketsInactivos');
$routes->post('verTicket', 'TicketCrud::buscarTicketPorId');
$routes->get('verTicketModal/(:num)', 'TicketCrud::ticketsModal/$1');
$routes->get('logo', 'TicketCrud::getLogoBase64');
$routes->get('obtenerTicket/(:num)', 'TicketCrud::ticketId/$1');
$routes->post('editar-ticket', 'TicketCrud::actualizarTicket'); 

//$routes->get('verTicketModal', 'TicketCrud::verTicketsId');


// ruta para configuraciones. 
$routes->get('configuraciones', 'TallerCrud::irConfiguracion');
$routes->get('salir', 'TallerCrud::logout');
$routes->post('agregar-admin', 'TallerCrud::guardarAdmin');
$routes->get('inhabilitarUsuario/(:num)', 'TallerCrud::inhabilitar/$1');
$routes->get('activarUsuario/(:num)', 'TallerCrud::activar/$1');
$routes->get('obtenerUsuario/(:num)', 'TallerCrud::singleUser/$1');
$routes->post('actualizar-admin', 'TallerCrud::actualizarAdmin');

// ruta para los clientes y tickets
$routes->get('Consultas', 'Seguimiento::inicio');
$routes->get('Cliente', 'Seguimiento::index');
$routes->post('Ticket', 'Seguimiento::buscarTicketPorId');
$routes->get('verDetalles/(:num)', 'Seguimiento::ticketsModal/$1');
$routes->get('historial', 'Seguimiento::index2');
$routes->post('TicketHistorial', 'Seguimiento::buscarTicketPorId2');
