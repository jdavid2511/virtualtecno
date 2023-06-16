<?php

require_once "models/detalle_entrada_MO.php";

class detalle_entrada_CO
{

  function __construct()
  {
  }

  function agregardetalle_entrada()
  {

    $conexion = new conexion();

    $detalle_entrada_MO = new  detalle_entrada_MO($conexion);
   
    $id_de = htmlentities($_POST['id_de'], ENT_QUOTES);
    $cantidad = htmlentities($_POST['cantidad'], ENT_QUOTES);
    $precio = htmlentities($_POST['precio'], ENT_QUOTES);
    $id_producto = htmlentities($_POST['id_producto'], ENT_QUOTES);

    if (empty($id_de) or empty($cantidad) or empty($precio)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    
    $detalle_entrada_MO->agregardetalle_entrada($id_de,$cantidad, $precio);
    /*$familia= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizardetalle_entrada()
  {

    $conexion = new conexion();
    $detalle_entrada_MO = new  detalle_entrada_MO($conexion);
 
    
    $id_de = htmlentities($_POST['id_de'], ENT_QUOTES);
    $id_producto = htmlentities($_POST['id_producto'], ENT_QUOTES);
    $precio = htmlentities($_POST['precio'], ENT_QUOTES);
    $cantidad = htmlentities($_POST['cantidad'], ENT_QUOTES);
    

    if (  empty($id_de) or empty($id_producto) or empty($cantidad) or empty($precio)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
   
   
  }
}