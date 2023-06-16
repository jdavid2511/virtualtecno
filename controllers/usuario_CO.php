<?php

require_once "../models/usuario_MO.php";
require_once "../lib/conexion.php";

    $conexion = new conexion();
    
    $usuario_MO = new  usuario_MO($conexion);

    $usuario=htmlentities($_POST['usuario'], ENT_QUOTES);
    $nombre=htmlentities($_POST['nombre'], ENT_QUOTES);
    $apellido=htmlentities($_POST['apellido'], ENT_QUOTES);
    $documento=htmlentities($_POST['documento'], ENT_QUOTES);
    $telefono=htmlentities($_POST['telefono'], ENT_QUOTES);
    $correo=htmlentities($_POST['correo'], ENT_QUOTES);
    $contrasena=htmlentities($_POST['contrasena'], ENT_QUOTES);
    
    if (empty($usuario) or empty($nombre) or empty($apellido) or empty($documento)or empty($telefono)or empty($correo)or empty($contrasena)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];
      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($documento) > 10) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del documento debe ser menor de 10 caracteres"
    
      ];
    
      exit(json_encode($arreglo_respuesta));
    }if (strlen($usuario) > 10) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del usuario deber ser menor de 10 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($telefono) > 10) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del telefono deber ser menor de 10 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($contrasena) > 30) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño de la contraseña deber ser menor de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (!(filter_var($correo, FILTER_VALIDATE_EMAIL))) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "por favor ingrese un correo valido"
        ];
        exit(json_encode($arreglo_respuesta));
      }

      $arreglo_usuario = $usuario_MO->seleccionar();
      
    foreach($arreglo_usuario as $doc_usuario){
    if ($documento==$doc_usuario['document']) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El documento del usuario ($documento) esta duplicado"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if ($correo==$doc_usuario['email']) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El correo ($correo) esta duplicado"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if ($usuario==$doc_usuario['user']) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El usuario ($usuario) esta duplicado"

      ];
      exit(json_encode($arreglo_respuesta));
    }
  }
      
      
    $usuario_MO->agregarusuarios($documento,$usuario,$nombre,$apellido,$telefono,$correo,$contrasena);
    /*$familia= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "document" => $documento,
      "estado" => "EXITO",
      "mensaje" => "Registro agregado ya puedes logearte"

    ];

    exit(json_encode($arreglo_respuesta));
 ?>