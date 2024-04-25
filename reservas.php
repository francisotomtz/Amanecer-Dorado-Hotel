<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas | Amanecer Dorado Hotel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/d7d7972f93.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/stylesReservas.css">
    <link rel="shortcut icon" href="img/icono.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bnConf">
        <a class="navbar-brand" href="index.html"><i class="fa-solid fa-mountain-sun"></i> Amanecer Dorado</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active aconf">
                    <a class="nav-link" href="index.html">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item aconf">
                    <a class="nav-link" href="habitaciones.html">Habitaciones</a>
                </li>
                <li class="nav-item aconf">
                    <a class="nav-link" href="servicios.html">Servicios</a>
                </li>
                <li class="nav-item aconf">
                    <a class="nav-link" href="reservas.php">Reservas</a>
                </li>
                <li class="nav-item aconf">
                    <a class="nav-link" href="contacto.html">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>

    <section id="seccion_reserva">
        <div id="formulario-container" class="container">
            <h2 class="text-center mb-4">Reservación</h2>

            <form id="formularioPrincipal" action="php/procesarReserva.php" method="post" onsubmit="return validarYGuardarInformacion()">
                <div class="form-section active" id="seccion1">
                    <div class="form-group">
                        <label for="fecha-llegada">Selecciona tu fecha de llegada:</label>
                        <input type="date" id="fecha-llegada" name="fecha-llegada" onchange="actualizarFechaSalidaMin()" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="fecha-salida">Selecciona tu fecha de salida:</label>
                        <input type="date" id="fecha-salida" name="fecha-salida" class="form-control" disabled>
                    </div>

                    <button type="button" onclick="agendar()" class="btn btn-primary" id="btnSiguiente1">siguiente</button>
                </div>

                <div class="form-section" id="seccion2">
                    <div class="form-group">
                        <label for="apPaterno">Ingresa tu apellido paterno:</label>
                        <input type="text" id="apPaterno" name="apPaterno" class="form-control noPegar" oninput="validarInputTexto(this, /^[A-Za-zÁ-ú\s]+$/, 20)">
                    </div>
                    <div class="form-group">
                        <label for="apMaterno">Ingresa tu apellido materno:</label>
                        <input type="text" id="apMaterno" name="apMaterno" class="form-control noPegar"
                            oninput="validarInputTexto(this, /^[A-Za-zÁ-ú\s]+$/, 20)">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Ingresa tu nombre(s):</label>
                        <input type="text" id="nombre" name="nombre" class="form-control noPegar"
                            oninput="validarInputTexto(this, /^[A-Za-zÁ-ú\s]+$/, 30)">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Ingresa tu dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control noPegar"
                            oninput="validarInputDireccion(this)">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Ingresa tu no. de teléfono:</label>
                        <input type="text" id="telefono" name="telefono" class="form-control noPegar"
                            oninput="validarInputNumero(this, /^[0-9]+$/, 16)">
                    </div>
                    <div class="form-group">
                        <label for="correo">Ingresa tu correo electrónico:</label>
                        <input type="email" id="correo" name="correo" class="form-control noPegar" oninput="validarCorreo()">
                    </div>
                    <button type="button" onclick="regresarSeccion(1)" class="btn btn-secondary mr-2" id="btnRegresar2">regresar</button>
                    <button type="button" onclick="validarFormulario()" class="btn btn-primary" id="btnSiguiente2">siguiente</button>
                </div>

                <div class="form-section" id="seccion3">
                    <div class="form-group">
                        <label for="habitacion">Selecciona tu(s) habitación(es):</label>
                        <?php
                            include 'php/obtenerHabitaciones.php';
                        ?>
                    </div>

                    <button type="button" onclick="agregarHabitacionDesdeBoton()" class="btn btn-primary">Agregar</button>

            <div class="form-group">
                <div id="habitacion-table-container">
                    <h4 class="mt-4">Habitaciones a reservar:</h4>
                    <table id="habitacion-table" class="table">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Habitación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="habitacion-tbody"></tbody>
                    </table>
                    <p id="precio-total">Precio total: $0 MXN</p>
                </div>
            </div>

            <input type="hidden" id="informacionInvisible" name="informacionInvisible">
                    <button type="button" onclick="regresarSeccion(2)" class="btn btn-secondary mr-2" id="btnRegresar3">Regresar</button>
                </div>

                <br>
                <button type="submit" class="btn btn-success">Enviar Reserva</button>
            </form>

        </div>
    </section>

    <section id="aux">
    </section>

    <script src="https://code.jquery.com/jquery-1.9.1.min.js" integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/funcionesReservas.js"></script>


</body>

</html>