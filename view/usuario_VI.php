<?php

class usuario_VI
{

    function __construct()
    {
    }

    function actualizarUsuario()
    {require_once "models/usuario_MO.php";
        $conexion=new conexion();
        $usuario_MO=new usuario_MO($conexion);
        $arreglo=$usuario_MO->seleccionar($_SESSION['documento']);
        
        foreach ($arreglo as $document) {

          $nombre=$document['first_name'];
          $apellido=$document['last_name'];
          $telefono=$document['cellphone'];
          $usuario=$document['user'];
          $correo=$document['email'];
          $contrasena=$document['password'];
          $documento=$document['document'];

        }

?>
<div class="card">
    <div class="card-header">
        Actualizar Datos del usuario
    </div>
    <div class="card-body">
        <form id="formulario_actualizar_usuario">

            <div class="form-group">
                <label for="nombre">nombre del usuario</label>
                <input onkeypress="return sololetras(event)" type="text" class="form-control" id="nombre" name="nombre"
                    value="<?php echo $nombre ?>">
            </div>
            <div class="form-group">
                <label for="apellido">apellido</label>
                <input onkeypress="return sololetras(event)" type="text" class="form-control" id="apellido"
                    name="apellido" value="<?php echo $apellido ?>">
            </div>
            <div class="form-group">
                <label for="nombre">usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario ?>">
            </div>
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="number" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono ?>">
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo ?>">
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena"
                    value="<?php echo $contrasena ?>">
            </div>

            <input type="hidden" id="documento" name="documento" value="<?php echo $documento ?>">
            <button type="button" onclick="actualizarUsuario();" class="btn btn-success float-right">Actualizar</button>
            <br>

        </form>
    </div>
</div>
<script>
function actualizarUsuario() {

    var cadena = new FormData(document.querySelector('#formulario_actualizar_usuario'));

    fetch('usuario_CO/actualizarUsuario', {
            method: 'POST',
            body: cadena
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {

            if (respuesta.estado == 'EXITO') {

                toastr.success(respuesta.mensaje);

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