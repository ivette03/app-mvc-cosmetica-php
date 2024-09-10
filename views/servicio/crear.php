<?php include __DIR__ . '/../templates/barra.php';?>
<div class="m-2">
    <?php include __DIR__ . '/../templates/alertas.php';?>
</div>
<div class="flex justify-center border-2 border-white p-4 m-4">
<form class="flex flex-col" method="POST">
<h2 class="text-center text-3xl font-bold mb-3 text-purple-700">Crear Servicio</h2>
<?php include_once __DIR__  . '/form.php'; ?>
<input type="submit" value="Crear" class="bg-purple-700 rounded-xl text-white hover:bg-purple-900 mt-5 p-2 cursor-pointer" >
</form>
</div>
<?php
if (isset($_SESSION['crear'])):
    $script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Servicio creado',
            text: '{$_SESSION['crear']}',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            window.location.href = '/admin/servicios';
        });
    </script>";
    // Limpiamos la sesión para que no se repita la alerta
    unset($_SESSION['crear']);
endif;
?>