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
                                        $id_usuario = $objeto_usuario->document;
                                        $nombre_usuario= $objeto_usuario->first_name; 

                                ?>
                        <option value="<?php echo $id_usuario;?>">
                            <?php echo $nombre_usuario; ?>
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
                    <label for="producto_id">ID producto</label>
                    <select class="form-control" name="producto_id" id="producto_id">
                        <option value=""></option>
                        <?php
                                if ($arreglo_productos) {

                                    foreach ($arreglo_productos as $objeto_producto) {
                                        $producto_id = $objeto_producto->code;
                                        $nombre_producto= $objeto_producto->name_product; 

                                ?>
                        <option value="<?php echo $producto_id; ?>"><?php echo  $nombre_producto; ?></option>
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
                                    $producto_id= $objeto_entrada->detail_entries->product_id;
                                    $cantidad = $objeto_entrada ->detail_entries-> amount;
                                    $precio = $objeto_entrada->detail_entries->price;
          
                            ?>
                    <tr>
                        <td id="id_entrada_td_<?php echo $id_entrada;?>"> <?php echo $id_entrada;?> </td>
                        <td id="id_usuario_td_<?php echo $id_entrada;?>"> <?php echo $id_usuario;?> </td>
                        <td id="fecha_entrada_td_<?php echo $id_entrada;?>"> <?php echo $fecha_entrada;?></td>
                        <td id="producto_id_td_<?php echo $id_entrada ?>"><?php echo $producto_id; ?> </td>
                        <td id="cantidad_td_<?php echo $id_entrada ?>"><?php echo $cantidad; ?> </td>
                        <td id="precio_td_<?php echo $id_entrada ?>"><?php echo $precio; ?> </td>

                        <td style="text-align: center;">
                            <input type="hidden" id="id_entrada<?php echo $id_entrada; ?>"
                                value="<?php echo $id_entrada; ?>">
                            <input type="hidden" id="id_usuario<?php echo $id_entrada; ?>"
                                value="<?php echo $id_usuario; ?>">
                            <input type="hidden" id="fecha_entrada<?php echo $id_entrada; ?>"
                                value="<?php echo $fecha_entrada; ?>">
                            <input type="hidden" id="producto_id<?php echo $id_entrada?>"
                                value="<?php echo $producto_id; ?>">
                            <input type="hidden" id="cantidad<?php echo $id_entrada?>" value="<?php echo $cantidad; ?>">
                            <input type="hidden" id="precio<?php echo $id_entrada?>" value="<?php echo $precio; ?>">

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
            let producto_id = document.querySelector('#formulario_agregar_entrada #producto_id').value;
            let cantidad = document.querySelector('#formulario_agregar_entrada #cantidad').value;
            let precio = document.querySelector('#formulario_agregar_entrada #precio').value;

            if (respuesta.estado == 'EXITO') {

                let fila = `
                            <tr>  
                                <td id="id_entrada_td_${id_entrada}"> ${id_entrada} </td>
                                <td id="id_usuario_td_${id_entrada}"> ${id_usuario} </td>
                                <td id="fecha_entrada_td_${id_entrada}"> ${fecha_entrada} </td>  
                                <td id="producto_id_td_${id_entrada}"> ${producto_id} </td>
                                <td id="cantidad_td_${id_entrada}"> ${cantidad} </td>
                                <td id="precio_td_${id_entrada}"> ${precio} </td>  
                                    
                                <td style="text-align: center;">
                                    <input type="hidden" id="id_entrada_${id_entrada}" value="${id_entrada}">
                                    <input type="hidden" id="usuario_${id_entrada}" value="${id_usuario}">
                                    <input type="hidden" id="fecha_entrada_${id_entrada}" value="${fecha_entrada}">
                                    <input type="hidden" id="producto_id_${id_entrada}" value="${producto_id}">
                                    <input type="hidden" id="cantidad_${id_entrada}" value="${cantidad}">
                                    <input type="hidden" id="precio_${id_entrada}" value="${precio}">

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

    let id_usuario = document.querySelector('#id_usuario' + id_entrada).value;
    let fecha_entrada = document.querySelector('#fecha_entrada' + id_entrada).value;
    let producto_id = document.querySelector('#producto_id' + id_entrada).value;
    let cantidad = document.querySelector('#cantidad' + id_entrada).value;
    let precio = document.querySelector('#precio' + id_entrada).value;

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
                                    <div class="form-group">
                            <label for="producto_id">Nombre producto</label>
                            <select class="form-control" name="producto_id" id="producto_id">
                                <option value="${producto_id}">${producto_id}</option>
                                <?php
                                $arreglo_productos = $producto_MO->seleccionar();
                                print_r($arreglo_productos);
                                if ($arreglo_productos) {

                                    foreach ($arreglo_productos as $objeto_producto) {
                                        $producto_id = $objeto_producto->code;

                                ?>
                                    <option value="<?php echo $producto_id?>" > <?php echo  $producto_id; ?> </option>
                                <?php
                                 }
                                }
                                ?>
                            </select>

                        </div>
                    
                                    <div class="form-group">
                                        <label for="cantidad">cantidad producto</label>
                                        <input   type="number" class="form-control" id="cantidad" name="cantidad"
                                            value="${cantidad}">
                                    </div>
                                    <div class="form-group">
                                        <label for="precio">precio </label>
                                        <input type="number" class="form-control" id="precio" name="precio"
                                            value="${precio}">
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

    fetch('entrada_CO/actualizarentrada', {
            method: 'POST',
            body: cadena
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {

            if (respuesta.estado == 'EXITO') {
                let id_entrada = document.querySelector(
                    '#formulario_actualizar_entrada #id_entrada').value;
                let fecha_entrada = document.querySelector('#formulario_actualizar_entrada #fecha_entrada').value;
                let id_usuario = document.querySelector('#formulario_actualizar_entrada #id_usuario').value;
                let producto_id = document.querySelector('#formulario_actualizar_entrada #producto_id').value;
                let cantidad = document.querySelector('#formulario_actualizar_entrada #cantidad').value;
                let precio = document.querySelector('#formulario_actualizar_entrada #precio').value;

                document.querySelector('#id_usuario_td_' + id_entrada).innerHTML = id_usuario;
                document.querySelector('#id_usuario' + id_entrada).value = id_usuario;
                document.querySelector('#fecha_entrada_td_' + id_entrada).innerHTML = fecha_entrada;
                document.querySelector('#fecha_entrada' + id_entrada).value = fecha_entrada;
                document.querySelector('#producto_id_td_' + id_entrada).innerHTML = producto_id;
                document.querySelector('#producto_id' + id_entrada).value = producto_id;
                document.querySelector('#cantidad_td_' + id_entrada).innerHTML = cantidad;
                document.querySelector('#cantidad' + id_entrada).value = cantidad;
                document.querySelector('#precio_td_' + id_entrada).innerHTML = precio;
                document.querySelector('#precio' + id_entrada).value = precio;



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