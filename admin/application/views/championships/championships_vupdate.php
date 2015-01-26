<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/campeonato.png','border'=>'0')) ?> <?=anchor('championships','Campeonatos')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('championships/update/'.$this->uri->segment(3));	  
	$row=current($query->result());
	echo form_hidden('id',$row->id);?>
	<table width='95%'>
		<tr>
			<td>
				<table>
				<tr><td>Nombre:</td><td><input type="text" name="name" value="<?=$row->name?>" />*</td></tr>
				<tr><td>Imagen:</td><td><input type="file" name="image" /></td></tr>
				<tr><td>A&ntilde;o</td>
				<td><select name="year">
				<?php for($i = 2000; $i <= mdate("%Y",time())+1; $i += 1){?>
				<option value="<?php echo $i?>" <?php if($row->year==$i) echo " SELECTED "?>><?php echo $i?></option><?php }?>
				</select></td></tr>
				<tr><td>Ronda Activa:
				</td><td><select name="active_round">
							<option value=0 <? if($row->active_round==0) echo "SELECTED";?>>ninguna</option>
							<?php foreach($rnds->result() as $rou):?>
								<option value= <?='"'.$rou->id.'"'; if($row->active_round==$rou->id) echo "SELECTED";?>><?=$rou->name?></option> 
							<?php endforeach;?>
						</select></td></tr>
				</table>
			</td>
			<td align='right'>
				<?=img(array('src' => $row->image,'width' => '150','height' => '150','border'=>'1'))?>
			</td>
		</tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('championships');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>