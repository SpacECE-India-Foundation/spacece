<section class="panel">
	<header class="panel-heading">
		<div class="panel-btn">
			<a class="btn btn-default btn-circle icon" data-toggle="tooltip" data-original-title="<?=translate('refresh_mail')?>" 
			href="<?=base_url('communication/mailbox/inbox')?>">
				<i class="fas fa-sync"></i>
			</a>
			<button class="btn btn-circle btn-danger icon" id="msgAction" data-type="delete"><i class="far fa-trash-alt"></i></button>
		</div>
		<h4 class="panel-title">
			<i class="far fa-envelope"></i> <?=translate('inbox')?>
		</h4>
	</header>
	<div class="panel-body">
		<table class="table text-dark table-hover table-condensed mb-none table-export">
			<thead>
				<tr>
					<th>
						<div class="checkbox-replace">
							<label class="i-checks"><input type="checkbox" id="selectAllchkbox"><i></i></label>
						</div>
					</th>
					<th><?=translate('sender')?></th>
					<th><?=translate('subjects')?></th>
					<th><?=translate('message')?></th>
					<th><?=translate('time')?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			$this->db->order_by('id', 'desc');
			$messages = $this->db->get_where('message', array('reciever' => $active_user, 'trash_inbox' => 0))->result();
			foreach ($messages as $message):
				$get_sender = explode('-', $message->sender);
				$senderRoleID = $get_sender[0];
				$senderUserID = $get_sender[1];
			?>
				<tr <?php if($message->read_status == 0) { ?> class="text-weight-bold" <?php } ?>>
					<td class="checked-area" width="30px">
						<div class="checkbox-replace">
							<label class="i-checks">
								<input type="checkbox" class="msg_checkbox" id="<?=$message->id?>"><i></i>
							</label>
						</div>
					</td>
					<td width="20%">
						<a data-id="<?=$message->id?>" href="javascript:void(0);" class="mailbox-fav"
						data-toggle="tooltip" data-original-title="Click to teach if this conversation is important"><i class="text-warning <?=($message->fav_inbox == 0 ? 'far fa-bell' : 'fas fa-bell')?>"></i></a><?='&nbsp;&nbsp;&nbsp;'.$this->application_model->getUserNameByRoleID($senderRoleID, $senderUserID)['name']?>
					</td>
					<td>
						<?php echo (!empty($message->file_name) ? '<i class="fas fa-paperclip"></i>' : ''); ?>
						<a href="<?=base_url('communication/mailbox/read?type=inbox&id='.$message->id)?>" class="text-dark mail-subj"><?php echo $message->subject ?></a>
					</td>
					<td>
						<?php
						$body = strip_tags($message->body);
						echo mb_strimwidth($body, 0, 60, "...");
						?>
					</td>
					<td><?php echo get_nicetime($message->created_at);?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</section>