<?php namespace Model;

class Servicios extends ActiveRecord{
  
  // bd
  protected static $tabla='servicios';
  protected static $columnasDB = ['id', 'nombre', 'precio'];


  public $id;
  public $nombre;
  public $precio;


  public function __construct($servicio=[])
  {
    $this->id=$servicio['id']?? null;
    $this->nombre=$servicio['nombre']?? '';
    $this->precio=$servicio['precio']?? '';
    
  }

}