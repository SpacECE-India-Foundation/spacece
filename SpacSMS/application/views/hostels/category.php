<div class="row">
<?php if (get_permission('hostel_category', 'is_add')): ?>
	<div class="col-md-5">
		<section class="panel">
			<?php echo form_open($this->uri->uri_string()); ?>
				<header class="panel-heading">
					<h4 class="panel-title"><i class="far fa-edit"></i> <?=translate('add_category')?></h4>
				</header>
				<div class="panel-body">
					<?php if (is_superadmin_loggedin()): ?>
						<div class="form-group">
							<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' data-width='100%' id='branch_id'
								data-plugin-selectTwo  data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"><?php echo form_error('branch_id'); ?></span>
						</div>
					<?php endif; ?>
					<div class="form-group">
						<label class="control-label"><?=translate('name')?> <span class="required">*</span></label>
						<input type="text" class="form-control" name="category_name" value="<?=set_value('category_name')?>" />
						<span class="error"><?php echo form_error('category_name'); ?></span>
					</div>
					<div class="form-group">
						<label class="control-label"><?=translate('category_for')?> <span class="required">*</span></label>
						<?php
							$arrayType = array(
								"" => translate('select'),
								"hostel" => translate('hostel'),
								"room" => translate('room'),
							);
							echo form_dropdown("type", $arrayType, set_value('type'), "class='form-control'
							data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
						?>
						<span class="error"><?php echo form_error('type'); ?></span>
					</div>
					<div class="form-group mb-md">
						<label class="control-label"><?=translate('remarks')?></label>
						<textarea class="form-control" rows="2" name="description"></textarea>
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
<?php if (get_permission('hostel_category', 'is_view')): ?>
	<div class="col-md-<?php if (get_permission('hostel_category', 'is_add')){ echo "7"; }else{echo "12";} ?>">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-list-ul"></i> <?=translate('category') . ' ' . translate('list')?></h4>
			</header>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-condensed mb-none">
						<thead>
							<tr>
								<th><?=translate('sl')?></th>
								<th><?=translate('branch')?></th>
								<th><?=translate('name')?></th>
								<th><?=translate('type')?></th>
								<th><?=translate('remarks')?></th>
								<th><?=translate('action')?></th>
							</tr>
						</thead>
						<tbody>
						<?php
							$count = 1;
							if (count($categorylist)){
								foreach ($categorylist as $row):
						?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['branch_name'];?></td>
								<td><?php echo $row['name'];?></td>
								<td><?php echo ucfirst($row['type']);?> </td>
								<td><?php echo $row['description'];?></td>
								<td>
								<?php if (get_permission('hostel_category', 'is_edit')): ?>
									<!-- update link  -->
									<a class="btn btn-default btn-circle icon" href="javascript:void(0);" onclick="getHostelsCategoryModal(<?=$row['id']?>)">
										<i class="fas fa-pen-nib"></i>
									</a>
								<?php endif; if (get_permission('hostel_category', 'is_delete')): ?>
									<!-- delete link -->
									<?php echo btn_delete('hostels/category_delete/' . $row['id']);?>
								<?php endif; ?>
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
		</section>
	</div>
<?php endif; ?>
</div>

<?php if (get_permission('hostel_category', 'is_edit')): ?>
<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
	<section class="panel">
		<?php echo form_open('hostels/category_edit', array('class' => 'frm-submit')); ?>
			<header class="panel-heading">
				<h4 class="panel-title"><i class="far fa-edit"></i> <?=translate('edit_category')?></h4>
			</header>
			<div class="panel-body">
				<input type="hidden" name="category_id" id="ecategory_id" value="" >
				<?php if (is_superadmin_loggedin()): ?>
					<div class="form-group">
						<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
						<?php
							$arrayBranch = $this->app_lib->getSelectList('branch');
							echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' data-width='100%' id='ebranch_id'
							data-plugin-selectTwo  data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
					</div>
				<?php endif; ?>
				<div class="form-group mt-sm">
					<label class="control-label"><?=translate('name')?> <span class="required">*</span></label>
					<input type="text" class="form-control" value="" name="category_name" id="ecategory_name">
					<span class="error"></span>
				</div>
				<div class="form-group">
					<label class="control-label"><?=translate('category_for')?> <span class="required">*</span></label>
					<?php
						$arrayType = array(
							"" => translate('select'),
							"hostel" => translate('hostel'),
							"room" => translate('room'),
						);
						echo form_dropdown("type", $arrayType, set_value('type'), "class='form-control' id='etype'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
					?>
					<span class="error"></span>
				</div>
				<div class="form-group mb-md">
					<label class="control-label"><?=translate('remarks')?></label>
					<textarea class="form-control" rows="2" name="description" id="edescription"></textarea>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-default" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
							<i class="fas fa-plus-circle"></i> <?=translate('update')?>
						</button>
						<button class="btn btn-default modal-dismiss"><?=translate('cancel')?></button>
					</div>
				</div>
			</footer>
		<?php echo form_close();?>
	</section>
</div>

<script type="text/javascript">
	function getHostelsCategoryModal(id) {
		$('.error').html("");
		$.ajax({
			url: "<?=base_url('hostels/getCategoryDetails')?>",
			type: 'POST',
			data: {id: id},
			dataType: 'json',
			success: function (res) {
				$('#ecategory_id').val(res.id);
				$('#ecategory_name').val(res.name);
				$('#etype').val(res.type).trigger('change');
				$('#edescription').val(res.description);
			    if ($('#ebranch_id').length) {
			        $('#ebranch_id').val(res.branch_id).trigger('change');
			    }
				mfp_modal('#modal');
			}
		});
	}
</script>
<?php endif; ?>