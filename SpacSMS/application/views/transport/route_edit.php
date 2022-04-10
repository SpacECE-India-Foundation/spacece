<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('transport/route')?>"><i class="fas fa-list-ul"></i> <?=translate('route_list')?></a>
			</li>
			<li class="active">
				<a href="#edit" data-toggle="tab" ><i class="far fa-edit"></i> <?=translate('edit_route')?></a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="edit">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit')); ?>
					<input type="hidden" name="route_id" value="<?=$route['id']?>">
					<?php if (is_superadmin_loggedin()): ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('branch')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, $route['branch_id'], "class='form-control' id='branch_id'
								id='branch_id' data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<?php endif; ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('route_name')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="route_name" value="<?=$route['name']?>" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('start_place')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="start_place" value="<?=$route['start_place']?>" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('stop_place')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="stop_place" value="<?=$route['stop_place']?>" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('remarks')?></label>
						<div class="col-md-6 mb-md">
							<textarea class="form-control" rows="2" name="remarks"><?=$route['remarks']?></textarea>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-offset-3 col-md-2">
								<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
									<i class="fas fa-plus-circle"></i> <?=translate('update')?>
								</button>
							</div>
						</div>
					</footer>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</section>