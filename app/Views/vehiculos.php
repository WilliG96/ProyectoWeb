<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/vehiculos.css'); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
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
            <h3>Taller Mecánico</h3>
            <ul>
                <li><a href="<?= base_url('inicio-taller'); ?>">Inicio</a></li>
                <li><a href="#">Tickets Activos</a></li>
                <li><a href="#">Crear Nuevo Ticket</a></li>
                <li><a href="#">Clientes</a></li>
                <li><a href="#">Crear Nuevo Cliente</a></li>
                <li><a href="#">Configuraciones</a></li>
                <li><a href="<?= base_url('registro-vehiculo'); ?>">Registrar Vehículo</a></li>
            </ul>
        </nav>

        <!-- Contenido principal -->
        <div class="contenido-principal">
            <header>
                <h2>Registrar Vehículo</h2>
            </header>

            <!-- Formulario para agregar un nuevo vehículo -->
            <form action="<?= base_url('guardar-Vehiculo'); ?>" method="post" class="mb-4">
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

                <div class="text-center">
                    <button type="button" id="btn-agregar-tipo" class="btn btn-primary">Agregar Tipo de Vehículo</button>
                    <input type="submit" value="Registrar Vehículo" class="btn btn-success">
                </div>
            </form>

            <!-- Tabla de Vehículos Registrados -->
            <h2>Vehículos Registrados</h2>
            <div class="table-responsive">
                <table class="table table-bordered" id="vehiculos-list">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Marca</th>
                            <th>Línea</th>
                            <th>Tipo de Vehículo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Limitar a 10 registros por página
                        $limit = 10;
                        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $offset = ($currentPage - 1) * $limit;

                        // Obtener los vehículos para la página actual
                        $vehiculosPaginados = array_slice($vehiculos, $offset, $limit);
                        ?>

                        <?php if (!empty($vehiculosPaginados)): ?>
                            <?php foreach ($vehiculosPaginados as $vehiculo): ?>
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
                                <td colspan="5">No hay vehículos registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="pagination">
                <?php 
                // Calcular el número total de páginas
                $totalPages = ceil(count($vehiculos) / $limit);
                for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                <?php endfor; ?>
            </div>

            <!-- Ventana Modal para Agregar Nuevo Tipo de Vehículo -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Agregar Tipo de Vehículo</h2>
                    <form action="<?= base_url('agregar-TipoVehiculo'); ?>" method="post">
                        <label for="nombre_tipo">Nombre del Tipo de Vehículo:</label>
                        <input type="text" id="nombre_tipo" name="nombre_tipo" required>
                        <input type="submit" value="Agregar" class="btn btn-success mt-2">
                    </form>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Modal logic
                    var modal = document.getElementById("myModal");
                    var btn = document.getElementById("btn-agregar-tipo");
                    var span = document.getElementsByClassName("close")[0];

                    btn.onclick = function() {
                        modal.style.display = "block";
                    }

                    span.onclick = function() {
                        modal.style.display = "none";
                    }

                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                });
            </script>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#vehiculos-list').DataTable();
        });
    </script>
</body>
</html>