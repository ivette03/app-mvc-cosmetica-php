<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>servicios</title>
</head>

<body>

    <?php

use GrahamCampbell\ResultType\Success;

 include __DIR__ . '/../../views/templates/barra.php'; ?>
    <ul>
        <?php foreach($servicios as $servicio):?>
        <div class="flex justify-between border-4 border-t-pink-300 p-4 font-bold p-4">
            <div>
                <li><?php echo $servicio->nombre;?></li>
                <li class="text-purple-600">$<?php echo $servicio->precio;?></li>
            </div>
            <div class="flex ">
                <a href="/admin/servicios/actualizar?id=<?php echo $servicio->id;?>"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold p-3 rounded mx-2">
                    Actualizar
                </a>
                <form method="POST">
                    <input type="hidden" value="<?php echo $servicio->id;?>" name="id">
                    <input type="submit" value="Eliminar"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold p-3 rounded mx-2">
                </form>
            </div>
        </div>
        <?php endforeach ?>
    </ul>

    <?php
if (isset($_SESSION['eliminar'])):
    $script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Servicio eliminado',
            text: '{$_SESSION['eliminar']}',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            window.location.href = '/admin/servicios';
        });
    </script>";
    // Limpiamos la sesión para que no se repita la alerta
    unset($_SESSION['eliminar']);
endif;
?>
</body>

</html>