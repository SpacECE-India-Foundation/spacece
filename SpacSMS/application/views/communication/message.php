<?php $active = html_escape($this->input->get('type'));?>
<div class="row">
	<div class="col-md-3">
		<div class="panel mailbox">
			<div class="panel-heading">
				<h3 class="panel-title">Mailbox Folder</h3>
			</div>
			<div class="panel-body">
				<a href="<?=base_url('communication/mailbox/compose')?>" class="btn btn-default btn-block mb-md"><i class="fas fa-envelope"></i> <?=translate('compose')?></a>
				
				<ul class="nav nav-pills nav-stacked">
					<li class="<?php if ($inside_subview == 'message_inbox' || $active == 'inbox') echo 'active'; ?>">
						<a href="<?=base_url('communication/mailbox/inbox')?>">
							<i class="far fa-envelope"></i>
							<?=translate('inbox')?> <span class="label text-weight-normal pull-right"><?=$this->application_model->count_unread_message()?></span>
						</a>
					</li>
					<li class="<?php if ($inside_subview == 'message_sent' || $active == 'sent') echo 'active'; ?>">
						<a href="<?=base_url('communication/mailbox/sent')?>"> <i class="fas fa-share-square"></i>
							<?=translate('sent')?> <span class="label text-weight-normal pull-right"><?=$this->application_model->reply_count_unread_message()?></span>
						</a>
					</li>
					<li class="<?php if ($inside_subview == 'message_important') echo 'active'; ?>">
						<a href="<?=base_url('communication/mailbox/important')?>"> <i class="far fa-bell text-yellow"></i>
							<?=translate('important')?>
						</a>
					</li>
					<li class="<?php if ($inside_subview == 'message_trash') echo 'active'; ?>">
						<a href="<?=base_url('communication/mailbox/trash')?>"> 
							<i class="far fa-trash-alt"></i> <?=translate('trash')?>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<?php $this->load->view('communication/'. $inside_subview . '.php') ?>
	</div>
</div>