<?php
class entrada_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarentrada($id_entrada,$id_usuario,$fecha_entrada,$producto_id,$cantidad,$precio)
  {
    $mql=array('entry_code'=>$id_entrada,'user_id'=>$id_usuario,'entry_date'=>$fecha_entrada, 'detail_entries' => array('product_id'=>$producto_id,'amount'=>$cantidad,'price'=>$precio));

    $this->conexion->consultarIns($mql,"entries");
  }
  
  function actualizarentrada($id_entrada,$id_usuario,$fecha_entrada,$producto_id,$cantidad,$precio)
  {

    $mql= array('entry_code'=>$id_entrada);
    $update=array('$set'=>array('user_id'=>$id_usuario,'entry_date'=>$fecha_entrada, 'detail_entries' => array('product_id'=>$producto_id,'amount'=>$cantidad,'price'=>$precio)));
    
    $this->conexion->consultarAct($mql,$update,"entries");
  }

  

  function seleccionar($id_entrada = '')
  {

    if (empty($id_entrada)) {

      $mql=array();
    } else {

      $mql = array('entry_code'=>$id_entrada);
    }

    $this->conexion->consultar($mql, "entries");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_entrada($id = '')
  {
    if ($id) {

      $mql = array('_id'=>$id);
    } else {

      $mql=array();
    }

    $this->conexion->consultar($mql, "entries");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  
}