<?php

define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function debuguear($variable) : string{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}
function isAuth() : void {
    if(!isset($_SESSION['login'])){
        header('Location:/');
    }
}
function isAdmin() :void{
    if(!isset($_SESSION['admin'])){
        header('Location:/');
    }
}
function esUltimo(string $actual, string $ultimo) :bool{
    if($actual !== $ultimo){
        return true;
    }
    return false;
}
?>