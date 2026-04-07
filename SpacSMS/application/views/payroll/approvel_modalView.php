<?php
$this->db->select('leave_application.*,leave_category.name as type_name,staff.name as staff_name,staff.staff_id as staffid');
$this->db->from('leave_application');
$this->db->join('leave_category', 'leave_category.id = leave_application.category_id', 'left');
$this->db->join('staff', 'staff.id = leave_application.staff_id', 'left');
$this->db->where('leave_application.id', $leave_id);
$row = $this->db->get()->row_array();
?>
<?php echo form_open('leave/request_approval/' . $row['id']); ?>
	<header class="panel-heading">
		<h4 class="panel-title"><i class="fas fa-bars"></i> <?php echo translate('details'); ?></h4>
	</header>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table borderless mb-none">
				<tbody>
					<tr>
						<th><?php echo translate('staff') . " " . translate('name'); ?> : </th>
						<td><?php echo html_escape($row['staff_name']); ?></td>
					</tr>
					<tr>
						<th><?php echo translate('staff') . " " . translate('id'); ?> : </th>
						<td><?php echo html_escape($row['staffid']); ?></td>
					</tr>
					<tr>
						<th><?php echo translate('leave_type'); ?> : </th>
						<td><?php echo html_escape($row['type_name']); ?></td>
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
						<td><?php echo html_escape($row['reason']); ?></td>
					</tr>
<?php if (!empty($row['enc_file_name'])) { ?>
					<tr>
						<th><?php echo translate('attachment'); ?> : </th>
						<td><a class="btn btn-default btn-sm" href="<?php echo base_url('leave/download/' . $row['id'] . '/' . $row['enc_file_name']); ?>"><i class="far fa-arrow-alt-circle-down"></i> <?php echo translate('download'); ?></a></td>
					</tr>
<?php } ?>
					<tr>
		                <th><?php echo translate('status'); ?> : </th>
						<th>
		                    <div class="radio-custom radio-inline">
		                        <input type="radio" id="pending" name="status" value="1" <?php echo ($row['status'] == 1 ? ' checked' : ''); ?>>
		                        <label for="pending"><?php echo translate('pending'); ?></label>
		                    </div>
		                    <div class="radio-custom radio-inline">
		                        <input type="radio" id="paid" name="status" value="2" <?php echo ($row['status'] == 2 ? ' checked' : ''); ?>>
		                        <label for="paid"><?php echo translate('approved'); ?></label>
		                    </div>
		                    <div class="radio-custom radio-inline">
		                        <input type="radio" id="reject" name="status" value="3" <?php echo ($row['status'] == 3 ? ' checked' : ''); ?>>
		                        <label for="reject"><?php echo translate('reject'); ?></label>
		                    </div>
						</th>
					</tr>
					<tr>
						<th><?php echo translate('comments'); ?> : </th>
						<td><textarea class="form-control" name="comments" rows="3"><?php echo html_escape($row['comments']); ?></textarea></td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
	<footer class="panel-footer">
		<div class="row">
			<div class="col-md-12 text-right">
				<button class="btn btn-default mr-xs" type="submit" name="save" value="1">
					<i class="fas fa-plus-circle"></i> <?php echo translate('apply'); ?>
				</button>
				<button class="btn btn-default modal-dismiss"><?php echo translate('close'); ?></button>
			</div>
		</div>
	</footer>
<?php echo form_close(); ?>