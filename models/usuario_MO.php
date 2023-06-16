<?php
class usuario_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function seleccionar($id_usuario= '')
  {
    if (empty($id_usuario)) {
      $mql=array();
    } else {

      $mql=array('document'=>$id_usuario);
    }

    $this->conexion->consultar($mql,"users");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }

  
  function agregarusuarios($id_usuario,$usuario,$nombre,$apellido,$telefono,$correo,$contrasena)
  {
    $mql=array('document'=>$id_usuario,'user'=>$usuario,'first_name'=>$nombre,'last_name'=>$apellido,'cellphone'=>$telefono,'email'=>$correo,'password'=>$contrasena);

    $this->conexion->consultarIns($mql,"users");

  }
  
  function actualizarusuario($id_usuario,$usuario,$nombre,$apellido,$telefono,$correo,$contrasena)
  {

    $Nsql= array('document'=>$id_usuario);
    $update=array('$set'=>array('fisrt name'=>$usuario,'user'=>$usuario,'first_name'=>$nombre, 'last_name'=>$apellido, 'cellphone'=>$telefono, 'email'=>$correo, 'password'=>$contrasena));
    

    $this->conexion->consultarAct($Nsql,$update,"users");
  }
 
}