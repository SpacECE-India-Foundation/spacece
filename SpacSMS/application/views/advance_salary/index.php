<?php $widget = (is_superadmin_loggedin() ? 'col-md-6' : 'col-md-offset-3 col-md-6'); ?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><?=translate('select_ground')?></h4>
			<?php if (get_permission('advance_salary_manage', 'is_add')): ?>
				<div class="panel-btn">
					<a href="javascript:void(0);" id="advanceSalary" class="btn btn-default btn-circle" >
						<i class="fas fa-plus-circle"></i> Add Advance Salary
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
								<label class="control-label"><?=translate('deduct_month')?> <span class="required">*</span></label>
								 <input type="text" class="form-control monthyear" required name="month_year" value="<?=set_value('month_year',date("Y-m"))?>" />
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
				<h4 class="panel-title"><i class="fas fa-users" aria-hidden="true"></i> <?=translate('advance_salary')?></h4>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-condensed table-hover mb-none table-export" >
					<thead>
						<tr>
							<th width="50">#</th>
							<th><?=translate('photo')?></th>
							<?php if (is_superadmin_loggedin()): ?>
							<th><?=translate('branch')?></th>
							<?php endif; ?>
							<th><?=translate('applicant')?></th>
							<th><?=translate('staff_role')?></th>
							<th><?=translate('deduct_month')?></th>
							<th><?=translate('applied_on')?></th>
							<th><?=translate('create_at')?></th>
							<th><?=translate('status')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						foreach ($advanceslist as $row) {?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td class="center"><img class="rounded" src="<?php echo get_image_url('staff', $row['photo']);?>" width="40" height="40" /></td>
							<?php if (is_superadmin_loggedin()): ?>
							<td><?php echo get_type_name_by_id('branch', $row['branch_id']);?></td>
							<?php endif; ?>
							<td><?php echo $row['name'];?><br><small><?php echo $row['uniqid'];?></small></td>
							<td><?php echo $row['role'];?></td>
							<td><?php echo date("F Y", strtotime($row['year'] .'-'. $row['deduct_month']));?></td>
							<td><?php echo _d($row['request_date']);?></td>
							<td><?php echo _d($row['create_at']);?></td>
							<td>
								<?php
								if ($row['status'] == 1)
									echo '<span class="label label-warning-custom">' . translate('pending') . '</span>';
								else if ($row['status'] == 2)
									echo '<span class="label label-success-custom">' . translate('payment') . '</span>';
								else if ($row['status'] == 3)
									echo '<span class="label label-danger-custom">' . translate('rejected') . '</span>';
								?>
							</td>
							<td>
							<?php if (get_permission('advance_salary_manage', 'is_add')): ?>
								<!--modal dialogbox-->
								<a href="javascript:void(0);" class="btn btn-default btn-circle icon" onclick="getAdvanceSalaryDetails('<?=$row['id']?>')">
									<i class="fas fa-bars"></i>
								</a>
							<?php endif; ?>
							<?php if (get_permission('advance_salary_manage', 'is_delete')): ?>
								<!--delete link-->
								<?php echo btn_delete('advance_salary/delete/' . $row['id']);?>
							<?php endif; ?>
							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</section>
	</div>
</div>

<!-- Advance Salary View Modal -->
<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
	<section class="panel" id='quick_view'></section>
</div>

<!-- Advance Salary Add Modal -->
<div id="advanceSalaryModal" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
    <section class="panel">
        <div class="panel-heading">
            <h4 class="panel-title"><i class="fas fa-plus-circle"></i> <?php echo translate('advance_salary'); ?></h4>
        </div>
		<?php echo form_open('advance_salary/save', array('class' => 'form-horizontal frm-submit')); ?>
			<div class="panel-body">
			<?php if (is_superadmin_loggedin()): ?>
			<div class="form-group mt-md">
				<label class="col-md-3 control-label"><?=translate('branch')?> <span class="required">*</span></label>
				<div class="col-md-9">
					<?php
						$arrayBranch = $this->app_lib->getSelectList('branch');
						echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' onchange='getStafflistRole()'
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
	                    $role_list = $this->app_lib->getRoles();
	                    echo form_dropdown("staff_role", $role_list, set_value('staff_role'), "class='form-control' id='staff_role' onchange='getStafflistRole()' data-plugin-selectTwo
	                    data-width='100%' data-minimum-results-for-search='Infinity' ");
	                ?>
	                <span class="error"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?=translate('applicant')?> <span class="required">*</span></label>
				<div class="col-md-9">
					<?php
						$array = array("" => translate('select_employee'));
						echo form_dropdown("staff_id", $array, set_value('staff_id'), "class='form-control' id='staff_id'
						data-plugin-selectTwo data-width='100%' ");
					?>
					<span class="error"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?=translate('deduct_month');?> <span class="required">*</span></label>
				<div class="col-md-9">
	                <input type="text" class="form-control monthyear" name="month_year" id="month_year" value="<?=set_value('month_year',date("Y-m"))?>" />
					<span class="error"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?=translate('amount')?> <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="number" class="form-control" value="<?=set_value('amount')?>" name="amount"/>
					<span class="error"></span>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label"><?=translate('reason')?></label>
				<div class="col-md-9">
					<textarea class="form-control" rows="4" name="reason" placeholder="Enter your Reason"><?=set_value('reason')?></textarea>
				</div>
			</div>
			</div>
		    <footer class="panel-footer">
		        <div class="row">
		            <div class="col-md-12 text-right">
		                <button type="submit" class="btn btn-default mr-xs" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
		                    <i class="fas fa-plus-circle"></i> <?=translate('apply') ?>
		                </button>
		                <button class="btn btn-default modal-dismiss"><?=translate('cancel') ?></button>
		            </div>
		        </div>
		    </footer>
		<?php echo form_close();?>
    </section>
</div>

<script type="text/javascript">
	function getStafflistRole() {
    	var staff_role = $('#staff_role').val();
    	var branch_id = ($( "#branch_id" ).length ? $('#branch_id').val() : "");
        $.ajax({
            url: base_url + 'ajax/getStafflistRole',
            type: "POST",
            data:{ 
            	role_id: staff_role,
            	branch_id: branch_id 
            },
            success: function (data) {
            	$('#staff_id').html(data);
            }
        });
	}
</script>