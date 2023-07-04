<?php namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;


class email {

  public $email;
  public $nombre;
  public $token;

  public function __construct($email, $nombre, $token)
  {
    $this->email=$email;
    $this->nombre=$nombre;
    $this->token=$token;
  }

  public function enviarConfirmacion(){
    
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = $_ENV['EMAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->Port = $_ENV['EMAIL_PORT'];
    $mail->Username =$_ENV['EMAIL_USER'] ;
    $mail->Password = $_ENV['EMAIL_PASS'];
    $mail->Subject = 'Confirmar tu cuenta';

    //Recipients
    $mail->isHTML(true);
    $mail->CharSet='UTF-8';

    $mail->setFrom('Cuentas@appsalon.com', 'Mailer');
    $mail->addAddress('ceuntas@appsalon.com', 'AppSalon.com');  
    $contenido="<html>";
    $contenido.="<p> Hola <strong>". $this->nombre ."</strong>  Has creado tu cuenta en appsalon, solo debes confirmarla presionando el siguiente enlace: </p>";
    $contenido.="<p> <a href='" .$_ENV['APP_URL']. "/confirmar-cuenta?token=". $this->token."'>Confirmar cuenta</a> </p>";
    $contenido.="Si no solicitaste esta cuenta, ignorad el mensaje";
    $contenido.="</html>";

    $mail->Body    = $contenido;
    $mail->AltBody = 'es para confirmar la cuenta';

    // enviar el email
    $mail->send();

  }

  public function recuperarContraseña(){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = $_ENV['EMAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->Port = $_ENV['EMAIL_PORT'];
    $mail->Username =$_ENV['EMAIL_USER'] ;
    $mail->Password = $_ENV['EMAIL_PASS'];
    $mail->Subject = 'Confrimar tu cuenta';

    //Recipients
    $mail->isHTML(true);
    $mail->CharSet='UTF-8';

    $mail->setFrom('Cuentas@appsalon.com', 'Mailer');
    $mail->addAddress('ceuntas@appsalon.com', 'AppSalon.com');  
    $contenido="<html>";
    $contenido.="<p> Hola <strong>". $this->nombre ."</strong>  Haz solicitado el cambio de contraseña de tu cuenta: </p>";
    $contenido.="<p> Presiona aqui: <a href='".$_ENV['APP_URL']."/recuperar?token=". $this->token."'>Cambiar Contraseña</a> </p>";
    $contenido.="Si no solicitaste esta cambio, ignora el mensaje";
    $contenido.="</html>";

    $mail->Body    = $contenido;
    $mail->AltBody = 'correo para cambiar la contraseña';

    // enviar el email
    $mail->send();
  }

}