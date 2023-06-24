<?php namespace  Model;

use Model\ActiveRecord;

class Citas extends ActiveRecord {

  // creamos los valores para mapear los datos
  protected static $tabla= 'citas';
  protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId'];
  
  public $id;
  public $fecha;
  public $hora;
  public $usuarioId;

  public function __construct($cita=[])
  {
    $this->id=$cita['id'] ?? null;
    $this->fecha=$cita['fecha'] ?? '';
    $this->hora=$cita['hora'] ?? '';
    $this->usuarioId=$cita['usuarioId'] ?? null;
    
  }

}
