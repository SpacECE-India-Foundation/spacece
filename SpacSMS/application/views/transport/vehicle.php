<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#list" data-toggle="tab">
					<i class="fas fa-list-ul"></i> <?=translate('vehicle_list')?>
				</a>
			</li>
<?php if (get_permission('transport_vehicle', 'is_add')): ?>
			<li>
				<a href="#new" data-toggle="tab">
				   <i class="far fa-edit"></i>< <?=translate('create_vehicle')?>
				</a>
			</li>
<?php endif; ?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane box active" id="list">
				<table class="table table-bordered table-hover mb-none table-export">
					<thead>
						<tr>
							<th><?=translate('sl')?></th>
						<?php if (is_superadmin_loggedin()): ?>
							<th><?=translate('branch')?></th>
						<?php endif; ?>
							<th><?=translate('vehicle_no')?></th>
							<th><?=translate('capacity')?></th>
							<th><?=translate('insurance_renewal_date')?></th>
							<th><?=translate('driver_name')?></th>
							<th><?=translate('driver_phone')?></th>
							<th><?=translate('driver_license')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
					<?php $count = 1; foreach ($transportlist as $row): ?>
						<tr>
							<td><?php echo $count++ ;?></td>
						<?php if (is_superadmin_loggedin()): ?>
							<td><?php echo $row['branch_name']; ?></td>
						<?php endif; ?>
							<td><?php echo $row['vehicle_no'];?></td>
							<td><?php echo $row['capacity'];?></td>
							<td><?php if(!empty($row['insurance_renewal'])) echo _d($row['insurance_renewal']); ?></td>
							<td><?php echo $row['driver_name'];?></td>
							<td><?php echo $row['driver_phone'];?></td>
							<td><?php echo $row['driver_license'];?></td>
							<td>
							<?php if (get_permission('transport_vehicle', 'is_edit')): ?>
								<!--update link-->
								<a href="<?php echo base_url('transport/vehicle_edit/' . $row['id']);?>" class="btn btn-default btn-circle icon">
									<i class="fas fa-pen-nib"></i>
								</a>
							<?php endif; if (get_permission('transport_vehicle', 'is_delete')): ?>
								<!--delete link-->
								<?php echo btn_delete('transport/vehicle_delete/' . $row['id']);?>
							<?php endif; ?>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
<?php if (get_permission('transport_vehicle', 'is_add')): ?>
			<div class="tab-pane box" id="new">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit'));?>
					<?php if (is_superadmin_loggedin()): ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('branch')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, "", "class='form-control' id='branch_id'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<?php endif; ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('vehicle_no')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="vehicle_no" value="" />
							<span class="error"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('capacity')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="capacity" value="" />
							<span class="error"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('insurance_renewal_date')?></label>
						<div class="col-md-6">
							<input type="text" class="form-control" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' name="insurance_renewal"/>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('driver_name')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="driver_name" value="" />
							<span class="error"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('driver_phone')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="driver_phone" value="" />
							<span class="error"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('driver_license')?> <span class="required">*</span></label>
						<div class="col-md-6 mb-md">
							<input type="text" class="form-control" name="driver_license" value="" />
							<span class="error"></span>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-offset-3 col-md-2">
								<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
									<i class="fas fa-plus-circle"></i> <?=translate('save')?>
								</button>
							</div>
						</div>
					</footer>
				<?php echo form_close();?>
			</div>
<?php endif; ?>
		</div>
	</div>
</section>