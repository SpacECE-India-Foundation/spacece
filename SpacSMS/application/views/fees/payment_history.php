<?php
$widget = (is_superadmin_loggedin() ? 3 : 4);
$currency_symbol = $global_config['currency_symbol'];
?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><?=translate('select_ground')?></h4>
			</header>
			<?php echo form_open($this->uri->uri_string(), array('class' => 'validate'));?>
			<div class="panel-body">
				<div class="row mb-sm">
				<?php if (is_superadmin_loggedin() ): ?>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' id='branch_id' onchange='getClassByBranch(this.value)'
								required data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
						</div>
					</div>
				<?php endif; ?>
					<div class="col-md-<?php echo $widget; ?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('class')?></label>
							<?php
								$arrayClass = $this->app_lib->getClass($branch_id);
								echo form_dropdown("class_id", $arrayClass, set_value('class_id'), "class='form-control' id='class_id'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>
					<div class="col-md-<?php echo $widget; ?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('payment_via')?> <span class="required">*</span></label>
							<?php
								$arrayVia = array(
									'' => translate('select'),
									'all' => translate('both'),
									'online' => "Online",
									'cash' => "Cash",
								);
								echo form_dropdown("payment_via", $arrayVia, set_value('payment_via'), "class='form-control' required
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>
					<div class="col-md-<?php echo $widget; ?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?php echo translate('date'); ?> <span class="required">*</span></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-calendar-check"></i></span>
								<input type="text" class="form-control daterange" name="daterange" value="<?php echo set_value('daterange', date("Y/m/d") . ' - ' . date("Y/m/d")); ?>" required />
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-offset-10 col-md-2">
						<button type="submit" name="search" value="1" class="btn btn-default btn-block"> <i class="fas fa-filter"></i> <?=translate('filter')?></button>
					</div>
				</div>
			</footer>
			<?php echo form_close();?>
		</section>
<?php if (isset($invoicelist)): ?>
		<section class="panel appear-animation" data-appear-animation="<?php echo $global_config['animations'];?>" data-appear-animation-delay="100">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-list-ol"></i> <?=translate('fees_payment_history');?></h4>
			</header>
			<div class="panel-body">
				<div class="mb-md mt-md">
					<div class="export_title"><?=translate('fees_payment_history')?></div>
					<table class="table table-bordered table-condensed table-hover mb-none tbr-top table-export">
						<thead>
							<tr>
								<th><?=translate('sl')?></th>
								<th><?=translate('student')?></th>
								<th><?=translate('register_no')?></th>
								<th><?=translate('roll')?></th>
								<th><?=translate('date')?></th>
								<th><?=translate('class')?></th>
								<th><?=translate('collect_by')?></th>
								<th><?=translate('payment_via')?></th>
								<th><?=translate('fees_type')?></th>
								<th><?=translate('amount')?></th>
								<th><?=translate('discount')?></th>
								<th><?=translate('fine')?></th>
								<th><?=translate('total')?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$count = 1;
							$totalamount = 0;
							$totaldiscount = 0;
							$totalfine = 0;
							$total = 0;
							foreach($invoicelist as $row):
								$totalamount += $row['amount'];
								$totaldiscount += $row['discount'];
								$totalfine += $row['fine'];
								$totalp = ($row['amount'] + $row['fine']) - $row['discount'];
								$total += $totalp;
								?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $row['first_name'] . ' ' . $row['last_name'];?></td>
								<td><?php echo $row['register_no'];?></td>
								<td><?php echo $row['roll'];?></td>
								<td><?php echo _d($row['date']);?></td>
								<td><?php echo $row['class_name'] ." (" . $row['section_name'] . ")";?></td>
								<td><?php 
								if($row['collect_by'] == 'online'){
									echo "Online";
								} else {
									echo get_type_name_by_id('staff', $row['collect_by']);
								} ?></td>
								<td><?php echo $row['pay_via'];?></td>
								<td><?php echo $row['type_name'];?></td>
								<td><?php echo $currency_symbol . $row['amount'];?></td>
								<td><?php echo $currency_symbol . $row['discount'];?></td>
								<td><?php echo $currency_symbol . $row['fine'];?></td>
								<td><?php echo $currency_symbol . number_format($totalp, 2, '.', '');?></td>
						
							</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th><?php echo ($currency_symbol . number_format($totalamount, 2, '.', '')); ?></th>
								<th><?php echo ($currency_symbol . number_format($totaldiscount, 2, '.', '')); ?></th>
								<th><?php echo ($currency_symbol . number_format($totalfine, 2, '.', '')); ?></th>
								<th><?php echo ($currency_symbol . number_format($total, 2, '.', '')); ?></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</section>
<?php endif; ?>
	</div>
</div>
