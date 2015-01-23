<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/modulossecciones.png','border'=>'0')) ?> <?=anchor('modules_sections/index/'.$this->uri->segment(4),'Modulos de Secci&oacute;n')?></li>
    </ul>
	</div>
	<br>
	<?php echo form_open('modules_sections/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	$row=$query->result();
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('section_id',$this->uri->segment(4))?>
	<table>
	<tr>
		<td>Sección:</td>
		<td><?=$section->name;?></td>
	</tr>
	<tr><td>M&oacute;dulo:</td>
	<td><select name="module_id">
		<?php foreach($query2->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" 
			<?if($row2->id==$row[0]->module_id)
				echo "SELECTED";?>			
			><?=$row2->title;?></option>
		<?php endforeach;?>
	</select></td></tr>
	<tr>
		<td>Bloque:</td>
		<td><?php echo form_dropdown('block', $blocks, $row[0]->block);?></td>
	</tr>
	<tr><td></td>
	<td>
	<?=form_radio('visible', 1,($row[0]->visible==1)?TRUE:FALSE);?>Visible<br>
	<?=form_radio('visible', 0,($row[0]->visible==0)?TRUE:FALSE);?>Invisible
	</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('modules_sections/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>