<?php $widget = (is_superadmin_loggedin() ? 4 : 6); ?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title">
					<?php echo translate('select_ground'); ?>
				</h4>
			</header>
			<?php echo form_open($this->uri->uri_string(), array('class' => 'validate')); ?>
				<div class="panel-body">
					<div class="row mb-sm">
					<?php if (is_superadmin_loggedin()): ?>
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('branch'); ?> <span class="required">*</span></label>
								<?php
									$arrayBranch = $this->app_lib->getSelectList('branch');
									echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' onchange='getDesignationByBranch(this.value)'
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
								?>
							</div>
						</div>
					<?php endif; ?>
						<div class="col-md-<?=$widget?> mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('role'); ?> <span class="required">*</span></label>
								<?php
									$role_list = $this->app_lib->getRoles();
									echo form_dropdown("staff_role", $role_list, set_value('staff_role'), "class='form-control' data-plugin-selectTwo required data-width='100%'
									data-minimum-results-for-search='Infinity' ");
								?>
							</div>
						</div>
						<div class="col-md-<?=$widget?> mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('designation'); ?> <span class="required">*</span></label>
								<?php
									echo form_dropdown("designation_id", $designationlist, set_value('designation_id'), "class='form-control' id='designation_id' required
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
								?>
							</div>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-offset-10 col-md-2">
							<button type="submit" name="search" value="1" class="btn btn btn-default btn-block"><i class="fas fa-filter"></i> <?php echo translate('filter'); ?></button>
						</div>
					</div>
				</footer>
			<?php echo form_close(); ?>
		</section>
	
		<?php if (isset($stafflist)): ?>
			<section class="panel appear-animation" data-appear-animation="<?=$global_config['animations'] ?>" data-appear-animation-delay="100">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'validate')); ?>
					<header class="panel-heading">
						<h4 class="panel-title"><i class="fas fa-users" aria-hidden="true"></i> <?php echo translate('employee') . " " . translate('salary_assign'); ?></h4>
					</header>
					<div class="panel-body">
						<div class="table-responsive mt-md mb-lg">
							<table class="table table-bordered table-condensed mb-none">
								<thead>
									<tr>
										<th width="60"><?php echo translate('sl'); ?></th>
										<th><?php echo translate('staff_id'); ?></th>
										<th><?php echo translate('name'); ?></th>
										<th><?php echo translate('designation'); ?></th>
										<th><?php echo translate('department'); ?></th>
										<th><?php echo translate('salary') . " " . translate('grade'); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$i = 1;
									if (count($stafflist)) {
										foreach ($stafflist as $key => $value): ?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td><?php echo html_escape($value->staff_id); ?></td>
										<td><?php echo html_escape($value->name); ?></td>
										<td><?php echo html_escape($value->designation_name); ?></td>
										<td><?php echo html_escape($value->department_name); ?></td>
										<td width="25%">
											<input type="hidden" name="stafflist[<?php echo $key; ?>][id]" value="<?php echo html_escape($value->id); ?>">
											<?php
												echo form_dropdown("stafflist[$key][template_id]", $templatelist, $value->salary_template_id, "class='form-control'
												data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
											?>
										</td>
									</tr>
									<?php
										endforeach;
									}else{
										echo '<tr><td colspan="6"><h5 class="text-danger text-center">' . translate('no_information_available') . '</td></tr>';
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-offset-10 col-md-2">
								<button type="submit" class="btn btn-default btn-block" name="assign" value="1"><i class="fas fa-plus-circle"></i> <?php echo translate('save'); ?></button>
							</div>
						</div>
					</div>
				<?php echo form_close(); ?>
			</section>
		<?php endif; ?>
	</div>
</div>