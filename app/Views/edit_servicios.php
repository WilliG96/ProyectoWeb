<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Servicio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>  
    body {
    background-image: url("<?= base_url('images/mecanica1.jpg'); ?>");
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat; 
    filter: blur(0px); 
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
    <div class="container mt-5 d-flex justify-content-center">
        <div class="w-50 form-container"> <!-- Clase personalizada para el formulario -->
            <h2 class="text-center">Editar Servicio</h2>
            
            <form action="<?= base_url('actualizar-servicio'); ?>" method="post">
                <input type="hidden" name="id_servicio" value="<?= $servicios[0]['Id_Servicio']; ?>">

                <div class="form-group">
                    <label for="id_servicio">ID Servicio</label>
                    <input type="text" class="form-control" id="id_servicio" value="<?= $servicios[0]['Id_Servicio']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="nombre_servicio">Nombre del Servicio</label>
                    <input type="text" class="form-control" id="nombre_servicio" name="nombre_servicio" value="<?= $servicios[0]['Nombre_Servicio']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="costo_servicio">Costo del Servicio</label>
                    <input type="number" class="form-control" id="costo_servicio" name="costo_servicio" value="<?= $servicios[0]['Costo_Servicio']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="id_usuario">ID Usuario</label>
                    <input type="text" class="form-control" id="id_usuario" value="<?= $servicios[0]['usuario']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" class="form-control" id="estado" 
                        value="<?= $servicios[0]['Estado'] == 1 ? 'Activo' : 'Inactivo'; ?>" readonly>
                </div>

                <div class="text-center">
                    <a href="<?= base_url('servicios'); ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
