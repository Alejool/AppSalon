<?php namespace Controllers;

use MVC\Router;
use Classes\email;
use Model\Usuario;



class citaControllers{


  public static function index(Router $router){

    verificarAuth();
    verificarAdmin();

    $router->render('cita/index',[
      'nombre'=>$_SESSION['nombre'],
      'id'=>$_SESSION['id'],
    ], 'cita');
  }


  


}