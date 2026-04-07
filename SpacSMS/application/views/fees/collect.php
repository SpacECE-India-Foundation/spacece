<?php $currency_symbol = $global_config['currency_symbol']; ?>
<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#invoice" data-toggle="tab"><i class="far fa-credit-card"></i> <?=translate('invoice')?></a>
			</li>
<?php if ($invoice['status'] != 'unpaid'): ?>
			<li>
				<a href="#history" data-toggle="tab"><i class="fas fa-dollar-sign"></i> <?=translate('payment_history')?></a>
			</li>
<?php endif; ?>
<?php if (get_permission('collect_fees', 'is_add') && $invoice['status'] != 'total'): ?>
			<li>
				<a href="#collect_fees" data-toggle="tab"><i class="fas fa-hand-holding-usd"></i> <?=translate('collect_fees')?></a>
			</li>
<?php endif; ?>
		</ul>
		<div class="tab-content">
			<div id="invoice" class="tab-pane <?=empty($this->session->flashdata('pay_tab')) ? 'active' : ''; ?>">
				<div id="invoice_print">
					<div class="invoice">
						<header class="clearfix">
							<div class="row">
								<div class="col-xs-6">
									<div class="ib">
										<img src="<?=base_url('uploads/app_image/printing-logo.png')?>" alt="RamomCoder Img" />
									</div>
								</div>
								<div class="col-md-6 text-right">
									<h4 class="mt-none mb-none text-dark">Invoice No #<?=$invoice['invoice_no']?></h4>
									<p class="mb-none">
										<span class="text-dark"><?=translate('date')?> : </span>
										<span class="value"><?=_d(date('Y-m-d'))?></span>
									</p>
									<p class="mb-none">
										<span class="text-dark"><?=translate('status')?> : </span>
										<?php
											$labelmode = '';
											if($invoice['status'] == 'unpaid') {
												$status = translate('unpaid');
												$labelmode = 'label-danger-custom';
											} elseif($invoice['status'] == 'partly') {
												$status = translate('partly_paid');
												$labelmode = 'label-info-custom';
											} elseif($invoice['status'] == 'total') {
												$status = translate('total_paid');
												$labelmode = 'label-success-custom';
											}
											echo "<span class='value label " . $labelmode . " '>" . $status . "</span>";
										?>
									</p>
								</div>
							</div>
						</header>
						<div class="bill-info">
							<div class="row">
								<div class="col-xs-6">
									<div class="bill-data">
										<p class="h5 mb-xs text-dark text-weight-semibold">Invoice To :</p>
										<address>
											<?php 
											echo $basic['first_name'] . ' ' . $basic['last_name'] . '<br>';
											echo $basic['student_address'] . '<br>';
											echo translate('class') . ' : ' . $basic['class_name'] . '<br>';
											echo translate('email') . ' : ' . $basic['student_email']; 
											?>
										</address>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="bill-data text-right">
										<p class="h5 mb-xs text-dark text-weight-semibold">Academic :</p>
										<address>
											<?php 
											echo $basic['school_name'] . "<br/>";
											echo $basic['school_address'] . "<br/>";
											echo $basic['school_mobileno'] . "<br/>";
											echo $basic['school_email'] . "<br/>";
											?>
										</address>
									</div>
								</div>
							</div>
						</div>

						<div class="table-responsive br-none">
							<table class="table invoice-items table-hover mb-none">
								<thead>
									<tr class="text-dark">
										<th id="cell-id" class="text-weight-semibold">#</th>
										<th id="cell-item" class="text-weight-semibold"><?=translate("fees_type")?></th>
										<th id="cell-id" class="text-weight-semibold"><?=translate("due_date")?></th>
										<th id="cell-price" class="text-weight-semibold"><?=translate("status")?></th>
										<th id="cell-price" class="text-weight-semibold"><?=translate("amount")?></th>
										<th id="cell-price" class="text-weight-semibold"><?=translate("discount")?></th>
										<th id="cell-price" class="text-weight-semibold"><?=translate("fine")?></th>
										<th id="cell-price" class="text-weight-semibold"><?=translate("paid")?></th>
										<th id="cell-total" class="text-center text-weight-semibold"><?=translate("balance")?></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count = 1;
										$total_fine = 0;
										$total_discount = 0;
										$total_paid = 0;
										$total_balance = 0;
										$total_amount = 0;
										$typeData = array('' => translate('select'));
										$allocations = $this->fees_model->getInvoiceDetails($basic['id']);
										foreach ($allocations as $row) {
											$deposit = $this->fees_model->getStudentFeeDeposit($row['allocation_id'], $row['fee_type_id']);
											$type_discount = $deposit['total_discount'];
											$type_fine = $deposit['total_fine'];
											$type_amount = $deposit['total_amount'];
											$balance = $row['amount'] - ($type_amount + $type_discount);
											$total_discount += $type_discount;
											$total_fine += $type_fine;
											$total_paid += $type_amount;
											$total_balance += $balance;
											$total_amount += $row['amount'];
											if ($balance != 0) {
											 	$typeData[$row['allocation_id'] . "|" . $row['fee_type_id']] = $row['name'];
											}
										?>
									<tr>
										<td><?php echo $count++;?></td>
										<td class="text-weight-semibold text-dark"><?=$row['name']?></td>
										<td><?=_d($row['due_date'])?></td>
										<td><?php 
											$status = 0;
											$labelmode = '';
											if($type_amount == 0) {
												$status = translate('unpaid');
												$labelmode = 'label-danger-custom';
											} elseif($balance == 0) {
												$status = translate('total_paid');
												$labelmode = 'label-success-custom';
											} else {
												$status = translate('partly_paid');
												$labelmode = 'label-info-custom';
											}
											echo "<span class='label ".$labelmode." '>".$status."</span>";
										?></td>
										<td><?php echo $currency_symbol . $row['amount'];?></td>
										<td><?php echo $currency_symbol . $type_discount;?></td>
										<td><?php echo $currency_symbol . $type_fine;?></td>
										<td><?php echo $currency_symbol . $type_amount;?></td>
										<td class="text-center"><?php echo $currency_symbol . number_format($balance, 2, '.', '');?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="invoice-summary text-right mt-lg">
							<div class="row">
								<div class="col-lg-5 pull-right">
									<ul class="amounts">
										<li><strong><?=translate('grand_total')?> :</strong> <?=$currency_symbol . number_format($total_amount, 2, '.', ''); ?></li>
										<li><strong><?=translate('paid')?> :</strong> <?=$currency_symbol . number_format($total_paid, 2, '.', ''); ?></li>
										<li><strong><?=translate('discount')?> :</strong> <?=$currency_symbol . number_format($total_discount, 2, '.', ''); ?></li>
										<li><strong><?=translate('fine')?> :</strong> <?=$currency_symbol . number_format($total_fine, 2, '.', ''); ?></li>
										<?php if ($total_balance != 0): ?>
										<li>
											<strong><?=translate('balance')?> : </strong> 
											<?php
											$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
											echo $currency_symbol . number_format($total_balance, 2, '.', '') . ' </br>( ' . ucwords($f->format($total_balance)) . ' )' ;
											?>
										</li>
										<?php else: ?>
										<li>
											<strong><?=translate('total_paid')?> : </strong> 
											<?php
											$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
											echo $currency_symbol . number_format(($total_paid + $total_fine), 2, '.', '') . ' </br>( ' . ucwords($f->format(($total_paid + $total_fine))) . ' )' ;
											?>
										</li>
										<?php endif; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="text-right mr-lg hidden-print">
						<button onClick="fn_printElem('invoice_print')" class="btn btn-default ml-sm"><i class="fas fa-print"></i> <?=translate('print')?></button>
					</div>
				</div>
			</div>
			<?php if ($invoice['status'] != 'unpaid'): ?>
			<div class="tab-pane" id="history">
				<div id="payment_print">
					<div class="invoice payment">
						<header class="clearfix">
							<div class="row">
								<div class="col-xs-6">
									<div class="ib">
										<img src="<?=base_url('uploads/app_image/printing-logo.png')?>" alt="RamomCoder Img" />
									</div>
								</div>
								<div class="col-md-6 text-right">
									<h4 class="mt-none mb-none text-dark">Invoice No #<?= $invoice['invoice_no']?></h4>
									<p class="mb-none">
										<span class="text-dark"><?=translate('date')?> : </span>
										<span class="value"><?php echo _d(date('Y-m-d'));?></span>
									</p>
									<p class="mb-none">
										<span class="text-dark"><?=translate('status')?> : </span>
										<?php
											$labelmode = '';
											if($invoice['status'] == 'unpaid') {
												$status = translate('unpaid');
												$labelmode = 'label-danger-custom';
											} elseif($invoice['status'] == 'partly') {
												$status = translate('partly_paid');
												$labelmode = 'label-info-custom';
											} elseif($invoice['status'] == 'total') {
												$status = translate('total_paid');
												$labelmode = 'label-success-custom';
											}
											echo "<span class='value label ".$labelmode." '>".$status."</span>";
										?>
									</p>
								</div>
							</div>
						</header>
						<div class="bill-info">
							<div class="row">
								<div class="col-xs-6">
									<div class="bill-data">
										<p class="h5 mb-xs text-dark text-weight-semibold">Invoice To :</p>
										<address>
											<?php 
											echo $basic['first_name'] . ' '. $basic['last_name'] . '<br>';
											echo $basic['student_address'] . '<br>';
											echo translate('class').' : '. $basic['class_name'] . '<br>';
											echo translate('email').' : '. $basic['student_email']; 
											?>
										</address>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="bill-data text-right">
										<p class="h5 mb-xs text-dark text-weight-semibold">Academic :</p>
										<address>
											<?php 
											echo $basic['school_name'] . "<br/>";
											echo $basic['school_address'] . "<br/>";
											echo $basic['school_mobileno'] . "<br/>";
											echo $basic['school_email'] . "<br/>";
											?>
										</address>
									</div>
								</div>
							</div>
						</div>

						<table class="table invoice-items" id="invoice">
							<thead>
								<tr class="h5 text-dark">
									<th id="cell-id" class="text-weight-semibold hidden-print">
										<div class="checkbox-replace" >
											<label class="i-checks" data-toggle="tooltip" data-original-title="Print Show / Hidden">
												<input type="checkbox" name="select-all" id="selectAllchkbox" checked> <i></i>
											</label>
										</div>
									</th>
									<th id="cell-item" class="text-weight-semibold"><?=translate('fees_type')?></th>
									<th id="cell-item" class="text-weight-semibold"><?=translate('fees_code')?></th>
									<th id="cell-item" class="text-weight-semibold"><?=translate('date')?></th>
									<th id="cell-item" class="text-weight-semibold hidden-print"><?=translate('collect_by')?></th>
									<th id="cell-desc" class="text-weight-semibold"><?=translate('remarks')?></th>
									<th id="cell-qty" class="text-weight-semibold"><?=translate('method')?></th>
									<th id="cell-price" class="text-weight-semibold"><?=translate('amount')?></th>
									<th id="cell-price" class="text-weight-semibold"><?=translate('discount')?></th>
									<th id="cell-price" class="text-weight-semibold"><?=translate('fine')?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$allocations = $this->db->where(array('student_id' => $basic['id'], 'session_id' => get_session_id()))->get('fee_allocation')->result_array();
								foreach ($allocations as $allRow) {
									$historys = $this->fees_model->getPaymentHistory($allRow['id'], $allRow['group_id']);
									foreach ($historys as $row) {
								?>
								<tr>
									<td class="hidden-print checked-area">
										<div class="checkbox-replace">
											<label class="i-checks"><input type="checkbox" name="chkPrint" checked ><i></i></label>
										</div>
									</td>
									<td class="text-weight-semibold text-dark"><?=$row['name']?></td>
									<td><?=$row['fee_code']?></td>
									<td><?=_d($row['date'])?></td>
									<td class="hidden-print">
										<?php
											if ($row['collect_by'] == 'online') {
												echo translate('online');
											}else{
												echo get_type_name_by_id('staff', $row['collect_by']);
											}
										?>
									</td>
									
									<td><?=$row['remarks']?></td>
									<td><?=$row['payvia']?></td>
									<td><?=$currency_symbol . $row['amount']?></td>
									<td><?=$currency_symbol . $row['discount']?></td>
									<td><?=$currency_symbol . $row['fine']?></td>
								</tr>
								 <?php } } ?>
							</tbody>
						</table>
						<div class="invoice-summary text-right mt-lg">
							<div class="row">
								<div class="col-lg-5 pull-right">
									<ul class="amounts">
										<li><strong><?=translate('grand_total')?> :</strong> <?=$currency_symbol . number_format($total_amount, 2, '.', ''); ?></li>
										<li><strong><?=translate('paid')?> :</strong> <?=$currency_symbol . number_format($total_paid, 2, '.', ''); ?></li>
										<li><strong><?=translate('discount')?> :</strong> <?=$currency_symbol . number_format($total_discount, 2, '.', ''); ?></li>
										<li><strong><?=translate('fine')?> :</strong> <?=$currency_symbol . number_format($total_fine, 2, '.', ''); ?></li>
										<?php if ($total_balance != 0): ?>
										<li>
											<strong><?=translate('balance')?> : </strong> 
											<?php
											$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
											echo $currency_symbol . number_format($total_balance, 2, '.', '') . ' </br>( ' . ucwords($f->format($total_balance)) . ' )' ;
											?>
										</li>
										<?php else: ?>
										<li>
											<strong><?=translate('total_paid')?> : </strong> 
											<?php
											$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
											echo $currency_symbol . number_format(($total_paid + $total_fine), 2, '.', '') . ' </br>( ' . ucwords($f->format(($total_paid + $total_fine))) . ' )' ;
											?>
										</li>
										<?php endif; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="text-right mr-lg hidden-print">
						<button onClick="fn_printElem('payment_print')" class="btn btn-default"><i class="fas fa-print"></i> <?=translate('print')?></button>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			<!--add fees form-->
			<?php if($invoice['status'] != 'total'): ?>
				<div id="collect_fees" class="tab-pane">
					<?php echo form_open('fees/fee_add', array('class' => 'form-horizontal frm-submit' )); ?>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('fees_type')?> <span class="required">*</span></label>
							<div class="col-md-6">
							<?php
								echo form_dropdown("fees_type", $typeData, set_value('fees_type'), "class='form-control' id='fees_type'
								data-plugin-selectTwo data-width='100%' ");
							?>
							<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('date')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" data-plugin-datepicker
								data-plugin-options='{"todayHighlight" : true}' name="date" value="<?=date('Y-m-d')?>" autocomplete="off" />
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('amount')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="amount" id="feeAmount" value="" autocomplete="off" />
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('discount')?></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="discount_amount" value="0" autocomplete="off" />
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('fine')?></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="fine_amount" id="fineAmount" value="0" autocomplete="off" />
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('payment_method')?> <span class="required">*</span></label>
							<div class="col-md-6">
	    						<?php
	    							$payvia_list = $this->app_lib->getSelectList('payment_types');
	    							echo form_dropdown("pay_via", $payvia_list, set_value('pay_via'), "class='form-control' data-plugin-selectTwo data-width='100%'
	    							data-minimum-results-for-search='Infinity' ");
	    						?>
								<span class="error"></span>
							</div>
						</div>
                        <?php
                        $links = $this->fees_model->get('transactions_links', array('branch_id' => $basic['branch_id']), true);
                        if ($links['status'] == 1) {
                        ?>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo translate('account'); ?> <span class="required">*</span></label>
                               	<div class="col-md-6">
                                <?php
                                    $accounts_list = $this->app_lib->getSelectByBranch('accounts', $basic['branch_id']);
                                    echo form_dropdown("account_id", $accounts_list, $links['deposit'], "class='form-control' id='account_id' required data-plugin-selectTwo data-width='100%'");
                                ?>
                            	</div>
                            </div>
                        <?php } ?>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('remarks')?></label>
							<div class="col-md-6 mb-md">
								<textarea name="remarks" rows="2" class="form-control" placeholder="<?=translate('write_your_remarks')?>"></textarea>
								<div class="checkbox-replace mt-lg">
									<label class="i-checks">
										<input type="checkbox" name="guardian_sms" checked> <i></i> Guardian Confirmation Sms
									</label>
								</div>
							</div>
						</div>
						<input type="hidden" name="branch_id" value="<?=$basic['branch_id']?>">
						<input type="hidden" name="student_id" value="<?=$basic['id']?>">
						<footer class="panel-footer">
							<div class="row">
								<div class="col-md-offset-3 col-md-3">
									<button type="submit" class="btn btn-default" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
										<?=translate('fee_payment')?>
									</button>
								</div>
							</div>
						</footer>
					<?php echo form_close();?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<script type="text/javascript">
    $('#fees_type').on("change", function(){
        var typeID = $(this).val();

	    $.ajax({
	        url: base_url + 'fees/getBalanceByType',
	        type: 'POST',
	        data: {
	        	'typeID': typeID
	        },
	        dataType: "json",
	        success: function (data) {
	            $('#feeAmount').val(data.balance.toFixed(2));
	            $('#fineAmount').val(data.fine.toFixed(2));
	        }
	    });
    });
</script>