<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administración</title>
</head>
<body>
    <?php include __DIR__ . '/../templates/barra.php';?>
    <h2 class="text-3xl font-bold text-center mt-5  text-purple-600">Buscar Citas</h2>
    <div class="flex justify-center items-center  mt-5">
        <form class="max-w-md w-full mx-auto text-black+ font-bold">
            <label for="fecha" >Buscar por fecha</label>
            <input type="date" id="fecha" class="w-full" name="fecha" value="<?php echo $fecha;?>">
        </form>
    </div>

    <div class="overflow-y-auto max-h-screen">
       <ul class="mt-5">
       <?php 
        $idCita=0;
        foreach($citas as $key=>$cita){
        
        if($idCita !== $cita->id){
        $total=0;     
       ?>
        <li class="border-t-2 border-t-pink-300 p-4">
            <p class="font-bold">Id: <span class="font-normal"><?php echo $cita->id;?></span></p>
            <p class="font-bold">Hora: <span class="font-normal"><?php echo $cita->hora;?></span></p>
            <p class="font-bold">Cliente: <span class="font-normal"><?php echo $cita->cliente;?></span></p>
            <p class="font-bold">Email: <span class="font-normal"><?php echo $cita->email;?></span></p>
            <p class="font-bold">Teléfono: <span class="font-normal"><?php echo $cita->telefono;?></span></p>
            <h2 class="text-3xl font-bold text-center text-purple-600">Servicios</h2>
        </li>
        <?php $idCita=$cita->id;  } 
        $total += $cita->precio;?>      
        <div class="p-4">
        <p class="font-bold">Servicio: <span class="font-normal"><?php echo $cita->servicio . " " . $cita->precio;?></span></p>
        </div>
        <?php
        $actual=$cita->id;
        $ultimo=$citas[$key + 1]->id ?? 0;
        ?>
        <?php if(esUltimo($actual,$ultimo)): ?>
            <p class="font-bold p-4">Total :<span class="font-normal">$<?php echo $total;?></span></p>
        <?php endif ?>
        <?php } ?>
       </ul>
    </div>
    <?php
    $script="<script src='../../src/js/buscador.js'></script>";
    ?>
</body>
</html>