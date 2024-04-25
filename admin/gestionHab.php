<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/d7d7972f93.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/stylesPanelAdm.css">
    <title>Panel Administrador | Gestión de habitaciones</title>
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
                <div class="container mt-5">
                    <h2>Gestión de habitaciones</h2>
                    <form method="post" action="php-bd/ingresarHab.php">
                        <div class="form-group">
                            <label for="numeroHabitacion">Número de habitación:</label>
                            <input type="number" class="form-control" id="numeroHabitacion" name="numeroHabitacion"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="tipoHabitacion">Tipo de habitación:</label>
                            <select class="form-control" id="tipoHabitacion" name="tipoHabitacion" required
                                onchange="actualizarPrecio()">
                                <option value="Individual" selected>Individual</option>
                                <option value="Doble">Doble</option>
                                <option value="Suite">Suite</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="text" class="form-control" id="precio" name="precio" readonly>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="Disponible">Disponible</option>
                                <option value="Limpieza">Limpieza</option>
                                <option value="Reparacion">Reparación</option>
                                <option value="Reservada">Reservada</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar habitación</button>
                    </form>
                </div>
                <div class="container mt-5">
                    <table class="table table-bordered" id="habitacionesTable">
                        <thead>
                            <tr>
                                <th onclick="sortTable(0)"># habitación</th>
                                <th onclick="sortTable(1)">Tipo de habitación</th>
                                <th onclick="sortTable(2)">Estado</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            include('php-bd/consultarHab.php');
                          ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/funcionesgestionHab.js"></script>

    <div class="modal fade" id="modalModificar" tabindex="-1" role="dialog" aria-labelledby="modalModificarLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModificarLabel">Modificar habitación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario dentro del modal -->
                    <form id="formularioModificar" method="post" action="php-bd/actualizarHab.php">
                        <div class="form-group">
                            <label for="numeroHabitacionModal">Número de habitación:</label>
                            <input type="text" id="numeroHabitacionModal" name="numeroHabitacion" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tipoHabitacionModal">Tipo de habitación:</label>
                            <input type="text" id="tipoHabitacionModal" name="tipoHabitacion" readonly>
                        </div>
                        <div class="form-group">
                            <label for="estadoHabitacionModal">Estado:</label>
                            <select id="estadoHabitacionModal" name="estado" class="form-control">
                                <option value="Disponible">Disponible</option>
                                <option value="Limpieza">Limpieza</option>
                                <option value="Reparacion">Reparación</option>
                                <option value="Reservada">Reservada</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>