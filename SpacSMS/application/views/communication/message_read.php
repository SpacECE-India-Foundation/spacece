<?php
$message 		= $this->communication_model->getSingle('message', $message_id, true);
$getSender 		= explode('-', $message->sender);
$senderRoleID 	= $getSender[0];
$senderUserID 	= $getSender[1];
$getReciever 	= explode('-', $message->reciever);
$recieverRoleID = $getReciever[0];
$recieverUserID = $getReciever[1];
if ($message->sender == $active_user) {
	$status = $message->fav_sent;
}
if ($message->reciever == $active_user) {
	$status = $message->fav_inbox;
}
?>
<div class="panel mb-lg">
	<div class="panel-body">
		<h3 class="m-none text-weight-light">
			<?php echo $message->subject; ?>
			<a data-id="<?=$message_id?>" href="javascript:;" class="mailbox-fav" data-toggle="tooltip" data-original-title="Click to teach if this conversation is important">
				<i class="text-warning <?=($status == 0 ? 'far fa-bell' : 'fas fa-bell');?>"></i>
			</a>
		</h3>
		<p class="mt-lg mb-none text-md">
			<?php 
			echo 'From <strong class="text-dark">'.$this->application_model->getUserNameByRoleID($senderRoleID, $senderUserID)['name'].'</strong> To ';
			echo 'From <strong class="text-dark">'.$this->application_model->getUserNameByRoleID($recieverRoleID, $recieverUserID)['name'].'</strong> , Started On ';
			echo 'From <span class="text-dark">'.date("d/M/Y", strtotime($message->created_at)). '</span>';
			?>
		</p>
	</div>
</div>

<div class="panel">
	<div class="panel-heading">
		<h4 class="panel-title">
			<?php echo $this->application_model->getUserNameByRoleID($senderRoleID, $senderUserID)['name']; ?>
		</h4>
	</div>
	<div class="panel-body">
		<p><?php echo $message->body; ?></p>
	<?php if (!empty($message->enc_name)): ?>
		<blockquote class="warning">
			<p><?=translate('attachment_file')?></p>
			<a href="<?=base_url('communication/download?type=mailbox&file='.$message->enc_name)?>" class="btn btn-default btn-sm"><i class="fas fa-paper-plane"></i><span> Download</span></a>
		</blockquote>
	<?php endif; ?>
	</div>
	<div class="panel-footer">
		<p class="m-none">
			<small>
				<?php echo date("d/M/Y - g:i A", strtotime($message->created_at));?>
			</small>
		</p>
	</div>
</div>

<?php
$repliesResult = $this->db->get_where('message_reply', array('message_id' => $message_id))->result();
$reply_status = $this->db->select('sender,reciever')->where('id', $message_id)->get('message')->row();
foreach ($repliesResult as $reply):
	if ($reply->identity == 1)
		$user_to_show = explode('-', $reply_status->sender);
	if ($reply->identity == 0)
		$user_to_show = explode('-', $reply_status->reciever);
	
	$senderRoleID = $user_to_show[0];
	$senderUserID = $user_to_show[1];
?>
<div class="panel">
	<div class="panel-heading">
		<h4 class="panel-title">
			<?php echo $this->application_model->getUserNameByRoleID($senderRoleID, $senderUserID)['name']; ?>
		</h4>
	</div>
	<div class="panel-body">
		<p><?php echo $reply->body;?></p>
<?php if (!empty($reply->enc_name)): ?>
		<blockquote class="warning">
			<p><?=translate('attachment_file')?></p>
			<a href="<?=base_url('communication/download?type=reply&file='.$reply->enc_name)?>" class="btn btn-default btn-sm"><i class="fas fa-paper-plane"></i><span> Download</span></a>
		</blockquote>
<?php endif; ?>
	</div>
	<div class="panel-footer">
		<p class="m-none">
			<small><?php echo date("d/M/Y - g:i A", strtotime($reply->created_at)); ?></small>
		</p>
	</div>
</div>
<?php endforeach; ?>

<div class="panel">
	<?php echo form_open_multipart('communication/message_reply', array('class' => 'frm-submit-data')); ?>
		<?php
		$user_identity = $reply_status->sender == $active_user ? 'sender' : 'reciever';
		$hiddenInput = array( 'user_identity' => $user_identity, 'message_id' => $message_id);
		echo form_hidden($hiddenInput);
		?>
		<div class="panel-heading br-none">
			<h4 class="panel-title"> 
				<i class="far fa-envelope mr-xs"></i> <?=translate('reply_message')?>
			</h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<div class="compose">
					<textarea name="message" class="form-control summernote" id="summernote" rows="10"></textarea>
					<span class="error"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label"><?=translate('attachment_file')?></label>
				<div class="col-md-12 row">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="input-append">
							<div class="uneditable-input">
								<i class="fas fa-file fileupload-exists"></i>
								<span class="fileupload-preview"></span>
							</div>
							<span class="btn btn-default btn-file">
								<span class="fileupload-exists">Change</span>
								<span class="fileupload-new">Select file</span>
								<input type="file" name="attachment_file" />
							</span>
							<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
						</div>
					</div>
					<span class="error"></span>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="col-md-offset-10 col-md-2">
					<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
						<i class="fas fa-paper-plane"></i><span> <?=translate('send')?></span>
					</button>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>