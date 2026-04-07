<div class="row">
	<div class="col-md-3">
        <?php include 'sidebar.php'; ?>
    </div>
	<div class="col-md-7">
		<section class="panel">
			<div class="tabs-custom">
				<ul class="nav nav-tabs">
					<li  class="active">
						<a href="#paypal" data-toggle="tab">Paypal Config</a>
					</li>
					<li>
						<a href="#stripe" data-toggle="tab">Stripe Config</a>
					</li>
					<li>
						<a href="#payumoney" data-toggle="tab">PayUmoney Config</a>
					</li>
					<li>
						<a href="#paystack" data-toggle="tab">Paystack</a>
					</li>
					<li>
						<a href="#razorpay" data-toggle="tab">Razorpay</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane box active" id="paypal">
						<?php echo form_open('settings/paypal_save', array('class' => 'form-horizontal frm-submit-msg'));?>
						<input type="hidden" name="branch_id" value="<?=$branch_id?>">
							<div class="form-group">
								<label  class="col-sm-3 control-label">Paypal Username </label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="paypal_username" value="<?=$config['paypal_username']?>">
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-3 control-label">Paypal Password</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="paypal_password" value="<?=$config['paypal_password']?>">
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-3 control-label">Paypal Signature</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="paypal_signature" value="<?=$config['paypal_signature']?>">
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-3 control-label">Paypal Email</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="paypal_email" value="<?=$config['paypal_email']?>">
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-offset-3 col-md-6 mb-md">
									<div class="checkbox-replace">
										<label class="i-checks">
											<input type="checkbox" name="paypal_sandbox" id="paypal_sandbox" <?=($config['paypal_sandbox'] == 1 ? 'checked' : ''); ?>>
											<i></i> Paypal Sandbox
										</label>
									</div>
								</div>
							</div>
							<footer class="panel-footer">
								<div class="row">
									<div class="col-md-3 col-sm-offset-3">
										<button type="submit" class="btn btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
											<i class="fas fa-plus-circle"></i> <?=translate('save');?>
										</button>
									</div>
								</div>
							</footer>
						<?php echo form_close();?>
					</div>
					<div class="tab-pane box" id="stripe">
						<?php echo form_open('settings/stripe_save', array('class' => 'form-horizontal frm-submit-msg'));?>
							<input type="hidden" name="branch_id" value="<?=$branch_id?>">
							<div class="form-group">
							  <label  class="col-sm-3 control-label">Stripe Secret Key</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="stripe_secret" value="<?=$config['stripe_secret']?>">
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-offset-3 col-md-6 mb-md">
									<div class="checkbox-replace">
										<label class="i-checks">
											<input type="checkbox" name="stripe_demo" id="stripe_demo" <?=($config['stripe_demo'] == 1 ? 'checked' : ''); ?>>
											<i></i> Stripe Demo
										</label>
									</div>
								</div>
							</div>
							<footer class="panel-footer">
								<div class="row">
									<div class="col-md-3 col-sm-offset-3">
										<button type="submit" class="btn btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
											<i class="fas fa-plus-circle"></i> <?=translate('save');?>
										</button>
									</div>
								</div>
							</footer>
						<?php echo form_close();?>
					</div>
					<div class="tab-pane box" id="payumoney">
						<?php echo form_open('settings/payumoney_save', array('class' => 'form-horizontal frm-submit-msg'));?>
							<input type="hidden" name="branch_id" value="<?=$branch_id?>">
							<div class="form-group">
							  <label  class="col-sm-3 control-label">Payumoney Key</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="payumoney_key" value="<?=$config['payumoney_key']?>">
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-3 control-label">Payumoney Salt</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="payumoney_salt" value="<?=$config['payumoney_salt']?>">
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-offset-3 col-md-6 mb-md">
									<div class="checkbox-replace">
										<label class="i-checks">
											<input type="checkbox" name="payumoney_demo" id="payumoney_demo" <?=($config['payumoney_demo'] == 1 ? 'checked' : ''); ?>>
											<i></i> Payumoney Demo
										</label>
									</div>
								</div>
							</div>
							<footer class="panel-footer">
								<div class="row">
									<div class="col-md-3 col-sm-offset-3">
										<button type="submit" class="btn btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
											<i class="fas fa-plus-circle"></i> <?=translate('save');?>
										</button>
									</div>
								</div>
							</footer>
						<?php echo form_close();?>
					</div>
					<div class="tab-pane box" id="paystack">
						<?php echo form_open('settings/paystack_save', array('class' => 'form-horizontal frm-submit-msg'));?>
							<input type="hidden" name="branch_id" value="<?=$branch_id?>">
							<div class="form-group">
								<label  class="col-sm-3 control-label">Paystack API Key</label>
								<div class="col-md-6 mb-md">
									<input type="text" class="form-control" name="paystack_secret_key" value="<?=$config['paystack_secret_key']?>">
									<span class="error"></span>
								</div>
							</div>
							<footer class="panel-footer">
								<div class="row">
									<div class="col-md-3 col-sm-offset-3">
										<button type="submit" class="btn btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
											<i class="fas fa-plus-circle"></i> <?=translate('save');?>
										</button>
									</div>
								</div>
							</footer>
						<?php echo form_close();?>
					</div>
					<div class="tab-pane box" id="razorpay">
						<?php echo form_open('settings/razorpay_save', array('class' => 'form-horizontal frm-submit-msg'));?>
							<input type="hidden" name="branch_id" value="<?=$branch_id?>">
							<div class="form-group">
								<label  class="col-sm-3 control-label">Key Id</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="razorpay_key_id" value="<?=$config['razorpay_key_id']?>">
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-3 control-label">Key Secret</label>
								<div class="col-md-6 mb-md">
									<input type="text" class="form-control" name="razorpay_key_secret" value="<?=$config['razorpay_key_secret']?>">
									<span class="error"></span>
								</div>
							</div>
							<footer class="panel-footer">
								<div class="row">
									<div class="col-md-3 col-sm-offset-3">
										<button type="submit" class="btn btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
											<i class="fas fa-plus-circle"></i> <?=translate('save');?>
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
	<div class="col-md-2">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="far fa-credit-card"></i> Active Gateway</h4>
			</header>
			<?php echo form_open('settings/payment_active', array('class' => 'form-horizontal frm-submit-msg')); ?>
			<input type="hidden" name="branch_id" value="<?=$branch_id?>">
			<div class="panel-body">
				<div class="form-group">
					<div class="col-md-12">
						<div class="checkbox-replace">
							<label class="i-checks">
								<input type="checkbox" name="paypal_status" id="paypal_status" <?=($config['paypal_status'] == 1 ? 'checked' : ''); ?>>
								<i></i> Paypal
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<div class="checkbox-replace">
							<label class="i-checks">
								<input type="checkbox" name="stripe_status" id="stripe_status" <?=($config['stripe_status'] == 1 ? 'checked' : ''); ?>>
								<i></i> Stripe
							</label>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<div class="checkbox-replace">
							<label class="i-checks">
								<input type="checkbox" name="payumoney_status" id="payumoney_status" <?=($config['payumoney_status'] == 1 ? 'checked' : ''); ?>>
								<i></i> PayUmoney
							</label>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<div class="checkbox-replace">
							<label class="i-checks">
								<input type="checkbox" name="paystack_status" id="paystack_status" <?=($config['paystack_status'] == 1 ? 'checked' : ''); ?>>
								<i></i> Paystack
							</label>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<div class="checkbox-replace">
							<label class="i-checks">
								<input type="checkbox" name="razorpay_status" id="razorpay_status" <?=($config['razorpay_status'] == 1 ? 'checked' : ''); ?>>
								<i></i> Razorpay
							</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<button type="submit" class="btn btn btn-default" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
					<?=translate('save')?>
				</button>
			</footer>
			<?php echo form_close();?>
		</section>
	</div>
</div>
