<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
    background-image: url("<?= base_url('images/mecanica1.jpg'); ?>");
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat; 
    filter: blur(0px); 
    }
        .container {
            max-width: 600px;
            height: 450px;
            margin-top: 10px; 
        }
        .form-container {
            border: 1px solid #000000; 
            border-radius: 15px; 
            padding: 20px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            background-color: #f8f9fa; 
        }
        h2 {
            color: #000000; 
        }
        .form-group label {
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container"> <!-- Clase personalizada para el formulario -->
            <h2 class="text-center">Editar Usuario</h2>
            <form action="<?= base_url('actualizar-admin'); ?>" method="post">
                <input type="hidden" id="editar_id_usuario" name="id_usuario" value="<?= $cliente_obj['Id_Usuario']; ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="editar_nombre_usuario">Nombre</label>
                        <input type="text" class="form-control" id="editar_nombre_usuario" name="nombre_usuario" value="<?= $cliente_obj['Nombre_Usuario']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="editar_apellido_usuario">Apellido</label>
                        <input type="text" class="form-control" id="editar_apellido_usuario" name="apellido_usuario" value="<?= $cliente_obj['Apellido_Usuario']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="editar_direccion_usuario">Dirección</label>
                    <input type="text" class="form-control" id="editar_direccion_usuario" name="direccion_usuario" value="<?= $cliente_obj['Direccion_Usuario']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editar_correo_usuario">Correo Electrónico</label>
                    <input type="email" class="form-control" id="editar_correo_usuario" name="correo_usuario" value="<?= $cliente_obj['Correo_Usuario']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editar_telefono_usuario">Teléfono</label>
                    <input type="number" class="form-control" id="editar_telefono_usuario" name="telefono_usuario" value="<?= $cliente_obj['Telefono']; ?>" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="editar_usuario_asignado">Usuario Asignado</label>
                        <input type="text" class="form-control" id="editar_usuario_asignado" name="usuario_asignado" value="<?= $cliente_obj['Usuario_Asignado']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="editar_contraseña_asignada">Contraseña</label>
                        <input type="password" class="form-control" id="editar_contraseña_asignada" name="contraseña_asignada" placeholder="Ingrese nueva contraseña si desea cambiarla">
                        <small class="form-text text-muted">Deje este campo vacío si no desea cambiar la contraseña.</small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fecha_registro">Fecha de Registro</label>
                    <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" value="<?= $cliente_obj['Fecha_Registro']; ?>" readonly>
                </div>
                <div class="text-center">
                    <a href="<?= base_url('configuraciones'); ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
