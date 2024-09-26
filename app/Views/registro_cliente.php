<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/cliente.css') ?>">
    <style>
        .form-container {
            max-width: 800px;
            margin: 15px auto;
            padding: 15px;
            background-color: rgba(92, 90, 90, 0.2); /* Cambia el 0.7 para ajustar la opacidad */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(10px); /* Aplica un desenfoque al fondo */
        }

        .form-container label {
            color: black;        /* Color del texto */
            font-weight: bold;   /* Texto en negrita */
            font-size: 15px;     /* Tamaño de fuente de 15px */
        }

        .form-header {
            margin-bottom: 30px;
            text-align: center;
            color: #000000;
          
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <!-- Barra lateral -->
        <nav class="barra-lateral">
            <h2>Taller Mecánico</h2>
            <ul>
                <li><a href="<?= base_url('inicio-taller'); ?>">Inicio</a></li>
                <li><a href="#">Tickets Activos</a></li>
                <li><a href="#">Crear Nuevo Ticket</a></li>
                <li><a href="#">Clientes</a></li>
                <li><a href="<?= base_url('registrar-cliente') ?>">Crear Nuevo Cliente</a></li>
                <li><a href="<?= base_url('registro-vehiculo') ?>">Registrar Vehículo</a></li>
                <li><a href="#">Configuraciones</a></li>
            </ul>
        </nav>

        <!-- Contenido principal -->
        <div class="contenido-principal">
            <div class="form-container">
                <h2 class="form-header">Registrar Nuevo Cliente</h2>

                <form action="<?= base_url('guardar-Cliente'); ?>" method="post" class="mb-4">

                    <!-- Otros campos del formulario -->
                    <div class="form-group">
                        <label for="nombre_cliente">Nombre</label>
                        <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder="Ingrese el nombre del cliente" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido_cliente">Apellido</label>
                        <input type="text" class="form-control" id="apellido_cliente" name="apellido_cliente" placeholder="Ingrese el apellido del cliente" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion_cliente">Dirección</label>
                        <input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente" placeholder="Ingrese la dirección del cliente" required>
                    </div>

                    <!-- Campos para municipio y departamento en una misma línea  -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_departamento">Departamento</label>
                            <select class="form-control" id="id_departamento" name="id_departamento" required>
                                <option value="" >Seleccione un departamento</option>
                                <?php foreach ($departamentos as $departamento): ?>
                                    <option value="<?= $departamento['Id_Departamento'] ?>"><?= htmlspecialchars($departamento['Nombre_Departamento']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_municipio">Municipio</label>
                            <select class="form-control" id="id_municipio" name="id_municipio" required>
                                <option value="" >Seleccione un municipio</option>
                                <?php foreach ($municipios as $municipio): ?>
                                    <option value="<?= $municipio['Id_Municipio'] ?>"><?= htmlspecialchars ($municipio['Nombre_Municipio']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                
                    <!-- Otros campos del formulario -->
                    <div class="form-row">
                         <div class="form-group col-md-6"> <!-- Ajusta el tamaño según sea necesario -->
                             <label for="dpi_cui">DPI/CUI</label>
                             <input type="number" class="form-control" id="dpi_cui" name="dpi_cui" placeholder="Ingrese el DPI/CUI del cliente" required>
                         </div>
                        <div class="form-group col-md-6">
                             <label for="telefono_cliente">Teléfono</label>
                             <input type="number" class="form-control" id="telefono_cliente" name="telefono_cliente" placeholder="Ingrese el teléfono del cliente" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Registrar Cliente</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

