<?php

class entrada_VI
{

    function __construct()
    {
    }

    function agregarEntrada()
    {

        
        require_once "models/entrada_MO.php";
        require_once "models/usuario_MO.php";
        require_once "models/producto_MO.php";

        $conexion = new conexion();
        $entrada_MO = new  entrada_MO($conexion);
        $usuario_MO = new usuario_MO($conexion);
        $producto_MO = new producto_MO($conexion);
        
        $arreglo_entrada = $entrada_MO->seleccionar();
        $arreglo_usuario = $usuario_MO->seleccionar();
        $arreglo_productos = $producto_MO->seleccionar();      

?>

<div class="card">
    <div class="card-header">
        Agregar entrada
    </div>
    <div class="card-body">
        <form id="formulario_agregar_entrada">

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="id_entrada">codigo entrada</label>
                        <input type="text" class="form-control" id="id_entrada" name="id_entrada">

                    </div>
                </div>

                <div class="col-md-3">
                    <label for="id_usuario">Nombre usuario</label>
                    <select class="form-control" name="id_usuario" id="id_usuario">
                        <option value=""></option>
                        <?php
                                if ($arreglo_usuario) {

                                    foreach ($arreglo_usuario as $objeto_usuario) {
                                        $id_usuario1 = $objeto_usuario->document;
                                        $nombre_usuario1= $objeto_usuario->first_name; 

                                ?>
                        <option value="<?php echo $id_usuario1;?>">
                            <?php echo $nombre_usuario1; ?>
                        </option>
                        <?php
                                    }
                                }
                                ?>
                    </select>

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="fecha_entrada">fecha entrada</label>
                        <input type="date" class="form-control" id="fecha_entrada" name="fecha_entrada">

                    </div>
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cantidad">Codigo detalle entrada</label>
                        <input type="number" class="form-control" id="id_de" name="id_de">

                    </div>
                </div>

                <div class="col-md-3">
                    <label for="id_producto">ID producto</label>
                    <select class="form-control" name="id_protucto" id="id_producto">
                        <option value=""></option>
                        <?php
                                if ($arreglo_productos) {

                                    foreach ($arreglo_productos as $objeto_producto) {
                                        $id_producto = $objeto_producto->code;

                                ?>
                        <option value="<?php echo $id_producto; ?>"><?php echo  $id_producto; ?></option>
                        <?php
                                    }
                                }
                                ?>
                    </select>

                </div>
                <br>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad">

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="precio">precio</label>
                        <input type="number" class="form-control" id="precio" name="precio">

                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="col-md-12">
                        <br>
                        <button type="button" onclick="agregarentrada();"
                            class="btn btn-success float-right">Agregar</button>
                    </div>
                </div>

        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Listar entrada
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="width:100%">
                <thead class="thead-light">
                    <tr>
                        <th style="text-align: center;">Codigo entrada</th>
                        <th style="text-align: center;">Usuario</th>
                        <th style="text-align: center;">Fecha</th>
                        <th style="text-align: center;">producto</th>
                        <th style="text-align: center;">cantidad</th>
                        <th style="text-align: center;">precio</th>
                        <th style="text-align: center;">Accion</th>
                    </tr>
                </thead>
                <tbody id="lista_entrada">
                    <?php
                            if ($arreglo_entrada) {

                                foreach ($arreglo_entrada as $objeto_entrada) {

                                    $id_usuario= $objeto_entrada->user_id;
                                                    
                                    $id_entrada= $objeto_entrada->entry_code;
                                    $fecha_entrada = $objeto_entrada->entry_date;
          
                            ?>
                    <tr>
                        <td id="id_entrada_td_<?php echo $id_entrada;?>"> <?php echo $id_entrada;?> </td>
                        <?php
                          
                                    
                            ?>
                        <td id="id_usuario_td_<?php echo $id_entrada;?>"> <?php echo $id_usuario;?> </td>
                        <?php 
                                    
                            
                        ?>

                        <td id="fecha_entrada_td_<?php echo $id_entrada;?>"> <?php echo $fecha_entrada;?>
                        </td>
                        <td style="text-align: center;">
                            <input type="hidden" id="id_entrada_<?php echo $id_entrada; ?>"
                                value="<?php echo $id_entrada; ?>">
                            <input type="hidden" id="id_usuario_<?php echo $id_entrada; ?>"
                                value="<?php echo $id_usuario; ?>">
                            <input type="hidden" id="fecha_entrada_<?php echo $id_entrada; ?>"
                                value="<?php echo $fecha_entrada; ?>">

                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal"
                                style="cursor: pointer;"
                                onclick="verActualizarentrada('<?php echo $id_entrada; ?>')"></i>
                        </td>
                    </tr>
                    <?php
                                      
                                    }
                                }
                            
                            ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<script type="text/javascript" src="datatables/main.js"></script>

<script>
function agregarentrada() {

    var cadena = new FormData(document.querySelector('#formulario_agregar_entrada'));

    fetch('entrada_CO/agregarentrada', {
            method: 'POST',
            body: cadena
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            let id_entrada = document.querySelector('#formulario_agregar_entrada #id_entrada').value;
            let fecha_entrada = document.querySelector('#formulario_agregar_entrada #fecha_entrada').value;
            let id_usuario = document.querySelector('#formulario_agregar_entrada #id_usuario').value;

            if (respuesta.estado == 'EXITO') {

                let fila = `
                      
                             <tr>  
                             <td id="id_entrada_td_${id_entrada}"> ${id_entrada} </td>
                             <td id="id_usuario_${id_entrada}"> ${id_usuario} </td>
                             <td id="fecha_entrada_${id_entrada}"> ${fecha_entrada} </td>    
                             
                             <td style="text-align: center;">
                                            <input type="hidden" id="id_entrada_${id_entrada}" value="${id_entrada}">
                                            <input type="hidden" id="usuario_${id_entrada}" value="${id_usuario}">
                                            <input type="hidden" id="fecha_entrada_${id_entrada}" value="${fecha_entrada}">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarentrada('${id_entrada}')"></i>
                                        </td>
                                    </tr>
                                    `;
                document.querySelector('#lista_entrada').insertAdjacentHTML('afterbegin', fila);

                document.querySelector('#formulario_agregar_entrada ').reset();
                toastr.success(respuesta.mensaje);
            } else if (respuesta.estado = 'ERROR') {

                toastr.error(respuesta.mensaje);

            } else {

                toastr.error('No se devolvio un estado');
            }
        })
}



function verActualizarentrada(id_entrada) {


    let id_usuario = document.querySelector('#id_usuario_' + id_entrada).value;
    let fecha_entrada = document.querySelector('#fecha_entrada_' + id_entrada).value;

    var cadena = `
                        <div class="card">
                            <div class="card-body">
                             <form id="formulario_actualizar_entrada">
                        <div class="form-group">
                            <label for="id_usuario">Nombre usuario</label>
                            <select class="form-control" name="id_usuario" id="id_usuario">
                                <option value="${id_entrada}">${id_usuario}</option>
                                <?php
                                $arreglo_usuario = $usuario_MO->seleccionar();
                                print_r($arreglo_usuario);
                                if ($arreglo_usuario) {

                                    foreach ($arreglo_usuario as $objeto_usuario) {
                                        $usuario = $objeto_usuario->document;

                                ?>
                                
                                    <option value="<?php echo $usuario?>" > <?php echo  $usuario; ?> </option>
                                <?php
                                 }
                                }
                                ?>
                            </select>
                        </div>

                                    <div class="form-group">
                                        <label for="fecha_entrada">fecha entrada</label>
                                        <input  type="date" class="form-control" id="fecha_entrada" name="fecha_entrada"
                                            value="${fecha_entrada}">
                                    </div>
                                    <input type="hidden" id="id_entrada" name="id_entrada" value="${id_entrada}">
                                    <button type="button" onclick="actualizarentrada();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

    document.querySelector('#titulo_modal').innerHTML = 'Actualizar entradas';

    document.querySelector('#contenido_modal').innerHTML = cadena;

}


function actualizarentrada() {

    var cadena = new FormData(document.querySelector('#formulario_actualizar_entrada'));
    var dato_usuario = document.getElementById("id_usuario");



    fetch('entrada_CO/actualizarentrada', {
            method: 'POST',
            body: cadena
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {

            if (respuesta.estado == 'EXITO') {
                let id_entrada = id_usuario.querySelector(
                    '#formulario_actualizar_entrada #id_entrada').value;
                let fecha_entrada = id_usuario.querySelector('#formulario_actualizar_entrada #fecha_entrada').value;
                let id_usuario = id_usuario.querySelector('#formulario_actualizar_entrada #id_usuario').value;




                id_usuario.querySelector('#usuario_td_' + id_entrada).innerHTML = usuario;
                id_usuario.querySelector('#usuario_' + id_entrada).value = usuario;
                id_usuario.querySelector('#fecha_entrada_td_' + id_entrada).innerHTML = fecha_entrada;
                id_usuario.querySelector('#fecha_entrada_' + id_entrada).value = fecha_entrada;
                id_usuario.querySelector('#id_usuario' + id_entrada).value = id_usuario;

                $.post('entrada_VI/agregarEntrada', function(respuesta) {
                    $('#contenido').html(respuesta);
                });
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