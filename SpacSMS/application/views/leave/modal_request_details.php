<?php $row = $this->leave_model->getLeaveList(array('la.id' => $leave_id), true); ?>
<header class="panel-heading">
	<h4 class="panel-title"><i class="fas fa-bars"></i> <?php echo translate('details'); ?></h4>
</header>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table borderless mb-none">
			<tbody>
				<tr>
					<th width="120"><?=translate('reviewed_by')?> :</th>
					<td>
						<?php
                            if(!empty($row['approved_by'])){
                                echo html_escape(get_type_name_by_id('staff', $row['approved_by']));
                            }else{
                                echo translate('unreviewed');
                            }
						?>
					</td>
				</tr>
				<tr>
					<th><?php echo translate('applicant'); ?> : </th>
					<td><?php
							if ($row['role_id'] == 7) {
							 	$getStudent = $this->application_model->getStudentDetails($row['user_id']);
							 	echo $getStudent['first_name'] . " " . $getStudent['last_name'];
							} else {
								$getStaff = $this->db->select('name,staff_id')->where('id', $row['user_id'])->get('staff')->row_array();
								echo $getStaff['name'];
							}?></td>
				</tr>
<?php if ($row['role_id'] == 7) { ?>
				<tr>
					<th><?php echo translate('class'); ?> : </th>
					<td><?php echo $getStudent['class_name'] . ' (' . $getStudent['section_name'] . ')'; ?></td>
				</tr>
<?php }else{ ?>
				<tr>
					<th><?php echo translate('staff_id'); ?> : </th>
					<td><?php echo $getStaff['staff_id']; ?></td>
				</tr>
<?php } ?>
				<tr>
					<th><?php echo translate('leave_category'); ?> : </th>
					<td><?php echo $row['category_name']; ?></td>
				</tr>
				<tr>
					<th><?php echo translate('apply') . " " . translate('date'); ?> : </th>
					<td><?php echo _d($row['apply_date']) . " " . date('h:i A' ,strtotime($row['apply_date'])); ?></td>
				</tr>
				<tr>
					<th><?php echo translate('start_date'); ?> : </th>
					<td><?php echo _d($row['start_date']); ?></td>
				</tr>
				<tr>
					<th><?php echo translate('end_date'); ?> : </th>
					<td><?php echo _d($row['end_date']); ?></td>
				</tr>
				<tr>
					<th><?php echo translate('reason'); ?> : </th>
					<td><?php echo (empty($row['reason']) ? 'N/A' : $row['reason']); ?></td>
				</tr>
<?php if (!empty($row['enc_file_name'])) { ?>
				<tr>
					<th><?php echo translate('attachment'); ?> : </th>
					<td>
						<a class="btn btn-default btn-sm" target="_blank" href="<?=base_url('leave/download/' . $row['id'] . '/' . $row['enc_file_name'])?>">
							<i class="far fa-arrow-alt-circle-down"></i> <?php echo translate('download'); ?>
						</a>
					</td>
				</tr>
<?php } ?>
				<tr>
					<th><?php echo translate('comments'); ?> : </th>
					<td><?php echo (empty($row['comments']) ? 'N/A' : $row['comments']); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<footer class="panel-footer">
	<div class="row">
		<div class="col-md-12 text-right">
			<button class="btn btn-default modal-dismiss"><?php echo translate('close'); ?></button>
		</div>
	</div>
</footer>