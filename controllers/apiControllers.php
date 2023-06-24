<?php namespace Controllers;

use Model\Citas;
use Model\CitaServicio;
use Model\Servicios; 
use MVC\Router; 



class apiControllers{

  public static function index(){
    $servicios=Servicios::all();
    
    echo json_encode($servicios);
  }



  public static function guardarCitas() {
    //lee la cita y devuelve el id (buscarlo en activeRecord)
    $cita= new Citas($_POST);
 
    $resultado=$cita->guardar();


    // sacar los servicios ya que estan como una cadena
    $idServicios= explode(',', $_POST['servicios']);

    // se recoore el array de id creado y se van creando los registros dependeindo de los servicios con la misma instancia de cita
    foreach($idServicios as $idServicio){
      $citaServicio= [
          'servicioId'=>$idServicio,
          'citaId'=> $resultado['id'] // lo que retorna del activeRecord
      ];

      $citasServicios= new CitaServicio($citaServicio);
      $citasServicios->guardar();
    }

    echo json_encode($resultado);
  }



  public static function eliminar(){
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
      $id=$_POST['id'];
      $cita= Citas::find($id);
      $cita->eliminar();
      header('LOCATION: /admin');

    }


  }

  


}
