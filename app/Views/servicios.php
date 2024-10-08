<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serivicios Mecánicos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/servicio.css'); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style>
    .table-responsive {
        max-height: 500px; 
        overflow-y: auto; 
        position: relative; 
    }

    .table-responsive table {
        background-color: white; /* Fondo semitransparente */
        backdrop-filter: blur(10px); /* Desenfoque en el fondo */
        border-radius: 15px; /* Bordes redondeados */
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
    h1{
        color: #ffffff;
        font-weight: bold;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
       color: white !important;     /* Siempre blanco */
       font-weight: bold !important; /* Siempre en negrita */
       background-color: transparent; /* Fondo transparente */
       border: none;                 /* Sin bordes */
    }

    .modal-content {
    border-radius: 20px; /* Ajusta el valor según lo redondeado que desees */
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
                <h1>Servicios Del Taller</h1>
            </header>

            <!-- Botón para abrir el modal -->
            <div class="text-center mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarServicio">
                    Agregar Servicio
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalAgregarServicio" tabindex="-1" role="dialog" aria-labelledby="modalAgregarServicioLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAgregarServicioLabel">Agregar Nuevo Servicio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario dentro del modal -->
                            <form action="<?= base_url('guardar-servicio'); ?>" method="post" id="formAgregarServicio">
                                <div class="form-group">
                                    <label for="servicio">Nombre Servicio:</label>
                                    <input type="text" class="form-control" id="servicio" name="servicio" required>
                                </div>
                                <div class="form-group">
                                    <label for="costo">Costo Servicio:</label>
                                    <input type="number" class="form-control" id="costo" name="costo" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" form="formAgregarServicio">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Servicios Registrados -->
            <div class="table-responsive">
                <table class="table table-bordered" id="clientes-list">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Servicio</th>
                            <th>Costo Estimado</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($servicios)): ?>
                            <?php foreach ($servicios as $servicio): ?>
                                <tr>
                                    <td><?= htmlspecialchars($servicio['Id_Servicio']); ?></td>
                                    <td><?= htmlspecialchars($servicio['Nombre_Servicio']); ?></td>
                                    <td><?= htmlspecialchars($servicio['Costo_Servicio']); ?></td>
                                    <td><?= htmlspecialchars($servicio['usuario']); ?></td>
                                    <td class="action-buttons">
                                        <a href="<?= base_url('ClienteCrud/editarCliente/'.$servicio['Id_Servicio']); ?>" class='btn btn-primary btn-sm'>Editar</a>
                                        <a href="<?= base_url('ClienteCrud/eliminarCliente/'.$servicio['Id_Servicio']); ?>" class='btn btn-danger btn-sm' onclick='return confirm("¿Estás seguro de que quieres eliminar este cliente?");'>Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">No hay servicios registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#servicios-list').DataTable({
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
