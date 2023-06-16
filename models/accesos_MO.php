<?php
class accesos_MO{
    
  private $conexion;
    
    function __construct($conexion)
    {
     $this->conexion=$conexion;
    }
    
    function iniciarSesion($correo,$contrasena)
    {

      $mql=array('email'=>$correo,'password'=>$contrasena);    
      $this->conexion->consultar($mql,"users");
      return $this->conexion->extraerRegistro();
       
    }
}
?>