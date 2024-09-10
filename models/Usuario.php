<?php
namespace Model;
class Usuario extends ActiveRecord{
    protected static $tabla='Usuarios';
    protected static $columnaDb=['id','nombre','apellido','email','telefono','admin','confirmado','token','password'];
  

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;
    public $password;

    public function __construct($args=[]) {
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
        $this->apellido=$args['apellido'] ?? '';
        $this->email=$args['email'] ?? '';
        $this->telefono=$args['telefono'] ?? '';
        $this->admin=$args['admin'] ?? '0';
        $this->confirmado=$args['confirmado'] ?? '0';
        $this->token=$args['token'] ?? '0';
        $this->password=$args['password'] ?? '';
    }
    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][]='La constraseña es obligatorio';
        }
        return self::$alertas;
    }
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][]='El nombre es obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['error'][]='El apellido es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        if(!$this->telefono){
            self::$alertas['error'][]='El teléfono es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][]='La constraseña es obligatoria';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][]='La contraseña tiene que tener 6 o más caracteres';
        }
        return self::$alertas;
    }
    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email= '" . $this->email . "' LIMIT 1";
        $resultado=self::$db->query($query);
        if($resultado->num_rows > 0){
            self::$alertas['error'][]='Este usuario ya ha sido registrado antes';
            
        }
        return $resultado;
    }

    public function hashearPassword(){
        $this->password=password_hash($this->password,PASSWORD_BCRYPT);
    }
    public function crearToken(){
        $this->token=uniqid();
    }
    public function comprobarPasswordAndVerificado($password){
      $resultado=password_verify($password,$this->password);
      if(!$resultado  ||  $this->confirmado === '0'){
        self::$alertas['error'][]='Password incorrecto o tu cuenta no ha sido confirmada';
        return false;
      }else{
        return true;
      }
    }
    public function verificarEmail(){
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        return self::$alertas;
    }
    public function verificarPassword(){
        if(!$this->password){
            self::$alertas['error'][]="El password es obligatorio";
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][]='La constraseña no puede ser menos de 6 caracteres';
        }
        return self::$alertas;
    }
   




}



?>