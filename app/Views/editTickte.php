<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Datos del Cliente</title>
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
            max-width: 700px;
            margin-top: 20px;
        }
        .form-container {
            border: 1px solid #000000; 
            border-radius: 10px; 
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
        <div class="form-container">
            <h2 class="text-center">Actualizar Estado del Ticket</h2>
            <form action="<?= base_url('editar-ticket'); ?>" method="post" class="mt-4">
                <input type="hidden" name="id_ticket" value="<?= $tickets[0]['Id_Ticket']; ?>">

                <div class="form-group">
                    <label for="nombre_cliente">Nombre del Cliente</label>
                    <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" value="<?= htmlspecialchars($tickets[0]['nombre']); ?>" readonly>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="placa_vehiculo">Placa</label>
                        <input type="text" class="form-control" id="placa_vehiculo" name="placa_vehiculo" value="<?= htmlspecialchars($tickets[0]['Placa_Vehiculo']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="anio_vehiculo">Año del Vehículo</label>
                        <input type="text" class="form-control" id="anio_vehiculo" name="anio_vehiculo" value="<?= htmlspecialchars($tickets[0]['Año_Vehiculo']); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                        <label for="descripcion_problema">Descripción del Problema</label>
                        <textarea class="form-control" id="descripcion_problema" name="descripcion_problema" rows="3" required><?= htmlspecialchars($tickets[0]['Descripcion_Problema']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="usuario_registro">Usuario que Registró</label>
                    <input type="text" class="form-control" id="usuario_registro" value="<?= htmlspecialchars($tickets[0]['usuario']); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                        <option value="">Seleccione el estado</option>
                        <option value="1" <?= $tickets[0]['Estado'] == 1 ? 'selected' : '' ?>>Pendiente</option>
                        <option value="2" <?= $tickets[0]['Estado'] == 2 ? 'selected' : '' ?>>En Proceso</option>
                        <option value="0" <?= $tickets[0]['Estado'] == 0 ? 'selected' : '' ?>>Finalizado</option>
                    </select>
                </div>

                <div class="text-center">
                    <a href="<?= base_url('inicio-taller'); ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>