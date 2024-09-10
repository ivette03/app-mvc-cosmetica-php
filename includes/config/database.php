<?php

$db=mysqli_connect(
    $_ENV['BD_HOST'],
    $_ENV['BD_USER'],
    $_ENV['BD_PASS'],
    $_ENV['BD_NAME'],
    $_ENV['BD_PUERTO']
);
$db->set_charset('utf8');
if(!$db){
    echo "no se pudo conectar";
    exit;
}

?>