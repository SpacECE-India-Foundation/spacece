<?php $currency_symbol = $global_config['currency_symbol']; ?>
<section class="panel">
	<div class="panel-body">
		<div class="invoice" id="payslipPrint">
			<header class="clearfix mt-lg">
				<div class="row">
					<div class="col-xs-6">
						<div class="ib">
							<img src="<?php echo base_url('uploads/app_image/printing-logo.png'); ?>" alt="Img" />
						</div>
					</div>
					<div class="col-xs-6 text-right">
						<h4 class="mt-none text-dark">Payslip No #<?php echo $salary['bill_no']; ?></h4>
						<p class="mb-none">
							<span class="text-dark"><?php echo translate('date'); ?> : </span> <span class="value"><?php echo _d($salary['created_at']); ?></span>
						</p>
						<p class="mb-none">
							<span class="text-dark"><?php echo translate('salary_month')?> : </span> <?php echo  $this->app_lib->getMonthslist($salary['month']); ?>
						</p>
					</div>
				</div>
			</header>
			
			<div class="bill-info">
				<div class="row">
					<div class="col-xs-6">
						<div class="bill-data">
							<p class="h5 mb-xs text-dark text-weight-semibold">To :</p>
							<address>
								<?php echo $salary['staff_name']; ?><br>
								<?php echo translate('department') . ' : ' . $salary['department_name']; ?><br>
								<?php echo translate('designation') . ' : ' . $salary['designation_name']; ?><br>
								<?php echo translate('mobile_no') . ' : ' . $salary['mobileno']; ?>
							</address>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="bill-data text-right">
							<p class="h5 mb-xs text-dark text-weight-semibold">From :</p>
							<address>
								<?php 
								echo $salary['school_name'] . "<br/>";
								echo $salary['school_address'] . "<br/>";
								echo $salary['school_mobileno'] . "<br/>";
								echo $salary['school_email'] . "<br/>";
								?>
							</address>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-md payslip">
				<div class="col-xs-6">
					<section class="panel panel-custom">
						<div class="panel-heading panel-heading-custom">
							<h4 class="panel-title">Allowances</h4>
						</div>
						<div class="panel-body">
							<div class="table-responsive text-dark">
								<table class="table">
									<thead>
										<tr>
											<th><?php echo translate('name'); ?></th>
											<th class="text-right"><?php echo translate('amount'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$total_allowance = 0;
											$allowances = $this->payroll_model->get('payslip_details', array('payslip_id' => $salary['id'], 'type' => 1));
											if(count($allowances)){
												foreach ($allowances as $allowance):
													$total_allowance += $allowance['amount'];
										?>
										<tr>
											<td><?php echo $allowance['name']; ?></td>
											<td class="text-right"><?php echo $currency_symbol . $allowance['amount']; ?></td>
										</tr>
										<?php endforeach; } else {
											echo '<tr> <td colspan="2"> <h5 class="text-danger text-center">' . translate('no_information_available') . '</h5> </td></tr>';
										 }; ?>
									</tbody>
								</table>
							</div>
						</div>
					</section>
				</div>
				<div class="col-xs-6">
					<section class="panel panel-custom">
						<div class="panel-heading panel-heading-custom"><h4 class="panel-title"><?php echo translate('deductions'); ?></h4></div>
						<div class="panel-body">
							<div class="table-responsive text-dark">
								<table id="deductiontable" class="table">
									<thead>
										<tr>
											<th><?php echo translate('name'); ?></th>
											<th class="text-right"><?php echo translate('amount'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$total_deduction = 0;
											$deductions = $this->payroll_model->get('payslip_details', array('payslip_id' => $salary['id'], 'type' => 2));
											if(count($deductions)){
												foreach ($deductions as $deduction):
													$total_deduction += $deduction['amount'];
										?>
										<tr>
											<td><?php echo $deduction['name']; ?></td>
											<td class="text-right"><?php echo $currency_symbol . $deduction['amount']; ?></td>
										</tr>
										<?php 
												endforeach; 
											}else{
											
												echo '<tr> <td colspan="2"> <h5 class="text-danger text-center">' . translate('no_information_available') .  '</h5></td></tr>';
											};
										 ?>
									</tbody>
								</table>
							</div>
						</div>
					</section>
				</div>
			</div>
			<div class="invoice-summary text-right mt-lg">
				<div class="row">
					<div class="col-lg-5 pull-right">
						<ul class="amounts">
							<li><strong><?php echo translate('basic_salary'); ?> :</strong> <?php echo $currency_symbol . $salary['basic_salary']; ?></li>
							<li><strong><?php echo translate('total') . " " . translate('allowance'); ?> :</strong> <?php echo $currency_symbol . $salary['total_allowance']; ?></li>
							<li><strong><?php echo translate('total') . " " . translate('deduction'); ?> :</strong> <?php echo $currency_symbol . $salary['total_deduction']; ?></li>
							<li>
								<strong><?php echo translate('net') . " " . translate('salary'); ?> :</strong> 
								<?php
								$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
								echo $currency_symbol . $salary['net_salary'] . ' </br>(' . strtoupper($f->format($salary['net_salary'])) . ')' ;
								?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="panel-footer">
		<div class="text-right mr-lg">
			<a href="javascript:void(0);" onClick="fn_printElem('payslipPrint')" class="btn btn-default">
				<i class="fas fa-print"></i> <?php echo translate('print'); ?>
			</a>
		</div>
	</footer>
</section>