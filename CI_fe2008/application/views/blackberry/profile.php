<?$row=$stories?>
<center>
<br/>
<table cellpadding="0" cellspacing="0">
	<tr><td align="center" style="font-family: Arial; font-weight:bold; font-size: 12px;"><?=$row->title?></td></tr>
	<tr><td align="center"><img src="<?=base_url().$row->picture_box?>" border="0" width="120px"/></td></tr>
	<tr><td align="center" style="font-family: Arial; font-weight:bold; font-size: 12px;"></td></tr>
	<tr><td><br/></td></tr>
	<tr><td>
			<?if(mdate('%Y-%m-%d',time())==(mdate('%Y-%m-%d',$row->datem))){?>
				<span style="font-family: Arial; font-weight:bold; font-size: 11px;"><?=ucfirst(strftime('%B %d %H:%M',$row->datem))?></span>
			<?}else{?>
				<span style="font-family: Arial; font-weight:normal; font-size: 11px;"><?=ucfirst(strftime('%B %d',$row->datem))?></span>
			<?}?>
	</td></tr>
	<tr><td><br/></td></tr>
	<tr><td  style="font-family: Arial; font-weight:normal; font-size: 11px;"><?=$row->text?></td></tr>
	<tr><td><br/></td></tr>
</table>
</center>