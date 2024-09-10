<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;


class LoginController{
    public static function login(Router $router){
        $alertas=[];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
           $auth=new Usuario($_POST);
           $alertas=$auth->validarLogin();
           if(empty($alertas)){
            $usuario=Usuario::where('email',$auth->email);
            if($usuario){
                if($usuario->comprobarPasswordAndVerificado($auth->password)){
                   session_start();
                   $_SESSION['id']=$usuario->id ;
                   $_SESSION['nombre']=$usuario->nombre . " " . $usuario->apellido;
                   $_SESSION['email']=$usuario->email;
                   $_SESSION['login']=true;
                   if($usuario->admin === '1'){
                    $_SESSION['admin']=$usuario->admin ?? null;
                      header('Location:/admin/citas');
                   }else{
                     header('Location:/cita');
                   }
                }     
            }
           }
           $alertas=Usuario::getAlertas();
        }
        $router->render('auth/login',[
            'alertas'=>$alertas
        ]);

    }

    
    public static function crear_cuenta(Router $router){
        $usuario=new Usuario($_POST);
        $alertas=[];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas=$usuario->validarNuevaCuenta();
            if(empty($alertas)){
                $resultado=$usuario->existeUsuario();
                if($resultado->num_rows > 0){
                   $alertas=Usuario::getAlertas();
                }else{
                    $usuario->hashearPassword();
                    $usuario->crearToken();
                    $email=new Email($usuario->nombre,$usuario->email,$usuario->token);
                    $email->enviarEmail();
                    $resultado=$usuario->crear();
                    if($resultado){
                        header('Location:/mensaje');
                    }
                }
            }     
        }
        $router->render('auth/crear_cuenta',[
            'alertas'=>$alertas,
            'usuario'=>$usuario

        ]);
    }

    public static function confirmar(Router $router){
        $alertas=[];
        $token=$_GET['token'];
        $usuario=Usuario::where('token',$token);
        if(empty($usuario)){
            $alertas=Usuario::setAlertas('error','Token no Válido');
        }else{
            $usuario->confirmado="1";
            $usuario->token=null;
            $usuario->guardar();
            $alertas=Usuario::setAlertas('exito','Cuenta confirmada');
            header('Location:/');
        }
        $alertas=Usuario::getAlertas();

        $router->render('auth/confirmar_cuenta',[
            'alertas'=>$alertas

        ]);
    }
 
    public static function mensaje(Router $router){
        $router->render('auth/mensaje',[

        ]);

    }

    public static function olvide(Router $router){
        $alertas=[];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth=new Usuario($_POST);
            $alertas=$auth->verificarEmail();
            if(empty($alertas)){
                $usuario=Usuario::where('email',$auth->email);
                if($usuario && $usuario->confirmado === '1'){
                    $usuario->crearToken();
                    $usuario->guardar();
                    $email=new Email($usuario->nombre,$usuario->email,$usuario->token);
                    $email->enviarInstrucciones();
                    Usuario::setAlertas('exito','Por favor revise su email');
                }else{
                    Usuario::setAlertas('error','Usuario no exite o no esta confirmado');
                }
            }
            $alertas=Usuario::getAlertas();
        }
        $router->render('auth/olvide',[
            'alertas'=>$alertas

        ]);
    }

    public static function recuperar(Router $router){
        $resultado=null;
        $alertas=[];
        $token=$_GET['token'];
        $usuario=Usuario::where('token',$token);
        if(empty($usuario)){
            Usuario::setAlertas('error','El token no es válido');
           
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $password=new Usuario($_POST);
            $alertas=$password->verificarPassword();
            if(empty($alertas)){
                $usuario->password=null;
                $usuario->password=$password->password;
                $usuario->hashearPassword();
                $usuario->token=null;
                $resultado=$usuario->guardar();
            }
            if($resultado){
                Usuario::setAlertas('exito','Contraseña actualizada');
                header('Location:/');
            } else {
                Usuario::setAlertas('error', 'Error al actualizar el password');
            }
        }
        $alertas=Usuario::getAlertas();
        $router->render('auth/recuperar',[
            'alertas'=>$alertas

        ]);

        
    }
    public static function logout(){
        session_start();
        $_SESSION=[];
        header('Location:/');
    }
}
?>