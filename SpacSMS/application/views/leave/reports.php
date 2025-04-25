<?php $widget = (is_superadmin_loggedin() ? 'col-md-4' : 'col-md-6'); ?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><?=translate('select_ground')?></h4>
			</header>
			<?php echo form_open($this->uri->uri_string(), array('class' => 'validate')); ?>
				<div class="panel-body">
					<div class="row mb-sm">
					<?php if (is_superadmin_loggedin()): ?>
						<div class="col-md-4 mb-sm">
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
						<div class="<?=$widget?> mb-sm">
	                        <div class="form-group">
	                            <label class="control-label"><?php echo translate('date'); ?> <span class="required">*</span></label>
	                            <div class="input-group">
	                                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
	                                <input type="text" class="form-control daterange" name="daterange" value="<?=set_value('daterange', date("Y/m/d", strtotime('-6day')) . ' - ' . date("Y/m/d"))?>" required />
	                            </div>
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
	<?php if (isset($leavelist)) { ?>
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
						</tr>
						<?php } } ?>
					</tbody>
				</table>
			</div>
		</section>
	<?php } ?>
	</div>
</div>