<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('award')?>"><i class="fas fa-list-ul"></i> <?=translate('award') . ' ' . translate('list')?></a>
			</li>
			<li class="active">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?=translate('edit_award')?></a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit'));?>
				<input type="hidden" name="award_id" value="<?=$award['id']?>">
				<?php if (is_superadmin_loggedin()): ?>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('branch')?> <span class="required">*</span></label>
					<div class="col-md-6">
						<?php
							$arrayBranch = $this->app_lib->getSelectList('branch');
							echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id', $award['branch_id']), "class='form-control' onchange='getStafflistRole()'
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
		                    echo form_dropdown("role_id", $role_list, set_value('role_id', $award['role_id']), "class='form-control' id='role_id'
		                    onchange='getStafflistRole()' data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
		                ?>
		                <span class="error"></span>
					</div>
				</div>
				<div class="form-group" id="classDiv" style="<?=($award['role_id'] != 7 ? 'display: none;' : '');?>" >
					<label class="col-md-3 control-label"><?=translate('class')?> <span class="required">*</span></label>
					<div class="col-md-6">
						<?php
							$class_id ="";
							$arrayClass = array("" => translate('select'));
							if($award['role_id'] == 7){
								$class_id = $this->db->get_where('enroll', array('student_id' => $award['user_id']))->row()->class_id;
								$arrayClass = $this->app_lib->getClass($award['branch_id']);
							}
							echo form_dropdown("class_id", $arrayClass, set_value('class_id', $class_id), "class='form-control' id='class_id'
							data-plugin-selectTwo data-width='100%' ");
						?>
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('winner')?> <span class="required">*</span></label>
					<div class="col-md-6">
						<?php
							$arrayUser = array("" => translate('select'));
							if($award['role_id'] != 7){
								$arrayUser = $this->app_lib->getStaffList($award['branch_id'], $award['role_id']);
							} else {
								$query_enroll = $this->award_model->get('enroll', array('class_id' => $class_id, 'branch_id' => $award['branch_id']), false, false,'student_id,roll');
								foreach ($query_enroll as $enroll){
									$s = $this->db->select('id,CONCAT(first_name," ",last_name) as full_name')->where(array('id' => $enroll['student_id']))->get('student')->row();
									$arrayUser[$s->id] = $s->full_name . ' (' . $enroll['roll'] . ')';
								}
							}
							echo form_dropdown("user_id", $arrayUser, set_value('user_id', $award['user_id']), "class='form-control' id='user_id'
							data-plugin-selectTwo data-width='100%' ");
						?>
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('award_name')?> <span class="required">*</span></label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="award_name" value="<?=set_value('award_name', $award['name'])?>" />
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('gift_item')?> <span class="required">*</span></label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="gift_item" value="<?=set_value('gift_item', $award['gift_item'])?>" />
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('cash_price')?></label>
					<div class="col-md-6">
						<input type="number" class="form-control" name="cash_price" id="cash_price" />
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('award_reason')?> <span class="required">*</span></label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="award_reason" value="<?=set_value('award_reason', $award['award_reason'])?>" />
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('given_date')?> <span class="required">*</span></label>
					<div class="col-md-6 mb-md">
						<input type="text" class="form-control" name="given_date" data-plugin-datepicker data-plugin-options='{"todayHighlight" : true}'
						value="<?=set_value('given_date', $award['given_date'])?>" />
						<span class="error"></span>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-offset-3 col-md-2">
			                <button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
			                    <i class="fas fa-plus-circle"></i> <?=translate('update') ?>
			                </button>
						</div>
					</div>
				</footer>
				<?php echo form_close(); ?>
			</div>
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