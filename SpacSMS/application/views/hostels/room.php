<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> <?=translate('room_list')?></a>
			</li>
<?php if (get_permission('hostel_room', 'is_add')): ?>
			<li>
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?=translate('create') . " " . translate('room')?></a>
			</li>
<?php endif; ?>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane active">
				<table class="table table-bordered table-hover table-export">
					<thead>
						<tr>
							<th><?=translate('sl')?></th>
							<?php if (is_superadmin_loggedin()): ?>
							<th><?=translate('branch')?></th>
							<?php endif; ?>
							<th><?=translate('room_name')?></th>
							<th><?=translate('hostel_name')?></th>
							<th><?=translate('category')?></th>
							<th><?=translate('no_of_beds')?></th>
							<th><?=translate('cost_per_bed')?></th>
							<th><?=translate('remarks')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
						<?php $count = 1; foreach($roomlist as $row): ?>
						<tr>
							<td><?php echo $count++;?></td>
							<?php if (is_superadmin_loggedin()): ?>
							<td><?php echo $row['branch_name'];?></td>
							<?php endif; ?>
							<td><?php echo $row['name'];?></td>
							<td><?php echo get_type_name_by_id('hostel', $row['hostel_id']);?></td>
							<td><?php echo get_type_name_by_id('hostel_category', $row['category_id']);?></td>
							<td><?php echo $row['no_beds'];?></td>
							<td><?php echo $global_config['currency_symbol'] . $row['bed_fee']; ?></td>
							<td><?php echo $row['remarks'];?></td>
							<td>
							<?php if (get_permission('hostel_room', 'is_edit')): ?>
								<!--update link-->
								<a href="<?=base_url('hostels/edit_room/' . $row['id'])?>" class="btn btn-default btn-circle icon">
									<i class="fas fa-pen-nib"></i>
								</a>
							<?php endif; if (get_permission('hostel_room', 'is_delete')): ?>
								<!-- deletion link -->
								<?php echo btn_delete('hostels/delete_room/'. $row['id']);?>
							<?php endif; ?>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
<?php if (get_permission('hostel_room', 'is_add')): ?>
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
						<label class="col-md-3 control-label"><?=translate('room_name')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="<?=set_value('name')?>" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('hostel_name')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayHostel = $this->app_lib->getSelectByBranch('hostel', $branch_id, false);
								echo form_dropdown("hostel_id", $arrayHostel, set_value('hostel_id'), "class='form-control' id='hostel_id'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('category')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayCategory = $this->app_lib->getSelectByBranch('hostel_category', $branch_id, false, array('type' => 'room'));
								echo form_dropdown("category_id", $arrayCategory, set_value('category_id'), "class='form-control' id='category_id'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('no_of_beds')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" value="<?=set_value('number_of_beds')?>" name="number_of_beds" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('cost_per_bed')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" value="<?=set_value('bed_fee')?>" name="bed_fee" />
							<span class="error"></span>
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
		$('#branch_id').on("change", function(){	
			var branchID = $(this).val();
			$.ajax({
				url: "<?=base_url('ajax/getDataByBranch')?>",
				type: 'POST',
				data: {
					table: 'hostel',
					branch_id: branchID
				},
				success: function (data) {
					$('#hostel_id').html(data);
				}
			});

			$.ajax({
				url: "<?=base_url('hostels/getCategoryByBranch')?>",
				type: 'POST',
				data:{
					branch_id: branchID,
					type: 'room'
				},
				success: function (data) {
					$('#category_id').html(data);
				}
			});
		});
	});
</script>
 