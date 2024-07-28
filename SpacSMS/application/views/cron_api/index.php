<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title">Secret Key</h4>
			</header>
			<?php echo form_open($this->uri->uri_string());?>
			<div class="panel-body">
				<div class="alert alert-subl mb-xs"><?=$global_config['cron_secret_key']?></div>
			</div>
		<?php if (get_permission('cron_job', 'is_edit')) { ?>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-2">
						<button type="submit" name="search" value="1" class="btn btn btn-default btn-block"><i class="fas fa-fingerprint"></i> Re-generate API Key</button>
					</div>
				</div>
			</footer>
		<?php } ?>
			<?php echo form_close();?>
		</section>
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="far fa-clock"></i> Scheduled Email/SMS Cron Job Command [once per minute or higher]</h4>
			</header>
			<div class="panel-body">
				<div class="alert alert-subl"><?php echo "curl ".site_url("cron_api/send_smsemail_command")."/".$global_config['cron_secret_key']; ?></div>
			</div>
		</section>
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="far fa-clock"></i> Scheduled Homework Cron Job Command</h4>
			</header>
			<div class="panel-body">
				<div class="alert alert-subl"><?php echo "curl ".site_url("cron_api/homework_command")."/".$global_config['cron_secret_key']; ?></div>
			</div>
		</section>
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="far fa-clock"></i> Fees Reminder Cron Job Command</h4>
			</header>
			<div class="panel-body">
				<div class="alert alert-subl"><?php echo "curl ".site_url("cron_api/fees_reminder_command")."/".$global_config['cron_secret_key']; ?></div>
			</div>
		</section>
	</div>
</div>