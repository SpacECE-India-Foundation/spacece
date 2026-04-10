<section class="panel appear-animation" data-appear-animation="<?=$global_config['animations'] ?>" data-appear-animation-delay="100">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-8">
                <section class="panel panel-sp-custom">
                    <header class="panel-heading panel-heading-sp-custom">
                        <h4 class="panel-title"><i class="fas fa-user-tag"></i> <?=translate('salary_details')?></h4>
                    </header>
                    <div class="panel-body panel-body-sp-custom">
                        <div class="row mb-md">
                            <div class="col-md-3 mt-sm">
                                <center>
                                    <img class="img-thumbnail" width="132px" height="132px" src="<?php echo get_image_url($role, $employee->photo);?>">
                                </center>
                            </div>
                            <div class="col-md-7 mt-md">
                                <div class="table-responsive">
                                    <table class="table table-condensed text-dark mb-none">
                                        <tbody>
                                            <tr class="tbtb-none">
                                                <th><?=translate('name')?>:</th>
                                                <td><?=html_escape($employee->name)?> </td>
                                            </tr>
                                            <tr>
                                                <th><?=translate('joining_date')?>:</th>
                                                <td><?=html_escape(_d($employee->joining_date))?></td>
                                            </tr>
                                            <tr>
                                                <th><?=translate('designation')?>:</th>
                                                <td><?=html_escape($employee->designation_name)?></td>
                                            </tr>
                                            <tr>
                                                <th><?=translate('department')?>:</th>
                                                <td><?=html_escape($employee->department_name)?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-offset-2 col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-condensed text-dark">
                                        <tbody>
                                            <tr class="tbtb-none">
                                                <th><?=translate('salary_grade')?> :</td>
                                                <td><?php echo html_escape($employee->template_name); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?=translate('basic_salary')?> :</td>
                                                <td><?php echo html_escape($global_config['currency_symbol'] . $employee->basic_salary);?></td>
                                            </tr>
                                            <tr>
                                                <th><?=translate('overtime')?> :</td>
                                                <td><?php echo html_escape($global_config['currency_symbol'] . $employee->overtime_salary);?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-lg">
								<div class="col-md-6 mt-lg">
									<section class="panel">
										<header class="panel-heading">
											<h4 class="panel-title"><?=translate('allowances')?></h4>
										</header>
										<div class="panel-body">
											<div class="table-responsive text-dark">
												<table class="table">
													<thead>
														<tr>
															<th><?=translate('name')?></th>
															<th class="text-right"><?=translate('amount')?></th>
														</tr>
													</thead>
													<tbody>
														<?php
															$total_allowance = 0;
															$allowances = $this->db->select('name,amount,type')->where(array('salary_template_id' => $employee->template_id, 'type' => 'allowance'))->get('salary_stipend')->result();
															if(count($allowances)){
																foreach ($allowances as $allowance):
																	$total_allowance += $allowance->amount;
														?>
														<tr>
															<td><?php echo html_escape($allowance->name);?></td>
															<td class="text-right"><?php echo html_escape($global_config['currency_symbol'] . $allowance->amount);?></td>
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
												<table id="deductiontable" class="table">
													<thead>
														<tr>
															<th><?=translate('name')?></th>
															<th class="text-right"><?=translate('amount')?></th>
														</tr>
													</thead>
													<tbody>
														<?php
															$advance_salary = $employee->a_salary_amount;
															$total_deduction = 0;
															$deductions = $this->db->select('name,amount,type')->where(array('salary_template_id' => $employee->template_id, 'type' => 'deduction'))->get('salary_stipend')->result();
															if (count($deductions)):
																foreach ($deductions as $deduction):
																	$total_deduction += $deduction->amount;
														?>
														<tr>
															<td><?php echo html_escape($deduction->name);?></td>
															<td class="text-right"><?php echo html_escape($global_config['currency_symbol'] . $deduction->amount);?></td>
														</tr>
														<?php 
															endforeach; 
															endif;
																if(!empty($advance_salary)){
																	$total_deduction += $advance_salary;
																	echo '<tr><td>Advance Salary</td><td class="text-right">'.$global_config['currency_symbol'] . $advance_salary . '</td</tr>';
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
                    </div>
                </section>
            </div>
            <div class="col-md-4">
			<?php  echo form_open('payroll/create_pay?role='.$role.'&id='.$employee->id.'&m='.$month.'&y='.$year, array('class' => 'validate')); ?>
			<section class="panel panel-sp-custom">
				<header class="panel-heading panel-heading-sp-custom">
					<h4 class="panel-title"><i class="fas fa-stamp"></i> <?=translate('continue_to_payment')?></h4>
				</header>
				<div class="panel-body panel-body-sp-custom">
					<div class="form-group">
						<label class="control-label"><?=translate('total_allowance')?></label>
						<input type="number" class="form-control" name="total_allowance" id="total_allowance" value="<?=html_escape($total_allowance)?>" readonly/>
					</div>
					<div class="form-group">
						<label class="control-label"><?=translate('total_deduction')?></label>
						<input type="number" class="form-control" name="total_deduction" id="total_deduction" value="<?=html_escape($total_deduction)?>" readonly/>
					</div>
					<div class="form-group">
						<label class="control-label"><?=translate('overtime_total_hour')?></label>
						<input type="number" class="form-control" id="overtime_total_hour" name="overtime_total_hour" value="<?=set_value('overtime_total_hour')?>" />
					</div>
					<div class="form-group">
						<label class="control-label"><?=translate('overtime_amount')?></label>
						<input type="number" class="form-control" id="overtime_amount" name="overtime_amount" value="0" readonly/>
					</div>
					<?php
						$sum          = 0;
						$net_salary   = 0;
						$sum          = $employee->basic_salary + $total_allowance;
						$net_salary   = $sum - $total_deduction;
					?>
					<div class="form-group">
						<label class="control-label"><?=translate('net_salary')?></label>
						<input type="text" class="form-control" name="net_salary" id="net_salary" value="<?=html_escape($net_salary)?>" readonly/>
					</div>
					<div class="form-group">
						<label class="control-label"><?=translate('payment_type')?> <span class="required">*</span></label>
						<?php
							$array = array("" => translate('select_payment_method'));
							$types = $this->db->get_where('payment_types', array('branch_id' => $employee->branch_id))->result();
							foreach ($types as $row){
								$array[$row->id] = $row->name;
							}
							echo form_dropdown("payment_types", $array, set_value('payment_types'), "class='form-control' required
							data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
						?>
					</div>

					<div class="mb-lg">
						<label class="control-label"><?=translate('remarks')?></label>
                        <textarea class="form-control" name="remark" rows="2" maxlength="50"><?=set_value('remark')?></textarea>
					</div>
				</div>
				<div class="panel-footer panel-footer-sp-custom">
					<div class="row">
						<div class="col-md-offset-6 col-md-6">
							<button type="submit" class="btn btn-default btn-block"> <?=translate('paid')?></button>
						</div>
					</div>
				</div>
			</section>
            <?php
                $data = array('month' => $month, 'year'  => $year);
                echo form_hidden($data);
                echo form_close();
            ?>
		</div>
        </div>
    </div>
</section>

<script type="text/javascript">
	$(document).ready(function () {
		"use strict";
		
		$('#overtime_total_hour').on('keyup', function(){
			var per_hour = <?=floatval($employee->overtime_salary)?>;
			var total_allowance = <?=floatval($total_allowance)?>;
			var $net_salary = <?=floatval($net_salary)?>;
			var overtime_hour = $('#overtime_total_hour').val() ? parseFloat($('#overtime_total_hour').val()) : 0; 
			var overtime_amount = parseFloat(overtime_hour * per_hour);
			var advance_salary = $('#advance_salary').val() ? parseFloat($('#advance_salary').val()) : 0;
			$('#overtime_amount').val(overtime_amount);
			$('#total_allowance').val(total_allowance + overtime_amount);
			$('#net_salary').val(($net_salary + overtime_amount) - advance_salary);
		});
    });
</script>