<?php
namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use MVC\Router;
use Model\Servicio;

class ApiController{
    public static function index(){
        $servicios=Servicio::all();
        echo json_encode($servicios);
    }
    public static function guardar(){
        $cita=new cita($_POST);
        $resultado=$cita->crear();
        $citaId=$resultado['id'];
        $idServicios=explode(',',$_POST['servicios']);
        
        foreach($idServicios as $idServicio){
             $args=[
                 'idServicio'=>intval($idServicio),
                 'idCita'=>$citaId
             ];
             $citaServicio=new CitaServicio($args);
             $citaServicio->crear();
        }
        
        echo json_encode(['resultado'=>$resultado]);
        
    }

}
?>