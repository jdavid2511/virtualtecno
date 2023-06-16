<?php

class producto_VI
{

    function __construct()
    {
    }

    function agregarproducto()
    {

        require_once "models/producto_MO.php";
        $conexion = new conexion();
        $producto_MO = new producto_MO($conexion);
        $arreglo_productos = $producto_MO->seleccionar();   

?>

<div class="card">
    <div class="card-header">
        Agregar productos al inventario
    </div>
    <div class="card-body">
        <form id="formulario_agregar_productos">

            <div class="row">


                <div class="col-md-3">
                    <label for="marca">Nombre marca</label>
                    <select class="form-control" name="marca" id="marca">
                        <option value=""></option>
                        <option value="SAMSUNG">SAMSUNG</option>
                        <option value="OPPO">OPPO</option>
                        <option value="REALME">REALME</option>
                        <option value="XIAOMI">XIAOMI</option>
                        <option value="NOKIA">NOKIA</option>
                        <option value="MOTOROLA">MOTOROLA</option>
                        <option value="TECNO">TECNO</option>
                        <option value="APPLE">APPLE</option>
                        <option value="HONOR">HONOR</option>
                        <option value="ONEPLUS">ONEPLUS</option>

                    </select>

                </div>
                <div class=" col-md-3">
                    <label for="categoria">categoria</label>
                    <select class="form-control" name="categoria" id="categoria">
                        <option value=""></option>
                        <option value="MAS VENDIDOS">MAS VENDIDOS</option>
                        <option value="ASARTPHONE">SMARTPHONE</option>
                        <option value="CLASICOS">CLASICOS</option>
                        <option value="GAMA BAJA">GAMA BAJA</option>
                        <option value="BAJO COSTO">BAJO COSTO</option>
                        <option value="GAMA ALTA">GAMA ALTA</option>
                        <option value="MEJOR CAMARA">MEJOR CAMARA</option>
                        <option value="ALACENAMIENTO">ALMACENAMIENTO</option>
                    </select>
                </div>

                <br>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id_producto">codigo producto</label>
                            <input type="text" class="form-control" id="id_producto" name="id_producto">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nombre_producto">Nombre producto</label>
                            <input type="text" class="form-control" id="nombre_producto" name="nombre_producto">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="precio_unitario">precio unitario</label>
                            <input type="number" class="form-control" id="precio_unitario" name="precio_unitario">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="descripcion_producto">descripcion</label>
                            <input type="text" class="form-control" id="descripcion_producto"
                                name="descripcion_producto">

                        </div>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <button type="button" onclick="agregarproducto()"
                            class="btn btn-success float-right">Agregar</button>
                    </div>
                </div>

        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Listar productos del inventario
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="width:100%">
                <thead class="thead-light">
                    <tr>
                        <th style="text-align: center;">codigo producto</th>
                        <th style="text-align: center;">marca</th>
                        <th style="text-align: center;">categoria</th>
                        <th style="text-align: center;">Nombre producto</th>
                        <th style="text-align: center;">Stock</th>
                        <th style="text-align: center;">precio unitario</th>
                        <th style="text-align: center;">descripcion</th>
                        <th style="text-align: center;">Accion</th>
                    </tr>
                </thead>
                <tbody id="lista_productos">
                    <?php
                            if ($arreglo_productos) {

                                foreach ($arreglo_productos as $objeto_productos) {

                                    $id_producto = $objeto_productos['code'];
                                    $nombre_producto = $objeto_productos['name_product'];
                                    $stock = $objeto_productos['stock'];
                                    $precio_unitario = $objeto_productos['unit_price'];
                                    $descripcion_producto = $objeto_productos['product_description'];
                                    $categoria = $objeto_productos['category'];
                                    $marca = $objeto_productos['brand'];
                            ?>
                    <tr>
                        <td id="id_producto_td_<?php echo $id_producto; ?>"> <?php echo $id_producto; ?> </td>
                        <td id="nombre_marca_td_<?php echo $id_producto; ?>"> <?php echo $marca; ?> </td>
                        <td id="nombre_categoria_td_<?php echo $id_producto; ?>"> <?php echo $categoria; ?> </td>
                        <td id="nombre_producto_td_<?php echo $id_producto; ?>"> <?php echo $nombre_producto; ?> </td>
                        <td id="stock_td_<?php echo $id_producto; ?>"> <?php echo $stock; ?> </td>
                        <td id="precio_unitario_td_<?php echo $id_producto; ?>"> <?php echo $precio_unitario; ?> </td>
                        <td id="descripcion_producto_td_<?php echo $id_producto; ?>">
                            <?php echo $descripcion_producto; ?> </td>
                        <td style="text-align: center;">
                            <input type="hidden" id="id_producto_<?php echo $id_producto; ?>"
                                value="<?php echo $id_producto; ?>">
                            <input type="hidden" id="marca_<?php echo $id_producto; ?>" value="<?php echo $marca; ?>">
                            <input type="hidden" id="categoria_<?php echo $id_producto; ?>"
                                value="<?php echo $categoria; ?>">
                            <input type="hidden" id="nombre_producto_<?php echo $id_producto; ?>"
                                value="<?php echo $nombre_producto; ?>">
                            <input type="hidden" id="stock_<?php echo $id_producto; ?>" value="<?php echo $stock; ?>">
                            <input type="hidden" id="precio_unitario_<?php echo $id_producto; ?>"
                                value="<?php echo $precio_unitario; ?>">
                            <input type="hidden" id="descripcion_producto_<?php echo $id_producto; ?>"
                                value="<?php echo $descripcion_producto; ?>">


                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal"
                                style="cursor: pointer;"
                                onclick="verActualizarproducto('<?php echo $id_producto; ?>')"></i>
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
function agregarproducto() {

    var cadena = new FormData(document.querySelector('#formulario_agregar_productos'));

    fetch('producto_CO/agregarproducto', {
            method: 'POST',
            body: cadena
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            let codigo = document.querySelector('#formulario_agregar_productos #id_producto').value;
            let stock = document.querySelector('#formulario_agregar_productos #stock').value;
            let nombre_producto = document.querySelector('#formulario_agregar_productos #nombre_producto').value;
            let precio_unitario = document.querySelector('#formulario_agregar_productos #precio_unitario').value;
            let descripcion_producto = document.querySelector('#formulario_agregar_productos #descripcion_producto')
                .value;
            let marca = document.querySelector('#formulario_agregar_productos #marca').value;
            let categoria = document.querySelector('#formulario_agregar_productos #categoria').value;

            if (respuesta.estado == 'EXITO') {

                let fila = `
                             <tr>
                                        <td id="id_producto_td_${id_producto}"> ${codigo} </td>
                                        <td id="marca_td_${id_producto}"> ${marca} </td>
                                        <td id="categoria_td_${id_producto}"> ${categoria} </td>
                                        <td id="nombre_producto_td_${id_producto}"> ${nombre_producto} </td>
                                        <td id="stock_td_${id_producto}"> ${stock} </td>
                                        <td id="precio_unitario_td_${id_producto}"> ${precio_unitario} </td>
                                        <td id="descripcion_producto_td_${id_producto}"> ${descripcion_producto} </td>

                                        <td style="text-align: center;">
                                            <input type="hidden" id="id_producto_${id_producto}" value="${codigo}">
                                            <input type="hidden" id="marca_${id_producto}" value="${marca}">
                                            <input type="hidden" id="categoria_${id_producto}" value="${categoria}">
                                            <input type="hidden" id="nombre_producto_${id_producto}" value="${nombre_producto}">
                                            <input type="hidden" id="stock_${id_producto}" value="${stock}">
                                            <input type="hidden" id="precio_unitario_${id_producto}" value="${precio_unitario}">
                                            <input type="hidden" id="descripcion_producto_${id_producto}" value="${descripcion_producto}">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarproducto('${id_producto}')"></i>
                                        </td>
                                    </tr>
                                    `;
                document.querySelector('#lista_productos').insertAdjacentHTML('afterbegin', fila);

                document.querySelector('#formulario_agregar_productos ').reset();
                toastr.success(respuesta.mensaje);
            } else if (respuesta.estado = 'ERROR') {

                toastr.error(respuesta.mensaje);

            } else {

                toastr.error('No se devolvio un estado');
            }
        })
}

function verActualizarproducto(id_producto) {
    //let especie1 = document.querySelector('#especie_' + id_$id_producto).value;
    let marca = document.querySelector('#marca_' + id_producto).value;
    let categoria = document.querySelector('#categoria_' + id_producto).value;
    let nombre_producto = document.querySelector('#nombre_producto_' + id_producto).value;
    let stock = document.querySelector('#stock_' + id_producto).value;
    let precio_unitario = document.querySelector('#precio_unitario_' + id_producto).value;
    let descripcion_producto = document.querySelector('#descripcion_producto_' + id_producto).value;

    //console.log(codi_origen);
    var cadena = `
                        <div class="card">
                            <div class="card-body">
                             <form id="formulario_actualizar_productos">
 
                        <div class="form-group">
                            <label for="marca_">Nombre marca</label>
                            <select class="form-control" name="marca_" id="marca_">
                                <option value="${marca}">${marca}</option>
                                <option value="SAMSUNG">SAMSUNG</option>
                                <option value="OPPO">OPPO</option>
                                <option value="REALME">REALME</option>
                                <option value="XIAOMI">XIAOMI</option>
                                <option value="NOKIA">NOKIA</option>
                                <option value="MOTOROLA">MOTOROLA</option>
                                <option value="TECNO">TECNO</option>
                                <option value="APPLE">APPLE</option>
                                <option value="HONOR">HONOR</option>
                                <option value="ONEPLUS">ONEPLUS</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="categoria">categoria</label>
                            <select class="form-control" name="categoria_" id="categoria_">
                                <option value="${categoria}">${categoria}</option>
                                <option value="MAS VENDIDOS">MAS VENDIDOS</option>
                                <option value="ASARTPHONE">SMARTPHONE</option>
                                <option value="CLASICOS">CLASICOS</option>
                                <option value="GAMA BAJA">GAMA BAJA</option>
                                <option value="BAJO COSTO">BAJO COSTO</option>
                                <option value="GAMA ALTA">GAMA ALTA</option>
                                <option value="MEJOR CAMARA">MEJOR CAMARA</option>
                                <option value="ALACENAMIENTO">ALMACENAMIENTO</option>
                            </select>
                        </div>

                                    <div class="form-group">
                                        <label for="nombre_producto">nombre producto</label>
                                        <input   type="text" class="form-control" id="nombre_producto" name="nombre_producto"
                                            value="${nombre_producto}">
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock"
                                            value="${stock}">
                                    </div>
                                    <div class="form-group">
                                        <label for="precio_unitario">precio unitario</label>
                                        <input type="number" class="form-control" id="precio_unitario" name="precio_unitario"
                                            value="${precio_unitario}">
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion_producto">descripcion producto</label>
                                        <input  type="text" class="form-control" id="descripcion_producto" name="descripcion_producto"
                                            value="${descripcion_producto}">
                                    </div>
                                    <input    type="hidden" id="id_producto" name="id_producto" value="${id_producto}">
                                    <button type="button" onclick="actualizarproducto();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

    document.querySelector('#titulo_modal').innerHTML = 'Actualizar productos';

    document.querySelector('#contenido_modal').innerHTML = cadena;

}

function actualizarproducto() {

    var cadena = new FormData(document.querySelector('#formulario_actualizar_productos'));

    fetch('producto_CO/actualizarproducto', {
            method: 'POST',
            body: cadena
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {

            if (respuesta.estado == 'EXITO') {
                let id_producto = document.querySelector('#formulario_actualizar_productos #id_producto').value;
                let nombre_producto = document.querySelector(
                        '#formulario_actualizar_productos #nombre_producto')
                    .value;
                let marca = document.querySelector('#formulario_actualizar_productos #marca').value;
                let categoria = document.querySelector('#formulario_actualizar_productos #categoria')
                    .value;
                let stock = document.querySelector('#formulario_actualizar_productos #stock').value;
                let precio_unitario = document.querySelector(
                        '#formulario_actualizar_productos #precio_unitario')
                    .value;
                let descripcion_producto = document.querySelector(
                    '#formulario_actualizar_productos #descripcion_producto').value;




                document.querySelector('#marca_td_' + id_producto).innerHTML = marca;
                document.querySelector('#marca_' + id_producto).value = marca;
                document.querySelector('#categoria_td_' + id_producto).innerHTML = categoria;
                document.querySelector('#categoria_' + id_producto).value = categoria;
                document.querySelector('#nombre_producto_td_' + id_producto).innerHTML = nombre_producto;
                document.querySelector('#nombre_producto_' + id_producto).value = nombre_producto;
                document.querySelector('#stock_td_' + id_producto).innerHTML = stock;
                document.querySelector('#stock_' + id_producto).value = stock;
                document.querySelector('#precio_unitario_td_' + id_producto).innerHTML = precio_unitario;
                document.querySelector('#precio_unitario_' + id_producto).value = precio_unitario;
                document.querySelector('#descripcion_producto_td_' + id_producto).innerHTML =
                    descripcion_producto;
                document.querySelector('#descripcion_producto_' + id_producto).value = descripcion_producto;


                $.post('producto_VI/agregarProducto', function(respuesta) {
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