<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?php echo (empty(validation_errors()) ? 'active' : ''); ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> <?php echo translate('leave_list'); ?></a>
			</li>
<?php if (get_permission('leave_request', 'is_add')) { ?>
			<li class="<?php echo (!empty(validation_errors()) ? 'active' : ''); ?>">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?php echo translate('leave_request'); ?></a>
			</li>
<?php } ?>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane <?php echo (empty(validation_errors()) ? 'active' : ''); ?>">
				<table class="table table-bordered table-condensed table-hover mb-none table_default" >
					<thead>
						<tr>
							<th><?=translate('sl')?></th>
							<th><?=translate('applicant')?></th>
							<th><?=translate('leave_category')?></th>
							<th><?=translate('date_of_start')?></th>
							<th><?=translate('date_of_end')?></th>
							<th><?=translate('days'); ?></th>
                            <th><?=translate('apply_date')?></th>
							<th><?=translate('status')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						if (count($leavelist)) {
							foreach($leavelist as $row) {
								?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php
									echo !empty($row['orig_file_name']) ? '<i class="fas fa-paperclip"></i> ' : '';
									if ($row['role_id'] == 7) {
									 	$getStudent = $this->application_model->getStudentDetails($row['user_id']);
									 	echo $getStudent['first_name'] . " " . $getStudent['last_name'] . '<br><small> - ' .
									 	$getStudent['class_name'] . ' (' . $getStudent['section_name'] . ')</small>';
									} else {
										$getStaff = $this->db->select('name,staff_id')->where('id', $row['user_id'])->get('staff')->row_array();
										echo $getStaff['name'] . '<br><small> - ' . $getStaff['staff_id'] . '</small>';
									}
									?></td>
							<td><?php echo $row['category_name']; ?></td>
							<td><?php echo _d($row['start_date']); ?></td>
							<td><?php echo _d($row['end_date']); ?></td>
							<td><?php echo $row['leave_days']; ?></td>
							<td><?php echo _d($row['apply_date']); ?></td>
							<td>
								<?php
								if ($row['status'] == 1)
									$status = '<span class="label label-warning-custom text-xs">' . translate('pending') . '</span>';
								else if ($row['status']  == 2)
									$status = '<span class="label label-success-custom text-xs">' . translate('accepted') . '</span>';
								else if ($row['status']  == 3)
									$status = '<span class="label label-danger-custom text-xs">' . translate('rejected') . '</span>';
								echo ($status);
								?>
							</td>
							<td>
								<a href="javascript:void(0);" class="btn btn-circle icon btn-default" onclick="getRequestDetails('<?=$row['id']?>')">
									<i class="fas fa-bars"></i>
								</a>
								<?php if ($row['status'] == 1 && get_permission('leave_request', 'is_delete')) { ?>
									<?php echo btn_delete('leave/request_delete/' . $row['id']); ?>
								<?php } ?>
							</td>
						</tr>
						<?php } } ?>
					</tbody>
				</table>
			</div>
<?php if (get_permission('leave_request', 'is_add')) { ?>
			<div class="tab-pane <?php echo (!empty(validation_errors()) ? 'active' : ''); ?>" id="create">
				<?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('leave_type')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
					            $query = $this->db->select('id,name,days')
					            ->where(array('branch_id' => get_loggedin_branch_id(), 'role_id' => loggedin_role_id()))
					            ->get('leave_category');
					            $arrayCategory = array('' => translate('select'));
					            if ($query->num_rows() != 0) {
					                $sections = $query->result_array();
					                foreach ($sections as $row) {
					                	$categoryid = $row['id'];
					                	$arrayCategory[$categoryid] = $row['name'] . ' (' . $row['days'] . ')';
					                }
					            }
								echo form_dropdown("leave_category", $arrayCategory, set_value('leave_category'), "class='form-control' data-plugin-selectTwo
								data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"><?=form_error('leave_category')?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('date')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
								<input type="text" class="form-control" name="daterange" id="daterange" value="<?=set_value('daterange', date("Y/m/d") . ' - ' . date("Y/m/d"))?>" required />
							</div>
							<span class="error"><?=form_error('daterange')?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('reason')?></label>
						<div class="col-md-6">
							<textarea class="form-control" name="reason" rows="3"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('attachment')?></label>
						<div class="col-md-6 mb-md">
							<input type="file" name="attachment_file" class="dropify" data-height="80" />
							<span class="error"><?=form_error('attachment_file')?></span>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-offset-3 col-md-2">
								<button type="submit" name="save" value="1" class="btn btn-default btn-block"><i class="fas fa-plus-circle"></i> <?=translate('save')?></button>
							</div>
						</div>
					</footer>
				<?php echo form_close(); ?>
			</div>
<?php } ?>
		</div>
	</div>
</section>

<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
	<section class="panel" id='quick_view'></section>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#daterange').daterangepicker({
			opens: 'left',
		    locale: {format: 'YYYY/MM/DD'}
		});
	});

	function getRequestDetails(id) {
	    $.ajax({
	        url: base_url + 'leave/getRequestDetails',
	        type: 'POST',
	        data: {'id': id},
	        dataType: "html",
	        success: function (data) {
	            $('#quick_view').html(data);
	            mfp_modal('#modal');
	        }
	    });
	}
</script>