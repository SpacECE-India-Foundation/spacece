<div class="row">
<?php if (get_permission('attachment_type', 'is_add')): ?>
	<div class="col-md-5">
		<section class="panel">
			<?php echo form_open($this->uri->uri_string());?>
				<header class="panel-heading">
					<h4 class="panel-title"><i class="far fa-edit"></i> <?=translate('add') . " " . translate('attachment_type')?></h4>
				</header>
				<div class="panel-body">
					<?php if (is_superadmin_loggedin() ): ?>
					<div class="form-group">
						<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
						<?php
							$arrayBranch = $this->app_lib->getSelectList('branch');
							echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control'
							data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"><?=form_error('branch_id')?></span>
					</div>
					<?php endif; ?>
					<div class="form-group mb-md">
						<label class="control-label"><?=translate('type_name')?> <span class="required">*</span></label>
						<input type="text" class="form-control" name="type_name" value="<?=set_value('type_name')?>" />
						<span class="error"><?=form_error('type_name')?></span>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-default pull-right" type="submit" name="save" value="1">
								<i class="fas fa-plus-circle"></i> <?=translate('save');?>
							</button>
						</div>	
					</div>
				</div>
			<?php echo form_close();?>
		</section>
	</div>
<?php endif; ?>
<?php if (get_permission('attachment_type', 'is_view')): ?>
	<div class="col-md-<?php if (get_permission('attachment_type', 'is_add')){ echo "7"; }else{ echo "12"; } ?>">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-list-ul"></i> <?=translate('attachment_type') . " " . translate('list')?></h4>
			</header>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-condensed mb-none">
						<thead>
							<tr>
								<th>#</th>
								<th><?=translate('branch')?></th>
								<th><?=translate('type_name')?></th>
								<th><?=translate('action')?></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$count = 1;
						if (count($typelist)) {
							foreach ($typelist as $row):
								?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['branch_name'];?></td>
								<td><?php echo $row['name'];?></td>
								<td>
								<?php if (get_permission('attachment_type', 'is_edit')): ?>
									<!-- type update  -->
									<a class="btn btn-default btn-circle icon" href="javascript:void(0);" onclick="getCategoryModal(this)"
									data-id="<?=$row['id']?>" data-name="<?=$row['name']?>" data-branch="<?=$row['branch_id']?>">
										<i class="fas fa-pen-nib"></i>
									</a>
								<?php endif; if (get_permission('attachment_type', 'is_delete')): ?>
									<!-- delete link -->
									<?php echo btn_delete('attachments/type_delete/' . $row['id']);?>
								<?php endif; ?>
								</td>
							</tr>
							<?php
								endforeach;
							}else{
								echo '<tr><td colspan="4"><h5 class="text-danger text-center">' . translate('no_information_available') . '</td></tr>';
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</div>
<?php endif; ?>
<?php if (get_permission('attachment_type', 'is_edit')): ?>
<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
	<section class="panel">
		<?php echo form_open('attachments/type_edit', array('class' => 'frm-submit')); ?>
		<input type="hidden" name="type_id" id="ecategory_id" value="" />
			<header class="panel-heading">
				<h4 class="panel-title"><i class="far fa-edit"></i> <?=translate('edit') . " " . translate('attachment_type')?></h4>
			</header>
			<div class="panel-body">
				<?php if (is_superadmin_loggedin() ): ?>
				<div class="form-group">
					<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
					<?php
						$arrayBranch = $this->app_lib->getSelectList('branch');
						echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' id='ebranch_id'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					<span class="error"></span>
				</div>
				<?php endif; ?>
				<div class="form-group mb-md">
					<label class="control-label"><?=translate('type_name')?> <span class="required">*</span></label>
					<input type="text" class="form-control" value="" name="type_name" id="ename">
					<span class="error"></span>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-default mr-xs" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
							<i class="fas fa-plus-circle"></i> <?=translate('update')?>
						</button>
						<button class="btn btn-default modal-dismiss"><?=translate('cancel')?></button>
					</div>
				</div>
			</footer>
		<?php echo form_close();?>
	</section>
</div>
<?php endif; ?>