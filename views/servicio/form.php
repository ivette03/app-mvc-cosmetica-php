
<label>Nombre:</label>
<input type="text" placeholder="Ingrese nombre del servicio" class="w-64 p-2" name="nombre" id="nombre" value="<?php echo htmlspecialchars($servicio->nombre);?>">
<label>Precio:</label>
<input type="number" step="0.01" min="0" placeholder="0.00" class="w-64  p-2" name="precio" id="precio" value="<?php echo htmlspecialchars($servicio->precio);?>">

