<div class="row">
	<div class="col-md-3">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-md-9">
		<section class="panel">
			<div class="tabs-custom">
				<ul class="nav nav-tabs">
					<li>
						<a href="<?=base_url('school_settings/emailconfig'. $url)?>"><i class="far fa-envelope"></i> <?=translate('email_config')?></a>
					</li>
					<li class="active">
						<a href="#email_triggers" data-toggle="tab"><i class="fas fa-sitemap"></i> <?=translate('email_triggers')?></a>
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
									$getRow = $this->db->get('email_templates_details')->row_array();
									?>	
								<div class="panel panel-accordion">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?=$template['id']?>">
												<i class="fas fa-at"></i> <?=translate($template['name'])?>
											</a>
										</h4>
									</div>
									<div id="<?=$template['id']?>" class="accordion-body collapse">
											<?php echo form_open('school_settings/emailTemplateSave' . $url, array('class' => 'frm-submit-msg')); ?>
											<input type="hidden" name="branch_id" value="<?=$branch_id?>">
											<input type="hidden" name="template_id" value="<?=$template['id']?>">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<div class="checkbox-replace">
																<label class="i-checks">
																	<input type="checkbox" name="notify_enable" id="notify_enable" <?=($getRow['notified'] == 1 ? 'checked' : '');?>>
																	<i></i> <?=translate('notify_enable')?>
																</label>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label"><?=translate('subject')?> <span class="required">*</span></label>
															<input class="form-control" value="<?=$getRow['subject']?>" name="subject" type="text">
															<span class="error"></span>
														</div>
														<div class="form-group">
															<label class=" control-label"><?=translate('body')?></label>
															<textarea name="template_body" class="summernote"><?=$getRow['template_body']?></textarea>
															<span class="error"></span>
														</div>
														<div class="md">
															<strong>Codes : </strong><?=html_escape($template['tags'])?>
														</div>
													</div>
												</div>
											</div>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-offset-10 col-md-2">
														<button type="submit" name="submit" value="update" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
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