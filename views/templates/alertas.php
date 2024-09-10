<?php $alertas=$alertas ?? [];?>
<?php
//mostrando las alertas
foreach ($alertas as $key => $mensajes) :
    foreach ($mensajes as $mensaje) :
        $color='';
        if($key === 'error'){
            $color='bg-red-500 text-white';
        }else{
            $color='bg-green-500 text-white';
        }
?>
    <div class="m-2 <?php echo $color;?>">
        <p class="p-1 font-bold text-center "><?php echo $mensaje; ?></p>
    </div>
<?php
    endforeach;
endforeach;
?>