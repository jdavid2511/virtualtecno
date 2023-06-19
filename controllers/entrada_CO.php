<?php

require_once "models/entrada_MO.php";

class entrada_CO
{

  function __construct()
  {
  }

  function agregarentrada()
  {

    $conexion = new conexion();

    $entrada_MO = new  entrada_MO($conexion);

    $id_entrada = htmlentities($_POST['id_entrada'], ENT_QUOTES);
    $id_usuario = htmlentities($_POST['id_usuario'], ENT_QUOTES);
    $fecha_entrada = htmlentities($_POST['fecha_entrada'], ENT_QUOTES);
    $producto_id = htmlentities($_POST['producto_id'], ENT_QUOTES);
    $cantidad = htmlentities($_POST['cantidad'], ENT_QUOTES);
    $precio = htmlentities($_POST['precio'], ENT_QUOTES);

    
    if ( empty($id_entrada) or empty($id_usuario) or empty($fecha_entrada) or empty($producto_id) or empty($cantidad) or empty($precio)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    
    $arreglo_entrada = $entrada_MO->seleccionar($id_entrada);
    foreach($arreglo_entrada as $objeto_entrada){
      if ($id_entrada==$objeto_entrada['entry_code']) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El codigo de la entrada ($id_entrada) esta duplicado"

        ];

      exit(json_encode($arreglo_respuesta));
    }
  }

    $entrada_MO->agregarentrada($id_entrada,$id_usuario,$fecha_entrada,$producto_id,$cantidad,$precio);
    /*$id_marca= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizarentrada()
  {

    $conexion = new conexion();
    $entrada_MO = new  entrada_MO($conexion);
 


    $id_usuario = htmlentities($_POST['id_usuario'], ENT_QUOTES);
    $fecha_entrada = htmlentities($_POST['fecha_entrada'], ENT_QUOTES);
    $id_entrada = htmlentities($_POST['id_entrada'], ENT_QUOTES);
    $cantidad = htmlentities($_POST['cantidad'], ENT_QUOTES);
    $precio = htmlentities($_POST['precio'], ENT_QUOTES);
    $producto_id = htmlentities($_POST['producto_id'], ENT_QUOTES);
   
    
    if ( empty($id_usuario) or empty($fecha_entrada) or empty($cantidad) or empty($precio) or empty($producto_id)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
     
    $entrada_MO->actualizarentrada($id_entrada,$id_usuario,$fecha_entrada,$producto_id,$cantidad,$precio);

    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
   
  }
}