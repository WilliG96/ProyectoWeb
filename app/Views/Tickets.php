<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>
<style>
    /* Estilos generales */
    body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #ebebeb; 
    background-image: url('<?php echo base_url('images/0.jpg'); ?>'); 
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat; 
    position: relative;
    overflow: hidden;
}

.container {
    margin-top: 30px;
}

/* Estilos para los encabezados */
.header-titulo, .header-titulo2 {
    text-align: center;
    margin-bottom: 20px;
}

.header-titulo h2, .header-titulo2 h2 {
    font-size: 28px;
    font-weight: bold;
    color: #ffffff;
}

.header-titulo2 p {
    font-size: 18px;
    color: #ffffff;
}
/* Estilos del formulario de búsqueda */
.search-form {
    margin-bottom: 30px;
}

.search-form input[type="number"] {
    border-radius: 5px;
    padding: 10px;
    border: 1px solid #ced4da;
    font-size: 16px;
    width: 100%;
}

.search-form button {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
}

.search-form button:hover {
    background-color: #0056b3;
}

/* Estilos para la tabla */
.table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

.table thead {
    background-color: #0000;
    color: white; 
}

.table th, .table td {
    padding: 12px 15px; 
    text-align: center; 
    color: #000000; 
    background-color: white; 
}

.table-responsive{
    border-radius: 15px;
}

.table th {
    font-size: 18px; 
}

.table tbody tr:nth-child(even) {
    background-color: #f2f2f2; 
}

.table tbody tr:hover {
    background-color: #e9ecef; 
}


.action-buttons .btn {
    margin-right: 5px;
}

h1{
    color: white;
}

/* Estilos del modal */
.modal-header {
    background-color: #343a40;
    color: white;
}

.modal-body p {
    font-size: 16px;
    margin-bottom: 10px;
}

.modal-footer button {
    background-color: #6c757d;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
}

.modal-footer button:hover {
    background-color: #5a6268;
}

/* Estilos para botones de acción */
.btn-info {
    background-color: #17a2b8;
    color: white;
}

