<?php $widget = (is_superadmin_loggedin() ? 4 : 6); ?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><?=translate('select_ground')?></h4>
			</header>
			<?php echo form_open($this->uri->uri_string(), array('class' => 'validate'));?>
			<div class="panel-body">
				<div class="row mb-sm">
				<?php if (is_superadmin_loggedin() ): ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' onchange='getClassByBranch(this.value)'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
						</div>
					</div>
				<?php endif; ?>
					<div class="col-md-<?php echo $widget; ?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('class')?> <span class="required">*</span></label>
							<?php
								$arrayClass = $this->app_lib->getClass($branch_id);
								echo form_dropdown("class_id", $arrayClass, set_value('class_id'), "class='form-control' id='class_id' onchange='getSectionByClass(this.value,0)'
								required data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>
					<div class="col-md-<?php echo $widget; ?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('section')?> <span class="required">*</span></label>
							<?php
								$arraySection = $this->app_lib->getSections(set_value('class_id'), false);
								echo form_dropdown("section_id", $arraySection, set_value('section_id'), "class='form-control' id='section_id' required
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-offset-10 col-md-2">
						<button type="submit" name="search" value="1" class="btn btn-default btn-block"> <i class="fas fa-filter"></i> <?=translate('filter')?></button>
					</div>
				</div>
			</footer>
			<?php echo form_close();?>
		</section>

		<?php if (isset($allocationlist)): ?>
		<section class="panel appear-animation" data-appear-animation="<?=$global_config['animations'] ?>" data-appear-animation-delay="100">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-users"></i> <?=translate('student') . ' ' . translate('allocation_list')?></h4>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-hover table-condensed tbr-top table-export">
					<thead>
						<tr>
							<th><?=translate('sl')?></th>
							<th><?=translate('student') . ' ' . translate('name')?></th>
							<th><?=translate('register_no')?></th>
							<th><?=translate('route_name')?></th>
							<th><?=translate('stoppage')?></th>
							<th><?=translate('vehicle_no')?></th>
							<th><?=translate('route_fare')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						foreach($allocationlist as $row) {	
						?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
								<td><?php echo $row['register_no']; ?></td>
								<td><?php echo $row['route_name']; ?></td>
								<td>
									<?php 
										echo $row['stop_position'];
										echo '<br> <small class="text-dark">'.translate('stop_time').' : '.date('g:i A', strtotime($row['stop_time'])).'</small>';
									?>
								</td>
								<td><?php echo $row['vehicle_no']; ?></td>
								<td><?php echo $global_config['currency_symbol'] . $row['route_fare'];?></td>
								<td>
									<!-- deletion link -->
									<?php echo btn_delete('transport/allocation_delete/' . $row['enroll_id']);?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</section>
		<?php endif;?>
	</div>
</div>