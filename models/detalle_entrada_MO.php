<?php
class detalle_entrada_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregardetalle_entrada($id_de,$id_producto,$cantidad, $precio)
  {

    $mql=array('detail_entries' => array('code_detail_entry'=>$id_de,'amount'=>$cantidad,'precio'=>$precio));

    $this->conexion->consultarIns($mql,"entries");
  }
  function actualizardetalle_entrada($ordinal_entrada,$consecutivo_entrada,$id_producto,$cantidad, $precio)
  {

    $sql = "update tienda.detalle_entrada set id_producto='$id_producto',cantidad='$cantidad', precio='$precio' where ordinal_entrada='$ordinal_entrada' and consecutivo_entrada='$consecutivo_entrada' ";

    $this->conexion->consultar($sql);
  }

  function seleccionar($id_de = '')
  {
    if(empty($id_de)){
      $sql = array("detail_entries"=> array());
    }else{
      $sql = array("detail_entries"=> array('code_detail_entry'=>$id_de));
    }
      $this->conexion->consultar($sql, "entries");

      $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }

}