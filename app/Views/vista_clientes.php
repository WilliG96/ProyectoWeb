<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Registrados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/vercliente.css'); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style>
    .table-responsive {
        max-height: 500px; 
        overflow-y: auto; 
        position: relative; 
    }

    .table-responsive table {
        background-color: rgba(255, 255, 255, 0.5); /* Fondo semitransparente */
        backdrop-filter: blur(10px); /* Desenfoque en el fondo */
        border-radius: 5px; /* Bordes redondeados */
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

    .dataTables_filter label {
    color: white; 
    font-weight: bold;
    }

    .dataTables_paginate .paginate_button {
        color: white;          
        font-weight: bold;     
    }

    .dataTables_paginate .paginate_button:hover {
        color: #f0f0f0;      
    }

    .dataTables_paginate .paginate_button.current {
        color: #ffffff;           
        background-color: #007bff; 
        border: none;          
    }
    h2{
        color: #ffffff;
        font-weight: bold;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
       color: white !important;     /* Siempre blanco */
       font-weight: bold !important; /* Siempre en negrita */
       background-color: transparent; /* Fondo transparente */
       border: none;                 /* Sin bordes */
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
                <h2>Clientes del Taller</h2>
            </header>

            <!-- Tabla de Clientes Registrados -->
            <div class="table-responsive">
                <table class="table table-bordered" id="clientes-list">
                    <thead>
                        <tr>
                            <th>Id Cliente</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>DPI/CUI</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($clientes)): ?>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr>
                                    <td><?= htmlspecialchars($cliente['Id_Cliente']); ?></td>
                                    <td><?= htmlspecialchars($cliente['Nombre_Cliente']); ?></td>
                                    <td><?= htmlspecialchars($cliente['Apellido_Cliente']); ?></td>
                                    <td><?= htmlspecialchars($cliente['Direccion_Cliente']); ?></td>
                                    <td><?= htmlspecialchars($cliente['Telefono_Cliente']); ?></td>
                                    <td><?= htmlspecialchars($cliente['DPI_CUI']); ?></td>
                                    <td class="action-buttons">
                                        <a href="<?= base_url('ClienteCrud/editarCliente/'.$cliente['Id_Cliente']); ?>" class='btn btn-primary btn-sm'>Editar</a>
                                        <a href="<?= base_url('ClienteCrud/eliminarCliente/'.$cliente['Id_Cliente']); ?>" class='btn btn-danger btn-sm' onclick='return confirm("¿Estás seguro de que quieres eliminar este cliente?");'>Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">No hay clientes registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#clientes-list').DataTable({
                "language": {
            "search": "Buscar:",          // Cambia "Search" a "Buscar"
            "paginate": {
                "next": "Siguiente",       // Cambia "Next" a "Siguiente"
                "previous": "Atrás"        // Cambia "Previous" a "Atrás"
            }
          },
                "pageLength": 7,        // Mostrar 8 filas por página
                "lengthChange": false,  // Desactivar la opción de cambiar el número de filas
                "ordering": false,               // Desactiva el ordenamiento
                "searching": true,      // Mantener la opción de búsqueda
                "paging": true,         // Habilitar la paginación
                "info": false           // Ocultar la información del estado de la tabla

            });
        });
    </script>
</body>
</html>
