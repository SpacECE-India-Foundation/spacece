<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<div class="tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#attachments" data-toggle="tab"><i class="fas fa-list-ul"></i> <?=translate('attachments')?></a>
					</li>
<?php if (get_permission('attachments', 'is_add')): ?>
					<li >
						<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?=translate('create_attachments')?></a>
					</li>
<?php endif; ?>
				</ul>
				<div class="tab-content">
					<div id="attachments" class="tab-pane active">
						<div class="mb-md">
							<table class="table table-bordered table-hover table-condensed mb-none table-export">
								<thead>
									<tr>
										<th><?=translate('sl')?></th>
									<?php if (is_superadmin_loggedin()) { ?>
										<th><?=translate('branch')?></th>
									<?php } ?>
										<th><?=translate('title')?></th>
										<th><?=translate('type')?></th>
										<th><?=translate('class')?></th>
										<th><?=translate('subject')?></th>
										<th><?=translate('remarks')?></th>
										<th><?=translate('publisher')?></th>
										<th><?=translate('date')?></th>
										<th><?=translate('action')?></th>
									</tr>
								</thead>
								<tbody>
									<?php  $count = 1; foreach($attachmentss as $row): ?>
									<tr>
										<td><?php echo $count++; ?></td>
									<?php if (is_superadmin_loggedin()) { ?>
										<td><?php echo $row['branch_name'];?></td>
									<?php } ?>
										<td><?php echo $row['title'];?></td>
										<td><?php echo $row['type_name'];?></td>
										<td><?php echo (empty($row['class_name']) ? '<span class="text-dark">All</span>' : $row['class_name']);?></td>
										<td><?php echo (empty($row['subject_name']) ? '<span class="text-dark">Unfiltered</span>' : $row['subject_name']);?></td>
										<td><?php echo $row['remarks']; ?></td>
										<td><?php echo get_type_name_by_id('staff', $row['uploader_id']);?></td>
										<td><?php echo _d($row['date']);?></td>
										<td class="min-w-c">
											<!--download link-->
											<a href="<?=base_url('attachments/download?file=' . $row['enc_name'])?>" class="btn btn-default btn-circle icon" data-toggle="tooltip"
											data-original-title="<?=translate('download')?>">
												<i class="fas fa-cloud-download-alt"></i>
											</a>
										<?php if (get_permission('attachments', 'is_edit')): ?>
											<!--update link-->
											<a href="<?=base_url('attachments/edit/' . $row['id'])?>" class="btn btn-default btn-circle icon">
												<i class="fas fa-pen-nib"></i>
											</a>
										<?php endif; if (get_permission('attachments', 'is_delete')): ?>
											<!-- delete link -->
											<?php echo btn_delete('attachments/delete/' . $row['id']);?>
										<?php endif; ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane" id="create">
						<?php echo form_open_multipart('attachments/save', array('class' => 'form-bordered form-horizontal frm-submit-data')); ?>
							<?php if (is_superadmin_loggedin() ): ?>
							<div class="form-group">
								<label class="control-label col-md-3"><?=translate('branch')?> <span class="required">*</span></label>
								<div class="col-md-6">
									<?php
										$arrayBranch = $this->app_lib->getSelectList('branch');
										echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' id='branch_id'
										data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
									?>
									<span class="error"></span>
								</div>
							</div>
							<?php endif; ?>
							<div class="form-group">
								<label class="col-md-3 control-label"><?=translate('title')?> <span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="title" value="<?=set_value('title')?>" />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3"><?=translate('type')?> <span class="required">*</span></label>
								<div class="col-md-6">
									<?php
										$arrayType = $this->app_lib->getSelectByBranch('attachments_type', $branch_id);
										echo form_dropdown("type_id", $arrayType, set_value('type_id'), "class='form-control' id='type_id' data-plugin-selectTwo
										data-width='100%' data-minimum-results-for-search='Infinity' ");
									?>
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-offset-3">
									<div class="ml-md checkbox-replace">
										<label class="i-checks"><input type="checkbox" name="all_class_set" id="all_class_set"><i></i> Available For All Classes</label>
									</div>
								</div>
								<div id="class_div">
									<div class="mt-sm">
										<label class="control-label col-md-3"><?=translate('class')?> <span class="required">*</span></label>
										<div class="col-md-6">
											<?php
												$arrayClass = $this->app_lib->getClass($branch_id);
												echo form_dropdown("class_id", $arrayClass, set_value('class_id'), "class='form-control' id='class_id' onchange='getSubjectByClass(this.value)'
												data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
											?>
											<span class="error"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group" id="sub_div">
								<div class="col-md-offset-3">
									<div class="ml-md checkbox-replace">
										<label class="i-checks"><input type="checkbox" name="subject_wise" id="subject_wise"><i></i> Not According Subject</label>
									</div>
								</div>
								<div id="subject_div">
									<div class="mt-sm">
										<label class="control-label col-md-3"><?=translate('subject')?> <span class="required">*</span></label>
										<div class="col-md-6">
											<?php
												$arraySubject = array("" => translate('select_class_first'));
												echo form_dropdown("subject_id", $arraySubject, set_value('subject_id'), "class='form-control' id='subject_id'
												data-plugin-selectTwo data-width='100%' ");
											?>
											<span class="error"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3"><?=translate('publish_date')?> <span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="date" value="<?=date('Y-m-d')?>" data-plugin-datepicker />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-md-3 control-label"><?=translate('remarks')?></label>
								<div class="col-md-6">
									<textarea type="text" rows="2" class="form-control" name="remarks" ><?=set_value('remarks')?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3"><?=translate('attachment_file')?> <span class="required">*</span></label>
								<div class="col-md-6 mb-md">
									<input type="file" name="attachment_file" class="dropify" data-height="120" data-allowed-file-extensions="*" />
									<span class="error"></span>
								</div>
							</div>
							<footer class="panel-footer mt-lg">
								<div class="row">
									<div class="col-md-2 col-md-offset-3">
										<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
											<i class="fas fa-plus-circle"></i> <?=translate('save')?>
										</button>
									</div>
								</div>	
							</footer>
						<?php echo form_close();?>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#branch_id').on('change', function() {
			var branchID = $(this).val();
			getClassByBranch(this.value);
			$.ajax({
				url: "<?=base_url('ajax/getDataByBranch')?>",
				type: 'POST',
				data: {
					branch_id: branchID,
					table: 'attachments_type'
				},
				success: function (data) {
					$('#type_id').html(data);
				}
			});
		});
	});
</script>