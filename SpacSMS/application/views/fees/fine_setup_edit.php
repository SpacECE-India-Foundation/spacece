<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('fees/fine_setup')?>"><i class="fas fa-list-ul"></i> <?php echo translate('fine') . " " . translate('list'); ?></a>
			</li>
			<li class="active">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?php echo translate('edit') . " " . translate('fine'); ?></a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit')); ?>
					<input type="hidden" name="fine_id" value="<?=$fine['id']?>">
					<?php if (is_superadmin_loggedin() ): ?>
					<div class="form-group">
						<label class="control-label col-md-3"><?=translate('branch')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, $fine['branch_id'], "class='form-control' id='branch_id'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<?php endif; ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('group_name'); ?></label>
						<div class="col-md-6">
							<?php
								$arrayGroup = $this->app_lib->getSelectByBranch('fee_groups', $fine['branch_id']);
								echo form_dropdown("group_id", $arrayGroup, $fine['group_id'], "class='form-control' id='groupID'
								data-plugin-selectTwo data-width='100%'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('fees_type'); ?></label>
						<div class="col-md-6">
							<?php
								$arrayType = array('' => translate('first_select_the_group'));
								echo form_dropdown("fine_type_id", $arrayType, "", "class='form-control' id='feesTypeID'
								data-plugin-selectTwo data-width='100%'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('fine_type'); ?></label>
						<div class="col-md-6">
							<?php
								$arrayFine = array(
									'' => translate('select'),
									'1' => translate('fixed_amount'),
									'2' => translate('percentage'),
								);
								echo form_dropdown("fine_type", $arrayFine, $fine['fine_type'], "class='form-control' id='fineType'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('fine') . " " . translate('value'); ?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="fine_value" value="<?=$fine['fine_value']?>" autocomplete="off" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('late_fee_frequency'); ?></label>
						<div class="col-md-6 mb-md">
							<?php
								$feeFrequency = array(
									'' => translate('select'),
									'0' => translate('fixed'),
									'1' => translate('daily'),
									'7' => translate('weekly'),
									'30' => translate('monthly'),
									'365' => translate('annually'),
								);
								echo form_dropdown("fee_frequency", $feeFrequency, $fine['fee_frequency'], "class='form-control' id='feeFrequency'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-2 col-md-offset-3">
								<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
									<i class="fas fa-plus-circle"></i> <?php echo translate('update'); ?>
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
		$('#branch_id').on('change', function(){
			var branchID = $(this).val();
		    $.ajax({
		        url: base_url + 'fees/getGroupByBranch',
		        type: 'POST',
		        data: {
		            'branch_id' : branchID
		        },
		        success: function (data) {
		            $('#groupID').html(data);
		        }
		    });
		});

		$('#groupID').on('change', function(){
			var groupID = $(this).val();
			getTypeByGroup(groupID);
		});
		var groupID = "<?=$fine['group_id']?>"
		var typeID = "<?=$fine['type_id']?>"
		getTypeByGroup(groupID, typeID);
	});

	function getTypeByGroup(groupID, typeID = '') {
	    $.ajax({
	        url: base_url + 'fees/getTypeByGroup',
	        type: 'POST',
	        data: {
	            'group_id' : groupID,
	            'type_id' : typeID
	        },
	        success: function (data) {
	            $('#feesTypeID').html(data);
	        }
	    });
	}
</script>