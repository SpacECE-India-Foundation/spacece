<?php $widget = (is_superadmin_loggedin() ? 3 : 4); ?>
<section class="panel">
	<?php echo form_open($this->uri->uri_string());?>
	<header class="panel-heading">
		<h4 class="panel-title"><?=translate('select_ground')?></h4>
	</header>
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
				<div class="form-group">
					<label class="control-label"><?=translate('month')?> <span class="required">*</span></label>
					<div class="input-group">
						<input type="text" class="form-control" name="timestamp" value="<?=set_value('timestamp', date('Y-F'))?>" data-plugin-datepicker required
						data-plugin-options='{ "format": "yyyy-MM", "minViewMode": "months", "orientation": "bottom"}' />
						<span class="input-group-addon"><i class="icon-event icons"></i></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="panel-footer">
		<div class="row">
			<div class="col-md-offset-10 col-md-2">
				<button type="submit" name="submit" value="search" class="btn btn btn-default btn-block"> <i class="fas fa-filter"></i> <?=translate('filter')?></button>
			</div>
		</div>
	</footer>
    <?php echo form_close();?>
</section>

<?php if (isset($studentlist)): ?>
	<section class="panel appear-animation mt-sm" data-appear-animation="<?=$global_config['animations'] ?>" data-appear-animation-delay="100">
		<header class="panel-heading">
			<h4 class="panel-title"><i class="fas fa-users"></i> <?=translate('attendance_report')?></h4>
		</header>
		<div class="panel-body">
			<!-- hidden school information prints -->
			<div class="export_title">Monthly Attendance Sheet on <?=date("F Y", strtotime($year.'-'.$month)); ?> <?php 
				echo translate('class') .' : '. get_type_name_by_id('class', $class_id);
				echo ' ( ' .translate('section'). ' : ' .get_type_name_by_id('section', $section_id).' )';
				?></div>
			
			
			<div class="row mt-sm">
				<div class="col-md-offset-8 col-md-4">
					<table class="table table-condensed table-bordered text-dark text-center">
						<tbody>
							<tr>
								<td><strong>Present :</strong> <i class="far fa-check-circle hidden-print text-success"></i><span class="visible-print">P</span></td>
								<td><strong>Absent : </strong> <i class="far fa-times-circle hidden-print text-danger"></i><span class="visible-print">A</span></td>
								<td><strong>Holiday : </strong> <i class="fas fa-hospital-symbol hidden-print text-info"></i><span class="visible-print">H</span></td>
								<td><strong>Late : </strong> <i class="far fa-clock hidden-print text-tertiary"></i><span class="visible-print">L</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="mb-lg">
						<table class="table table-bordered table-hover table-condensed mb-none text-dark table-export">
							<thead>
								<tr>
									<td><?=translate('student_name')?></td>
<?php
for($i = 1; $i <= $days; $i++){
$date = $year . '-' . $month . '-' . $i;
?>
							<td class="text-center"><?php echo date('D', strtotime($date)); ?> <br> <?php echo date('d', strtotime($date)); ?></td>
<?php } ?>
									<td class="text-center text-success">Total<br>Present</td>
									<td class="text-center text-danger">Total<br>Absent</td>
									<td class="text-center text-tertiary">Total<br>Late</td>
								</tr>
							</thead>
							<tbody>
<?php
foreach ($studentlist as $row):
$total_present = 0;
$total_absent = 0;
$total_late = 0;
$studentID = $row['student_id'];
?>
								<tr>
									<td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
<?php
for ($i = 1; $i <= $days; $i++) { 
$date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $i));
$atten = $this->attendance_model->get_attendance_by_date($studentID, $date);
?>
							<td class="center">
<?php if (!empty($atten)) { ?>
								<span data-toggle="popover" data-trigger="hover" data-placement="top" data-trigger="hover" data-content="<?php echo $atten['remark']; ?>">
<?php if ($atten['status'] == 'A') { $total_absent++; ?>
									<i class="far fa-times-circle text-danger"></i><span class="visible-print">A</span>
<?php } if ($atten['status'] == 'P') { $total_present++; ?>
									<i class="far fa-check-circle text-success"></i><span class="visible-print">P</span>
<?php } if ($atten['status'] == 'L') { $total_late++; ?>
									<i class="far fa-clock text-info"></i><span class="visible-print">L</span>
<?php } if ($atten['status'] == 'H'){ ?>
									<i class="fas fa-hospital-symbol text-tertiary"></i><span class="visible-print">H</span>
<?php } ?>
								</span>
<?php } ?>
							</td>
<?php } ?>
									<td class="center"><?=html_escape($total_present)?></td>
									<td class="center"><?=html_escape($total_absent)?></td>
									<td class="center"><?=html_escape($total_late)?></td>
									<?php endforeach; ?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>