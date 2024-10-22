<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios Mecánicos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/servicios.css'); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    
    <!-- Título Taller W&C -->
    <div class="header-titulo">
        <h2>Taller W&C</h2>
    </div>

    <div class="contenedor">
        <!-- Barra lateral -->
        <nav class="barra-lateral">
            <h3>Taller Mecánico</h3>
            <ul>
                <li><a href="<?= base_url('inicio-taller'); ?>"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="<?= base_url('crear-ticket'); ?>"><i class="fas fa-plus-circle"></i> Crear Nuevo Ticket</a></li>
                <li><a href="<?= base_url('ver-Cliente') ?>"><i class="fas fa-users"></i> Clientes</a></li>
                <li><a href="<?= base_url('registrar-cliente') ?>"><i class="fas fa-user-plus"></i> Crear Nuevo Cliente</a></li>
                <li><a href="<?= base_url('registro-vehiculo') ?>"><i class="fas fa-car"></i> Registrar Vehículo</a></li>
                <li><a href="<?= base_url('servicios') ?>"><i class="fas fa-cogs"></i> Servicios</a></li>
                <li><a href="<?= base_url('configuraciones') ?>"><i class="fas fa-cog"></i> Configuraciones</a></li>
                <li><a href="<?= base_url('salir'); ?>"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            </ul>
        </nav>

        <!-- Contenido principal -->
        <div class="contenido-principal">
            <header>
                <h2>Servicios Del Taller</h2>
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

                <!-- Formulario de búsqueda -->
                <div class="search-form">
                <a href="<?= base_url('servicios') ?>" class="volver-enlace">Volver a ver todos los servicios</a>
                    <form id="formBuscar" method="post" action="<?= base_url('verPorId'); ?>"> 
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Ingrese ID" id="busqueda" name="busqueda" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" id="btnBuscar">Buscar</button>
                                <br>

                            </div>
                        </div>
                    </form>
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
                            <th>Estado</th>
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
                                    <td><?= $servicio['Estado'] == 1 ? 'Activo' : 'Inactivo'; ?></td>
                                        <td class="action-buttons">
                                        <a href="<?= base_url('obtenerServicio/' . $servicio['Id_Servicio']); ?>" class='btn btn-primary btn-sm'>Editar</a>
                                            <?php if ($servicio['Estado'] == 1): ?>
                                                <a href="<?= base_url('inhabilitar/' . $servicio['Id_Servicio']); ?>" class='btn btn-danger btn-sm' onclick='return confirm("¿Seguro que quieres inhabilitar el servicio?");'>Inhabilitar</a>
                                            <?php else: ?>
                                                <a href="<?= base_url('activar/' . $servicio['Id_Servicio']); ?>" class='btn btn-success btn-sm' onclick='return confirm("¿Quieres activar el servicio?");'>Activar</a>
                                            <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No hay servicios registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Cargar scripts en el orden correcto -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#clientes-list').DataTable({
                "language": {
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Atrás"
                    }
                },
                "pageLength": 5,
                "lengthChange": false,
                "ordering": false,
                "searching": false,
                "paging": true,
                "info": false
            });
        });
    </script>
</body>
</html>
