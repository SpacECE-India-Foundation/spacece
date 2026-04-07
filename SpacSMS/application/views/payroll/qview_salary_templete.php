<?php $currency_symbol = html_escape($global_config['currency_symbol']); ?>
<div class="row">
	<div class="col-md-8 col-md-offset-2 mt-md">
		<div class="table-responsive">
			<table class="table table-condensed text-dark">
				<tbody>
					<tr class="b-top-none">
						<td colspan="2"><strong><?=translate('branch')?> :</strong></td>
						<td class="text-left"><?php echo get_type_name_by_id('branch', $template['branch_id']);?></td>
					</tr>
					<tr>
						<td colspan="2"><strong><?php echo translate('salary') . " " . translate('grade'); ?> :</strong></td>
						<td class="text-left"><?php echo html_escape($template['name']); ?></td>
					</tr>
					<tr>
						<td colspan="2"><strong><?php echo translate('basic') . " " . translate('salary'); ?> :</strong></td>
						<td class="text-left"><?php echo ($currency_symbol) . number_format(html_escape($template['basic_salary']) , 2, '.', ''); ?></td>
					</tr>
					<tr>
						<td colspan="2"><strong><?php echo translate('overtime'); ?> :</strong></td>
						<td class="text-left"><?php echo ($currency_symbol) . number_format(html_escape($template['overtime_salary']), 2, '.', ''); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 mt-lg">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><?php echo translate('allowances'); ?></h4>
			</header>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr class="text-dark">
								<th><?php echo translate('name'); ?></th>
								<th class="text-right"><?php echo translate('amount'); ?></th>
							</tr>
						</thead>
						<?php
						$total_allowance = 0;
						if(!empty($allowances)){
						foreach ($allowances as $allowance):
						$total_allowance += floatval($allowance['amount']);
						?>
							<tr>
								<td><?php echo html_escape($allowance['name']); ?></td>
								<td class="text-right"><?php echo ($currency_symbol) . html_escape($allowance['amount']); ?></td>
							</tr>
						<?php 
						endforeach;
						}else{
							echo '<tr> <td colspan="2"> <h5 class="text-danger text-center">' . translate('no_information_available') .  '</h5> </td></tr>';
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-6 mt-lg">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><?php echo translate('deductions'); ?></h4>
			</header>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr class="text-dark">
								<th><?php echo translate('name'); ?></th>
								<th class="text-right"><?php echo translate('amount'); ?></th>
							</tr>
						</thead>
						<?php
						$total_deduction = 0;
						if(!empty($deductions)){
						foreach ($deductions as $deduction):
						$total_deduction += floatval($deduction['amount']);
						?>
							<tr>
								<td><?php echo html_escape($deduction['name']); ?></td>
								<td class="text-right"><?php echo ($currency_symbol) . html_escape($deduction['amount']); ?></td>
							</tr>
						<?php endforeach;
						} else {
							echo '<tr><td colspan="2"> <h5 class="text-danger text-center">' . translate('no_information_available') .  '</h5></td></tr>';
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</div>

<div class="row">
	<div class="col-md-7 col-md-offset-5">
		<section class="panel">
			<header class="panel-heading"><h4 class="panel-title"><?php echo translate('salary_details'); ?></h4></header>
			<div class="panel-body">
				<table class="table table-condensed text-dark mb-none">
					<tbody>
						<tr class="b-top-none">
							<td colspan="2"><strong><?php echo translate('basic') . " " . translate('salary'); ?> :</strong></td>
							<td class="text-left">
								<?php echo ($currency_symbol) . number_format(html_escape($template['basic_salary']), 2, '.', ''); ?>
							</td>
						</tr>
						<tr>
							<td colspan="2"><strong><?php echo translate('total') . " " . translate('allowance'); ?> :</strong></td>
							<td class="text-left">
								<?php echo ($currency_symbol) . number_format($total_allowance, 2, '.', ''); ?>
							</td>
						</tr>
						<tr>
							<td colspan="2"><strong><?php echo translate('total') . " " . translate('deduction'); ?> :</strong></td>
							<td class="text-left">
								<?php echo ($currency_symbol) . number_format($total_deduction, 2, '.', ''); ?>
							</td>
						</tr>
						<tr>
							<td colspan="2"><strong><?php echo translate('net') . " " . translate('salary'); ?> :</strong></td>
							<td class="text-left">
								<?php
								$sum = 0;
								$net_salary = 0;
								$basic_salary = $template['basic_salary'];
								$sum = $basic_salary + $total_allowance;
								$net_salary = $sum - $total_deduction;	
								echo ($currency_symbol) . number_format($net_salary, 2, '.', '');
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
	</div>
</div>