<?php

namespace Controllers;

use Model\Admin;
use MVC\Router;

class AdminController
{
    public static function index(Router $router){
        session_start();
        isAdmin();
        $fecha=$_GET['fecha'] ?? date('Y-m-d') ;
        $fechas=explode('-', $fecha);
        if(!checkdate((int)$fechas[1], (int)$fechas[2], (int)$fechas[0])){
            header('Location: /404');
            exit;
        }
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citaservicio ";
        $consulta .= " ON citaservicio.idCita=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citaservicio.idServicio ";
        $consulta .= " WHERE fecha =  '${fecha}' ";
        $resultado=Admin::sql($consulta);
       
        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas'=>$resultado,
            'fecha'=>$fecha
        ]);
       
    }
}
