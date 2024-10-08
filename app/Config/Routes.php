<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login-user', 'TallerCrud::loginview');        // Mostrar la lista de clientes
$routes->post('login-chek', 'TallerCrud::login');    // Ruta POST para procesar el login
$routes->get('inicio-taller', 'TallerCrud::inicio');        // Formulario para agregar un cliente

//ruta para la ventana registrar vehiculo
$routes->get('registro-vehiculo', 'VehiculosCrud::verVehiculos');
$routes->post('agregar-TipoVehiculo', 'VehiculosCrud::agregarTipoVehiculo');
$routes->post('guardar-Vehiculo', 'VehiculosCrud::agregarVehiculo');
$routes->get('servicios', 'VehiculosCrud::verServicios');

// ruta para los clientes
$routes->get('registrar-cliente', 'ClienteCrud::Cliente');
$routes->post('guardar-Cliente', 'ClienteCrud::guardarCliente');
$routes->get('ver-Cliente', 'ClienteCrud::verCliente');

// ruta para los tickets
$routes->get('crear-ticket', 'TicketCrud::crearTicket');

$routes->post('store-cliente', 'TallerCrud::store');       // Almacenar nuevo cliente
$routes->get('edit-cliente/(:num)', 'TallerCrud::singleCliente/$1'); // Editar cliente
$routes->post('update-cliente', 'TallerCrud::update');     // Actualizar cliente
$routes->get('delete-cliente/(:num)', 'TallerCrud::delete/$1');  // Eliminar cliente