<?php namespace Model;

use Model\ActiveRecord;

class AdminCita extends ActiveRecord {

  protected static $tabla='citaservicios';

  protected static $columnasDB = ['id', 'nombreCompleto', 'hora', 'email', 'telefono','servicio', 'precio' ];

  public $id;
  public $hora;
  public $nombreCompleto;
  public $email;
  public $telefono;
  public $servicio;
  public $precio;

  function __construct($arg=[])
  {
    $this->id= $arg['id'] ?? null;
    $this->hora= $arg['hora'] ?? '';
    $this->nombreCompleto= $arg['nombreCompleto'] ?? '';
    $this->email= $arg['email'] ?? '';
    $this->telefono= $arg['telefono'] ?? '';
    $this->servicio= $arg['servicio'] ?? '';
    $this->precio= $arg['precio'] ?? '';
    
  }
}