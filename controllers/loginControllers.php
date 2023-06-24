<?php namespace Controllers;

use MVC\Router;
use Classes\email;
use Model\Usuario;



class loginControllers {


  public static function login (Router $router){
    $alertas=[];


    if($_SERVER['REQUEST_METHOD']==="POST"){
      $auth=new Usuario($_POST['login']);


      $alertas=$auth->validarLogin();
     

      if(empty($alertas)){
        // validar si existe el usuario y si la contraseña es correcta y este autenticado
         // verificar que exista.
         $registrado=Usuario::where('email',$auth->email );

         if ($registrado){

          // verifica el password
          if($registrado->validarConfirmadoAndPassword($auth->password))
          {
            session_start();
            $_SESSION['id']=$registrado->id;
            $_SESSION['nombre']=$registrado->nombre . " ". $registrado->apellido;
            $_SESSION['email']=$registrado->email;
            $_SESSION['login']=true;

           

            // verificar si es admin o corriente
            if($registrado->admin==='1'){
              $_SESSION['admin']=$registrado->admin ?? null;
              header('LOCATION: /admin');
            }else 
            {
              header('LOCATION: /cita');
            }
          }

         }
         else 
         {
          Usuario::setAlerta('error','el usuario no existe');
         }

         $alertas=Usuario::getAlertas();

      }


    }

    $router->render ('auth/login', [
      'alertas'=> $alertas
    ], 'login');
  }
  
  public static function logout (Router $router){
    $_SESSION=[];

    header('LOCATION: /');
  
  }

  public static function olvidar (Router $router){
    $estado=true;
    $alertas=[];

    if($_SERVER['REQUEST_METHOD']==='POST'){
      $auth=new Usuario($_POST['recuperar']);
      $alertas=$auth->validarEmail();

      if(empty($alertas)){
        $buscado=Usuario::where('email',$auth->email);

        if($buscado && $buscado->confirmado === "1"){
          $buscado->crearToken();
          $buscado->guardar();

          // enviar mail 
         $email=new email($buscado->email,$buscado->nombre, $buscado->token );
          
         $email->recuperarContraseña();

         Usuario::setAlerta("exito", 'revisa tu email');
         $estado=false;
      

         
         
        }
        else {
          // $alertas['error'][]='el usuario no existe o no esta confirmado';

          if(!$buscado){
            Usuario::setAlerta("error",'el usuario no existe' );
            
          }
          else {
            if( $buscado->confirmado==='0'){
              Usuario::setAlerta('error', 'usuario no confirmado');
            }
          }
        }
      }
     
    }
    $alertas=Usuario::getAlertas();


    $router->render ('auth/olvidar', [
      'alertas'=>$alertas,
      'estado'=> $estado
    ], 'login');
  
  }

  public static function recuperar (Router $router){

   
    $alertas=[];
    $token=$_GET['token'];

    $existe=Usuario::where('token', $token);

    if($existe){
      $estado=true;
    
      if($_SERVER['REQUEST_METHOD']==="POST"){
        $password=new Usuario($_POST['restaurar']);
        
        $alertas=$password->validarPassword();

        if(empty($alertas)){

          if(password_verify($password->password, $existe->password)){
            Usuario::setAlerta('error', 'la nueva contraseña no puede ser igual a la anterior');
          }
          else 
          {
            $password->hashPassword();
            $existe->actualizarPassword($password->password);
            $actualizado=$existe->guardar();

            if($actualizado){
              Usuario::setAlerta('exito', 'contraseña cambiada correctamente');
              $estado=false;
            }
            else {
              Usuario::setAlerta('error', 'no fue posible actualizar la contraseña');
            }
          }
        }
        
      }



    }
     else {
      $estado=false;
      Usuario::setAlerta('error', 'Token no válido');
     }

     $alertas=Usuario::getAlertas();

     
    
    $router->render ('auth/recuperar', [
      'alertas'=>$alertas, 
      'estado'=>$estado,

    ], 'login');
  }

  public static function crear (Router $router){

     $usuario=new Usuario;

     // inicializar las alertas 
     $alertas= [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

      $usuario->sincronizar($_POST['crear']);
      $alertas=$usuario->validarCuenta();
    


      // revisar si las alertas estan vacias
      if(empty($alertas)){
        
        // verificar que no este registrado
        $registrado=$usuario->existeUsuario();

        if ($registrado[0]){
         $alertas= Usuario::getAlertas();

        }
        else {
          //hashear password
          
          $usuario->hashPassword();
          $usuario->crearToken();
         
          $email= new email($usuario->email, $usuario->nombre, $usuario->token);

          $email->enviarConfirmacion();

          //crear el usuario
          $resultado=$usuario->guardar();

          if($resultado){
            header('location:/mensaje');
          }

        }
       
      }
   
      
    }



    $router->render ('auth/crear-cuenta', [
      'usuario'=>$usuario,
      'alertas'=>$alertas

    ]);
  
  }

  public static function confirmar(Router $router) {

    $alertas=[];
    $token=s($_GET['token']);
    $confirmarToken=Usuario::where('token',$token);
    

    if (empty($confirmarToken)){
      // mostrar mensaje
     Usuario::setAlerta('error',"token no válido ");
  
    }
    else {
      $confirmarToken->confirmado="1";
      $confirmarToken->token="";
      $confirmarToken->guardar();
      Usuario::setAlerta('exito',"Cuenta confirmada ");
    }

    $alertas=Usuario::getAlertas();


    // renderizar
    $router->render ('auth/confirmar-cuenta', [
      'alertas'=> $alertas
    ]);


  }

  public static function mensaje(Router $router){
    $router->render('auth/mensaje',[
    ]);
  }

 
}