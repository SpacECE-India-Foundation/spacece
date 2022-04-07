<?php
$widget = (is_superadmin_loggedin() ? 3 : 4);
$currency_symbol = $global_config['currency_symbol'];
?>
<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"> <?php echo translate('select_ground'); ?></h4>
	</header>
	<?php echo form_open($this->uri->uri_string(), array('class' => 'validate')); ?>
		<div class="panel-body">
			<div class="row mb-sm">
				<?php if (is_superadmin_loggedin() ): ?>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' id='branch_id'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
						</div>
					</div>
				<?php endif; ?>
				<div class="col-md-<?php echo $widget; ?> mb-sm">		
					<div class="form-group">
						<label class="control-label"><?php echo translate('account'); ?> <span class="required">*</span></label>
						<?php
							$accountlist = $this->app_lib->getSelectByBranch('accounts', $branch_id);
							echo form_dropdown("account_id", $accountlist, set_value('account_id'), "class='form-control' id='account_id' required
							data-plugin-selectTwo data-width='100%'");
						?>
					</div>
				</div>
				<div class="col-md-<?php echo $widget; ?> mb-sm">		
					<div class="form-group">
						<label class="control-label"><?php echo translate('type'); ?> <span class="required">*</span></label>
						<?php
							$typelList =array(
								'' => translate('select'),
								'all' => translate('all'),
								'expense' => translate('expense') . ' (Dr.)',
								'deposit' => translate('income') . ' (Cr.)',
							);
							echo form_dropdown("type", $typelList, set_value('type'), "class='form-control' required
							data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
						?>
					</div>
				</div>
				<div class="col-md-<?php echo $widget; ?>">		
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
					<button type="submit" name="search" value="1" class="btn btn btn-default btn-block"><i class="fas fa-filter"></i> <?php echo translate('filter'); ?></button>
				</div>
			</div>
		</footer>
	<?php echo form_close(); ?>
</section>
<?php if (isset($results)): ?>
<section class="panel appear-animation" data-appear-animation="<?php echo $global_config['animations'];?>" data-appear-animation-delay="100">
	<header class="panel-heading">
		<h4 class="panel-title"><i class="fas fa-list-ol"></i> <?php echo translate('account') . " " . translate('statement'); ?></h4>
	</header>
	<div class="panel-body">
		<!-- Hidden information for printing -->
		<div class="export_title"><?php echo get_type_name_by_id('accounts', set_value('account_id')) ?> Statement : <?php echo _d($daterange[0]); ?> To <?php echo _d($daterange[1]); ?></div>
		<table class="table table-bordered table-hover table-condensed table-export" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th><?php echo translate('sl'); ?></th>
					<th><?php echo translate('voucher') . " " . translate('head'); ?></th>
					<th><?php echo translate('ref_no'); ?></th>
					<th><?php echo translate('description'); ?></th>
					<th><?php echo translate('date'); ?></th>
					<th><?php echo translate('dr'); ?>.</th>
					<th><?php echo translate('cr'); ?>.</th>
					<th><?php echo translate('balance'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$total_dr = 0;
				$total_cr = 0;
				$total_bal = 0;
				if(!empty($results)) {
					$count = 1; 
					foreach($results as $row):
						$total_dr += $row['dr'];
						$total_cr += $row['cr'];
				?>	
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo html_escape($row['v_head']); ?></td>
					<td><?php echo html_escape($row['ref']); ?></td>
					<td><?php echo html_escape($row['description']); ?></td>
					<td><?php echo html_escape(_d($row['date'])); ?></td>
					<td><?php echo html_escape($currency_symbol . number_format($row['dr'], 2, '.', ''));?></td>
					<td><?php echo html_escape($currency_symbol . number_format($row['cr'], 2, '.', ''));?></td>
					<td><?php echo (set_value('type') == 'all' ? $currency_symbol . number_format($row['bal'], 2, '.', '') : $currency_symbol . "0.00"); ?>
					</td>
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
					<th><?php echo html_escape($currency_symbol . number_format($total_dr, 2, '.', '')); ?></th>
					<th><?php echo html_escape($currency_symbol . number_format($total_cr, 2, '.', '')); ?></th>
					<th><?php echo html_escape(set_value('type') == 'all' ? $currency_symbol . number_format($total_cr - $total_dr, 2, '.', '') : $currency_symbol . "0.00"); ?></th>
				</tr>
			</tfoot>
		</table>
	</div>
</section>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function () {
		$('#branch_id').on("change", function(){
		    var branchID = $(this).val();
		    $.ajax({
		        url: base_url + 'ajax/getDataByBranch',
		        type: "POST",
		        data: {
		            'branch_id': branchID,
		            'table': 'accounts'
		        },
		        success: function (data) {
		        	$('#account_id').html(data);
		        }
		    });
		});
    });
</script>