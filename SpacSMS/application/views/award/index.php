<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> <?=translate('award') . ' ' . translate('list')?></a>
			</li>
<?php if (get_permission('award', 'is_add')) { ?>
			<li>
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?=translate('give_award')?></a>
			</li>
<?php } ?>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane active">
				<table class="table table-bordered table-hover table-condensed mb-none table-export">
					<thead>
						<tr>
							<th>#</th>
<?php if (is_superadmin_loggedin()): ?>
							<th><?=translate('branch')?></th>
<?php endif; ?>
							<th><?=translate('winner')?></th>
							<th><?=translate('role')?></th>
							<th><?=translate('award_name')?></th>
							<th><?=translate('gift_item')?></th>
							<th><?=translate('cash_price')?></th>
							<th><?=translate('award_reason')?></th>
							<th><?=translate('given_date')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						foreach ($awardlist as $row):
							?>
						<tr>
							<td><?php echo $count++; ?></td>
<?php if (is_superadmin_loggedin()): ?>
							<td><?php echo get_type_name_by_id('branch', $row['branch_id']);?></td>
<?php endif; ?>
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
							<td><?php echo $row['role_name']; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['gift_item']; ?></td>
							<td><?php echo $global_config['currency_symbol'] . $row['award_amount']; ?></td>
							<td><?php echo $row['award_reason']; ?></td>
							<td><?php echo _d($row['given_date']); ?></td>
							<td class="min-w-c">
							<?php if (get_permission('award', 'is_edit')) { ?>
								<!--update link-->
								<a href="<?php echo base_url('award/edit/' . $row['id']);?>" class="btn btn-default btn-circle icon">
									<i class="fas fa-pen-nib"></i>
								</a>
							<?php } if (get_permission('award', 'is_delete')) { ?>
								<!-- delete link -->
								<?php echo btn_delete('award/delete/' . $row['id']);?>
							<?php } ?>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
<?php if (get_permission('award', 'is_add')) { ?>
			<div class="tab-pane" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit'));?>
				<?php if (is_superadmin_loggedin()): ?>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('branch')?> <span class="required">*</span></label>
					<div class="col-md-6">
						<?php
							$arrayBranch = $this->app_lib->getSelectList('branch');
							echo form_dropdown("branch_id", $arrayBranch, "", "class='form-control' onchange='getStafflistRole()'
							id='branch_id' data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
					</div>
				</div>
				<?php endif; ?>
		        <div class="form-group">
					<label class="col-md-3 control-label"><?=translate('role')?> <span class="required">*</span></label>
					<div class="col-md-6">
		                <?php
		                    $role_list = $this->app_lib->getRoles([1,6]);
		                    echo form_dropdown("role_id", $role_list, set_value('role_id'), "class='form-control' id='role_id'
		                    onchange='getStafflistRole()' data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
		                ?>
		                <span class="error"></span>
					</div>
				</div>
				<div class="form-group" id="classDiv" style="display: none;">
					<label class="col-md-3 control-label"><?=translate('class')?> <span class="required">*</span></label>
					<div class="col-md-6">
						<?php
							$array = array("" => translate('select'));
							echo form_dropdown("class_id", $array, set_value('class_id'), "class='form-control' id='class_id'
							data-plugin-selectTwo data-width='100%' ");
						?>
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('winner')?> <span class="required">*</span></label>
					<div class="col-md-6">
						<?php
							$array = array("" => translate('select'));
							echo form_dropdown("user_id", $array, set_value('user_id'), "class='form-control' id='user_id'
							data-plugin-selectTwo data-width='100%' ");
						?>
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('award_name')?> <span class="required">*</span></label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="award_name" />
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('gift_item')?> <span class="required">*</span></label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="gift_item" />
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('cash_price')?></label>
					<div class="col-md-6">
						<input type="number" class="form-control" name="cash_price" />
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('award_reason')?> <span class="required">*</span></label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="award_reason" />
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('given_date')?> <span class="required">*</span></label>
					<div class="col-md-6 mb-md">
						<input type="text" class="form-control" name="given_date" data-plugin-datepicker data-plugin-options='{"todayHighlight" : true}'
						value="<?=date('Y-m-d')?>" />
						<span class="error"></span>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-offset-3 col-md-2">
			                <button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
			                    <i class="fas fa-plus-circle"></i> <?=translate('save') ?>
			                </button>
						</div>
					</div>
				</footer>
				<?php echo form_close(); ?>
			</div>
<?php } ?>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function () {
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
					$('#user_id').html(data);
				}
			});
        });
	});

	function getStafflistRole() {
	    $('#user_id').html('');
	    $('#user_id').append('<option value=""><?=translate('select')?></option>');
    	var user_role = $('#role_id').val();
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
		            	$('#user_id').html(data);
		            }
		        });
	        }
    	}
	}
</script>