<?php $widget = (is_superadmin_loggedin() ? 3 : 4);?>
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
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' id='branch_id'
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
								echo form_dropdown("class_id", $arrayClass, set_value('class_id'), "class='form-control' id='class_id' onchange='getSectionByClass(this.value,1)'
								required data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>
					<div class="col-md-<?php echo $widget; ?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('section')?> <span class="required">*</span></label>
							<?php
								$arraySection = $this->app_lib->getSections(set_value('class_id'), true);
								echo form_dropdown("section_id", $arraySection, set_value('section_id'), "class='form-control' id='section_id' required
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>
					<div class="col-md-<?php echo $widget; ?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('fee_group')?> <span class="required">*</span></label>
							<?php
								$arrayGroup = $this->app_lib->getSelectByBranch('fee_groups', $branch_id);
								echo form_dropdown("fee_group_id", $arrayGroup, set_value('fee_group_id'), "class='form-control' id='groupID' required
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

		<?php if (isset($studentlist)):?>
		<section class="panel appear-animation" data-appear-animation="<?=$global_config['animations'] ?>" data-appear-animation-delay="100">
			<?php echo form_open($this->uri->uri_string());?>
			<input type="hidden" name="fee_group_id" value="<?=$fee_group_id; ?>" >
			<input type="hidden" name="branch_id" value="<?=$branch_id; ?>" >
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-list"></i> <?php echo translate('student_list');?></h4>
			</header>
			<div class="panel-body mb-sm">
				<table class="table table-bordered table-condensed table-hover mb-none">
					<thead>
						<tr>
							<th width="80">
								<div class="checkbox-replace">
									<label class="i-checks"><input type="checkbox" id="selectAllchkbox"><i></i></label>
								</div>
							</th>
							<th width="80"><?=translate('sl')?></th>
							<th><?=translate('name')?></th>
							<th><?=translate('register_no')?></th>
							<th><?=translate('roll')?></th>
							<th><?=translate('gender')?></th>
							<th><?=translate('mobile_no')?></th>
							<th><?=translate('email')?></th>
							<th><?=translate('guardian_name')?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1; 
						if (count($studentlist)) {
							foreach($studentlist as $row):
							?>
						<tr>
							<td class="checked-area">
								<div class="checkbox-replace">
									<label class="i-checks"><input type="checkbox" name="stu_operations[]" <?=($row['allocation_id'] != 0 ? 'checked' : "");?> value="<?=$row['student_id']?>"><i></i></label>
								</div>
							</td>
							<td><?php echo $count++; ?></td>
							<td><?php echo $row['fullname']; ?></td>
							<td><?php echo $row['register_no']; ?></td>
							<td><?php echo $row['roll']; ?></td>
							<td><?php echo ucfirst($row['gender']); ?></td>
							<td><?php echo $row['mobileno']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo (!empty($row['parent_id']) ? get_type_name_by_id('parent', $row['parent_id']) : 'N/A'); ?></td>
						</tr>
						<?php endforeach; }else{
							echo '<tr><td colspan="9"><h5 class="text-danger text-center">' . translate('no_information_available') . '</td></tr>'; 
						} ?>
					</tbody>
				</table>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-offset-10 col-md-2">
						<button type="submit" name="save" value="1" class="btn btn-default btn-block"> <i class="fas fa-plus-circle"></i> <?=translate('save')?></button>
					</div>
				</div>
			</footer>
			<?php echo form_close();?>
		</section>
		<?php endif;?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#branch_id').on('change', function(){
			var branchID = $(this).val();
			getClassByBranch(branchID);

		    $.ajax({
		        url: base_url + 'fees/getGroupByBranch',
		        type: 'POST',
		        data: {
		            'branch_id' : branchID,
		        },
		        success: function (data) {
		            $('#groupID').html(data);
		        }
		    });
		});
	});
</script>