.btn-info:hover {
    background-color: #138496;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

</style>
<body>

    <div class="container mt-4">
        <div class="header-titulo2">
            <h1>BIENVENIDO BUSCA TU TICKET</h1>
            <P>Ingresa tu numero de ticket para obtener informacion</P>
            <!-- Formulario de búsqueda -->
            <div class="search-form">
                <form id="formBuscar" method="post" action="<?= base_url('Ticket'); ?>"> 
                    <div class="input-group" style="display: flex; align-items: center; justify-content: flex-end; max-width: 300px; float: right;">
                        <input type="number" class="form-control" placeholder="Ingrese número de Ticket" id="buscar" name="buscar" required style="margin-right: 10px;">
                        <button class="btn btn-black text-white" type="submit" id="btnBuscar">Buscar</button>
                        <!-- Botón de regresar -->
                        <a href="<?= base_url('Consultas'); ?>" class="btn btn-secondary" style="margin-left: 10px;">Regresar</a>
                    </div>
                </form>
            </div>
        <!-- Tabla de Tickets -->
        <div class="table-responsive">
            <table class="table table-bordered" id="ticket-list">
                <thead>
                    <tr>
                        <th># Ticket</th>
                        <th>Cliente</th>
                        <th>Vehiculo</th>
                        <th>Servicio</th>
                        <th>Placa</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tickets)): ?>
                        <?php foreach ($tickets as $ticket): ?>
                            <tr>
                                <td><?= htmlspecialchars($ticket['Id_Ticket']); ?></td>
                                <td><?= htmlspecialchars($ticket['nombre']); ?></td>
                                <td><?= htmlspecialchars($ticket['linea']); ?></td>
                                <td><?= htmlspecialchars($ticket['servicio']); ?></td>
                                <td><?= htmlspecialchars($ticket['Placa_Vehiculo']); ?></td>
                                <td><?= htmlspecialchars($ticket['fecha_registro']); ?></td>
                                <td>
                                    <?php
                                    switch ($ticket['Estado']) {
                                        case 0:
                                            echo 'Finalizado'; // Estado 0 para Finalizado
                                            break;
                                        case 1:
                                            echo 'Pendiente'; // Estado 1 para Activo
                                            break;
                                        case 2:
                                            echo 'En Proceso'; // Estado 2 para En Proceso
                                            break;
                                        default:
                                            echo 'Desconocido'; // Para manejar cualquier otro valor inesperado
                                            break;
                                    }
                                    ?>
                                </td>
                                <td class="action-buttons">
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detallesModal" 
                                        data-id="<?= $ticket['Id_Ticket']; ?>" onclick="verDetalles(<?= $ticket['Id_Ticket']; ?>)">
                                        Ver
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">No hay tickets registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detallesModal" tabindex="-1" role="dialog" aria-labelledby="detallesModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detallesModalLabel">Detalles del Ticket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="d-flex justify-content-between mb-2">
          <p><strong>  ID Ticket:</strong> <span id="modalTicketId"></span></p>
          <p><strong>  Cliente #:</strong> <span id="modalTicketIdCliente"></span></p>
        </div>

        <div class="d-flex justify-content-between mb-2">
          <p><strong>Marca:</strong> <span id="modalTicketMarca"></span></p>
          <p><strong>Línea:</strong> <span id="modalTicketLinea"></span></p>
        </div>

        <div class="d-flex justify-content-between mb-2">
          <p><strong>Placa:</strong> <span id="modalTicketPlaca"></span></p>
          <p><strong>Año:</strong> <span id="modalTicketvehiculo"></span></p>
        </div>

        <div class="d-flex justify-content-between mb-2">
          <p><strong>Cliente:</strong> <span id="modalClienteNombre"></span></p>
          <p><strong>Teléfono:</strong> <span id="modalClienteTelefono"></span></p>
        </div>
        <p><strong>  Servicio:</strong> <span id="modalServicioNombre"></span></p>

        <div class="d-flex justify-content-between mb-2">
          <p><strong>Descripción del Problema:</strong> <span id="modalDescripcionProblema"></span></p>
        </div>

        <div class="d-flex justify-content-between mb-2">
          <p><strong>Fecha:</strong> <span id="modalFechaRegistro"></span></p>
          <p><strong>Hora:</strong> <span id="modalHoraRegistro"></span></p>
        </div>

        <div class="d-flex justify-content-between mb-2">
          <p><strong>Estado:</strong> <span id="modalEstado"></span></p>
          <p><strong>Usuario:</strong> <span id="modalUsuarioAsignado"></span></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
function verDetalles(idTicket) {
    // Realizar la llamada AJAX para obtener los detalles del ticket
    console.log('<?= base_url('verTicketModal'); ?>' + idTicket);
    $.ajax({
        url: '<?= base_url('verTicketModal/'); ?>' + idTicket,  // Añade una barra al final
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);  // Para verificar los datos en consola
            // Rellenar los campos del modal con los datos obtenidos
            $('#modalTicketId').text(response[0].Id_Ticket);
            $('#modalTicketIdCliente').text(response[0].cliente);  // response es un array
            $('#modalTicketMarca').text(response[0].marca);
            $('#modalTicketLinea').text(response[0].linea);
            $('#modalTicketPlaca').text(response[0].Placa_Vehiculo);
            $('#modalTicketvehiculo').text(response[0].vehiculo);
            $('#modalClienteNombre').text(response[0].nombre + ' ' + response[0].apellido);
            $('#modalClienteDireccion').text(response[0].direccion);
            $('#modalClienteTelefono').text(response[0].telefono);
            $('#modalUsuarioAsignado').text(response[0].usuario);
            $('#modalServicioNombre').text(response[0].servicio);
            $('#modalDescripcionProblema').text(response[0].Descripcion_Problema);
            
            switch (parseInt(response[0].Estado, 10)) {
                case 0:
                    $('#modalEstado').text('Finalizado');
                    break;
                case 1:
                    $('#modalEstado').text('Pendiente');
                    break;
                case 2:
                    $('#modalEstado').text('En Proceso');
                    break;
                default:
                    $('#modalEstado').text('Estado desconocido'); // En caso de que el estado no sea válido
            }

            $('#modalFechaRegistro').text(response[0].fecha_registro);
            $('#modalHoraRegistro').text(response[0].hora_registro);

            // Mostrar el modal
            $('#detallesModal').modal('show');
        },
        error: function() {
            alert('No se pudieron obtener los detalles del ticket.');
        }
    });
}

</script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</body>
</html>