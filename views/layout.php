<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo list</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background-color: #FFDDF2;" class="flex flex-col md:flex-row ">
    <!-- Contenedor para la imagen de fondo -->
    <div class="bg-cover bg-center md:w-1/2 min-h-screen md:min-h-auto bg-no-repeat" style="background-image: url('../../src/img/imagenf.jpg');"></div>
    
    <!-- Contenedor para el mensaje -->
    <div class="w-full md:w-1/2 mt-5 ">
    <?php echo $contenido; ?>
    </div>
    <?php
    echo $script ?? '';
    ?>
</body>
</html>
