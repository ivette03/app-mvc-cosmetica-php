<div class="flex justify-center items-center h-screen">
    <form class="bg-white shadow-md rounded px-8 py-3  my-4" method="POST">
    <div class="mt-4">
    <?php
     include __DIR__ . '/../templates/alertas.php';
    ?>
    </div>
        <h3 clasS="text-center font-bold text-purple-800 text-2xl p-2">Crear cuenta</h3>
        <div class="mb-4">
            <label class="block text-purple-700 text-sm font-bold mb-2" for="nombre">
                Nombre
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" placeholder="nombre" name="nombre" value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';?>">
        </div>
        <div class="mb-4">
            <label class="block text-purple-700 text-sm font-bold mb-2" for="apellido">
                Apellido
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="apellido" type="text" placeholder="apellido" name="apellido" value="<?php echo isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : '';?>">
        </div>
        <div class="mb-4">
            <label class="block text-purple-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';?>">
        </div>
        <div class="mb-4">
            <label class="block text-purple-700 text-sm font-bold mb-2" for="telefono">
                Teléfono
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telefono" type="text" placeholder="telefono" name="telefono" value="<?php echo isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono']) :'';?>">
        </div>
        <div class="mb-6">
            <label class="block text-purple-700 text-sm font-bold mb-2" for="password">
                Contraseña
            </label>
            <input class=" shadow appearance-none border rounded  w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="******************">
        </div>
        <div class="flex items-center  justify-center">
            <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Iniciar
            </button>
        </div>
        <div class="flex flex-col p-4 text-center">
            <a class="text-purple-600 block md:mx-3 hover:text-purple-800 " href="/">Ya tienes una cuenta? Iniciar Sesión</a><br>
            <a class="text-purple-600 hover:text-purple-800"  href="/olvide">Olvide mi contraseña</a>
        </div>
    </form>
</div>