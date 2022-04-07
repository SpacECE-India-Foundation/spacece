<?php $currency_symbol = $global_config['currency_symbol']; ?>
<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#template" data-toggle="tab"><i class="fas fa-list-ul"></i> <?php echo translate('template') . ' ' . translate('list'); ?></a>
			</li>
<?php if (get_permission('salary_template', 'is_add')){ ?>
			<li>
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?php echo translate('create') . ' ' . translate('template'); ?></a>
			</li>
<?php } ?>
		</ul>
		<div class="tab-content">
			<div id="template" class="tab-pane active mb-md">
				<table class="table table-bordered table-hover table-condensed mb-none table_default">
					<thead>
						<tr>
							<th><?=translate('sl')?></th>
							<th><?=translate('branch')?></th>
							<th><?=translate('salary_grades')?></th>
							<th><?=translate('basic_salary')?></th>
							<th><?=translate('overtime')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						if (!is_superadmin_loggedin()) {
							$this->db->where('branch_id', get_loggedin_branch_id());
						}
						$templatelist = $this->db->get('salary_template')->result_array();
						foreach ($templatelist as $row):
						?>	
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo get_type_name_by_id('branch', html_escape($row['branch_id']));?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $global_config['currency_symbol'] . $row['basic_salary']; ?></td>
							<td><?php echo $row['overtime_salary']; ?></td>
							<td>
								<a href="javascript:void(0);" class="btn btn-circle icon btn-default" data-toggle="tooltip"
								data-original-title="<?php echo translate('view'); ?>" onclick="getSalaryTemplate('<?php echo html_escape($row['id']); ?>')">
									<i class="fas fa-bars"></i>
								</a>
								<?php if (get_permission('salary_template', 'is_edit')){ ?>
									<a href="<?php echo base_url('payroll/salary_template_edit/' . $row['id']); ?>" class="btn btn-circle icon btn-default" data-toggle="tooltip"
									data-original-title="<?php echo translate('edit'); ?>">
										<i class="fas fa-pen-nib"></i>
									</a>
								<?php } ?>
								<?php if (get_permission('salary_template', 'is_delete')){ ?>
									<?php echo btn_delete('payroll/salary_template_delete/' . $row['id']); ?>
								<?php } ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php if (get_permission('salary_template', 'is_add')){ ?>
			<div id="create" class="tab-pane">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit')); ?>
				<?php if (is_superadmin_loggedin()): ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('branch');?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
				<?php endif; ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('salary_grade'); ?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="template_name" value="" placeholder="Grade Name Here" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('basic_salary'); ?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="basic_salary" id="basic_salary" value="" placeholder="Basic Salary Here" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('overtime'); ?></label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="overtime_rate" value="" placeholder="Overtime Rate Here">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mt-lg">
							<section class="panel panel-custom">
								<header class="panel-heading panel-heading-custom">
									<h4 class="panel-title"><?php echo translate('allowances'); ?></h4>
								</header>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-6">
											<input type="text" class="form-control" name="allowance[0][name]" placeholder="<?php echo translate('name_of_allowance'); ?>" />
										</div>
										<div class="col-md-6">
											<input type="number" class="allowance form-control" name="allowance[0][amount]" placeholder="<?php echo translate('amount'); ?>" />
										</div>
									</div>
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
									<div class="row">
										<div class="col-md-6">
											<input type="text" class="form-control" name="deduction[0][name]" placeholder="<?php echo translate('name_of_deductions'); ?>" />
										</div>
										<div class="col-md-6">
											<input type="number" class="deduction form-control" name="deduction[0][amount]" placeholder="<?php echo translate('amount'); ?>" />
										</div>
									</div>
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
									<h4 class="panel-title"><?php echo translate('salary_details'); ?></h4>
								</header>
								<div class="panel-body">
									<table class="table h5 text-dark tbr-middle">
										<tbody>
											<tr class="b-top-none">
												<td colspan="2"><?php echo translate('basic_salary'); ?></td>
												<td class="text-left">
													<div class="input-group">
														<span class="input-group-addon"><?php echo $currency_symbol; ?></span>
														<input type="text" class="form-control" name="salary_amount" readonly id="salary_amount" value="0" />
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2"><?php echo translate('total_allowance'); ?></td>
												<td class="text-left">
													<div class="input-group">
														<span class="input-group-addon"><?php echo $currency_symbol; ?></span>
														<input type="text" class="form-control" name="total_allowance" readonly id="total_allowance" value="0" />
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2"><?php echo translate('total_deduction'); ?></td>
												<td class="text-left">
													<div class="input-group">
														<span class="input-group-addon"><?php echo $currency_symbol; ?></span>
														<input type="text" class="form-control" name="total_deduction" readonly id="total_deduction" value="0" />
													</div>
												</td>
											</tr>

											<tr class="h4">
												<td colspan="2"><?php echo translate('net_salary'); ?></td>
												<td class="text-left">
													<div class="input-group">
														<span class="input-group-addon"><?php echo html_escape($currency_symbol); ?></span>
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
								<button type="submit" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing" class="btn btn-default btn-block">
									<i class="fas fa-plus-circle"></i> <?=translate('save')?>
								</button>
							</div>
						</div>
					</footer>
				<?php echo form_close(); ?>
			</div>
			<?php } ?>
		</div>
	</div>
</section>

<div class="zoom-anim-dialog modal-block modal-block-lg mfp-hide payroll-t-modal" id="modal">
	<section class="panel">
		<header class="panel-heading">
			<h4 class="panel-title"><i class="fas fa-bars"></i> <?php echo translate('salary_template'); ?></h4>
		</header>
		<div class="panel-body">
			<div id="quick_view"></div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-default modal-dismiss"><?php echo translate('close'); ?></button>
				</div>
			</div>
		</footer>
	</section>
</div>

<script type="text/javascript">
	
	var iAllowance = 1;
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
	
	var iDeduction = 1;
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