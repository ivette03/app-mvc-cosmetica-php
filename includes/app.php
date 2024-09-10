<?php

use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); 
$dotenv->safeLoad();
require '../includes/funciones.php';
require_once '../includes/config/database.php';

//Conectamos a la abse de datos
ActiveRecord::setDB($db);


?>