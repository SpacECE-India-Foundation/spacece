<?php $currency_symbol = $global_config['currency_symbol']; ?>
<div class="row">
	<div class="col-md-12">
	<?php if(is_superadmin_loggedin()): ?>
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"> <?php echo translate('select_ground'); ?></h4>
			</header>
			<?php echo form_open($this->uri->uri_string(), array('class' => 'validate')); ?>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-offset-3 col-md-6">
							<div class="form-group mb-md">
								<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
								<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' data-plugin-selectTwo
								data-width='100%' data-minimum-results-for-search='Infinity'");
								?>
							</div>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-offset-10 col-md-2">
							<button type="submit" class="btn btn btn-default btn-block"> <i class="fas fa-filter"></i> <?php echo translate('filter'); ?></button>
						</div>
					</div>
				</footer>
			<?php echo form_close(); ?>
		</section>
	<?php endif; ?>
	<?php if(!empty($branch_id)): ?>
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-list-ol"></i> <?php echo translate('balance') . " " . translate('sheet'); ?></h4>
			</header>
			<div class="panel-body">
				<!-- Hidden information for printing -->
				<div class="export_title">Balance Sheet</div>
				<table class="table table-bordered table-hover table-condensed table-export" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="50"><?php echo translate('sl'); ?></th>
							<th><?php echo translate('account') . " " . translate('name'); ?></th>
							<th><?php echo translate('total_dr'); ?></th>
							<th><?php echo translate('total_cr'); ?></th>
							<th><?php echo translate('balance'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$total_bal = 0; $count = 1;
							foreach($results as $row):
								$total_bal += $row['fbalance'];
						?>	
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo $row['ac_name']; ?></td>
							<td><?php echo $currency_symbol . $row['total_dr']; ?></td>
							<td><?php echo $currency_symbol . $row['total_cr']; ?></td>
							<td><?php echo $currency_symbol . $row['fbalance']; ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><?php echo $currency_symbol . number_format($total_bal, 2, '.', ''); ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</section>
	<?php endif; ?>
	</div>
</div>