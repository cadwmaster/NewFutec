<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/encabezados.png','border'=>'0')) ?> <?=anchor('headers','Encabezados')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('headers/insert')?>
	<?php echo form_hidden('id',$id=0)?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?php echo set_value('name')?>"/>*</td></tr>
	<tr><td>Archivo:</td><td><input type="file" name="file" /></td></tr>
	<tr><td>Ancho:</td><td><input type="text" name="width" value="<?php echo set_value('width')?>"/></td></tr>
	<tr><td>Altura:</td><td><input type="text" name="height" value="<?php echo set_value('height')?>"/></td></tr>
	<tr><td>Descripci&oacute;n:</td><td><input type="text" name="description" value="<?php echo set_value('description')?>"/></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('headers');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>