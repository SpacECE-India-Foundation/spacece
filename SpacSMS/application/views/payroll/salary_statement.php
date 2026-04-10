<?php
$widget = (is_superadmin_loggedin() ? 'col-md-6' : 'col-md-offset-3 col-md-6');
$currency_symbol = $global_config['currency_symbol'];
?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><?php echo translate('select_ground');?></h4>
			</header>
			<?php echo form_open($this->uri->uri_string(), array('class' => 'validate')); ?>
			<div class="panel-body">
				<div class="row mb-sm">
                <?php if (is_superadmin_loggedin()): ?>
                    <div class="col-md-6 mb-sm">
                        <div class="form-group">
                            <label class="control-label"><?php echo translate('branch'); ?> <span class="required">*</span></label>
                            <?php
                                $arrayBranch = $this->app_lib->getSelectList('branch');
                                echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control'
                                data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
					<div class="<?=$widget?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('month')?> <span class="required">*</span></label>
                            <input type="text" class="form-control monthyear" autocomplete="off" name="month_year" value="<?=set_value('month_year',date("Y-m"))?>" required />
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-md-offset-10 col-md-2">
						<button type="submit" class="btn btn-default btn-block"><i class="fas fa-filter"></i> <?=translate('filter')?></button>
					</div>
				</div>
			</div>
			<?php echo form_close();?>
		</section>
		
		<?php if (isset($payslip)): ?>
		<section class="panel appear-animation" data-appear-animation="<?php echo $global_config['animations']; ?>" data-appear-animation-delay="100">
			<?php echo form_open('payroll/payslipPrint', array('class' => 'printIn')); ?>
			<header class="panel-heading">
				<h4 class="panel-title">
					<i class="fas fa-list-ul"></i> <?=translate('payroll_summary')?>
					<div class="panel-btn">
						<button type="submit" class="btn btn-default btn-circle" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
							<i class="fas fa-print"></i> <?=translate('generate')?>
						</button>
					</div>
				</h4>
			</header>
			<div class="panel-body">
				<div class="export_title">Payroll Summary Of : <?php echo $this->app_lib->getMonthslist($month) . " - " . $year; ?></div>
				<table class="table table-bordered table-hover table-condensed table-export" cellspacing="0" width="100%" id="table-export">
					<thead>
						<tr>
							<th class="hidden-print"> 
								<div class="checkbox-replace">
									<label class="i-checks" data-toggle="tooltip" data-original-title="Print Show / Hidden">
										<input type="checkbox" name="select-all" id="selectAllchkbox"> <i></i>
									</label>
								</div>
							</th>
							<th><?php echo translate('name'); ?></th>
							<th><?php echo translate('designation'); ?></th>
							<th><?php echo translate('salary') . " " . translate('salary'); ?></th>
							<th><?php echo translate('allowance'); ?> (+)</th>
							<th><?php echo translate('deduction'); ?> (-)</th>
							<th><?php echo translate('net') . " " . translate('salary'); ?></th>
							<th><?php echo translate('pay_via'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						$basic_salary = 0;
						$total_allowance = 0;
						$total_deduction = 0;
						$net_salary = 0;
						if (count($payslip)) {
							foreach ( $payslip as $row ):
								$basic_salary += $row['basic_salary'];
								$total_allowance += $row['total_allowance'];
								$total_deduction += $row['total_deduction'];
								$net_salary += $row['net_salary'];
						?>
						<tr>
							<td class="hidden-print checked-area hidden-print">
								<div class="checkbox-replace">
									<label class="i-checks"><input type="checkbox" name="payslip_id[]" value="<?=$row['id']?>"><i></i></label>
								</div>
							</td>
							<td><a href="<?php echo base_url('payroll/invoice/'.$row['id'].'/'.$row['hash']); ?>" class="mail-subj"><?php echo $row['staff_name']; ?></a></td>
							<td><?php echo $row['designation_name']; ?></td>
							<td><?php echo $currency_symbol . $row['basic_salary']; ?></td>
							<td><?php echo $currency_symbol . $row['total_allowance']; ?></td>
							<td><?php echo $currency_symbol . $row['total_deduction']; ?></td>
							<td><?php echo $currency_symbol . $row['net_salary']; ?></td>
							<td><?php echo $row['payvia']; ?></td>
						</tr>
						<?php endforeach; } ?>
					</tbody>
					<tfoot>
						<tr>
							<th></th>
							<th></th>
							<th></th>
							<th><?php echo $currency_symbol . number_format($basic_salary, 2, '.', ''); ?></th>
							<th><?php echo $currency_symbol . number_format($total_allowance, 2, '.', ''); ?></th>
							<th><?php echo $currency_symbol . number_format($total_deduction, 2, '.', ''); ?></th>
							<th><?php echo $currency_symbol . number_format($net_salary, 2, '.', ''); ?></th>
							<th></th>

						</tr>
					</tfoot>
				</table>
			</div>
			<?php echo form_close(); ?>
		</section>
		<?php endif;?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
        $('form.printIn').on('submit', function(e){
            e.preventDefault();
            var btn = $(this).find('[type="submit"]');
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: $(this).serialize(),
                dataType: 'html',
                beforeSend: function () {
                    btn.button('loading');
                },
                success: function (data) {
                	fn_printElem(data, true);
                },
                error: function () {
	                btn.button('reset');
	                alert("An error occured, please try again");
                },
	            complete: function () {
	                btn.button('reset');
	            }
            });
        });
	});
</script>