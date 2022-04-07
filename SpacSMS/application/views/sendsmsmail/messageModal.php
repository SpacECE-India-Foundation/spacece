<tbody>
<?php if ($bulkdata['message_type'] == 2): ?>
	<tr>
		<td class="min-w-c"><?=translate('email') . " " . translate('subject')?></td>
		<td><?=$bulkdata['email_subject'];?></td>
	</tr>
<?php endif; ?>
	<tr>
		<td class="min-w-c"><?=translate('recipients_type')?></td>
		<td><?php
	        $array = array(
	            '1' => translate('group'), 
	            '2' => translate('individual'), 
	            '3' => translate('class'), 
	        );
	        echo $array[$bulkdata['recipient_type']]; 
	    ?></td>
	</tr>
<?php if ($bulkdata['recipient_type'] != 2): ?>
	<tr>
		<td><?=translate('recipients') . " " . translate('list')?></td>
		<td><?php
		if ($bulkdata['recipient_type'] == 1) {
			$list = json_decode($bulkdata['recipients_details'], true);
			foreach ($list['role'] as $key => $value) {
				echo get_type_name_by_id('roles', $value) . '<br>';
			}
		}
		if ($bulkdata['recipient_type'] == 3) {
			$list = json_decode($bulkdata['recipients_details'], true);
			echo get_type_name_by_id('class', $list['class']) . ' </br><small>';
			foreach ($list['sections'] as $key => $value) {
				echo ' -' . get_type_name_by_id('section', $value) . '</br>';
			}
			echo "</small>";
		}
	    ?></td>
	</tr>
<?php endif; ?>
	<tr>
		<td><?=translate('message')?></td>
		<td><?=$bulkdata['message'];?></td>
	</tr>
</tbody>