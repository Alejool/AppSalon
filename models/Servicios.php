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

  public function validarForm(){
   
    if(!$this->nombre){
      self::$alertas['error'][]='El nombre no puede estar vacío';
    }
    if(!$this->precio){
      self::$alertas['error'][]='El precio no puede estar vacío';
    }
    if($this->precio && !is_numeric($this->precio)){
      self::$alertas['error'][]='el precio debe ser solo números';
    }

    return self::$alertas;
  
  }

}