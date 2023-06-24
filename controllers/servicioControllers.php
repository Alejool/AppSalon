<?php namespace Controllers;

use MVC\Router;



class servicioControllers {


  public static function index (Router $router) {

    $router->render('servicios/index',[

    ],'servicios');
  }

  public static function crear(Router $router){

    $router->render('servicios/crear',[

    ],'servicios');

  }

  public static function actualizar(Router $router){

    $router->render('servicios/actualizar',[

    ],'servicios');

  }

}