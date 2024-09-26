<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets Activos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/inicio.css') ?>">
    <style>
        .table-responsive {
            max-height: 300px; /* Ajustar la altura máxima */
            overflow-y: auto; /* Habilitar scroll vertical */
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <!-- Barra lateral -->
        <nav class="barra-lateral">
            <h2>Taller Mecánico</h2>
            <ul>
            <li><a href="<?= base_url('inicio-taller'); ?>">Inicio</a></li>
                <li><a href="#">Tickets Activos</a></li>
                <li><a href="#">Crear Nuevo Ticket</a></li>
                <li><a href="#">Clientes</a></li>
                <li><a href="<?= base_url('registrar-cliente') ?>">Crear Nuevo Cliente</a></li>
                <li><a href="<?= base_url('registro-vehiculo') ?>">Registrar Vehículo</a></li>
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