<?php 
$this->db->select('homework.*,staff.name as creator_name');
$this->db->from('homework');
$this->db->join('staff', 'staff.id = homework.evaluated_by', 'left');
if (!is_superadmin_loggedin()) {
	$this->db->where('homework.branch_id', get_loggedin_branch_id());
}
$this->db->where('homework.id', $homeworkID);
$this->db->where('homework.session_id', get_session_id());
$this->db->order_by('homework.id', 'desc');
$row = $this->db->get()->row_array();
 ?>
<div class="row">
	<div class="col-md-8">
		<label><span class="text-weight-semibold"><?=translate('homework')?> :</span></label>
		<div class="alert alert-subl text-dark"><?=$row['description']?></div>
	</div>
	<div class="col-md-4">
		<label><span class="text-weight-semibold"><?=translate('date_of_homework')?></span> : <?=_d($row['date_of_homework'])?></label><br>
		<label><span class="text-weight-semibold"><?=translate('date_of_submission')?></span> : <?=_d($row['date_of_submission'])?> </label><br>
		<label><span class="text-weight-semibold"><?=translate('evaluation_date')?></span> : <?=$row['evaluation_date'] != null ? _d($row['evaluation_date']) : "N/A";?> </label><br>
		<label><span class="text-weight-semibold"><?=translate('evaluated_by')?></span> : <?=$row['creator_name'] != null ? $row['creator_name'] : "N/A";?></label><br>
		<label><span class="text-weight-semibold"><?=translate('document')?></span> : <a href="<?=base_url('homework/download/' . $row['id'])?>" class="mail-subj"><?=$row['document']?></a></label><br>
	<?php if ($row['status'] == 1) { ?>
		<label><span class="text-weight-semibold"><?=translate('published') . " " . translate('date')?></span> : <?=_d($row['schedule_date'])?> </label><br>
	<?php } else { ?>
		<p><a href="<?=base_url('homework/evaluate/' . $row['id'])?>" class="mail-subj">Click To Evaluate Homework</a></p>
	<?php } ?>
	</div>
</div>