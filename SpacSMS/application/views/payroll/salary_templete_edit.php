<?php $currency_symbol = $global_config['currency_symbol']; ?>
<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
				<a href="<?php echo base_url('payroll/salary_template'); ?>"><i class="fas fa-list-ul"></i> <?php echo translate('template') . ' ' . translate('list'); ?></a>
			</li>

			<li class="active">
				<a href="#edit" data-toggle="tab"><i class="far fa-edit"></i> <?php echo translate('edit') . ' ' . translate('template'); ?></a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="edit" class="tab-pane active">
			    <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit')); ?>
					<input type="hidden" name="salary_template_id" value="<?=$template_id?>">
					<?php if (is_superadmin_loggedin()): ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('branch');?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id', $template['branch_id']), "class='form-control'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<?php endif; ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('salary_grade'); ?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="template_name" value="<?=$template['name']?>" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('basic_salary'); ?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="basic_salary" id="basic_salary" value="<?=$template['basic_salary']?>" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('overtime'); ?></label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="overtime_rate" value="<?=$template['overtime_salary']?>" />
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mt-lg">
							<section class="panel panel-custom">
								<header class="panel-heading panel-heading-custom">
									<h4 class="panel-title"><?php echo translate('allowances'); ?></h4>
								</header>
								<div class="panel-body">
									<?php
									if (count($allowances)){
										foreach ($allowances as $key => $allowance):
											?>
									<input type="hidden" name="allowance[<?php echo $key; ?>][old_allowance_id]" value="<?=$allowance['id']?>">
									<div class="row <?php echo ($key > 0 ? 'mt-md' : '') ;?>">
										<div class="col-md-6">
											<input type="text" class="form-control" name="allowance[<?php echo $key; ?>][name]" required value="<?=$allowance['name']?>" />
										</div>
										<div class="col-md-6">
											<input type="number" class="allowance form-control" name="allowance[<?php echo $key; ?>][amount]" required value="<?=$allowance['amount']?>" />
										</div>
									</div>
									<?php endforeach; }else{ ?>
									<div class="row">
										<div class="col-md-6">
											<input type="text" class="form-control" name="allowance[0][name]" placeholder="<?php echo translate('name_of_allowance'); ?>" />
										</div>
										<div class="col-md-6">
											<input type="number" class="allowance form-control" name="allowance[0][amount]" placeholder="<?php echo translate('amount'); ?>" />
										</div>
									</div>
									<?php } ?>
									<div id="add_new_allowance"></div>
									<button type="button" class="btn btn-default mt-md" onclick="addAllowanceRows()">
										<i class="fas fa-plus-circle"></i> <?php echo translate('add_rows'); ?>
									</button>
								</div>
							</section>
						</div>

						<div class="col-md-6 mt-lg">
							<section class="panel panel-custom">
								<header class="panel-heading panel-heading-custom">
									<h4 class="panel-title"><?php echo translate('deductions'); ?></h4>
								</header>
								<div class="panel-body">
									<?php
									if (count($deductions)){
										foreach ($deductions as $key => $deduction):
											?>
									<input type="hidden" name="deduction[<?php echo $key; ?>][old_deduction_id]" value="<?php echo html_escape($deduction['id']); ?>">
									<div class="row <?php echo ($key > 0 ? 'mt-md' : ''); ?>">
										<div class="col-md-6">
											<input type="text" class="form-control" name="deduction[<?php echo $key; ?>][name]" required value="<?=$deduction['name']?>" />
										</div>
										<div class="col-md-6">
											<input type="number" class="deduction form-control" name="deduction[<?php echo $key; ?>][amount]" required value="<?=$deduction['amount']?>" />
										</div>
									</div>
									<?php endforeach; }else{ ?>
									<div class="row">
										<div class="col-md-6">
											<input type="text" class="form-control" name="deduction[0][name]" placeholder="<?php echo translate('name_of_deductions'); ?>" />
										</div>
										<div class="col-md-6">
											<input type="number" class="deduction form-control" name="deduction[0][amount]" placeholder="<?php echo translate('amount'); ?>" />
										</div>
									</div>
									<?php } ?>
									<div id="add_new_deduction"></div>
									<button type="button" class="btn btn-default mt-md" onclick="addDeductionRows()">
										<i class="fas fa-plus-circle"></i> <?php echo translate('add_rows'); ?>
									</button>
								</div>
							</section>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-md-offset-6">
							<section class="panel panel-custom">
								<header class="panel-heading panel-heading-custom">
									<h4 class="panel-title"><?php echo translate('salary') . " " . translate('details'); ?></h4>
								</header>
								<div class="panel-body">
									<table class="table h5 text-dark tbr-middle">
										<tbody>
											<tr class="b-top-none">
												<td colspan="2"><?php echo translate('basic') . " " . translate('salary'); ?></td>
												<td class="text-left">
													<div class="input-group">
														<span class="input-group-addon"><?php echo ($currency_symbol); ?></span>
														<input type="text" class="form-control" name="salary_amount" readonly id="salary_amount" value="0" />
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2"><?php echo translate('total') . " " . translate('allowance'); ?></td>
												<td class="text-left">
													<div class="input-group">
														<span class="input-group-addon"><?php echo ($currency_symbol); ?></span>
														<input type="text" class="form-control" name="total_allowance" readonly id="total_allowance" value="0" />
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2"><?php echo translate('total') . " " . translate('deduction'); ?></td>
												<td class="text-left">
													<div class="input-group">
														<span class="input-group-addon"><?php echo ($currency_symbol); ?></span>
														<input type="text" class="form-control" name="total_deduction" readonly id="total_deduction" value="0" />
													</div>
												</td>
											</tr>

											<tr class="h4">
												<td colspan="2"><?php echo translate('net') . " " . translate('salary'); ?></td>
												<td class="text-left">
													<div class="input-group">
														<span class="input-group-addon"><?php echo ($currency_symbol); ?></span>
														<input type="text" class="form-control" name="net_salary" readonly id="net_salary" value="0" />
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</section>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-offset-9 col-md-3">
								<button type="submit" name="save" value="1" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
									<i class="fas fa-plus-circle"></i> <?=translate('update')?>
								</button>
							</div>
						</div>
					</footer>
				<?php echo form_close(); ?>
			</div>
		
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){ 
		totalCalculate();
	});

	var iAllowance = <?php echo count($allowances) ? count($allowances) : 1; ?>;
	function addAllowanceRows() {
		var html_row = "";
		html_row += '<div class="row" id="al_row_' + iAllowance + '"><div class="col-md-6 mt-md">';
		html_row += '<input class="form-control" name="allowance[' + iAllowance + '][name]" placeholder="<?php echo translate('name_of_allowance'); ?>" type="text">';
		html_row += '</div>';
		html_row += '<div class="col-md-4 mt-md"> <input type="number" class="allowance form-control" name="allowance[' + iAllowance + '][amount]" placeholder="<?php echo translate('amount'); ?>"></div>';
		html_row += '<div class="col-md-2 mt-md text-right"><button type="button" class="btn btn-danger" onclick="deleteAllowancRow(' + iAllowance + ')"><i class="fas fa-times"></i> </button></div></div>';
		$("#add_new_allowance").append(html_row);
		iAllowance++;
	}

    function deleteAllowancRow(id) {
        $("#al_row_" + id).remove();
      	totalCalculate();
    }
	
	var iDeduction = <?php echo count($deductions) ? count($deductions) : 1; ?>;
	function addDeductionRows() {
		var html_row = "";
		html_row += '<div class="row" id="de_row_' + iDeduction + '"><div class="col-md-6 mt-md">';
		html_row += '<input class="form-control" name="deduction[' + iDeduction + '][name]" placeholder="<?php echo translate('name_of_deductions'); ?>" type="text">';
		html_row += '</div><div class="col-md-4 mt-md"> <input type="number" class="deduction form-control" name="deduction[' + iDeduction + '][amount]" placeholder="<?php echo translate('amount'); ?>"></div>';
		html_row += '<div class="col-md-2 mt-md text-right"><button type="button" class="btn btn-danger" onclick="deleteDeductionRow(' + iDeduction + ')"><i class="fas fa-times"></i> </button></div></div>';
		$("#add_new_deduction").append(html_row);
		iDeduction++;
	}

    function deleteDeductionRow(id) {
        $("#de_row_" + id).remove();
        totalCalculate();
    }
	
    $(document).on( "change", function () {
		totalCalculate();
    });

	function totalCalculate() {
        var total_allowance = 0;
        var total_deduction = 0;
        $(".allowance").each(function () {
            total_allowance += read_number($(this).val());
        });

        $(".deduction").each(function () {
            total_deduction += read_number($(this).val());
        });

        $("#total_allowance").val(total_allowance);
        $("#total_deduction").val(total_deduction);

		var basic = read_number($('#basic_salary').val());
        var net_amount = (basic + total_allowance) - total_deduction;

        $("#salary_amount").val(basic);
        $("#net_salary").val(net_amount);
	}
</script>