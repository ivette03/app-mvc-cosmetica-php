<div class="flex justify-center items-center h-screen">
    <form class="bg-white shadow-md rounded px-8 py-6  mb-4" method="POST">
    <?php
     include __DIR__ . '/../templates/alertas.php';
    ?>
          <h3 clasS="text-center font-bold text-purple-800 text-3xl py-8">Olvide password</h3>
          <p class="text-center font-bold text-purple-800">Restablece tu password escribiendo tu email</p>
        <div class="mb-4">
           
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="email" name="email">
        </div>
        
        <div class="flex items-center  justify-center">
            <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Enviar
            </button>
        </div>
        <div class="flex flex-col p-4 text-center">
            <a class="text-purple-600 block md:mx-3 hover:text-purple-800 " href="/crear-cuenta">Aun no tiene una cuenta? crear una</a><br>
            <a class="text-purple-600 hover:text-purple-800"  href="/">Ya tienes una cuenta? Inciar sesión</a>
        </div>
    </form>
</div>