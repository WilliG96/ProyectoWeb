<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/vehiculo.css'); ?>">
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

    .btn {
    margin-right: 10px; /* Ajusta el valor según la separación deseada */
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
                <h1>Vehículos Registrados</h1>
            </header>

            <div class="text-center mb-4">
                <!-- Botones para abrir modales -->
                <button type="button" id="btn-agregar-tipo" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipo">Agregar Tipo de Vehículo</button>
                <button type="button" id="btn-agregar-vehiculo" class="btn btn-secondary" data-toggle="modal" data-target="#modalAgregarVehiculo">Agregar Vehículo</button>
            </div>

            <!-- Ventana Modal para Agregar Nuevo Tipo de Vehículo -->
            <div class="modal fade" id="modalAgregarTipo" tabindex="-1" role="dialog" aria-labelledby="modalAgregarTipoLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAgregarTipoLabel">Agregar Tipo de Vehículo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('agregar-TipoVehiculo'); ?>" method="post">
                                <div class="form-group">
                                    <label for="nombre_tipo">Nombre del Tipo de Vehículo:</label>
                                    <input type="text" class="form-control" id="nombre_tipo" name="nombre_tipo" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Ventana Modal para Agregar Nuevo Vehículo -->
            <div class="modal fade" id="modalAgregarVehiculo" tabindex="-1" role="dialog" aria-labelledby="modalAgregarVehiculoLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAgregarVehiculoLabel">Registrar Vehículo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('guardar-Vehiculo'); ?>" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="marca">Marca:</label>
                                        <input type="text" class="form-control" id="marca" name="marca" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="linea">Línea:</label>
                                        <input type="text" class="form-control" id="linea" name="linea" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="tipo_vehiculo">Tipo de Vehículo:</label>
                                        <select class="form-control" id="tipo_vehiculo" name="tipo_vehiculo" required>
                                            <option value="">Seleccionar Tipo</option>
                                            <?php foreach ($tipos as $tipo): ?>
                                                <option value="<?= $tipo['Id_Tipo_Vehiculo']; ?>"><?= htmlspecialchars($tipo['Nombre_Tipo_Vehiculo']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Registrar Vehículo</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla de Vehículos Registrados -->
            <div class="table-responsive">
                <table class="table table-bordered" id="vehiculos-list">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Marca</th>
                            <th>Línea</th>
                            <th>Tipo de Vehículo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($vehiculos)): ?>
                            <?php foreach ($vehiculos as $vehiculo): ?>
                                <tr>
                                    <td><?= htmlspecialchars($vehiculo['Id_Vehiculo']); ?></td>
                                    <td><?= htmlspecialchars($vehiculo['Marca']); ?></td>
                                    <td><?= htmlspecialchars($vehiculo['Linea']); ?></td>
                                    <td><?= htmlspecialchars($vehiculo['tipo_vehiculo_nombre']); ?></td>
                                    <td class="action-buttons">
                                        <a href="<?= base_url('TallerCrud/editarVehiculo/'.$vehiculo['Id_Vehiculo']); ?>" class='btn btn-primary btn-sm'>Editar</a>
                                        <a href="<?= base_url('TallerCrud/eliminarVehiculo/'.$vehiculo['Id_Vehiculo']); ?>" class='btn btn-danger btn-sm' onclick='return confirm("¿Estás seguro de que quieres eliminar este vehículo?");'>Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No hay clientes registrados.</td>
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
            $('#vehiculos-list').DataTable({
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

