<?php

require_once "models/producto_MO.php";

class producto_CO
{

  function __construct()
  {
  }

  function agregarproducto()
  {

    $conexion = new conexion();

    $producto_MO = new  producto_MO($conexion);
   
    $id_producto = htmlentities($_POST['id_producto'], ENT_QUOTES);
    $marca = htmlentities($_POST['marca'], ENT_QUOTES);
    $categoria = htmlentities($_POST['categoria'], ENT_QUOTES);
    $nombre_producto = htmlentities($_POST['nombre_producto'], ENT_QUOTES);
    $stock = htmlentities($_POST['stock'], ENT_QUOTES);
    $precio_unitario = htmlentities($_POST['precio_unitario'], ENT_QUOTES);
    $descripcion_producto = htmlentities($_POST['descripcion_producto'], ENT_QUOTES);

    if ( empty($id_producto) or empty($marca) or empty($categoria) or empty($nombre_producto) or empty($stock) or empty($precio_unitario) or empty($descripcion_producto) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($id_producto) > 2) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del  codigo del producto deber ser menor de 2 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }

    if (strlen($nombre_producto) > 30) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del nombre del producto deber ser menor de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }

      if (strlen($descripcion_producto) > 100) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño de la descripcion del producto deber ser menor de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }  
 

    $producto_MO->agregarproducto($id_producto,$marca,$categoria,$nombre_producto, $stock, $precio_unitario, $descripcion_producto);
    /*$familia= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "id_producto" => $id_producto,
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizarproducto()
  {

    $conexion = new conexion();
    $producto_MO = new  producto_MO($conexion);
 


    $id_producto = htmlentities($_POST['id_producto'], ENT_QUOTES);
    $marca = htmlentities($_POST['marca'], ENT_QUOTES);
    $categoria = htmlentities($_POST['categoria'], ENT_QUOTES);
    $nombre_producto = htmlentities($_POST['nombre_producto'], ENT_QUOTES);
    $stock = htmlentities($_POST['stock'], ENT_QUOTES);
    $precio_unitario = htmlentities($_POST['precio_unitario'], ENT_QUOTES);
    $descripcion_producto = htmlentities($_POST['descripcion_producto'], ENT_QUOTES);
    
    if ( empty($marca) or empty($categoria) or empty($nombre_producto) or empty($stock) or empty($precio_unitario) or empty($descripcion_producto) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }

    if (strlen($nombre_producto) > 30) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del nombre del producto deber ser menor de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }

      if (strlen($descripcion_producto) > 100) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño de la descripcion del producto deber ser menor de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }  
   
    $producto_MO->actualizarproducto($id_producto,$marca,$categoria,$nombre_producto, $stock, $precio_unitario, $descripcion_producto);

    $arreglo_respuesta = [
      "id_producto" => $id_producto,
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  
  }
}