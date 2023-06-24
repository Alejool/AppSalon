<?php namespace Controllers;

use Model\AdminCita;
use MVC\Router;


class adminControllers {


  public static function index (Router $router){

    !isAdmin();

    $fecha= $_GET['fecha'] ?? date('Y-m-d');

    // separamos para usarla en el checkdate
    $fechaexploit= explode('-', $fecha);
    
    if(!checkdate($fechaexploit[1], $fechaexploit[2], $fechaexploit[0])){
      header('LOCATION: /404');
    }

    // consultar base de datos
    $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as nombreCompleto, ";
    $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
    $consulta .= " FROM citas  ";
    $consulta .= " LEFT OUTER JOIN usuarios ";
    $consulta .= " ON citas.usuarioId=usuarios.id  ";
    $consulta .= " LEFT OUTER JOIN citasservicios ";
    $consulta .= " ON citasservicios.citaId=citas.id ";
    $consulta .= " LEFT OUTER JOIN servicios ";
    $consulta .= " ON servicios.id=citasservicios.servicioId ";
     $consulta .= " WHERE fecha =  '$fecha' ";

    $citas= AdminCita::sql($consulta);
    

    $router->render('admin/index',[
      'nombre'=> $_SESSION['nombre'] ?? '',
      'citas'=> $citas,
      'fecha'=> $fecha
      
    ], 'admin');

  }


}


