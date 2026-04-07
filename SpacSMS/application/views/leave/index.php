<?php $widget = (is_superadmin_loggedin() ? 'col-md-6' : 'col-md-offset-3 col-md-6'); ?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><?=translate('select_ground')?></h4>
			<?php if (get_permission('leave_manage', 'is_add')): ?>
				<div class="panel-btn">
					<a href="javascript:void(0);" id="addLeave" class="btn btn-default btn-circle" >
						<i class="fas fa-plus-circle"></i> Add Leave
					</a>
				</div>
			<?php endif; ?>
			</header>
			<?php echo form_open($this->uri->uri_string(), array('class' => 'validate')); ?>
				<div class="panel-body">
					<div class="row mb-sm">
					<?php if (is_superadmin_loggedin()): ?>
						<div class="col-md-6 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('branch'); ?> <span class="required">*</span></label>
								<?php
									$arrayBranch = $this->app_lib->getSelectList('branch');
									echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' required
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
								?>
							</div>
						</div>
					<?php endif; ?>
						<div class="<?=$widget?> mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('role'); ?> <span class="required">*</span></label>
				                <?php
				                    $role_list = $this->app_lib->getRoles([1,6]);
				                    echo form_dropdown("role_id", $role_list, set_value('role_id'), "class='form-control' required
				                    data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
				                ?>
							</div>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-offset-10 col-md-2">
							<button type="submit" name="search" value="1" class="btn btn btn-default btn-block"><i class="fas fa-filter"></i> <?=translate('filter')?></button>
						</div>
					</div>
				</footer>
			<?php echo form_close(); ?>
		</section>
		<section class="panel appear-animation" data-appear-animation="<?=$global_config['animations'] ?>" data-appear-animation-delay="100">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-users" aria-hidden="true"></i> <?=translate('leave_list')?></h4>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-condensed table-hover mb-none table-export" >
					<thead>
						<tr>
							<th><?=translate('sl')?></th>
							<th><?=translate('role')?></th>
							<th><?=translate('applicant')?></th>
							<th><?=translate('leave_category')?></th>
							<th><?=translate('date_of_start')?></th>
							<th><?=translate('date_of_end')?></th>
							<th><?=translate('days')?></th>
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
							<td><?php echo ucfirst($row['role']) ?></td>
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
							<td><?php echo $row['category_name'] ?></td>
							<td><?php echo _d($row['start_date']) ?></td>
							<td><?php echo _d($row['end_date']) ?></td>
							<td><?php echo $row['leave_days'] ?></td>
							<td><?php echo _d($row['apply_date']) ?></td>
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
							<?php if (get_permission('leave_manage', 'is_add')) { ?>
								<a href="javascript:void(0);" class="btn btn-circle icon btn-default" onclick="getApprovelLeaveDetails('<?=$row['id']?>')">
									<i class="fas fa-bars"></i>
								</a>
							<?php } ?>
							<?php if (get_permission('leave_manage', 'is_delete')) { ?>
								<?php echo btn_delete('leave/delete/' . $row['id']); ?>
							<?php } ?>
							</td>
						</tr>
						<?php } } ?>
					</tbody>
				</table>
			</div>
		</section>
	</div>
</div>

<!-- Leave View Modal -->
<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
	<section class="panel" id='quick_view'></section>
</div>

