<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/accion.png','border'=>'0')) ?> <?=anchor('actions/index/'.$this->uri->segment(4).'/'.$this->uri->segment(5),'Acciones')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('actions/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5))?>
	<?php $row=$query->result(0);
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('match_id',$this->uri->segment(4));
	echo form_hidden('team_id',$this->uri->segment(5))?>
	<table>
	<tr><td>Acci&oacute;n:</td>
	<td><textarea name="text" cols=20 rows=15><?=$row[0]->text?></textarea>*</td></tr>
	
	<tr><td>Tipo:</td><td><input type="text" name="type" value="<?=$row[0]->type?>"/>*</td></tr>
	
	<tr><td>Tipo:</td>
	<td><select name="type">
		<option value="1" <?php if($row[0]->type==1) echo " SELECTED "?>>1</option>
		<option value="2" <?php if($row[0]->type==2) echo " SELECTED "?>>2</option>
		<option value="3" <?php if($row[0]->type==3) echo " SELECTED "?>>3</option>
	</select></td></tr>
	
	<tr><td>Minuto:</td><td><input type="text" name="match_time" value="<?=$row[0]->match_time?>"/>*</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name='submit' value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('actions/index/'.$this->uri->segment(4).'/'.$this->uri->segment(5));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>