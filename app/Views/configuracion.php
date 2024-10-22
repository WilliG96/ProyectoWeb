<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuraciones</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/configuracion.css'); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
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

     /* Estilos de la barra lateral */
     .barra-lateral {
        width: 48px; /* Barra colapsada mostrando solo los iconos */
        background: #000000;
        color: white;
        padding: 15px;
        transition: width 0.3s;
        overflow: hidden;
        white-space: nowrap;
    }

    .barra-lateral h3 {
        display: none; /* Ocultar el título en la barra colapsada */
    }

    .barra-lateral ul {
        list-style-type: none;
        padding: 0;
    }

    .barra-lateral ul li {
        margin: 10px 0;
    }

    .barra-lateral ul li a {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .barra-lateral ul li a i {
        margin-right: 15px; /* Espacio entre el icono y el texto */
    }

    /* Expandir la barra lateral cuando se pasa el ratón sobre ella */
    .barra-lateral:hover {
        width: 250px;
    }

    /* Mostrar el título y el texto de los enlaces cuando la barra esté expandida */
    .barra-lateral:hover h3 {
        display: block;
    }

    .barra-lateral:hover ul li a span {
        display: inline;
    }

    /* Ocultar el texto cuando está colapsada */
    .barra-lateral ul li a span {
        display: none;
    }

    .header-titulo {
    background-color: #000000; /* Fondo gris */
    color: white; /* Letras blancas */
    text-align: center; /* Centrar el texto */
    padding:0px 0; /* Espaciado vertical */
    font-weight: bold; /* Texto en negrita */
    margin-bottom: 0; /* Asegúrate de que no haya margen inferior */
    }

    .header-titulo h2 {
        color: #ffffff;
    }

    .header-titulo2 h3 {
        color: #ffffff;
    }

    h5{
        color: #ffffff;
        font-weight: bold;
    }

    .usuario-logueado {
        margin-left: -140px; /* Ajusta el valor según sea necesario */
        padding-left: -140px; /* Ajusta el valor según sea necesario */
    }

    </style>
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

 <div class="contenido-principal">
    <div class="container mt-4">
        <div class="header-titulo2">
            <h3>Administradores del Taller</h3>
        </div>
        <!-- Sección de Usuario Logueado y Botón para Agregar Usuario -->
        <div class="row mb-4">
        <div class="col-md-6 usuario-logueado">
            <h5>Usuario Logueado: <strong>
                <?= session()->has('usuario') ? session()->get('usuario')['username'] : 'No hay usuario logueado'; ?>
            </strong></h5>
        </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
                    Agregar Nuevo Usuario
                </button>
            </div>
        </div>


                <!-- Tabla de Clientes Registrados -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="clientes-list">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Dirección</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($usuarios)): ?>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($usuario['Id_Usuario']); ?></td>
                                        <td><?= htmlspecialchars($usuario['Nombre_Usuario']); ?></td>
                                        <td><?= htmlspecialchars($usuario['Usuario_Asignado']); ?></td>
                                        <td><?= htmlspecialchars($usuario['Direccion_Usuario']); ?></td>
                                        <td><?= htmlspecialchars($usuario['Correo_Usuario']); ?></td>
                                        <td><?= htmlspecialchars($usuario['Telefono']); ?></td>
                                        <td><?= $usuario['Estado'] == 1 ? 'Activo' : 'Inactivo'; ?></td>
                                        <td class="action-buttons">
                                        <a href="<?= base_url('obtenerUsuario/' . $usuario['Id_Usuario']); ?>" class='btn btn-primary btn-sm'>Editar</a>
                                            <?php if ($usuario['Estado'] == 1): ?>
                                                <a href="<?= base_url('inhabilitarUsuario/' . $usuario['Id_Usuario']); ?>" class='btn btn-danger btn-sm' onclick='return confirm("¿Seguro que quieres inhabilitar el usuario?");'>Inhabilitar</a>
                                            <?php else: ?>
                                                <a href="<?= base_url('activarUsuario/' . $usuario['Id_Usuario']); ?>" class='btn btn-success btn-sm' onclick='return confirm("¿Seguro que quieres activar el usuario?");'>Activar</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9">No hay usuarios registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>


<!-- Modal para Agregar Usuario -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalAgregarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarUsuarioLabel">Agregar Nuevo Administrador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('agregar-admin'); ?>" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre_usuario">Nombre</label>
                            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Ingrese el nombre " required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido_usuario">Apellido</label>
                            <input type="text" class="form-control" id="apellido_usuario" name="apellido_usuario" placeholder="Ingrese el apellido " required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion_usuario">Dirección</label>
                        <input type="text" class="form-control" id="direccion_usuario" name="direccion_usuario" placeholder="Ingrese la dirección " required>
                    </div>
                    <div class="form-group">
                        <label for="correo_usuario">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo_usuario" name="correo_usuario" placeholder="Ingrese el correo o" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_usuario">Teléfono</label>
                        <input type="number" class="form-control" id="telefono_usuario" name="telefono_usuario" placeholder="Ingrese el teléfono " required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="usuario_asignado">Usuario Asignado</label>
                            <input type="text" class="form-control" id="usuario_asignado" name="usuario_asignado" placeholder="Ingrese el usuario asignado" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contraseña_asignada">Contraseña</label>
                            <input type="password" class="form-control" id="contraseña_asignada" name="contraseña_asignada" placeholder="Ingrese la contraseña asignada" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <!-- Botón de enviar sin el atributo form -->
                        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
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
            $('#clientes-list').DataTable({
                "language": {
            "search": "Buscar:",          // Cambia "Search" a "Buscar"
            "paginate": {
                "next": "Siguiente",       // Cambia "Next" a "Siguiente"
                "previous": "Atrás"        // Cambia "Previous" a "Atrás"
            }
          },
                "pageLength": 5,        // Mostrar 6 filas por página
                "lengthChange": false,  // Desactivar la opción de cambiar el número de filas
                "ordering": false,               // Desactiva el ordenamiento
                "searching": false,      // Mantener la opción de búsqueda
                "paging": true,         // Habilitar la paginación
                "info": false           // Ocultar la información del estado de la tabla

            });


        });
    </script>
</body>
</html>
