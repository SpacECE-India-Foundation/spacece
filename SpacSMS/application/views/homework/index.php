<?php $widget = (is_superadmin_loggedin() ? 3 : 4); ?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
		<?php echo form_open($this->uri->uri_string(), array('class' => 'validate'));?>
			<header class="panel-heading">
				<h4 class="panel-title"><?=translate('select_ground')?></h4>
			<?php if (get_permission('homework', 'is_add')): ?>
				<div class="panel-btn">
					<a href="<?=base_url('homework/add')?>" id="addLeave" class="btn btn-default btn-circle" >
						<i class="fas fa-plus-circle"></i> <?=translate('add') . " " . translate('homework')?>
					</a>
				</div>
			<?php endif; ?>
			</header>
			<div class="panel-body">
				<div class="row mb-sm">
					<?php if (is_superadmin_loggedin()): ?>
					<div class="col-md-3 mb-sm">
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
								echo form_dropdown("class_id", $arrayClass, set_value('class_id'), "class='form-control' id='class_id' onchange='getSectionByClass(this.value,0)'
								required data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>
					<div class="col-md-<?php echo $widget; ?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('section')?> <span class="required">*</span></label>
							<?php
								$arraySection = $this->app_lib->getSections(set_value('class_id'), false);
								echo form_dropdown("section_id", $arraySection, set_value('section_id'), "class='form-control' id='section_id' required
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>
					<div class="col-md-<?php echo $widget; ?>">
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
								echo form_dropdown("subject_id", $arraySubject, set_value('subject_id'), "class='form-control' id='subject_id' required
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
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
		
		<?php if (isset($homeworklist)): ?>
		<section class="panel appear-animation" data-appear-animation="<?php echo $global_config['animations'];?>" data-appear-animation-delay="100">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-list"></i> <?=translate('homework')?></h4>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-export">
					<thead>
						<tr>
							<th><?=translate('sl')?></th>
							<th><?=translate('subject')?></th>
							<th><?=translate('class')?></th>
							<th><?=translate('section')?></th>
							<th><?=translate('date_of_homework')?></th>
							<th><?=translate('date_of_submission')?></th>
							<th><?=translate('sms_notification')?></th>
							<th><?=translate('status')?></th>
							<th><?=translate('scheduled_at')?></th>
							<th><?=translate('created_by')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
						<?php $count = 1; foreach ($homeworklist as $row) { ?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo $row['subject_name']; ?></td>
							<td><?php echo $row['class_name']; ?></td>
							<td><?php echo $row['section_name']; ?></td>
							<td><?php echo _d($row['date_of_homework']); ?></td>
							<td><?php echo _d($row['date_of_submission']); ?></td>
							<td><?php 
							if ($row['sms_notification'] == 1) {
								$status = translate('yes');
								$labelmode = 'label-success-custom';
							} else {
								$labelmode = 'label-info-custom';
								$status = translate('no');
							}
							echo "<span class='value label " . $labelmode . " '>" . $status . "</span>";
							 ?></td>
							<td><?php 
							if ($row['status'] == 0) {
								$status = translate('published');
								$labelmode = 'label-success-custom';
							} else {
								$labelmode = 'label-info-custom';
								$status = translate('pending');
							}
							echo "<span class='value label " . $labelmode . " '>" . $status . "</span>";
							 ?></td>
							<td><?php echo empty(_d($row['schedule_date']))  ? "N/A" : _d($row['schedule_date']); ?></td>
							<td><?php echo $row['creator_name']; ?></td>
							<td class="min-w-sm">
								<a href="javascript:void(0);" class="btn btn-circle btn-default icon" data-toggle="tooltip" data-original-title="<?=translate('evaluate')?>" onclick="getEvaluate(<?=$row['id']?>)" >
									<i class="fas fa-bars"></i>
								</a>
							<?php if (get_permission('homework', 'is_edit')) { ?>
								<a href="<?php echo base_url('homework/edit/' . $row['id']); ?>" class="btn btn-circle btn-default icon">
									<i class="fas fa-pen-nib"></i>
								</a>
							<?php } if (get_permission('homework', 'is_delete')) { ?>
								<?php echo btn_delete('homework/delete/' . $row['id']); ?>
							<?php } ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<?php echo form_close(); ?>
		</section>
		<?php endif; ?>
	</div>
</div>

<div class="zoom-anim-dialog modal-block modal-block-lg mfp-hide" id="modal">
	<section class="panel">
		<header class="panel-heading">
			<h4 class="panel-title"><i class="fas fa-bars"></i> <?php echo translate('evaluate'); ?></h4>
		</header>
		<div class="panel-body">
			<div id='quick_view'></div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-default modal-dismiss"><?php echo translate('close'); ?></button>
				</div>
			</div>
		</footer>
	</section>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#branch_id').on('change', function() {
			var branchID = $(this).val();
			getClassByBranch(branchID);
			$('#subject_id').html('').append('<option value=""><?=translate("select")?></option>');
		});

		$('#section_id').on('change', function() {
			var classID = $('#class_id').val();
			var sectionID =$(this).val();
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

	// get details
	function getEvaluate(id) {
	    $.ajax({
	        url: base_url + 'homework/evaluateModal',
	        type: 'POST',
	        data: {'homework_id': id},
	        dataType: "html",
	        success: function (data) {
	            $('#quick_view').html(data);
	            mfp_modal('#modal');
	        }
	    });
	}
</script>	