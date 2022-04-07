<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#list" data-toggle="tab">
					<i class="fas fa-list-ul"></i><span class="hidden-xs"> <?=translate('stoppage_list')?></span>
				</a>
			</li>
<?php if (get_permission('transport_stoppage', 'is_add')): ?>
			<li>
				<a href="#new" data-toggle="tab">
				   <i class="far fa-edit"></i><span class="hidden-xs"> <?=translate('create_stoppage')?></span>
				</a>
			</li>
<?php endif; ?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane box active" id="list">
				<table class="table table-bordered table-hover table-condensed mb-none table-export">
					<thead>
						<tr>
							<th><?=translate('sl')?></th>
<?php if (is_superadmin_loggedin()): ?>
							<th><?=translate('branch')?></th>
<?php endif; ?>
							<th><?=translate('stoppage')?></th>
							<th><?=translate('stop_time')?></th>
							<th><?=translate('route_fare')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>

					<?php $count = 1; foreach ($stoppagelist as $row):
					?>
						<tr>
							<td><?php echo $count++;?></td>
<?php if (is_superadmin_loggedin()): ?>
							<td><?php echo $row['branch_name'];?></td>
<?php endif; ?>
							<td><?php echo $row['stop_position'];?></td>
							<td><?php echo date("g:i A", strtotime($row['stop_time']));?></td>
							<td><?php echo $global_config['currency_symbol'] . $row['route_fare'];?></td>
							<td>
							<?php if (get_permission('transport_stoppage', 'is_edit')): ?>
								<!--update link-->
								<a href="<?php echo base_url('transport/stoppage_edit/' . $row['id']);?>" class="btn btn-default btn-circle icon">
									<i class="fas fa-pen-nib"></i>
								</a>
							<?php endif; if (get_permission('transport_stoppage', 'is_delete')): ?>
								<!--delete link-->
								<?php echo btn_delete('transport/stoppage_delete/' . $row['id']);?>
							<?php endif;?>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
<?php if (get_permission('transport_stoppage', 'is_add')): ?>
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
						<label class="col-md-3 control-label"><?=translate('stoppage')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="stop_position" value="" />
							<span class="error"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('stop_time')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="stop_time" data-plugin-timepicker value="" />
							<span class="error"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('route_fare')?> <span class="required">*</span></label>
						<div class="col-md-6 mb-md">
							<input type="text" class="form-control" name="route_fare" value="" />
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