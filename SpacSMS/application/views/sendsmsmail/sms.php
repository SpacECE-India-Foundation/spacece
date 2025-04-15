<?php $widget = (is_superadmin_loggedin() ? 4 : 6); ?>
<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"> <a href="#sms" data-toggle="tab"> <i class="far fa-comment"></i> SMS</a> </li>
			<li><a href="<?=base_url('sendsmsmail/email')?>"> <i class="far fa-envelope"></i> Email</a> </li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane box active" id="sms">
				<?php echo form_open('sendsmsmail/save', array('class' => 'frm-submit')); ?>
				<input type="hidden" name="message_type" value="<?=$this->uri->segment(2)?>">
				<div class="row">
					<?php if (is_superadmin_loggedin()): ?>
					<div class="col-md-4 mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
							<?php
							$arrayBranch = $this->app_lib->getSelectList('branch');
							echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' data-width='100%' id='branch_id'
							data-plugin-selectTwo  data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<?php endif; ?>
					<div class="col-md-<?=$widget?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('campaign_name')?> <span class="required">*</span></label>
							<input type="text" class="form-control" name="campaign_name" value="" />
							<span class="error"></span>
						</div>
					</div>
					<div class="col-md-<?=$widget?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('template')?></label>
							<?php
								$arrayTemplate = $this->app_lib->getSelectByBranch('bulk_msg_category', $branch_id, false, array('type' => 1));
								echo form_dropdown("sms_template", $arrayTemplate, set_value('sms_template'), "class='form-control' id='sms_template'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 mb-sm">
						<div class="form-group">
							<label><?=translate('message')?> <span class="required">*</span></label>
							<textarea class="form-control" name="message" rows="5" id="message"></textarea>
							<span class="error"></span>
							<div class="pull-right pr-xs pl-xs alert-danger"> 
								<span id="remaining_count"> 160 characters remaining</span> <span id="messages">1 message </span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('sms_gateway')?> <span class="required">*</span></label>
							<?php
								$arrayGateway = array('' => translate('select'));
								echo form_dropdown("sms_gateway", $arrayGateway, set_value('sms_gateway'), "class='form-control' id='sms_gateway'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="col-md-6 mb-sm">
						<div class="form-group">
							<label class="control-label"> <?=translate('type')?> <span class="required">*</span></label>
							<?php
							$arrayType = array(
								"" => translate('select'),
								"1" => translate('group'),
								"2" => translate('individual'),
								"3" => translate('class'),
							);
							echo form_dropdown("recipient_type", $arrayType, "", "class='form-control' id='typeID' data-plugin-selectTwo
							data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"></span>
						</div>
					</div>
				</div>
				<div class="row hidden-div" id="group_div">
					<div class="col-md-12 mb-sm">
						<div class="form-group">
							<label class="control-label">Role <span class="required">*</span></label>
							<?php
								$role_list = $this->app_lib->getRoles(1);
								unset($role_list['']);
								echo form_dropdown("role_group[]", $role_list, "", "class='form-control' multiple id='role_group'
								data-plugin-selectTwo data-width='100%' ");
							?>
							<span class="error"></span>

							<div class="checkbox-replace mt-sm pr-xs pull-right">
								<label class="i-checks"><input type="checkbox" class="chk-sendsmsmail" name="chk_role"><i></i> Select All</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row hidden-div" id="individual_div">
					<div class="col-md-12 mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('role')?> <span class="required">*</span></label>
							<?php
								$role_list = $this->app_lib->getRoles(1);
								echo form_dropdown("role_id", $role_list, set_value('role_id'), "class='form-control' id='roleID' onchange='getRecipientsByRole()'
								data-plugin-selectTwo data-width='100%' ");
							?>
							<span class="error"><?=form_error('role')?></span>
						</div>
					</div>
					<div class="col-md-12 mb-sm">
						<div class="form-group">
							<label class="control-label">Name <span class="required">*</span></label>
							<select class="form-control" name="recipients[]" id="recipients" data-plugin-selectTwo multiple >
							
							</select>
							<span class="error"></span>

							<div class="checkbox-replace mt-sm pr-xs pull-right">
								<label class="i-checks"><input type="checkbox" class="chk-sendsmsmail" name="chk_recipients"><i></i> Select All</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row hidden-div" id="class_div">
					<div class="col-md-12 mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('class')?> <span class="required">*</span></label>
							<?php
								$arrayClass = $this->app_lib->getClass($branch_id);
								echo form_dropdown("class_id", $arrayClass, set_value('class_id'), "class='form-control' id='class_id'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"><?=form_error('class')?></span>
						</div>
					</div>
					<div class="col-md-12 mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('section')?> <span class="required">*</span></label>
							<select class="form-control" name="section[]" id="section_id" data-plugin-selectTwo multiple >
							</select>
							<span class="error"></span>
							<div class="checkbox-replace mt-sm pr-xs pull-right">
								<label class="i-checks"><input type="checkbox" class="chk-sendsmsmail" name="chk_section"><i></i> Select All</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 mb-xs">
						<div class="form-group">
							<div class="checkbox-replace">
								<label class="i-checks"><input type="checkbox" name="send_later" id="send_later"><i></i> Send Later</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 mb-sm">
						<div class="form-group">
							<label class="control-label">Schedule Date <span class="required">*</span></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
								<input type="text" class="form-control" name="schedule_date" id="schedule_date" disabled value="<?=date('Y-m-d')?>" data-plugin-datepicker />
							</div>
							<span class="error"></span>
						</div>
					</div>
					<div class="col-md-4 mb-sm">
						<div class="form-group">
							<label class="control-label">Schedule Time <span class="required">*</span></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-clock"></i></span>
								<input type="text" name="schedule_time" id="schedule_time" disabled data-plugin-timepicker class="form-control"  value="<?=date('H:M a')?>" />
								<span class="error"></span>
							</div>
							<span class="error"></span>
						</div>
					</div>
				</div>
				<div class="mt-md">
					<strong>Dynamic Tag : </strong>
					<a data-value=" {name} " class="btn btn-default btn-xs btn_tag ">{name}</a>
					<a data-value=" {email} " class="btn btn-default btn-xs btn_tag">{email}</a>
					<a data-value=" {mobile_no} " class="btn btn-default btn-xs btn_tag">{mobile_no}</a>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-offset-10 col-md-2">
			                <button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
			                    <i class="far fa-share-square"></i> <?=translate('send') ?>
			                </button>
						</div>
					</div>
				</footer>
				<?php echo form_close(); ?>
			</div>
			<div class="tab-pane" id="add">
				
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function () {
		$('#branch_id').on('change', function() {
			var branchID = $(this).val();
			getRecipientsByRole();
			getClassByBranch(branchID);
			getSmsGateway();

			$.ajax({
				url: "<?=base_url('sendsmsmail/getTemplateByBranch')?>",
				type: 'POST',
				data: {
					branch_id : branchID,
					type : "sms",
				},
				success: function (data) {
					$('#sms_template').html(data);
				}
			});
		});

		$('#typeID').on('change', function() {
			var val = $(this).val();
			if (val == 1) {
				$("#class_div").hide('slow');
				$("#individual_div").hide('slow');
				$("#group_div").show('slow');
			}
			if (val == 2) {
				$("#class_div").hide('slow');
				$("#group_div").hide('slow');
				$("#individual_div").show('slow');
			}
			if (val == 3) {
				$("#individual_div").hide('slow');
				$("#group_div").hide('slow');
				$("#class_div").show('slow');
			}
		});

		$('.chk-sendsmsmail').on('change', function() {
			if($(this).is(':checked') ){
				$(this).parents('.form-group').find('select > option').prop("selected","selected");
				$(this).parents('.form-group').find('select').trigger("change");
			} else {
				$(this).parents('.form-group').find('select').val(null).trigger('change');
			}
		});

		$('#send_later').on('change', function() {
			if($(this).is(':checked') ){
				$('#schedule_time').prop("disabled", false);
				$('#schedule_date').prop("disabled", false);
			} else {
				$('#schedule_time').prop("disabled", true);
				$('#schedule_date').prop("disabled", true);
			}
		});

		// SMS characters counter
	    var $remaining = $('#remaining_count'),
	        $messages = $remaining.next();
	    $('#message').keyup(function(){
	        var chars = this.value.length,
	            messages = Math.ceil(chars / 160),
	            remaining = messages * 160 - (chars % (messages * 160) || messages * 160);

	        $remaining.text(remaining + ' characters remaining');
	        $messages.text(messages + ' message');
	    });

		$('.btn_tag').on('click', function() {
			var $txt = $("#message");
	     	var caretPos = $txt[0].selectionStart;
	        var textAreaTxt = $txt.val();
	        var txtToAdd = $(this).data("value");
	        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos) );
		});

		getSmsGateway();
	});

	function getSmsGateway() {
		var branchID = ($('#branch_id').length ? $('#branch_id').val() : "");
		$.ajax({
			url: "<?=base_url('sendsmsmail/getSmsGateway')?>",
			type: 'POST',
			data: {
				branch_id : branchID
			},
			success: function (data) {
				$('#sms_gateway').html(data);
			}
		});
	}

	function getRecipientsByRole() {
		var roleID = $('#roleID').val();
		var branchID = ($('#branch_id').length ? $('#branch_id').val() : "");
		if (roleID !== '') {
			$.ajax({
				url: "<?=base_url('sendsmsmail/getRecipientsByRole')?>",
				type: 'POST',
				data: {
					branch_id : branchID,
					role_id : roleID,
				},
				success: function (data) {
					$('#recipients').html(data);
				}
			});
		}
	}

	$('#class_id').on('change', function() {
		var classID = $(this).val();
	    $.ajax({
	        url: base_url + 'sendsmsmail/getSectionByClass',
	        type: 'POST',
	        data: {
	            class_id: classID,
	        },
	        success: function (response) {
	            $('#section_id').html(response);
	        }
	    });
	});

	$('#sms_template').on('change', function() {
		var templateID = $(this).val();
	    $.ajax({
	        url: base_url + 'sendsmsmail/getSmsTemplateText',
	        type: 'POST',
	        data: {
	            id: templateID,
	        },
	        success: function (response) {
	        	$("#message").text(response);
	        }
	    });
	});
</script>