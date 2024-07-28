<?php
$this->db->select('advance_salary.*,staff.name as staff_name,staff.staff_id as staffid');
$this->db->from('advance_salary');
$this->db->join('staff', 'staff.id = advance_salary.staff_id', 'left');
$this->db->where('advance_salary.id', $salary_id);
$row = $this->db->get()->row_array();
?>
<header class="panel-heading">
	<h4 class="panel-title"><i class="fas fa-list-ol"></i> <?=translate('review')?></h4>
</header>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table borderless mb-none">
			<tbody>
				<tr>
					<th width="120"><?=translate('reviewed_by')?> :</th>
					<td>
						<?php
                            if(!empty($row['issued_by'])){
                                echo html_escape(get_type_name_by_id('staff', $row['issued_by']));
                            }else{
                                echo translate('unreviewed');
                            }
						?>
					</td>
				</tr>
				<tr>
					<th><?=translate('applicant')?> :</th>
					<td><?=ucfirst($row['staff_name'])?></td>
				</tr>
				<tr>
					<th><?=translate('staff_id')?> :</th>
					<td><?=ucfirst($row['staffid'])?></td>
				</tr>
				<tr>
					<th><?=translate('amount')?> :</th>
					<td><?=html_escape($global_config['currency_symbol'] . $row['amount'])?></td>
				</tr>
				<tr>
					<th><?=translate('deduct_month')?> :</th>
					<td><?=date("F Y", strtotime($row['year'].'-'. $row['deduct_month']))?></td>
				</tr>
				<tr>
					<th><?=translate('applied_on')?> : </th>
					<td><?php echo _d($row['request_date']);?></td>
				</tr>
				<tr>
					<th><?=translate('reason')?> : </th>
					<td width="350"><?=(empty($row['reason']) ? 'N/A' : $row['reason']);?></td>
				</tr>
				<tr>
					<th><?php echo translate('comments'); ?> : </th>
					<td width="350"><?=(empty($row['comments']) ? 'N/A' : $row['comments']);?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<footer class="panel-footer">
	<div class="row">
		<div class="col-md-12 text-right">
			<button class="btn btn-default modal-dismiss"><?=translate('close')?></button>
		</div>
	</div>
</footer>

