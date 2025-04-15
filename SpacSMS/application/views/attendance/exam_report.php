<?php $widget = (is_superadmin_loggedin() ? 2 : 3); ?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
		<?php echo form_open($this->uri->uri_string());?>
			<header class="panel-heading">
				<h4 class="panel-title"><?=translate('select_ground')?></h4>
			</header>
			<div class="panel-body">
				<div class="row mb-sm">
					<?php if (is_superadmin_loggedin() ): ?>
						<div class="col-md-2 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
								<?php
									$arrayBranch = $this->app_lib->getSelectList('branch');
									echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' id='branch_id'
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
								?>
							</div>
							<span class="error"><?=form_error('branch_id')?></span>
						</div>
					<?php endif; ?>

					<div class="col-md-<?php echo $widget; ?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('exam')?> <span class="required">*</span></label>
							<?php
								if(isset($branch_id)){
									$arrayExam = array("" => translate('select'));
									$exams = $this->db->get_where('exam', array('branch_id' => $branch_id,'session_id' => get_session_id()))->result();
									foreach ($exams as $row){
										$arrayExam[$row->id] = $this->application_model->exam_name_by_id($row->id);
									}
								}else{
									$arrayExam = array("" => translate('select_branch_first'));
								}
								echo form_dropdown("exam_id", $arrayExam, set_value('exam_id'), "class='form-control' id='exam_id' data-plugin-selectTwo
								data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"><?=form_error('exam_id')?></span>
						</div>
					</div>
					<div class="col-md-3 mb-sm">
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
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label"><?=translate('subject')?> <span class="required">*</span></label>
							<?php
								
								if(!empty(set_value('class_id'))) {
									$arraySubject = array("" => translate('select'));
									$assigns = $this->db->get_where('subject_assign', array('class_id' => set_value('class_id'), 'section_id' => set_value('section_id')))->result();
									foreach ($assigns as $row){
										$arraySubject[$row->subject_id] = get_type_name_by_id('subject', $row->subject_id);
									}
								} else {
									$arraySubject = array("" => translate('select_class_first'));
								}
								echo form_dropdown("subject_id", $arraySubject, set_value('subject_id'), "class='form-control' id='subject_id'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"><?=form_error('subject_id')?></span>
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

		<?php if(isset($examreport)): ?>
		<section class="panel appear-animation mt-sm" data-appear-animation="<?=$global_config['animations'] ?>" data-appear-animation-delay="100">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-users"></i> <?=translate('attendance_report');?></h4>
			</header>
			<div class="panel-body">
				<div class="mt-sm mb-md">
					<!-- hidden school information prints -->
					<div class="export_title"><?php echo translate('class'). ' : ' .get_type_name_by_id('class', $class_id) .  ' ( ' .translate('section'). ' : ' .get_type_name_by_id('section', $section_id). ' ) ' . $this->application_model->exam_name_by_id($exam_id) . ' - Attendance Sheet';?></div>
					<table class="table table-bordered table-hover table-condensed mb-none text-dark table-export">
						<thead>
							<tr>
								<th width="40">#</th>
								<th><?=translate('name')?></th>
								<th><?=translate('roll')?></th>
								<th><?=translate('register_no')?></th>
								<th><?=translate('subject')?></th>
								<th><?=translate('remarks')?></th>
								<th width="180"><?=translate('status')?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$count = 1;
							foreach($examreport as $row):
							?>
							<tr>
								<td><?php echo $count++ ;?></td>
								<td><?php echo html_escape($row['first_name'] . " " . $row['last_name']);?></td>
								<td><?php echo html_escape($row['roll']);?></td>
								<td><?php echo html_escape($row['register_no']);?></td>
								<td><?php echo html_escape($row['subject_name']);?></td>
								<td><?php echo html_escape(!empty($row['remark']) ? $row['remark']: 'N/A');?></td>
								<td>
									<?php
									if($row['status'] == "P")
										echo '<span class="label label-primary">'.strtoupper('present').'</span>';
									if($row['status'] == "A")
										echo '<span class="label label-danger">'.strtoupper('absent').'</span>';
									 if($row['status'] == "L")
										echo '<span class="label label-warning">'.strtoupper('late').'</span>';
									?>
								</td>
							<?php endforeach; ?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</section>
		<?php endif; ?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#branch_id').on('change', function() {
			var branchID = $(this).val();
			getClassByBranch(branchID);
			getExamByBranch(branchID);
			$('#subject_id').html('').append('<option value=""><?=translate("select")?></option>');
		});

		$('#section_id').on('change', function() {
			var classID = $('#class_id').val();
			var sectionID = $(this).val();
			$.ajax({
				url: base_url + 'subject/getByClassSection',
				type: 'POST',
				data: {
					classID: classID,
					sectionID: sectionID
				},
				success: function (data) {
					$('#subject_id').html(data);
				}
			});
		});
	});
</script>

