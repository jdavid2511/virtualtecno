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
   
    if ( empty($id_usuario) or empty($fecha_entrada)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }

    $entrada_MO->agregarentrada($id_entrada,$id_usuario,$fecha_entrada);
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
   
    
    if ( empty($id_usuario) or empty($fecha_entrada)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }

     
   
    $entrada_MO->actualizarentrada($id_entrada,$id_usuario,$fecha_entrada);
   
  }
}