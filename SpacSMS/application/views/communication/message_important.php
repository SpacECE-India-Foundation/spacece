<section class="panel">
	<header class="panel-heading">
		<div class="panel-btn">
			<a class="btn btn-default btn-circle icon" data-toggle="tooltip" data-original-title="<?=translate('refresh_mail')?>" 
			href="<?=base_url('communication/mailbox/important')?>">
				<i class="fas fa-sync"></i>
			</a>
		</div>
		<h4 class="panel-title">
			<i class="far fa-bell"></i> <?=translate('important')?>
		</h4>
	</header>
	<div class="panel-body">
		<table class="table text-dark table-hover table-condensed mb-none table-export">
			<thead>
				<tr>
					<th>#</th>
					<th><?=translate('type')?></th>
					<th><?=translate('sender').' / '.translate('receiver')?></th>
					<th><?=translate('subjects')?></th>
					<th><?=translate('message')?></th>
					<th><?=translate('time')?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$type 	= "";
					$count 	= 1;


					$sql = "SELECT * FROM message WHERE (sender = " . $this->db->escape($active_user) . " AND fav_sent = 1 AND trash_sent = 0) OR (reciever = " .
					$this->db->escape($active_user) . " AND fav_inbox = 1 AND trash_inbox = 0) ORDER BY id DESC";
					$messages = $this->db->query($sql)->result();


					foreach ($messages as $message):
						// defining the user to show
						if ($message->sender == $active_user){
							$type = 'inbox';
							$getUser = explode('-', $message->reciever);
						}
						if ($message->reciever == $active_user){
							$type = 'sent';
							$getUser = explode('-', $message->sender);
						}
						$userRoleID = $getUser[0];
						$userID = $getUser[1];
				?>
				<tr>
					<td><?php echo $count++;?></td>
					<td><?php echo ($type == 'inbox' ? '<i class="far fa-envelope"></i>' : '<i class="fas fa-share-square"></i>');?></td>
					<td width="20%"><?php echo $this->application_model->getUserNameByRoleID($userRoleID, $userID)['name']; ?></td>
					<td><a href="<?php echo base_url('communication/mailbox/read?type='.$type.'&id='.$message->id); ?>" class="text-dark mail-subj"><?php echo $message->subject; ?></a></td>
					<td>
					<?php
						$body = strip_tags($message->body);
						echo strlen($body) > 60 ? substr($body, 0, 60)."..." : $body;
					?>
					</td>
					<td><?php echo get_nicetime(html_escape($message->created_at));?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</section>
