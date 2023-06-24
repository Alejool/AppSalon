<?php namespace Model;



class CitaServicio extends ActiveRecord {

  // bd
  protected static $tabla='citasservicios';
  protected static $columnasDB = ['id', 'servicioId', 'citaId'];


  public $id;
  public $servicioId;
  public $citaId;


  public function __construct($citaServicio=[])
  {
    $this->id=$citaServicio['id']?? null;
    $this->servicioId=$citaServicio['servicioId']?? '';
    $this->citaId=$citaServicio['citaId']?? '';
  }



}




