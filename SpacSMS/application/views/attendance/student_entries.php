<?php $widget = (is_superadmin_loggedin() ? 3 : 4); ?>
<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"><?=translate('select_ground')?></h4>
	</header>
	<?php echo form_open($this->uri->uri_string());?>
	<div class="panel-body">
		<div class="row mb-sm">
		<?php if (is_superadmin_loggedin() ): ?>
			<div class="col-md-3 mb-sm">
				<div class="form-group">
					<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
					<?php
						$arrayBranch = $this->app_lib->getSelectList('branch');
						echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' onchange='getClassByBranch(this.value)'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
				</div>
				<span class="error"><?=form_error('branch_id')?></span>
			</div>
		<?php endif; ?>
			<div class="col-md-<?php echo $widget; ?> mb-sm">
				<div class="form-group">
					<label class="control-label"><?=translate('class')?> <span class="required">*</span></label>
					<?php
						$arrayClass = $this->app_lib->getClass($branch_id);
						echo form_dropdown("class_id", $arrayClass, set_value('class_id'), "class='form-control' id='class_id' onchange='getSectionByClass(this.value,0)'
					 	data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
					?>
					<span class="error"><?=form_error('class_id')?></span>
				</div>
			</div>
			<div class="col-md-<?php echo $widget; ?> mb-sm">
				<div class="form-group">
					<label class="control-label"><?=translate('section')?> <span class="required">*</span></label>
					<?php
						$arraySection = $this->app_lib->getSections(set_value('class_id'), false);
						echo form_dropdown("section_id", $arraySection, set_value('section_id'), "class='form-control' id='section_id'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
					?>
					<span class="error"><?=form_error('section_id')?></span>
				</div>
			</div>
			<div class="col-md-<?php echo $widget; ?> mb-sm">
				<div class="form-group <?php if (form_error('date')) echo 'has-error'; ?>">
					<label class="control-label"><?=translate('date')?> <span class="required">*</span></label>
					<div class="input-group">
						<input type="text" class="form-control" data-plugin-datepicker name="date" value="<?=set_value('date', date("Y-m-d"))?>"/>
						<span class="input-group-addon"><i class="icon-event icons"></i></span>
					</div>
					<span class="error"><?=form_error('date')?></span>
				</div>
			</div>
		</div>
	</div>
	<footer class="panel-footer">
		<div class="row">
			<div class="col-md-offset-10 col-md-2">
				<button type="submit" name="search" value="1" class="btn btn btn-default btn-block"> <i class="fas fa-filter"></i> <?=translate('filter')?></button>
			</div>
		</div>
	</footer>
	<?php echo form_close();?>
</section>

<?php if (isset($attendencelist)): ?>
	<section class="panel appear-animation" data-appear-animation="<?=$global_config['animations'] ?>" data-appear-animation-delay="100">
		<?php
			echo form_open($this->uri->uri_string());
			$data = array('date' => $date, 'branch_id' => $branch_id);
			echo form_hidden($data);
		?>
		<header class="panel-heading">
			<h4 class="panel-title"><i class="fas fa-users"></i> <?=translate('students_list')?></h4>
		</header>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-offset-9 col-md-3">
					<div class="form-group mb-sm">
						<label class="control-label"><?=translate('select_for_everyone')?> <span class="required">*</span></label>
						<?php
							$array = array(
								"" => translate('not_selected'),
								"P" 	=> translate('present'),
								"A" 	=> translate('absent'),
								"H" 	=> translate('holiday'),
								"L" 	=> translate('late')
							);
							echo form_dropdown("mark_all_everyone", $array, set_value('mark_all_everyone'), "class='form-control' 
							onchange='selAtten_all(this.value)' data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
						?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive mb-sm mt-xs">
						<table class="table table-bordered table-hover table-condensed mb-none">
							<thead>
								<tr>
									<th>#</th>
									<th><?=translate('name')?></th>
									<th><?=translate('roll')?></th>
									<th><?=translate('register_no')?></th>
									<th width="400"><?=translate('status')?></th>
									<th><?=translate('remarks')?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 1;
								if(count($attendencelist)) {
									foreach ($attendencelist as $key => $row):
										?>
								<tr>
									<input type="hidden" name="attendance[<?=$key?>][attendance_id]" value="<?=$row['att_id']?>" >
									<input type="hidden" name="attendance[<?=$key?>][student_id]" value="<?=$row['student_id']?>" >
									<td><?php echo $count++; ?></td>
									<td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
									<td><?php echo $row['roll']; ?></td>
									<td><?php echo $row['register_no']; ?></td>
									<td>
										<div class="radio-custom radio-success radio-inline mt-xs">
											<input type="radio" value="P" <?=($row['att_status'] == 'P' ? 'checked' : '')?> name="attendance[<?=$key?>][status]" id="pstatus_<?=$key?>">
											<label for="pstatus_<?=$key?>"><?=translate('present')?></label>
										</div>

										<div class="radio-custom radio-danger radio-inline mt-xs">
											<input type="radio" value="A" <?=($row['att_status'] == 'A' ? 'checked' : '')?> name="attendance[<?=$key?>][status]" id="astatus_<?=$key?>">
											<label for="astatus_<?=$key?>"><?=translate('absent')?></label>
										</div>

										<div class="radio-custom radio-info radio-inline mt-xs">
											<input type="radio" value="H" <?=($row['att_status'] == 'H' ? 'checked' : '')?> name="attendance[<?=$key?>][status]" id="hstatus_<?=$key?>">
											<label for="hstatus_<?=$key?>"><?=translate('holiday')?></label>
										</div>

										<div class="radio-custom radio-inline mt-xs">
											<input type="radio" value="L" <?=($row['att_status'] == 'L' ? 'checked' : '')?> name="attendance[<?=$key?>][status]" id="lstatus_<?=$key?>">
											<label for="lstatus_<?=$key?>"><?=translate('late')?></label>
										</div>
									</td>
									<td>
										<input class="form-control" name="attendance[<?=$key?>][remark]" type="text" placeholder="<?=translate('remarks')?>" value="<?=$row['att_remark']?>" >
									</td>
								</tr>
									<?php 
								endforeach;
							} else {
								echo '<tr><td colspan="6"><h5 class="text-danger text-center">'.translate('no_information_available').'</td></tr>';
							} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="col-md-offset-10 col-md-2">
					<button type="submit" class="btn btn-default btn-block" name="save" value="1">
						<i class="fas fa-plus-circle"></i> <?=translate('save')?>
					</button>
				</div>
			</div>
		</div>
		<?php echo form_close();?>
	</section>
<?php endif; ?>