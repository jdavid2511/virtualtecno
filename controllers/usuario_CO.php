<?php

require_once "models/usuario_MO.php";

class usuario_CO
{

  function __construct()
  {
  }
  function actualizarusuario()
  {

    $conexion = new conexion();
    $usuario_MO = new  usuario_MO($conexion);

    $nombre= htmlentities($_POST['nombre'], ENT_QUOTES);
    $apellido=htmlentities($_POST['apellido'], ENT_QUOTES);
    $telefono=htmlentities($_POST['telefono'], ENT_QUOTES);
    $correo=htmlentities($_POST['correo'], ENT_QUOTES);
    $contrasena=htmlentities($_POST['contrasena'], ENT_QUOTES);
    $id_usuario=htmlentities($_POST['id_usuario'], ENT_QUOTES);
    $usuario=htmlentities($_POST['usuario'], ENT_QUOTES);
    
    if (empty($nombre)or empty($apellido) or empty($usuario) or empty($telefono) or empty($correo)or empty($contrasena) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

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
    if (strlen($nombre) > 30) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del nombre del usuario deber ser menor de 30 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
      if (strlen($apellido) > 30) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño de los apellido del usuario deber ser menor de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($telefono) > 20) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del telefono del usuario deber ser menor de 20 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($correo) > 50) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del correo del usuario deber ser menor de 50 caracteres"
  
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
      

    $usuario_MO -> actualizarusuario($id_usuario,$usuario,$nombre,$apellido,$telefono,$correo,$contrasena);

    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "Registro actualizado"

    ];
     
    exit(json_encode($arreglo_respuesta, true));
   
  }
}