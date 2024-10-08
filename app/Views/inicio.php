<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets Activos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/principal.css') ?>">
    <style>
    .table-responsive {
        max-height: 500px; 
        overflow-y: auto; 
        position: relative; 
    }

    .table-responsive table {
        background-color: rgba(255, 255, 255, 0.7); /* Fondo semitransparente */
        backdrop-filter: blur(20px); /* Desenfoque en el fondo */
        border-radius: 20px; /* Bordes redondeados */
        width: 100%;
    }

    .table-responsive th {
        background-color: rgba(0, 0, 0, 0.7); 
        color: white; 
        padding: 10px;
    }

    .table-responsive td {
        padding: 10px;
        color: black; 
    }
    </style>
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

        <!-- Contenido principal -->
        <div class="contenido-principal">
            <header>
                <h1 class="text-center">Tickets Activos</h1>
                <div class="text-right">
                    <button class="btn btn-primary btn-crear">Crear Nuevo Ticket</button>
                </div>
            </header>

            <!-- Tabla de tickets activos -->
            <table class="table table-striped table-bordered tabla-tickets">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Vehículo</th>
                        <th>Estado</th>
                        <th>Fecha de Ingreso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Juan Pérez</td>
                        <td>Camión Freightliner</td>
                        <td>En proceso</td>
                        <td>05/09/2024</td>
                        <td>
                            <button class="btn btn-info btn-editar">Ver Detalles</button>
                            <button class="btn btn-danger btn-eliminar">Eliminar</button>
                        </td>
                    </tr>
                    <!-- Aquí irán más filas con tickets activos -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>