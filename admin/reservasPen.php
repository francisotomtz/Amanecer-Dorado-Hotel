<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/d7d7972f93.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/stylesPanelAdm.css">
    <title>Panel Administrador | Reservas pendientes</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3" id="sidebar">
                <nav class="sidebar">
                    <h3 class="text-center">Panel Administrador</h3>
                    <h6 class="text-center"><i class="fa-solid fa-mountain-sun"></i> Amanecer Dorado Hotel</h6>
                    <hr id="separador">
                    <a href="panelPrincipal.html"> Inicio </a>
                    <a href="reservasPen.php">Reservas pendientes</a>
                    <a href="reservasAct.php">Reservas activas</a>
                    <a href="facturas.php">Facturas</a>
                    <a href="gestionHab.php">Gestión de habitaciones</a>
                </nav>
            </div>

            <div class="col-md-9" id="content">
                <h2 class="mt-4">Reservas pendientes</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th># de reserva</th>
                            <th>Información del cliente</th>
                            <th>Habitaciones</th>
                            <th>Fecha de llegada</th>
                            <th>Fecha de salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include('php-bd/consultarRPendientes.php');
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-1.9.1.min.js"
        integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/funcionesRPendientes.js"></script>

    <div class="modal fade" id="infoClienteModal" tabindex="-1" role="dialog" aria-labelledby="infoClienteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoClienteModalLabel">Información del cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="infoClienteBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infoHabitacionesModal" tabindex="-1" role="dialog"
        aria-labelledby="infoHabitacionesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoHabitacionesModalLabel">Asignación de habitaciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="infoHabitacionesBody">
                    <table class='table' id='eliminarHabitacionesTable'>
                        <tr>
                            <th>Número de habitación</th>
                            <th>Tipo de habitación</th>
                            <th>Acciones</th>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" onclick="enviarDatosAlServidor()">Asignar
                        habitaciones</button>
                </div>
            </div>
        </div>
    </div>



</body>

</html>