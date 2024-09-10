<?php
namespace Controllers;

use Model\Servicio;
use MVC\Router;
class ServicioController{
    public static function index (Router $router){
        session_start();
        isAdmin();
        $servicios=Servicio::all();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id=$_POST['id'];
            if(!is_numeric($id)){
                header('Location:/admin/servicios');
                exit;
            }else{
                $servicio=Servicio::find($id);
                $servicio->eliminar();
                $_SESSION['eliminar']='El servicio fue eliminado correctamente';
            }
        }
        $router->render('servicio/index',[
            'nombre'=>$_SESSION['nombre'],
            'servicios'=>$servicios,
           
        ]);

    }
    public static function crear(Router $router){
        session_start();
        isAdmin();
        $alertas=[];
        $servicio=new Servicio($_POST);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $alertas=$servicio->validar();
            if(empty($alertas)){
                $servicio->crear();
                $_SESSION['crear']='El servicio fue creado con exito';
            }
        }
        $router->render('servicio/crear',[
            'nombre'=>$_SESSION['nombre'],
            'servicio'=>$servicio,
            'alertas'=>$alertas
        ]);
    }
    public static function actualizar(Router $router){
        session_start();
        isAdmin();
        $id=$_GET['id'];
        if(!is_numeric($id)){
            header('Location: /admin/servicios');
            exit;
        };
        $servicio=Servicio::find($id);
        $alertas=[];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);
            $alertas=$servicio->validar();
            if(empty($alertas)){
               $servicio->actualizar();
               $_SESSION['actualizar']='El servicio fue actualizado correctamente';
            }
        }
        $router->render('servicio/actualizar',[
            'servicio'=>$servicio,
            'alertas'=>$alertas,
            'nombre'=>$_SESSION['nombre'],
        ]);
    }
}
?>