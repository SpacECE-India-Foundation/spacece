<?php 
$widget = (is_superadmin_loggedin() ? '' : 'col-md-offset-3');
$currency_symbol = $global_config['currency_symbol'];
?>
<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"> <?php echo translate('select_ground'); ?></h4>
	</header>
	<?php echo form_open($this->uri->uri_string(), array('class' => 'validate')); ?>
		<div class="panel-body">
			<div class="row">
				<?php if (is_superadmin_loggedin() ): ?>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
						</div>
					</div>
				<?php endif; ?>
				<div class="<?=$widget?> col-md-6 mb-lg">		
					<div class="form-group">
						<label class="control-label"><?php echo translate('date'); ?> <span class="required">*</span></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fas fa-calendar-check"></i></span>
							<input type="text" class="form-control daterange" name="daterange" value="<?php echo set_value('date', date("Y/m/d") . ' - ' . date("Y/m/d")); ?>" required />
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-offset-10 col-md-2">
					<button type="submit" name="search" value="1" class="btn btn btn-default btn-block"> <i class="fas fa-filter"></i> <?php echo translate('filter'); ?></button>
				</div>
			</div>
		</footer>
	<?php echo form_close(); ?>
</section>

<?php if (isset($results)): ?>
<section class="panel appear-animation" data-appear-animation="<?php echo $global_config['animations'];?>" data-appear-animation-delay="100">
	<header class="panel-heading">
		<h4 class="panel-title"><i class="fas fa-list-ol"></i> <?php echo translate('expense') . " " . translate('repots'); ?></h4>
	</header>
	<div class="panel-body">
		<!-- Hidden information for printing -->
		<div class="export_title">Expense Repots : <?php echo _d($daterange[0]); ?> To <?php echo _d($daterange[1]); ?></div>
		<table class="table table-bordered table-hover table-condensed table-export" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th width="50"><?php echo translate('sl'); ?></th>
					<th><?php echo translate('account') . " " . translate('name'); ?></th>
					<th><?php echo translate('type'); ?></th>
					<th><?php echo translate('voucher') . " " . translate('head'); ?></th>
					<th><?php echo translate('ref_no'); ?></th>
					<th><?php echo translate('description'); ?></th>
					<th><?php echo translate('pay_via'); ?></th>
					<th><?php echo translate('date'); ?></th>
					<th><?php echo translate('amount') . ' (Dr.)'; ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$total_dr = 0;
				if(!empty($results)) {
					$count = 1;
					foreach($results as $row):
						$total_dr += $row['amount']; 
				?>	
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $row['ac_name']; ?></td>
					<td><?php echo ucfirst($row['type']); ?></td>
					<td><?php echo $row['v_head']; ?></td>
					<td><?php echo $row['ref']; ?></td>
					<td><?php echo $row['description']; ?></td>
					<td><?php echo $row['via_name']; ?></td>
					<td><?php echo _d($row['date']); ?></td>
					<td><?php echo $currency_symbol . $row['amount'];?></td>
				</tr>
				<?php endforeach; } ?>
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
					<th><?php echo html_escape($currency_symbol . number_format($total_dr, 2, '.', '')); ?></th>
				</tr>
			</tfoot>
		</table>
	</div>
</section>
<?php endif; ?>