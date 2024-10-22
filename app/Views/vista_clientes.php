<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Registrados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/vercliente.css'); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<style>
    .volver-enlace {
    display: block; 
    font-weight: bold; 
    color: white;
    font-size: 20px;
    text-align: right; 
    }
</style>
<body>
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
                <h2>Clientes del Taller</h2>
            </header>

            <!-- Formulario de búsqueda -->
            <div class="search-form">
            <a href="<?= base_url('ver-Cliente') ?>" class="volver-enlace">Ver todos los clientes</a>
                <form id="formBuscar" method="post" action="<?= base_url('verClientePorId'); ?>"> 
                    <div class="input-group" style="max-width: 350px; float: right;">
                        <input type="number" class="form-control" placeholder="Ingrese DPI Cliente" id="busqueda" name="busqueda" required>
                        <div class="input-group-append">
                            <button class="btn btn-black text-white" type="submit" id="btnBuscar">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
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
                            <th>Usuario</th>
                            <th>Estado</th>
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
                                    <td><?= htmlspecialchars($cliente['nombre_usuario']); ?></td>
                                    <td><?= $cliente['Estado'] == 1 ? 'Activo' : 'Inactivo'; ?></td>
                                        <td class="action-buttons">
                                        <a href="<?= base_url('obtenerCliente/' . $cliente['Id_Cliente']); ?>" class='btn btn-primary btn-sm'>Editar</a>
                                            <?php if ($cliente['Estado'] == 1): ?>
                                                <a href="<?= base_url('inhabilitarCliente/' . $cliente['Id_Cliente']); ?>" class='btn btn-danger btn-sm' onclick='return confirm("¿Seguro que quieres inhabilitar al cliente?");'>Inhabilitar</a>
                                            <?php else: ?>
                                                <a href="<?= base_url('activarCliente/' . $cliente['Id_Cliente']); ?>" class='btn btn-success btn-sm' onclick='return confirm("¿Quieres activar al cliente?");'>Activar</a>
                                            <?php endif; ?>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#clientes-list').DataTable({
                "language": {
            "search": "Buscar:",         
            "paginate": {
                "next": "Siguiente",       
                "previous": "Atrás"      
            }
          },
                "pageLength": 6,    
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
