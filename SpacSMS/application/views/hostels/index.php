<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> <?=translate('hostel_list')?></a>
			</li>
<?php if (get_permission('hostel', 'is_add')): ?>
			<li>
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?=translate('create_hostel')?></a>
			</li>
<?php endif; ?>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane active">
				<table class="table table-bordered table-hover table-condensed mb-none table-export">
					<thead>
						<tr>
							<th><?=translate('sl')?></th>
							<?php if (is_superadmin_loggedin()): ?>
							<th><?=translate('branch')?></th>
							<?php endif; ?>
							<th><?=translate('hostel_name')?></th>
							<th><?=translate('category')?></th>
							<th><?=translate('watchman_name')?></th>
							<th><?=translate('remarks')?></th>
							<th><?=translate('address')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$count = 1;
							foreach($hostellist as $row):
						?>
						<tr>
							<td><?php echo $count++;?></td>
							<?php if (is_superadmin_loggedin()): ?>
							<td><?php echo $row['branch_name'];?></td>
							<?php endif; ?>
							<td><?php echo $row['name'];?></td>
							<td><?php echo get_type_name_by_id('hostel_category', $row['category_id']);?></td>
							<td><?php echo $row['watchman'];?></td>
							<td><?php echo $row['remarks'];?></td>
							<td><?php echo $row['address'];?></td>
							<td class="min-w-c">
							<?php if (get_permission('hostel', 'is_edit')): ?>
								<!--update link-->
								<a href="<?=base_url('hostels/edit/'. $row['id'])?>" class="btn btn-default btn-circle icon">
									<i class="fas fa-pen-nib"></i>
								</a>
							<?php endif; if (get_permission('hostel', 'is_delete')): ?>
								<!-- delete link -->
								<?php echo btn_delete('hostels/delete/' . $row['id']);?>
							<?php endif; ?>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
<?php if (get_permission('hostel', 'is_add')): ?>
			<div class="tab-pane" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit')); ?>
					<?php if (is_superadmin_loggedin()): ?>
						<div class="form-group">
							<label class="control-label col-md-3"><?=translate('branch')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<?php
									$arrayBranch = $this->app_lib->getSelectList('branch');
									echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' data-width='100%' id='branch_id'
									data-plugin-selectTwo  data-minimum-results-for-search='Infinity'");
								?>
								<span class="error"></span>
							</div>
						</div>
					<?php endif; ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('hostel_name')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="<?=set_value('name')?>" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('category')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayCategory = $this->app_lib->getSelectByBranch('hostel_category', $branch_id, false, array('type' => 'hostel'));
								echo form_dropdown("category_id", $arrayCategory, set_value('category_id'), "class='form-control' id='category_id'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('watchman_name')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="watchman_name" value="<?=set_value('watchman_name')?>"  />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('hostel_address')?></label>
						<div class="col-md-6">
							<textarea class="form-control" rows="3" name="hostel_address"><?=set_value('hostel_address')?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('remarks')?></label>
						<div class="col-md-6 mb-md">
							<textarea class="form-control" rows="2" name="remarks"><?=set_value('remarks')?></textarea>
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

<script type="text/javascript">
	$(document).ready(function () {
		$(document).on('change', '#branch_id', function() {
			var branchID = $(this).val();
			$.ajax({
				url: "<?=base_url('hostels/getCategoryByBranch')?>",
				type: 'POST',
				data:{
					branch_id: branchID,
					type: 'hostel'
				},
				success: function (data) {
					$('#category_id').html(data);
				}
			});
		});
	});
</script>