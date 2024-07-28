<?php 
$count = 1; 
if (count($homeworklist)) {
	foreach ($homeworklist as $key => $row) {
	?>
<tr>
	<input type="hidden" name="evaluate[<?=$key?>][evaluation_id]" value="<?=$row['ev_id']?>">
	<input type="hidden" name="evaluate[<?=$key?>][student_id]" value="<?=$row['student_id']?>">
	<td><?php echo $count++; ?></td>
	<td><?php echo $row['fullname']; ?></td>
	<td><?php echo $row['register_no']; ?></td>
	<td><?php echo $row['subject_name']; ?></td>
	<td><?php 
	if ($row['ev_status'] == 'u' || $row['ev_status'] == '') {
		$labelmode = 'label-danger-custom';
		$status = translate('incomplete');
	} else {
		$status = translate('complete');
		$labelmode = 'label-success-custom';
	}
	echo "<span class='value label " . $labelmode . " '>" . $status . "</span>";
	 ?></td>
	<td><?=$row['rank']?></td>
	<td><?=$row['ev_remarks']?></td>
</tr>
<?php
	} 
} else {
	echo '<tr><td colspan="9"><h5 class="text-danger text-center">'.translate('no_information_available').'</td></tr>';
}?>


