<div class="row">
	<div class="col-md-3">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-md-9">
		<section class="panel">
			<div class="tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#email_config" data-toggle="tab"><i class="far fa-envelope"></i> <?=translate('email_config')?></a>
					</li>
					<li>
						<a href="<?=base_url('school_settings/emailtemplate' . $url)?>"><i class="fas fa-sitemap"></i> <?=translate('email_triggers')?></a>
					</li>
				</ul>
				<div class="tab-content">
					<div id="email_config" class="tab-pane active">
						<?php echo form_open('school_settings/saveEmailConfig' . $url, array('class' => 'form-horizontal form-bordered frm-submit-msg')); ?>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('system_email')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<input class="form-control" value="<?=$config['email']?>" name="email" 
								type="email" placeholder="All Outgoing Email Will be sent from This Email Address.">
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Email Protocol</label>
							<div class="col-md-6">
								<?php
								$array = array(
									"mail" => "PHP Mail",
									"smtp" => "SMTP Mail"
								);
								echo form_dropdown("protocol", $array, $config['protocol'], "class='form-control' data-plugin-selectTwo id='emailProtocol'
								data-width='100%' data-minimum-results-for-search='Infinity' ");
								?>
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">SMTP Host <span class="required">*</span></label>
							<div class="col-md-6">
								<input class="form-control smtp" value="<?=$config['smtp_host']?>" name="smtp_host" type="text" />
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">SMTP Username <span class="required">*</span></label>
							<div class="col-md-6">
								<input class="form-control smtp" value="<?=$config['smtp_user']?>" name="smtp_user" type="text" />
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							 <label class="col-md-3 control-label">SMTP Password <span class="required">*</span></label>
							<div class="col-md-6">
								<input name="smtp_pass" value="<?=$config['smtp_pass']?>" class="form-control smtp" type="password" />
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">SMTP Port <span class="required">*</span></label>
							<div class="col-md-6">
								<input class="form-control smtp" value="<?=$config['smtp_port']?>" name="smtp_port" type="text" />
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group m">
							<label class="col-md-3 control-label">Email Encryption</label>
							<div class="col-md-6 mb-md">
								<?php
								$array = array(
									"" 		=> "No",
									"tls" 	=> "TLS",
									"ssl" 	=> "SSL"
								);
								echo form_dropdown("smtp_encryption", $array, $config['smtp_encryption'], "class='form-control smtp' data-plugin-selectTwo data-width='100%'
								data-minimum-results-for-search='Infinity' ");
								?>
								<span class="error"></span>
							</div>
						</div>
					
						<footer class="panel-footer">
							<div class="row">
								<div class="col-md-2 col-sm-offset-3">
									<button type="submit" class="btn btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
										<i class="fas fa-plus-circle"></i> <?=translate('save')?>
									</button>
								</div>
							</div>
						</footer>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		var protocol = "<?=$config['protocol']?>"
		if (protocol !== "smtp") {
			$(".smtp").prop('disabled', true);
		}
		
		$('#emailProtocol').on('change', function(){
			var mode = $(this).val();
			if(mode == 'smtp'){
				$(".smtp").prop('disabled', false);
			} else {
				$(".smtp").prop('disabled', true);
			}
		});
	});
</script>