<?php
class producto_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarproducto($id_producto,$marca,$categoria,$nombre_producto,$stock,$precio_unitario,$descripcion_producto)
  {

    $mql=array( 'code'=>$id_producto,'brand'=>$marca,'category'=>$categoria,'name_product'=>$nombre_producto,'stock'=>$stock,'unit_price'=>$precio_unitario,'product_description'=>$descripcion_producto);

    $this->conexion->consultarIns($mql,"products");
  }
  
  function actualizarproducto($id_producto,$marca,$categoria,$nombre_producto, $stock, $precio_unitario, $descripcion_producto)
  {

    $Nsql= array('code'=>$id_producto);
    $update=array('$set'=>array('name_producto'=>$nombre_producto,'stock'=>$stock,'unit_price'=>$precio_unitario,'product_descrption'=>$descripcion_producto, 'brand'=>$marca, 'category'=>$categoria));
    

    $this->conexion->consultarAct($Nsql,$update,"products");
  }

  function seleccionar($id_producto = '')
  {

    if (empty($id_producto)) {

      $mql=array();
    } else {

      $mql=array('code'=>$id_producto);
    }

    $this->conexion->consultar($mql, "products");

    $arreglo_productos = $this->conexion->extraerRegistro();

    return $arreglo_productos;
  }
 
  function seleccionar_nombre($nombre_producto = '')
  {
    if (empty($nombre_producto)) {

      $mql=array();
    } else {

      $mql=array('name_product'=>$nombre_producto);
    }

    $this->conexion->consultar($mql, "products");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}