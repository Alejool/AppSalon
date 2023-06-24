<?php  namespace Model;


class Usuario extends ActiveRecord {


  // creamos los valores para mapear los datos
  protected static $tabla= 'usuarios';
  protected static $columnasDB = ['id', 'nombre', 'apellido', 'email','password', 'telefono', 'admin', 'confirmado', 'token' ];
  
  public $id;
  public $nombre;
  public $apellido;
  public $telefono;
  public $email;
  public $password;
  public $admin;
  public $confirmado;
  public $token;

  public function __construct($usuario=[])
  {
    $this->id=$usuario['id']?? null;
    $this->nombre=$usuario['nombre']?? '';
    $this->apellido=$usuario['apellido']?? "";
    $this->email=$usuario['email']?? "";
    $this->password=$usuario['password']?? "";
    $this->telefono=$usuario['telefono']?? "";
    $this->admin=$usuario['admin']?? 0;
    $this->confirmado=$usuario['confirmado']?? 0;
    $this->token=$usuario['token']?? "";
  }

  public function validarCuenta() {
    if (!$this->nombre){
      self::$alertas['error'][]= "el nombre es obligatorio";
    }
    if(!preg_match(static::$validarText, $this->nombre) && $this->nombre){
      self::$alertas['error'][]='el nombre solo puede tener letras';
    }

    if (!$this->apellido){
      self::$alertas['error'][]= "el apellido es obligatorio";
    }
    if(!preg_match(static::$validarText, $this->apellido) && $this->apellido){
      self::$alertas['error'][]='el apellido solo puede tener letras';
    }


    if (!$this->email  ){
      self::$alertas['error'][]= "el email es obligatorio";
    }

    if(!preg_match(static::$ValidarCorreo, $this->email)){
      self::$alertas['error'][]= "el email no tiene el formato correcto";
    }

    if (strlen($this->password)<6){
      self::$alertas['error'][]= "el password debe contener al memos 6 caracteres";
    }

    if (!$this->password){
      self::$alertas['error'][]= "el password es obligatorio";
    }

    if (!$this->telefono){
      self::$alertas['error'][]= "el telefono es obligatorio";
    }

    if(!preg_match(static::$ValidarTel, $this->telefono) && $this->telefono){
      self::$alertas['error'][]='el telefono debe contener 10 dígitos';
    }




    return self::$alertas;
  }

  public function existeUsuario(){
    $query="SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email. "' LIMIT 1";

    // buscarlo en la bd
    $usuario=self::consultarSQL($query);

    if($usuario[0]){
       self::$alertas['error'][]= "El usuario esta registrado";
    }
    return $usuario;

  }

  public function hashPassword(){

    $this->password=password_hash($this->password, PASSWORD_BCRYPT);

    
  }

  public function crearToken(){
    $this->token=uniqid();
  }

  public function validarLogin()
  {
    if (!$this->email  ){
      self::$alertas['error'][]= "el email es obligatorio";
    }
    if(!preg_match(static::$ValidarCorreo, $this->email)){
      self::$alertas['error'][]= "el email no tiene el formato correcto";
    }

    if (strlen($this->password)<6){
      self::$alertas['error'][]= "el password debe contener al memos 6 caracteres";
    }

    if (!$this->password){
      self::$alertas['error'][]= "el password es obligatorio";
    }

    return self::$alertas;
    
  }

  public function validarConfirmadoAndPassword($password){
    
    
     //validar si esta confirmado
    if($this->confirmado){

      //if alternativo validar password
      if(password_verify($password, $this->password)):

        return true;

      else:

        $this::setAlerta('error',' contraseña incorrecta');
      endif;

    
    }
    else 
    {
      $this::setAlerta('error',' Usuario no confirmado');
    }
  }

  public function validarEmail() {
    if (!$this->email  ){
      self::$alertas['error'][]= "el email es obligatorio";
    }
    if(!preg_match(static::$ValidarCorreo, $this->email)){
      self::$alertas['error'][]= "el email no tiene el formato correcto";
    }

    return self::$alertas;
  }

  public function validarPassword() {
    if (strlen($this->password)<6){
      self::$alertas['error'][]= "el password debe contener al memos 6 caracteres";
    }

    if (!$this->password){
      self::$alertas['error'][]= "el password es obligatorio";
    }

    return self::$alertas;
  }

  public function actualizarPassword($password){
    $this->password=$password;
    $this->token='';
  }
  

 




}