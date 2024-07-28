<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('hostels/room')?>"><i class="fas fa-list-ul"></i> <?=translate('room_list')?></a>
			</li>
			<li class="active">
				<a href="#edit" data-toggle="tab"><i class="far fa-edit"></i> <?=translate('edit_room')?></a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="edit">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit')); ?>
				<input type="hidden" name="room_id" value="<?=$room['id']?>">
					<?php if (is_superadmin_loggedin()): ?>
						<div class="form-group">
							<label class="control-label col-md-3"><?=translate('branch')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<?php
									$arrayBranch = $this->app_lib->getSelectList('branch');
									echo form_dropdown("branch_id", $arrayBranch, $room['branch_id'], "class='form-control' data-width='100%' id='branch_id'
									data-plugin-selectTwo  data-minimum-results-for-search='Infinity'");
								?>
								<span class="error"></span>
							</div>
						</div>
					<?php endif; ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('room_name')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="<?=$room['name']?>" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('hostel_name')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayHostel = $this->app_lib->getSelectByBranch('hostel', $room['branch_id'], false);
								echo form_dropdown("hostel_id", $arrayHostel, $room['hostel_id'], "class='form-control' id='hostel_id'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('category')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayCategory = $this->app_lib->getSelectByBranch('hostel_category', $room['branch_id'], false, array('type' => 'room'));
								echo form_dropdown("category_id", $arrayCategory, $room['category_id'], "class='form-control' id='category_id'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('no_of_beds')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="number" class="form-control" value="<?=$room['no_beds']?>" name="number_of_beds" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('cost_per_bed')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="number" class="form-control" value="<?=$room['bed_fee']?>" name="bed_fee" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('remarks')?></label>
						<div class="col-md-6 mb-md">
							<textarea class="form-control" rows="2" name="remarks"><?=$room['remarks']?></textarea>
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

<script type="text/javascript">
	$(document).ready(function () {
		"use strict";
		$(document).on('change', '#branch_id', function() {
			var branchID = $(this).val();
			$.ajax({
				url: "<?=base_url('hostels/get_hostel_branch_based')?>",
				type: 'POST',
				data: {branch_id: branchID},
				success: function (data) {
					$('#hostel_id').html(data);
				}
			});
			$.ajax({
				url: "<?=base_url('hostels/get_category_branch_based')?>",
				type: 'POST',
				data: {branch_id: branchID, type: 'room'},
				success: function (data) {
					$('#category_id').html(data);
				}
			});
		});
	});
</script>
 