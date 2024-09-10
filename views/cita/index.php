<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservar cita</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
  
    <h1 class="text-center font-bold text-3xl text-purple-800 p-4">Reservar cita</h1>
    <?php include __DIR__ . '/../../views/templates/barra.php'; ?>
    <nav class="flex justify-between items-center my-8 text-center bg-[#FFCCE5] mx-4 flex-col md:flex-row tabs">
      <button type="button" class="font-bold text-xl p-2" data-paso="1">Servicios</button>
      <button type="button" class="font-bold text-xl p-2" data-paso="2">Información Cita</button>
      <button type="button" class="font-bold text-xl p-2" data-paso="3">Resumen</button>
    </nav>

    <!-- servicios -->
    <div id="paso-1" class="hidden">
      <h2 class="text-center text-3xl font-bold mb-3 text-purple-700">Servicios</h2>
      <p class="text-center text-xl">Elige tus servicios</p>
      <div id="servicios"></div>
    </div>
     <!-- resumen -->
     <div id="paso-3" class="hidden">
      
      <div id="resumen"></div>
      <div class="text-center">
            <input type="submit" value="Reservar" id="btnReservar" class="bg-purple-700 text-white font-bold p-3 text-center rounded-lg w-full hover:bg-purple-900 cursor-pointer">
      </div>
    </div>
    <!-- reservar -->
    <div id="paso-2" class="hidden">
      <h2 class="text-center text-3xl font-bold mb-3 text-purple-700">Reservar cita</h2>
      <p class="text-center text-xl">Escribe los datos y fecha de cita</p>
      <div class="flex flex-col items-center justify-center my-8 w-full md:flex-row">
        
        <form method="POST" class="rounded-xl p-8 bg-white w-full max-w-sm md:max-w-md md:mx-4" id="formulario" action="/api/cita">
          <div class="mb-4">
            <label for="nombre" class="block text-gray-700">Nombre:</label>
            <input type="text" placeholder="Escribe tu nombre" id="nombre" name="nombre" class="w-full mt-2 p-2 border rounded-md" value="<?php echo $nombre;?>" disabled>
          </div>
          <div class="mb-4">
            <label for="hora" class="block text-gray-700">Hora:</label>
            <input type="time" name="hora" id="hora" class="w-full mt-2 p-2 border rounded-md">
          </div>
          <div class="mb-4">
            <label for="fecha" class="block text-gray-700">Fecha:</label>
            <input type="date" name="fecha" id="fecha" class="w-full mt-2 p-2 border rounded-md" min="<?php  echo date('Y-m-d', strtotime('+1 day'));?>">
          </div>
           <!-- Campo hidden para enviar el usuarioId -->
           <input type="hidden" id="id" value="<?php echo $id;?>" name="usuarioId">
        </form>
      </div>
    </div>
    <div id="paginacion" class="flex justify-between mt-5 md:flex-row flex-col">
      <button class="bg-purple-700 rounded-xl text-white p-3 hover:bg-purple-900 mb-2 md:mb-0" id="anterior">&laquo; Anterior</button>
      <button class="bg-purple-700 rounded-xl text-white p-3 hover:bg-purple-900" id="siguiente">Siguiente &raquo;</button>
    </div>
    <?php
    $script="
    <script src='../../src/js/app.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    ";
    ?>
   
</body>
</html>
