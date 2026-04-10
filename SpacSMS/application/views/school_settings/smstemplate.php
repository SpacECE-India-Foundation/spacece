<div class="row">
	<div class="col-md-3">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-md-9">
		<section class="panel">
			<div class="tabs-custom">
				<ul class="nav nav-tabs">
					<li>
						<a href="<?=base_url('school_settings/smsconfig' . $url)?>"><i class="far fa-envelope"></i> <?=translate('sms_config')?></a>
					</li>
					<li class="active">
						<a href="#email_triggers" data-toggle="tab"><i class="fas fa-sitemap"></i> <?=translate('sms_triggers')?></a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="email_triggers">
						<div class="panel-group" id="accordion">
							<?php
							if (count($templatelist)){
								foreach ($templatelist as $template):
									$this->db->where('branch_id', $branch_id);
									$this->db->where('template_id', $template['id']);
									$getRow = $this->db->get('sms_template_details')->row_array();
									?>		
								<div class="panel panel-accordion">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?=$template['name']?>">
												<i class="far fa-comments"></i> <?=translate($template['name'])?>
											</a>
										</h4>
									</div>
									<div id="<?=$template['name']?>" class="accordion-body collapse">
											<?php echo form_open('school_settings/smsTemplateeSave' . $url, array('class' => 'frm-submit-msg')); ?>
											<input type="hidden" name="template_id" value="<?=$template['id']?>">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label class=" control-label"><?=translate('notify_enable')?></label>
															<div class="checkbox-replace">
																<label class="i-checks">
																	<input type="checkbox" name="notify_student" id="notify_student" <?=($getRow['notify_student'] == 1 ? 'checked' : '');?>>
																	<i></i> <?=translate('student')?>
																</label>
															</div>
															<div class="checkbox-replace mt-xs">
																<label class="i-checks">
																	<input type="checkbox" name="notify_parent" id="notify_parent" <?=($getRow['notify_parent'] == 1 ? 'checked' : '');?>>
																	<i></i> <?=translate('parent')?>
																</label>
															</div>
														</div>
														<div class="form-group">
															<label class=" control-label"><?=translate('body')?></label>
															<textarea class="form-control message-text" name="template_body" rows="3" id="txt_<?=$getRow['id']?>"><?=$getRow['template_body']?></textarea>
															<span class="error"></span>
															<span class="help-block txtcount pull-right">You typed <?=strlen($getRow['template_body'])?> characters.</span>
														</div>
														<div class="md">
															<strong>Codes : </strong><?=$template['tags']?>
														</div>
													</div>
												</div>
											</div>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-offset-10 col-md-2">
														<button type="submit" name="save" value="1" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
															<i class="fas fa-plus-circle"></i> <?=translate('save')?>
														</button>
													</div>
												</div>
											</div>
										<?php echo form_close();?>
									</div>
								</div>			
							<?php
								endforeach;
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$(document).on('keyup', '.message-text', function() {
			var id = $(this).data('id');
			var text_length = $(this).val().length;
			$(this).parents('.form-group').find('.txtcount').html('You typed ' + text_length + ' characters.');
		});
	});
</script>