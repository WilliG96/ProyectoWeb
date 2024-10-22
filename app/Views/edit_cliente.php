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
            <h2 class="text-center">Actualizar Datos del Cliente</h2>
            <form action="<?= base_url('editar-cliente'); ?>" method="post">
                <input type="hidden" id="id_cliente" name="id_cliente" value="<?= $cliente[0]['Id_Cliente']; ?>">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre_cliente">Nombre del Cliente</label>
                        <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" value="<?= $cliente[0]['Nombre_Cliente']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellido_cliente">Apellido del Cliente</label>
                        <input type="text" class="form-control" id="apellido_cliente" name="apellido_cliente" value="<?= $cliente[0]['Apellido_Cliente']; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="telefono_cliente">Teléfono</label>
                        <input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente" value="<?= $cliente[0]['Telefono_Cliente']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dpi_cui">DPI/CUI</label>
                        <input type="text" class="form-control" id="dpi_cui" name="dpi_cui" value="<?= $cliente[0]['DPI_CUI']; ?>" required>
                    </div>
                </div>


        <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id_departamento">Departamento</label>
                        <select class="form-control" id="id_departamento" name="id_departamento" required>
                            <option value="" disabled>Seleccione un departamento</option>
                            <?php foreach ($departamentos as $departamento): ?>
                                <option value="<?= $departamento['Id_Departamento'] ?>"
                                    <?= $cliente[0]['Id_Departamento'] == $departamento['Id_Departamento'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($departamento['Nombre_Departamento']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_municipio">Municipio</label>
                        <select class="form-control" id="id_municipio" name="id_municipio" required>
                            <option value="" disabled>Seleccione un municipio</option>
                            <?php foreach ($municipios as $municipio): ?>
                                <option value="<?= $municipio['Id_Municipio'] ?>"
                                    <?= $cliente[0]['Id_Municipio'] == $municipio['Id_Municipio'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($municipio['Nombre_Municipio']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="fecha_registro">Fecha de Registro</label>
                    <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" value="<?= $cliente[0]['Fecha_Registro']; ?>" readonly>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" id="estado" 
                            value="<?= $cliente[0]['Estado'] == 1 ? 'Activo' : 'Inactivo'; ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_usuario">Usuario</label>
                        <input type="text" class="form-control" id="id_usuario" name="id_usuario" value="<?= $cliente[0]['usuario']; ?>" readonly>
                    </div>
                </div>

                <div class="text-center">
                    <a href="<?= base_url('ver-Cliente'); ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Script para actualizar municipios dinámicamente -->
        <script>
        $(document).ready(function() {
            $('#id_departamento').change(function() {
                var idDepartamento = $(this).val(); 
                
                console.log('ID Departamento:', idDepartamento); 

                
                $.ajax({
                    url: '<?= base_url('getMunicipiosByDepartamento'); ?>/' + idDepartamento,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response); 
                        var municipios = $('#id_municipio');
                        municipios.empty(); 

                        
                        municipios.append('<option value="" disabled selected>Seleccione un municipio</option>');

                        $.each(response, function(index, municipio) {
                            municipios.append('<option value="' + municipio.Id_Municipio + '">' + municipio.Nombre_Municipio + '</option>');
                        });
                    },
                    error: function() {
                        alert('Error al cargar los municipios.');
                    }
                });
            });
        });
</script>

</body>
</html>

