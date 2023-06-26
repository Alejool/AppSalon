<?php namespace Controllers;

use Model\Servicios;
use MVC\Router;
use Random\Engine\Secure;

class servicioControllers {


  public static function index (Router $router) {
    isAdmin();
    $servicios= Servicios::all();

    $router->render('servicios/index',[
      'nombre'=> $_SESSION['nombre'] ?? '',
      'servicios'=> $servicios
    ],'servicios');
  }

  public static function crear(Router $router){
    isAdmin();

    $servicio= new Servicios;
    $alertas=[];

    if($_SERVER['REQUEST_METHOD']== 'POST'){
      $servicio->sincronizar($_POST);

      $alertas=$servicio->validarForm();


      if(empty($alertas)){
        $servicio->guardar();
        header('LOCATION: /servicios');
      }

    }
      

      

    $router->render('servicios/crear',[
      'nombre'=> $_SESSION['precio'] ?? '',
      'servicio'=>$servicio,
      'alertas'=>$alertas
    ],'servicios');

  }

  public static function actualizar(Router $router){
    isAdmin();
    $alertas=[];
    $servicio= new Servicios;

 
      $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

      if(isset($id) && is_numeric($id)){
        $servicio= Servicios::find($id);

        if(is_null($servicio)){
          header('LOCATION: /servicios');
        }
      }
      else {
        header('LOCATION: /servicios');
      }
      

    if($_SERVER['REQUEST_METHOD']=='POST'){
      $servicio->sincronizar($_POST);
      $alertas=$servicio->validarForm();

      if(empty($alertas)){
        $servicio->guardar();
        header('LOCATION: /servicios');
      }
    }

    $router->render('servicios/actualizar',[
      'nombre'=> $_SESSION['nombre'] ?? '',
      'servicio'=> $servicio,
      'alertas'=> $alertas
    ],'servicios');

  }

  public static function eliminar(){
    isAdmin();

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
        
        $servicio= Servicios::find($id);
        $servicio->eliminar();

        header('LOCATION: /servicios');
    }
  }

}