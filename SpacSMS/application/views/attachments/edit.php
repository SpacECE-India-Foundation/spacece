<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<div class="tabs-custom">
				<ul class="nav nav-tabs">
					<li>
						<a href="<?=base_url('attachments')?>"><i class="fas fa-list-ul"></i> <?=translate('attachments')?></a>
					</li>
					<li  class="active">
						<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?=translate('edit_attachments')?></a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="create">
						<?php echo form_open_multipart('attachments/save', array('class' => 'form-bordered form-horizontal frm-submit-data')); ?>
							<input type="hidden" name="attachment_id" value="<?=$data['id']?>">
							<?php if (is_superadmin_loggedin() ): ?>
							<div class="form-group">
								<label class="control-label col-md-3"><?=translate('branch')?> <span class="required">*</span></label>
								<div class="col-md-6">
									<?php
										$arrayBranch = $this->app_lib->getSelectList('branch');
										echo form_dropdown("branch_id", $arrayBranch, $data['branch_id'], "class='form-control' id='branch_id'
										data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
									?>
									<span class="error"></span>
								</div>
							</div>
							<?php endif; ?>
							<div class="form-group">
								<label class="col-md-3 control-label"><?=translate('title')?> <span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="title" value="<?=$data['title']?>" />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3"><?=translate('type')?> <span class="required">*</span></label>
								<div class="col-md-6">
									<?php
										$arrayType = $this->app_lib->getSelectByBranch('attachments_type', $data['branch_id']);
										echo form_dropdown("type_id", $arrayType, $data['type_id'], "class='form-control' id='type_id' data-plugin-selectTwo
										data-width='100%' data-minimum-results-for-search='Infinity' ");
									?>
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-offset-3">
									<div class="ml-md checkbox-replace">
										<label class="i-checks"><input type="checkbox" name="all_class_set" id="all_class_set" <?=($data['class_id'] == 'unfiltered' ? 'checked' : '');?>><i></i> Available For All Classes</label>
									</div>
								</div>
								<div id="class_div" <?php if($data['class_id'] == 'unfiltered') { ?> style="display: none" <?php } ?>>
									<div class="mt-sm">
										<label class="control-label col-md-3"><?=translate('class')?> <span class="required">*</span></label>
										<div class="col-md-6">

											<?php
												$arrayClass = $this->app_lib->getClass($data['branch_id']);
												echo form_dropdown("class_id", $arrayClass, $data['class_id'], "class='form-control' id='class_id' onchange='getSubjectByClass(this.value)'
												data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
											?>
											<span class="error"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group" id="sub_div" <?php if($data['class_id'] == 'unfiltered') { ?> style="display: none" <?php } ?>>
								<div class="col-md-offset-3">
									<div class="ml-md checkbox-replace">
										<label class="i-checks"><input type="checkbox" name="subject_wise" id="subject_wise" <?=($data['subject_id'] == 'unfiltered' ? 'checked' : '');?>><i></i> Not According Subject</label>
									</div>
								</div>
								<div id="subject_div" <?php if($data['subject_id'] == 'unfiltered') { ?> style="display: none" <?php } ?>>
									<div class="mt-sm">
										<label class="control-label col-md-3"><?=translate('subject')?> <span class="required">*</span></label>
										<div class="col-md-6">
											<?php
												if(!empty($data['class_id'])){
													$arraySubject = array("" => translate('select'));
													$assigns = $this->db->select('subject_id')->where('class_id', $data['class_id'])->get('subject_assign')->result();
													foreach ($assigns as $assign){
														$arraySubject[$assign->subject_id] = get_type_name_by_id('subject', $assign->subject_id);
													}
												}else{
													$arraySubject = array("" => translate('select_class_first'));
												}
												echo form_dropdown("subject_id", $arraySubject, $data['subject_id'], "class='form-control' id='subject_id'
												data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
											?>
											<span class="error"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3"><?=translate('publish_date')?> <span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="date" value="<?=$data['date']?>" data-plugin-datepicker />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-md-3 control-label"><?=translate('remarks')?></label>
								<div class="col-md-6">
									<textarea type="text" rows="2" class="form-control" name="remarks" ><?=$data['remarks']?></textarea>
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