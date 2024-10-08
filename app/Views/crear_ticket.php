<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="contenedor">
        <!-- Barra lateral -->
        <nav class="barra-lateral">
            <h3>Taller Mecánico</h3>
            <ul>
            <li><a href="<?= base_url('inicio-taller'); ?>">Inicio</a></li>
                <li><a href="#">Tickets Activos</a></li>
                <li><a href="<?= base_url('crear-ticket'); ?>">Crear Nuevo Ticket</a></li>
                <li><a href="<?= base_url('ver-Cliente') ?>">Clientes</a></li>
                <li><a href="<?= base_url('registrar-cliente') ?>">Crear Nuevo Cliente</a></li>
                <li><a href="<?= base_url('registro-vehiculo') ?>">Registrar Vehículo</a></li>
                <li><a href="<?= base_url('servicios') ?>">Servicios</a></li>
                <li><a href="#">Configuraciones</a></li>
            </ul>
        </nav>
</body>
</html>