<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/principal.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <style>
        .form-container {
            max-width: 750px;
            height: 550px;
            top: 0;
            margin: 0 auto;
            padding: 15px;
            background-color: rgba(92, 90, 90, 0.2); 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(8px); 
        }

        .form-container label {
            color: #000000;       
            font-weight: bold;   
            font-size: 15px;     
        }

        .form-header {
            margin-bottom: 20px;
            text-align: center;
            color: #000000;
          
        }
        h2{
        color: #000000;
        font-weight: bold;
    }

     .barra-lateral {
        width: 48px; 
        background: #000000;
        color: white;
        padding: 15px;
        transition: width 0.3s;
        overflow: hidden;
        white-space: nowrap;
    }

    .barra-lateral h3 {
        display: none; 
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
        margin-right: 15px; 
    }

    .barra-lateral:hover {
        width: 250px;
    }

    .barra-lateral:hover h3 {
        display: block;
    }

    .barra-lateral:hover ul li a span {
        display: inline;
    }

    .barra-lateral ul li a span {
        display: none;
    }

    .header-titulo {
    background-color: #000000; 
    color: white; 
    text-align: center; 
    padding:0px 0; 
    font-weight: bold; 
    margin-bottom: 0; 
    }

.header-titulo h2 {
    color: #ffffff;
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

        <!-- Contenido principal -->
        <div class="contenido-principal">
            <div class="form-container">
                <h2 class="form-header">Crear Ticket</h2>
                <form action="<?= base_url('guardar-ticket'); ?>" method="post" class="mt-4">
                    <div class="form-group row">
                        <!-- Seleccionar Vehículo -->
                        <div class="col-md-6">
                            <label for="id_vehiculo">Seleccionar Vehículo</label>
                            <select class="form-control" id="id_vehiculo" name="id_vehiculo" required>
                                <option value="">Seleccione un vehículo</option>
                                <?php foreach ($vehiculos as $vehiculo): ?>
                                    <option value="<?= $vehiculo['Id_Vehiculo'] ?>"> <?= htmlspecialchars($vehiculo['Marca']); ?> &nbsp; <?= htmlspecialchars($vehiculo['Linea']); ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Seleccionar Servicio -->
                        <div class="col-md-6">
                            <label for="id_servicio">Seleccionar Servicio</label>
                            <select class="form-control" id="id_servicio" name="id_servicio" required>
                                <option value="">Seleccione un servicio</option>
                                <?php foreach ($servicios as $servicio): ?>
                                    <option value="<?= $servicio['Id_Servicio'] ?>"><?= htmlspecialchars($servicio['Nombre_Servicio']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <!-- Año del Vehículo -->
                        <div class="col-md-6">
                            <label for="anio_vehiculo">Año del Vehículo</label>
                            <input type="text" class="form-control" id="anio_vehiculo" name="anio_vehiculo" required placeholder="Ingrese el año del vehículo">
                        </div>

                        <!-- Placa del Vehículo -->
                        <div class="col-md-6">
                            <label for="placa_vehiculo">Placa del Vehículo</label>
                            <input type="text" class="form-control" id="placa_vehiculo" name="placa_vehiculo" required placeholder="Ingrese la placa del vehículo">
                        </div>
                    </div>

                    <div class="form-group row">
                        <!-- Estado -->
                        <div class="col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="">Seleccione el estado</option>
                                <option value="1">Pendiente</option>        <!-- 1 para Pendiente -->
                                <option value="2">En Proceso</option>       <!-- 2 para En Proceso -->
                                <option value="0">Finalizado</option>       <!-- 0 para Finalizado -->
                            </select>
                        </div>

                        <!-- Seleccionar Cliente -->
                        <div class="col-md-6">
                            <label for="id_cliente">Seleccionar Cliente</label>
                            <select class="form-control" id="id_cliente" name="id_cliente" required>
                                <option value="">Seleccione un cliente</option>
                                <?php foreach ($clientes as $cliente): ?>
                                    <option value="<?= $cliente['Id_Cliente'] ?>">
                                        <?= htmlspecialchars($cliente['Id_Cliente']) ?>: &nbsp; <?= htmlspecialchars($cliente['Nombre_Cliente']); ?> <?= htmlspecialchars($cliente['Apellido_Cliente']); ?> &nbsp; DPI: <?= htmlspecialchars($cliente['DPI_CUI']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <!-- Descripción del Problema -->
                    <div class="form-group">
                        <label for="descripcion_problema">Descripción del Problema</label>
                        <textarea class="form-control" id="descripcion_problema" name="descripcion_problema" rows="3" required></textarea>
                    </div>

                    <!-- Botón de Registrar Ticket -->
                    <button type="submit" class="btn btn-primary btn-block">Registrar Ticket</button>

                    <!-- Botón de Cancelar -->
                    <a href="<?= base_url('inicio-taller'); ?>" class="btn btn-secondary btn-block mt-2">Cancelar</a>
                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

                        <script>
                            $(document).ready(function() {
                                $('#id_cliente').select2({
                                    placeholder: 'Seleccione un cliente',
                                    allowClear: true,
                                    width: '100%' // Para que ocupe todo el ancho
                                });
                            });
                            </script>
</body>
</html>