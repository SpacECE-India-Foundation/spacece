<section class="panel">
	<?php echo form_open('homework/evaluate_save', array('class' => 'frm-submit'));
	$evaDate = array_column($homeworklist, 'evaluation_date');
	?>
	<input type="hidden" name="homework_id" value="<?=$this->uri->segment(3)?>">
	<header class="panel-heading">
		<h4 class="panel-title"><i class="fas fa-list"></i> <?=translate('student_list')?></h4>
	</header>
	<div class="panel-body">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group mb-sm">
						<label class="control-label"><?=translate('date')?> <span class="required">*</span></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
							<input type="text" class="form-control" name="date" id="date" value="<?=set_value('date', $evaDate[0])?>" autocomplete="off" data-plugin-datepicker
							data-plugin-options='{ "todayHighlight" : true }' />
						</div>
						<span class="error"></span>
					</div>
				</div>
				<div class="col-md-offset-6 col-md-3">
					<div class="form-group mb-sm">
						<label class="control-label"><?=translate('select_for_everyone')?> <span class="required">*</span></label>
						<?php
							$array = array(
								"" => translate('not_selected'),
								"c" 	=> translate('complete'),
								"u" 	=> translate('incomplete'),
							);
							echo form_dropdown("mark_all_everyone", $array, set_value('mark_all_everyone'), "class='form-control' 
							onchange='selAtten_all(this.value)' data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
						?>
					</div>
				</div>
			</div>
		<div class="table-responsive mb-sm mt-xs">
			<table class="table table-bordered table-hover table-condensed mb-none">
				<thead>
					<tr>
						<th><?=translate('sl')?></th>
						<th><?=translate('student')?></th>
						<th><?=translate('register_no')?></th>
						<th><?=translate('roll')?></th>
						<th><?=translate('class')?></th>
						<th><?=translate('section')?></th>
						<th><?=translate('subject')?></th>
						<th><?=translate('status')?></th>
						<th><?=translate('rank_out_of_5')?></th>
						<th><?=translate('remarks')?></th>

					</tr>
				</thead>
				<tbody>
					<?php 
					$count = 1; 
					if (count($homeworklist)) {
						foreach ($homeworklist as $key => $row) {
							?>
					<tr>
						<input type="hidden" name="evaluate[<?=$key?>][evaluation_id]" value="<?=$row['ev_id']?>">
						<input type="hidden" name="evaluate[<?=$key?>][student_id]" value="<?=$row['student_id']?>">
						<td><?php echo $count++; ?></td>
						<td><?php echo $row['fullname']; ?></td>
						<td><?php echo $row['register_no']; ?></td>
						<td><?php echo $row['roll']; ?></td>
						<td><?php echo $row['class_name']; ?></td>
						<td><?php echo $row['section_name']; ?></td>
						<td><?php echo $row['subject_name']; ?></td>
						<td class="min-w-sm">
							<div class="radio-custom radio-success radio-inline mt-xs">
								<input type="radio" value="c" <?=($row['ev_status'] == 'c' ? 'checked' : '')?> name="evaluate[<?=$key?>][status]" id="cstatus_<?=$key?>">
								<label for="cstatus_<?=$key?>"><?=translate('complete')?></label>
							</div>
							<div class="radio-custom radio-danger radio-inline mt-xs">
								<input type="radio" value="u" <?=($row['ev_status'] == 'u' ? 'checked' : '')?> name="evaluate[<?=$key?>][status]" id="ustatus_<?=$key?>">
								<label for="ustatus_<?=$key?>"><?=translate('incomplete')?></label>
							</div>
						</td>
						<td class="min-w-xs">
						<?php
							$array = array(
								1 => 1,
								2 => 2,
								3 => 3,
								4 => 4,
								5 => 5,
							);
							echo form_dropdown("evaluate[$key][rank]", $array, set_value('rank', $row['rank']), "class='form-control' 
							data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
						?>
						</td>
						<td class="min-w-sm">
							<input style="width: 100%" class="form-control" name="evaluate[<?=$key?>][remark]" type="text" placeholder="<?=translate('remarks')?>" value="<?=$row['ev_remarks']?>" >
						</td>
					</tr>
					<?php
					} 
				} else {
					echo '<tr><td colspan="9"><h5 class="text-danger text-center">'.translate('no_information_available').'</td></tr>';
				}?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="panel-footer">
		<div class="row">
			<div class="col-md-offset-10 col-md-2">
				<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
					<i class="fas fa-plus-circle"></i> <?=translate('save')?>
				</button>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
</section>
