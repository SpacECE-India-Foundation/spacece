<?php $currency_symbol = $global_config['currency_symbol']; ?>
<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> <?php echo translate('fine') . " " . translate('list'); ?></a>
			</li>
<?php if (get_permission('fees_fine_setup', 'is_add')){ ?>
			<li>
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?php echo translate('add') . " " . translate('fine'); ?></a>
			</li>
<?php } ?>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane active">
				<div class="mb-md">
					<div class="export_title">Fees Type List</div>
					<table class="table table-bordered table-hover table-condensed table-export">
						<thead>
							<tr>
								<th width="50"><?php echo translate('sl'); ?></th>
							<?php if (is_superadmin_loggedin()): ?>
								<th><?=translate('branch')?></th>
							<?php endif; ?>
								<th><?=translate('group_name')?></th>
								<th><?=translate('fees_type') . " " . translate('name') ?></th>
								<th><?=translate('fine_type')?></th>
								<th><?=translate('fine_value')?></th>
								<th><?=translate('late_fee_frequency')?></th>
								<th><?=translate('action')?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$count = 1; foreach ($finelist as $row): ?>
							<tr>
								<td><?php echo $count++; ?></td>
							<?php if (is_superadmin_loggedin()): ?>
								<td><?php echo $row['branch_name'];?></td>
							<?php endif; ?>
								<td><?php echo get_type_name_by_id('fee_groups', $row['group_id']); ?></td>
								<td><?php echo get_type_name_by_id('fees_type', $row['type_id']); ?></td>
								<td><?php echo $row['fine_type'] == 1 ? translate('fixed_amount') : translate('percentage'); ?></td>
								<td><?php
								if ($row['fine_type'] == 1) {
									echo $currency_symbol . $row['fine_value'];
								} else {
									echo $row['fine_value'] . "%";
								} ?></td>
								<td><?php
								$feeFrequency = array(
									'' => translate('select'),
									'0' => translate('fixed'),
									'1' => translate('daily'),
									'7' => translate('weekly'),
									'30' => translate('monthly'),
									'365' => translate('annually'),
								);
								echo $feeFrequency[$row['fee_frequency']];
								?></td>
								<td>
									<?php if (get_permission('fees_fine_setup', 'is_edit')): ?>
										<a href="<?php echo base_url('fees/fine_setup_edit/' . $row['id']); ?>" class="btn btn-circle btn-default icon"
										data-toggle="tooltip" data-original-title="<?php echo translate('edit'); ?>"> 
											<i class="fas fa-pen-nib"></i>
										</a>
									<?php endif; if (get_permission('fees_fine_setup', 'is_delete')): ?>
										<?php echo btn_delete('fees/fine_delete/' . $row['id']); ?>
									<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
<?php if (get_permission('fees_fine_setup', 'is_add')){ ?>
			<div class="tab-pane" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit')); ?>
					<?php if (is_superadmin_loggedin() ): ?>
					<div class="form-group">
						<label class="control-label col-md-3"><?=translate('branch')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' id='branch_id'
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
								$arrayGroup = $this->app_lib->getSelectByBranch('fee_groups', $branch_id);
								echo form_dropdown("group_id", $arrayGroup, set_value('group_id'), "class='form-control' id='groupID'
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
								echo form_dropdown("fine_type_id", $arrayType, set_value('fine_type_id'), "class='form-control' id='feesTypeID'
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
								echo form_dropdown("fine_type", $arrayFine, set_value('branch_id'), "class='form-control' id='fineType'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('fine') . " " . translate('value'); ?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="fine_value" value="<?=set_value('fine_value')?>" autocomplete="off" />
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
								echo form_dropdown("fee_frequency", $feeFrequency, set_value('branch_id'), "class='form-control' id='feeFrequency'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-2 col-md-offset-3">
								<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
									<i class="fas fa-plus-circle"></i> <?php echo translate('save'); ?>
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
		    $.ajax({
		        url: base_url + 'fees/getTypeByGroup',
		        type: 'POST',
		        data: {
		            'group_id' : groupID
		        },
		        success: function (data) {
		            $('#feesTypeID').html(data);
		        }
		    });
		});
	});
</script>