<?php if (get_permission('leave_manage', 'is_add')): ?>
<!-- Leave Add Modal -->
<div id="addLeaveModal" class="zoom-anim-dialog modal-block mfp-hide modal-block-lg">
    <section class="panel">
        <div class="panel-heading">
            <h4 class="panel-title"><i class="fas fa-plus-circle"></i> <?php echo translate('add_leave'); ?></h4>
        </div>
		<?php echo form_open_multipart('leave/save', array('class' => 'form-horizontal frm-submit-data')); ?>
		<div class="panel-body">
			<?php if (is_superadmin_loggedin()): ?>
			<div class="form-group mt-md">
				<label class="col-md-3 control-label"><?=translate('branch')?> <span class="required">*</span></label>
				<div class="col-md-9">
					<?php
						$arrayBranch = $this->app_lib->getSelectList('branch');
						echo form_dropdown("branch_id", $arrayBranch, "", "class='form-control' onchange='getStafflistRole()'
						id='branch_id' data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					<span class="error"></span>
				</div>
			</div>
			<?php endif; ?>
	        <div class="form-group mt-md">
				<label class="col-md-3 control-label"><?=translate('role')?> <span class="required">*</span></label>
				<div class="col-md-9">
	                <?php
	                    $role_list = $this->app_lib->getRoles([1,6]);
	                    echo form_dropdown("user_role", $role_list, set_value('user_role'), "class='form-control' id='user_role' onchange='getStafflistRole()'
	                    data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
	                ?>
	                <span class="error"></span>
				</div>
			</div>
			<div class="form-group" id="classDiv" style="display: none;">
				<label class="col-md-3 control-label"><?=translate('class')?> <span class="required">*</span></label>
				<div class="col-md-9">
					<?php
						$array = array("" => translate('select'));
						echo form_dropdown("class_id", $array, set_value('class_id'), "class='form-control' id='class_id'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
					?>
					<span class="error"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?=translate('applicant')?> <span class="required">*</span></label>
				<div class="col-md-9">
					<?php
						$array = array("" => translate('select'));
						echo form_dropdown("applicant_id", $array, set_value('applicant_id'), "class='form-control' id='applicant_id'
						data-plugin-selectTwo data-width='100%' ");
					?>
					<span class="error"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?=translate('leave_category')?> <span class="required">*</span></label>
				<div class="col-md-9">
					<?php
						$array = array("" => translate('select'));
						echo form_dropdown("leave_category", $array, set_value('leave_category'), "class='form-control' id='leave_category'
						data-plugin-selectTwo data-width='100%' ");
					?>
					<span class="error"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?=translate('leave_date')?> <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="input-group">
						<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
						<input type="text" class="form-control" name="daterange" id="daterange" value="<?=set_value('daterange', date("Y/m/d") . ' - ' . date("Y/m/d"))?>" required />
					</div>
					<span class="error"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('reason'); ?></label>
				<div class="col-md-9">
					<textarea class="form-control" name="reason" rows="3"><?php echo set_value('reason'); ?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('attachment'); ?></label>
				<div class="col-md-9">
					<input type="file" name="attachment_file" id="attachment_file" class="dropify" data-height="80" />
					<span class="error"></span>
				</div>
			</div>
			<div class="form-group mb-lg">
				<label class="col-md-3 control-label"><?php echo translate('comments'); ?></label>
				<div class="col-md-9">
					<textarea class="form-control" name="comments" rows="3"><?php echo set_value('comments'); ?></textarea>
				</div>
			</div>
		</div>
		    <footer class="panel-footer">
		        <div class="row">
		            <div class="col-md-12 text-right">
		                <button type="submit" class="btn btn-default mr-xs" id="savebtn" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
		                    <i class="fas fa-plus-circle"></i> <?=translate('apply') ?>
		                </button>
		                <button class="btn btn-default modal-dismiss"><?=translate('cancel') ?></button>
		            </div>
		        </div>
		    </footer>
		<?php echo form_close();?>
    </section>
</div>
<?php endif; ?>

<script type="text/javascript">
	$(document).ready(function () {
		$('#daterange').daterangepicker({
			opens: 'left',
		    locale: {format: 'YYYY/MM/DD'}
		});

	    $('#addLeave').on('click', function(){
	        mfp_modal('#addLeaveModal');
	    });

        $('#class_id').on('change', function() {
            var class_id = $(this).val();
            var branch_id = ($( "#branch_id" ).length ? $('#branch_id').val() : "");
			$.ajax({
				url: base_url + 'ajax/getStudentByClass',
				type: 'POST',
				data: {
					branch_id: branch_id,
					class_id: class_id
				},
				success: function (data) {
					$('#applicant_id').html(data);
				}
			});
        });
	});

	// get leave approvel details
	function getApprovelLeaveDetails(id) {
	    $.ajax({
	        url: base_url + 'leave/getApprovelLeaveDetails',
	        type: 'POST',
	        data: {'id': id},
	        dataType: "html",
	        success: function (data) {
				$('#quick_view').html(data);
				mfp_modal('#modal');
	        }
	    });
	}

	function getStafflistRole() {
	    $('#applicant_id').html('').append('<option value=""><?=translate('select')?></option>');
    	var user_role = $('#user_role').val();
    	var branch_id = ($( "#branch_id" ).length ? $('#branch_id').val() : "");

        $.ajax({
            url: base_url + 'leave/getCategory',
            type: "POST",
            data:{ 
            	role_id: user_role,
            	branch_id: branch_id 
            },
            success: function (data) {
            	$('#leave_category').html(data);
            }
        });

    	if (user_role != "") {
	        if (user_role == 7) {
	        	$("#classDiv").show("slow");
		        $.ajax({
		            url: base_url + 'ajax/getClassByBranch',
		            type: "POST",
		            data:{ branch_id: branch_id },
		            success: function (data) {
		            	$('#class_id').html(data);
		            }
		        });
	        }else{
	        	$("#classDiv").hide("slow");
		        $.ajax({
		            url: base_url + 'ajax/getStafflistRole',
		            type: "POST",
		            data:{ 
		            	role_id: user_role,
		            	branch_id: branch_id 
		            },
		            success: function (data) {
		            	$('#applicant_id').html(data);
		            }
		        });
	        }
    	}
	}
</script>