<div class="row">
	<div class="col-md-3">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-md-9">
		<section class="panel">
			<div class="tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#sms_config" data-toggle="tab"><i class="far fa-envelope"></i> <?=translate('sms_config')?></a>
					</li>
					<li>
						<a href="<?=base_url('school_settings/smstemplate' . $url)?>"><i class="fas fa-sitemap"></i> <?=translate('sms_triggers')?></a>
					</li>
				</ul>
				<div class="tab-content">
					<div id="sms_config" class="tab-pane active">
						<section class="panel panel-custom">
							<div class="panel-heading panel-heading-custom">
								<h4 class="panel-title"><i class="fas fa-sms"></i> SMS Gateway</h4>
							</div>
							<?php echo form_open('school_settings/sms_active' . $url, array( 'class' => 'frm-submit-msg')); ?>
							<input type="hidden" name="branch_id" value="<?=$branch_id?>">
							<div class="panel-body panel-body-custom">
								<div class="row">
									<div class="col-md-offset-3 col-md-6 mb-sm">
										<label class="control-label"><?=translate('activated_sms_gateway')?> <span class="required">*</span></label>
											<?php
												$sms_service_provider = $this->application_model->smsServiceProvider($branch_id);
												$arraySMS = array(
													"disabled" 	=> translate('disabled'),
													"1" 		=> "Twilio",
													"2" 		=> "Clickatell",
													"3" 		=> "Msg91",
													"4" 		=> "Bulk",
													"5" 		=> "Textlocal",
												);
												echo form_dropdown("sms_service_provider", $arraySMS, set_value('sms_service', $sms_service_provider), "class='form-control'
												data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
											?>
										<span class="error"></span>
									</div>
								</div>
							</div>
							<footer class="panel-footer panel-footer-custom">
								<div class="row">
									<div class="col-md-offset-3 col-md-2">
								        <button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
								            <i class="fas fa-plus-circle"></i> <?=translate('save')?>
								        </button>
									</div>
								</div>
							</footer>
							<?php echo form_close();?>
						</section>

						<div class="panel-group" id="accordion">
							<div class="panel panel-accordion">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#twilio">Twilio Gateway</a>
									</h4>
								</div>
								<div id="twilio" class="accordion-body collapse">
									<?php echo form_open('smsconfig/twilio' . $url, array( 'class' => 'form-horizontal form-bordered frm-submit-msg')); ?>
									<input type="hidden" name="branch_id" value="<?=$branch_id?>">
									<div class="panel-body">
										<div class="form-group mt-md">
										  <label class="col-md-3 control-label"><?=translate('account_sid')?> <span class="required">*</span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="twilio_sid" value="<?=$api['twilio']['field_one']?>">
												<span class="error"></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label"><?=translate('authentication_token')?> <span class="required">*</span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="twilio_auth_token" value="<?=$api['twilio']['field_two']?>">
												<span class="error"></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label"><?=translate('sender_number')?> <span class="required">*</span></label>
											<div class="col-md-6 mb-md">
												<input type="text" class="form-control" name="sender_number" value="<?=$api['twilio']['field_three']?>">
												<span class="error"></span>
											</div>
										</div>
									</div>
									<div class="panel-footer">
										<div class="row">
											<div class="col-md-offset-3 col-md-2">
												<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
													<i class="fas fa-plus-circle"></i> <?=translate('save')?>
												</button>
											</div>
										</div>
									</div>
									<?php echo form_close();?>
								</div>
							</div>
							<div class="panel panel-accordion">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#clickatell">Clickatell Gateway</a>
									</h4>
								</div>
								<div id="clickatell" class="accordion-body collapse">
									<?php echo form_open('smsconfig/clickatell' . $url, array('class' => 'form-horizontal form-bordered frm-submit-msg')); ?>
									<input type="hidden" name="branch_id" value="<?=$branch_id?>">
									<div class="panel-body">
										<div class="form-group mt-md">
										  <label class="col-md-3 control-label"><?=translate('username')?> <span class="required">*</span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="clickatell_user" value="<?=$api['clickatell']['field_one']?>">
												<span class="error"></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label"><?=translate('password')?> <span class="required">*</span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="clickatell_password" value="<?=$api['clickatell']['field_two']?>">
												<span class="error"></span>
											</div>
										</div>
										<div class="form-group">
										  <label class="col-md-3 control-label"><?=translate('api_key')?> <span class="required">*</span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="clickatell_api" value="<?=$api['clickatell']['field_three']?>">
												<span class="error"></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label"><?=translate('sender_number')?> <span class="required">*</span></label>
											<div class="col-md-6 mb-md">
												<input type="text" class="form-control" name="sender_number" value="<?=$api['clickatell']['field_four']?>">
												<span class="error"></span>
											</div>
										</div>
									</div>
									<div class="panel-footer">
										<div class="row">
											<div class="col-md-offset-3 col-md-2">
												<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
													<i class="fas fa-plus-circle"></i> <?=translate('save')?>
												</button>
											</div>
										</div>
									</div>
									<?php echo form_close();?>
								</div>
							</div>

							<div class="panel panel-accordion">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#msg91">MSG91 Gateway</a>
									</h4>
								</div>
								<div id="msg91" class="accordion-body collapse">
									<?php echo form_open('smsconfig/msg91' . $url, array('class' => 'form-horizontal form-bordered frm-submit-msg')); ?>
									<input type="hidden" name="branch_id" value="<?=$branch_id?>">
									<div class="panel-body">
										<div class="form-group mt-md">
											<label class="col-md-3 control-label"><?=translate('authkey')?> <span class="required">*</span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="msg91_auth_key" value="<?=$api['msg91']['field_one']?>">
												<span class="error"></span>
											</div>
										</div>
										<div class="form-group">
										  <label  class="col-md-3 control-label"><?=translate('sender_id')?> <span class="required">*</span></label>
											<div class="col-md-6 mb-md">
												<input type="text" class="form-control" name="sender_id" value="<?=$api['msg91']['field_two']?>">
												<span class="error"></span>
											</div>
										</div>
									</div>
									<div class="panel-footer">
										<div class="row">
											<div class="col-md-offset-3 col-md-2">
												<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
													<i class="fas fa-plus-circle"></i> <?=translate('save')?>
												</button>
											</div>
										</div>
									</div>
									<?php echo form_close();?>
								</div>
							</div>

							<div class="panel panel-accordion">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#bulk">Bulk Gateway</a>
									</h4>
								</div>
								<div id="bulk" class="accordion-body collapse">
									<?php echo form_open('smsconfig/bulksms' . $url, array( 'class' => 'form-horizontal form-bordered frm-submit-msg')); ?>
									<input type="hidden" name="branch_id" value="<?=$branch_id?>">
									<div class="panel-body">
										<div class="form-group mt-md">
										  <label  class="col-md-3 control-label"><?=translate('username')?> <span class="required">*</span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="bulk_sms_username" value="<?=$api['bulksms']['field_one']?>">
												<span class="error"></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label"><?=translate('password')?> <span class="required">*</span></label>
											<div class="col-md-6 mb-md">
												<input type="text" class="form-control" name="bulk_sms_password" value="<?=$api['bulksms']['field_two']?>">
												<span class="error"></span>
											</div>
										</div>
									</div>
									<div class="panel-footer">
										<div class="row">
											<div class="col-md-offset-3 col-md-2">
												<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
													<i class="fas fa-plus-circle"></i> <?=translate('save')?>
												</button>
											</div>
										</div>
									</div>
									<?php echo form_close();?>
								</div>
							</div>
							<div class="panel panel-accordion">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#txtlocal">Text Local Gateway</a>
									</h4>
								</div>
								<div id="txtlocal" class="accordion-body collapse">
									<?php echo form_open('smsconfig/textlocal' . $url, array('class' => 'form-horizontal form-bordered frm-submit-msg')); ?>
									<input type="hidden" name="branch_id" value="<?=$branch_id?>">
									<div class="panel-body">
										<div class="form-group mt-md">
										  <label  class="col-md-3 control-label"><?=translate('username')?> <span class="required">*</span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="textlocal_username" value="<?=$api['textlocal']['field_one']?>">
												<span class="error"></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label"><?=translate('sender_name')?> <span class="required">*</span></label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="textlocal_sender_id" value="<?=$api['textlocal']['field_two']?>">
												<span class="error"></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label"><?=translate('hash_key')?> <span class="required">*</span></label>
											<div class="col-md-6 mb-md">
												<input type="text" class="form-control" name="textlocal_hash_key" value="<?=$api['textlocal']['field_three']?>">
												<span class="error"></span>
											</div>
										</div>
									</div>
									<div class="panel-footer">
										<div class="row">
											<div class="col-md-offset-3 col-md-2">
												<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
													<i class="fas fa-plus-circle"></i> <?=translate('save')?>
												</button>
											</div>
										</div>
									</div>
									<?php echo form_close();?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
