<?php
require_once "../models/accesos_MO.php";
require_once "../lib/conexion.php";
require_once "../lib/vendor/autoload.php";

session_start();
    $conexion=new conexion();
    $accesos_MO = new accesos_MO ($conexion);
    
    $correo = htmlentities($_POST['correo'], ENT_QUOTES);
    $contrasena = htmlentities($_POST['contrasena'], ENT_QUOTES);
    
    if (empty($correo) or empty($contrasena)) {
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
        if (strlen($correo) > 30) {
          $arreglo_respuesta = [
            "estado" => "ERROR",
            "mensaje" => "el correo debe tener menos de 50 caracteres"
          ];
          exit(json_encode($arreglo_respuesta));
        }
        if (strlen($contrasena) > 20) {
          $arreglo_respuesta = [
            "estado" => "ERROR",
            "mensaje" => "la contraseña debe tener menos de 30 caracteres"
          ];
          exit(json_encode($arreglo_respuesta));
        }
        
        $accesos_MO = new accesos_MO($conexion);
        $arreglo=$accesos_MO->iniciarSesion($correo,$contrasena);
        
        if($arreglo)
        {  
          foreach ($arreglo as $id_usuario) {
            if($id_usuario['email']==$correo and $id_usuario['password']==$contrasena){
              
              $_SESSION['documento']=$id_usuario['document']; 
              $arreglo_respuesta = [
              "estado" => "EXITO",
              "mensaje" => "LOGIN EXITOSO ",
              ];
              exit(json_encode($arreglo_respuesta)); 
            }else{
              $arreglo_respuesta = [
                "estado" => "ERROR",
                "mensaje" => "correo o contrasena",
                ];
                exit(json_encode($arreglo_respuesta));
          }
        }
          $arreglo_respuesta = [
            "estado" => "ERROR",
            "mensaje" => "correo o contrasena incorrectos",
            ];
           
            exit(json_encode($arreglo_respuesta));
      }
        
     
      
?>