<?php $currency_symbol = $global_config['currency_symbol']?>
<section class="panel">
    <div class="panel-body">
        <div class="row mt-md">
            <div class="col-md-8">
                <section class="panel panel-custom">
                    <header class="panel-heading panel-heading-custom">
                        <h4 class="panel-title"><i class="fas fa-user-tag"></i> <?=translate('salary_details')?></h4>
                    </header>
                    <div class="panel-body panel-body-custom">
                        <div class="row mb-md">
                            <div class="col-md-3 mt-sm">
                                <center>
                                    <img class="img-thumbnail" width="132px" height="132px" src="<?=get_image_url('staff', $staff['photo'])?>">
                                </center>
                            </div>
                            <div class="col-md-7 mt-md">
                                <div class="table-responsive">
                                    <table class="table table-condensed text-dark mb-none">
                                        <tbody>
                                            <tr>
                                                <th class="top-b-none"><?=translate('name')?>:</th>
                                                <td class="top-b-none"><?=$staff['name'] ?></td>
                                            </tr>
                                            <tr>
                                                <th><?=translate('joining_date')?>:</th>
                                                <td><?=_d($staff['joining_date'])?></td>
                                            </tr>
                                            <tr>
                                                <th><?=translate('designation')?>:</th>
                                                <td><?=$staff['designation_name']?></td>
                                            </tr>
                                            <tr>
                                                <th><?=translate('department')?>:</th>
                                                <td><?=$staff['department_name']?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr class="solid mt-xs">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-condensed text-dark">
                                        <tbody>
                                            <tr>
                                                <th class="top-b-none"><?=translate('salary_grade')?> :</td>
                                                <td class="top-b-none"><?=$staff['template_name']?></td>
                                            </tr>
                                            <tr>
                                                <th><?=translate('basic_salary')?> :</td>
                                                <td><?=$currency_symbol . $staff['basic_salary']?></td>
                                            </tr>
                                            <tr>
                                                <th><?=translate('overtime')?> :</td>
                                                <td><?=$currency_symbol . $staff['overtime_salary']?></td>
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
                                        <h4 class="panel-title"><?=translate('allowances')?></h4>
                                    </header>
                                    <div class="panel-body">
                                        <div class="table-responsive text-dark">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><?=translate('name'); ?></th>
                                                        <th class="text-right"><?=translate('amount')?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total_allowance = 0;
                                                    $allowances = $this->payroll_model->get('salary_template_details', array('salary_template_id' => $staff['salary_template_id'], 'type' => 1));
                                                    if(count($allowances)){
                                                        foreach ($allowances as $allowance):
                                                        $total_allowance += floatval($allowance['amount']);
                                                        ?>
                                                            <tr>
                                                                <td><?=$allowance['name']; ?></td>
                                                                <td class="text-right"><?=$currency_symbol . $allowance['amount']; ?></td>
                                                            </tr>
                                                    <?php endforeach; } else {
                                                        echo '<tr> <td colspan="2"> <h5 class="text-danger text-center">' . translate('no_information_available') .  '</h5> </td></tr>';
                                                    }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-md-6 mt-lg">
                                <section class="panel">
                                    <header class="panel-heading">
                                        <h4 class="panel-title"><?=translate('deductions')?></h4>
                                    </header>
                                    <div class="panel-body">
                                        <div class="table-responsive text-dark">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><?=translate('name'); ?></th>
                                                        <th class="text-right"><?=translate('amount')?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $advance_salary = $staff['advance_amount'];
                                                $total_deduction = 0;
                                                $deductions = $this->payroll_model->get('salary_template_details', array('salary_template_id' => $staff['salary_template_id'], 'type' => 2));
                                                if(count($deductions)){
                                                    foreach ($deductions as $deduction):
                                                    $total_deduction += floatval($deduction['amount']);
                                                    ?>
                                                        <tr>
                                                            <td><?=$deduction['name']?></td>
                                                            <td class="text-right"><?=$currency_symbol . $deduction['amount']?></td>
                                                        </tr>
                                                <?php endforeach; } 
                                                    if(!empty($advance_salary)){
                                                        $total_deduction += $advance_salary;
                                                        echo '<tr><td>Advance Salary</td><td class="text-right">' . $global_config['currency_symbol'] . $advance_salary . '</td</tr>';
                                                    }
                                                     if(empty($advance_salary) && !count($deductions))
                                                        echo '<tr> <td colspan="2"> <h5 class="text-danger text-center">' . translate('no_information_available') .  '</h5> </td></tr>';
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
    			<section class="panel panel-custom">
    				<header class="panel-heading panel-heading-custom">
    					<h4 class="panel-title"><i class="fas fa-stamp"></i> <?=translate('payment_details')?></h4>
    				</header>
                    <?php echo form_open($this->uri->uri_string(), array('class' => 'validate')); ?>
                        <input type="hidden" name="branch_id" value="<?=$staff['branch_id']; ?>">
                        <input type="hidden" name="staff_id" value="<?=$staff['id']; ?>">
                        <input type="hidden" name="basic_salary" value="<?=$staff['basic_salary']; ?>">
                        <input type="hidden" name="salary_template_id" value="<?=$staff['salary_template_id']; ?>">
                        <input type="hidden" name="month" value="<?=$month; ?>">
                        <input type="hidden" name="year" value="<?=$year; ?>">
        				<div class="panel-body panel-body-custom">
        					<div class="form-group">
        						<label class="control-label"><?=translate('total_allowance')?></label>
        						<input type="number" class="form-control" name="total_allowance" id="total_allowance" value="<?=$total_allowance; ?>" readonly />
        					</div>
        					<div class="form-group">
        						<label class="control-label"><?=translate('total_deduction')?></label>
        						<input type="number" class="form-control" name="total_deduction" id="total_deduction" value="<?=$total_deduction; ?>" readonly />
        					</div>
        					<div class="form-group">
        						<label class="control-label"><?=translate('overtime_total_hour'); ?></label>
        						<input type="number" class="form-control" id="overtime_total_hour" name="overtime_total_hour" value="<?=set_value('overtime_total_hour'); ?>" />
        					</div>
        					<div class="form-group">
        						<label class="control-label"><?=translate('overtime_amount')?></label>
        						<input type="number" class="form-control" id="overtime_amount" name="ov_amount" value="0" readonly />
                                <input type="hidden" id="overtimeamount" name="overtime_amount" value="0" />
        					</div>
        					<?php
        						$salary = $staff['basic_salary'] + $total_allowance;
        						$net_salary = ($salary - $total_deduction);
        					?>
        					<div class="form-group">
        						<label class="control-label"><?=translate('net_salary')?></label>
        						<input type="text" class="form-control" name="net_salary" id="net_salary" value="<?=$net_salary; ?>" readonly />
        					</div>
        					<div class="form-group">
        						<label class="control-label"><?=translate('pay_via')?> <span class="required">*</span></label>
        						<?php
        							echo form_dropdown("pay_via", $payvia_list, set_value('pay_via'), "class='form-control' required
        							data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
        						?>
        					</div>
                        <?php
                        $links = $this->payroll_model->get('transactions_links', array('branch_id' => $staff['branch_id']), true);
                        if ($links['status'] == 1) {
                        ?>
                            <div class="form-group">
                                <label class="control-label"><?php echo translate('account'); ?> <span class="required">*</span></label>
                                <?php
                                    $accounts_list = $this->app_lib->getSelectByBranch('accounts', $staff['branch_id']);
                                    echo form_dropdown("account_id", $accounts_list, $links['expense'], "class='form-control' id='account_id' required data-plugin-selectTwo data-width='100%'");
                                ?>
                            </div>
                        <?php } ?>
        					<div class="mb-lg">
        						<label class="control-label"><?=translate('remarks')?></label>
                                <textarea class="form-control" name="remarks" rows="2" maxlength="50"><?=set_value('remarks')?></textarea>
        					</div>
        				</div>
        				<div class="panel-footer panel-footer-custom">
        					<div class="row">
        						<div class="col-md-offset-6 col-md-6">
        							<button type="submit" name="paid" value="1" class="btn btn-default btn-block"><?=translate('paid')?></button>
        						</div>
        					</div>
        				</div>
                    <?php echo form_close(); ?>
    			</section>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $('#overtime_total_hour').on('keyup', function(){
        var per_hour = <?=floatval($staff['overtime_salary']); ?>;
        var total_allowance = <?=$total_allowance; ?>;
        var $net_salary = <?=$net_salary; ?>;
        var overtime_hour = $('#overtime_total_hour').val() ? parseFloat($('#overtime_total_hour').val()) : 0; 
        var overtime_amount = parseFloat(overtime_hour * per_hour);
        var advance_salary = $('#advance_salary').val() ? parseFloat($('#advance_salary').val()) : 0;
        $('#overtime_amount').val(overtime_amount);
        $('#overtimeamount').val(overtime_amount);
        $('#total_allowance').val(total_allowance + overtime_amount);
        $('#net_salary').val(($net_salary + overtime_amount) - advance_salary);
    });
</script>