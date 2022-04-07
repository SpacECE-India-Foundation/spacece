<?php $currency_symbol = $global_config['currency_symbol']; ?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-list-ol"></i> <?php echo translate('transactions'); ?></h4>
			</header>
			<div class="panel-body">
				<div class="export_title">All Transactions</div>
				<table class="table table-bordered table-hover table-condensed table-export" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="50"><?php echo translate('sl'); ?></th>
						<?php if (is_superadmin_loggedin()): ?>
							<th><?=translate('branch')?></th>
						<?php endif; ?>
							<th><?php echo translate('account') . " " . translate('name'); ?></th>
							<th><?php echo translate('type'); ?></th>
							<th><?php echo translate('voucher') . " " . translate('head'); ?></th>
							<th><?php echo translate('ref_no'); ?></th>
							<th><?php echo translate('description'); ?></th>
							<th><?php echo translate('pay_via'); ?></th>
							<th><?php echo translate('amount'); ?></th>
							<th><?php echo translate('dr'); ?></th>
							<th><?php echo translate('cr'); ?></th>
							<th><?php echo translate('balance'); ?></th>
							<th><?php echo translate('date'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $count = 1; foreach ($voucherlist as $row): ?>
						<tr>
							<td><?php echo $count++; ?></td>
						<?php if (is_superadmin_loggedin()): ?>
							<td><?php echo get_type_name_by_id('branch', $row['branch_id']);?></td>
						<?php endif; ?>
							<td><?php echo (!empty($row['attachments']) ? '<i class="fas fa-paperclip"></i> ' : ''); ?> <?php echo html_escape($row['ac_name']); ?></td>
							<td><?php echo ucfirst($row['type']); ?></td>
							<td><?php echo $row['v_head']; ?></td>
							<td><?php echo $row['ref']; ?></td>
							<td><?php echo $row['description']; ?></td>
							<td><?php echo $row['via_name']; ?></td>
							<td><?php echo $currency_symbol . $row['amount']; ?></td>
							<td><?php echo $currency_symbol . $row['dr']; ?></td>
							<td><?php echo $currency_symbol . $row['cr']; ?></td>
							<td><?php echo $currency_symbol . $row['bal']; ?></td>
							<td><?php echo _d($row['date']); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</section>
	</div>
</div>