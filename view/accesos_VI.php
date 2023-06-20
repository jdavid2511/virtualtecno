<?php
class accesos_VI
{
    function __construct(){}
 
    function iniciarSesion()
    {
        require_once "lib/front_controller.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="30.png" />
    <title>tienda de telefonos</title>
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">
    <link href="build/css/custom.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <style>
    .toast {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    </style>

</head>

<body class="login">
    <!--img src="login.jpg"-->
    <div class="login">
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="../index.php" method="post" id="login">
                        <h1>Login Form</h1>
                        <div class="input-group mb-2">
                            <input type="email" name="correo" class="form-control" placeholder="Correo">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="contrasena" class="form-control" placeholder="Contraseña">
                        </div>
                        <div>
                            <button type="button" onclick="iniciarSesion()" class=" btn btn-success">Iniciar
                                Sesi&oacute;n</button>
                        </div>


                        <div class="form-footer text-center mt-5">
                            <p class="change_link">Aun no tienes cuenta? <a href="#signup"
                                    class="to_register">Resgistrate</a></p>
                        </div>
                        <div class="clearfix"></div>

                        <div class="separator">


                            <div class="clearfix"></div>


                            <div>

                                <p>virtualTecno</p>

                            </div>
                        </div>
                    </form>

            </div>

            <div id=" register" class="animate registration_form">
                <div class="login-area login-s2">
                    <div class="container">
                        <div class="login-box ptb--100">
                            <section class="login_content">
                                <form method="post" id="formulario_registrarse">
                                    <div class="login-form-head">
                                        <h4>REGISTRO</h4>
                                    </div>
                                    <div class="login-form-body">

                                        <div class="input-group mb-2">
                                            <input type="text" id="usuario" name="usuario" class="form-control"
                                                required="" placeholder="Usuario">
                                        </div>

                                        <div class="input-group mb-2">
                                            <input type="text" id="nombre" name="nombre" class="form-control"
                                                required="" placeholder="Nombre">
                                        </div>

                                        <div class="input-group mb-2">
                                            <input type="text" id="apellido" name="apellido" class="form-control"
                                                required="" placeholder="Apellido">
                                        </div>

                                        <div class="input-group mb-2">
                                            <input type="number" id="documento" name="documento" class="form-control"
                                                required="" placeholder="Documento">
                                        </div>
                                        <br>

                                        <div class="input-group mb-2">
                                            <input type="number" id="telefono" name="telefono" class="form-control"
                                                required="" placeholder="Telefono">
                                        </div>
                                        <br>

                                        <div class="input-group mb-2">
                                            <input type="email" id="correo" name="correo" class="form-control"
                                                required="" placeholder="Correo">
                                        </div>

                                        <div class="input-group mb-2">
                                            <input type="password" id="contrasena" name="contrasena"
                                                class="form-control" required="" placeholder="Contraseña">
                                        </div>


                                        <div class="submit-btn-area">
                                            <button type="button" onclick="registrar()"
                                                class=" btn btn-success">Registrarse</button>
                                        </div>
                                        <div class="form-footer text-center mt-5">
                                            <p class="change_link">Ya tienes cuenta? <a href="#"
                                                    class="to_register">Inicia
                                                    Sesion</a></p>
                                        </div>

                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</body>

</html>

<script>
function registrar() {

    var cadena = new FormData(document.querySelector('#formulario_registrarse'));

    fetch('./controllers/usuarios_CO.php', {
            method: 'POST',
            body: cadena
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {

            if (respuesta.estado == 'EXITO') {
                document.querySelector('#formulario_registrarse').reset();
                toastr.success(respuesta.mensaje);
            } else if (respuesta.estado = 'ERROR') {
                toastr.error(respuesta.mensaje);
            } else if (respuesta.estado = 'ADVERTENCIA') {
                toastr.warning(respuesta.mensaje);
            } else {
                toastr.error('No se devolvio un estado');
            }
        });
}

function salir() {
    $.post('accesos_CO/salir', function() {
        location.href = "index.php";
    });
}

function iniciarSesion() {

    var cadena = new FormData(document.querySelector('#login'));

    fetch('./controllers/accesos1_CO.php', {
            method: 'POST',
            body: cadena
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            if (respuesta.estado == 'EXITO') {
                toastr.success(respuesta.mensaje);
                location.href = "index.php";
            } else if (respuesta.estado = 'ERROR') {
                toastr.error(respuesta.mensaje);
            } else if (respuesta.estado = 'ADVERTENCIA') {
                toastr.error(respuesta.mensaje);
            } else {
                toastr.error('No se devolvio un estado');
            }
        });
}
</script>


<?php
      
    }
   
}
?>