<div class="text-center">
    <div class="my-6">
    <h3 class="text-2xl">Bienvenido <strong><?php echo $nombre;?></strong></h3>
    </div>
    <a class="bg-purple-800 p-3 text-white rounded-xl mx-4 block md:inline" href="/logout">Cerrar sesión</a>
</div>

<!--barra de navegacion del administrador-->
<?php
if(isset($_SESSION['admin'])){?>
<div class="flex flex-col md:flex-row  justify-center bg-[#FFCCE5]  font-bold mt-5 text-xl" >
    <a href="/admin/citas" class="p-3 hover:text-purple-600">Ver citas</a>
    <a href="/admin/servicios" class="p-3 hover:text-purple-600">Ver servicios</a>
    <a href="/admin/servicios/crear" class="p-3 hover:text-purple-600">Crear servicios</a>
</div>

<?php } ?>

 