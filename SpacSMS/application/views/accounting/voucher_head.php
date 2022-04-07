<div class="row">
<?php if (get_permission('voucher_head', 'is_add')): ?>
	<div class="col-md-5">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="far fa-edit"></i> <?php echo translate('add') . " " . translate('voucher') . " " . translate('head'); ?></h4>
			</header>
			<?php echo form_open($this->uri->uri_string()); ?>
				<div class="panel-body">
				<?php if (is_superadmin_loggedin()): ?>
					<div class="form-group">
						<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
						<?php
							$arrayBranch = $this->app_lib->getSelectList('branch');
							echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' data-width='100%' id='branch_id'
							data-plugin-selectTwo  data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"><?php echo form_error('branch_id'); ?></span>
					</div>
				<?php endif; ?>
					<div class="form-group">
						<label class="control-label"><?php echo translate('name'); ?> <span class="required">*</span></label>
						<input type="text" class="form-control" name="voucher_head" value="<?php echo set_value('voucher_head'); ?>" />
						<span class="error"><?=form_error('voucher_head')?></span>
					</div>
					<div class="form-group mb-md">
						<label class="control-label"><?php echo translate('type'); ?> <span class="required">*</span></label>
						<?php
							$arrayType = array(
								'' => translate('select'),
								'expense' => 'Expense',
								'income' => 'Income'
							);
							echo form_dropdown("type", $arrayType, set_value('type'), "class='form-control' data-plugin-selectTwo data-width='100%'
							data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"><?=form_error('type')?></span>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-default pull-right" type="submit" name="save" value="1"><i class="fas fa-plus-circle"></i> <?php echo translate('save'); ?></button>
						</div>	
					</div>
				</div>
			<?php echo form_close(); ?>
		</section>
	</div>
<?php endif; ?>
<?php if (get_permission('voucher_head', 'is_view')): ?>
	<div class="col-md-<?php if (get_permission('voucher_head', 'is_add')){ echo "7"; }else{echo "12";} ?>">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-list-ul"></i> <?php echo translate('voucher') . " " . translate('head') . " " . translate('list'); ?></h4>
			</header>

			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-condensed mb-none">
						<thead>
							<tr>
								<th><?=translate('sl')?></th>
								<th><?=translate('branch')?></th>
								<th><?=translate('name')?></th>
								<th><?=translate('type')?></th>
								<th><?=translate('action')?></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$count = 1;
						if (count($productlist)){
							foreach ($productlist as $row):
						?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $row['branch_name'] ; ?></td>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo ucfirst($row['type']); ?></td>
								<td>
								<?php if (get_permission('voucher_head', 'is_edit')): ?>
									<a class="btn btn-default btn-circle icon" href="javascript:void(0);" onclick="getVoucherHead('<?=$row['id']?>')">
										<i class="fas fa-pen-nib"></i>
									</a>
								<?php endif; if (get_permission('voucher_head', 'is_delete')): ?>
									<?php echo btn_delete('accounting/voucher_head_delete/' . $row['id']); ?>
								<?php endif; ?>
								</td>
							</tr>
							<?php
								endforeach;
							}else{
								echo '<tr><td colspan="5"><h5 class="text-danger text-center">' . translate('no_information_available') . '</td></tr>';
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</div>
<?php endif; ?>

<?php if (get_permission('voucher_head', 'is_edit')): ?>
<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
	<section class="panel">
		<header class="panel-heading">
			<h4 class="panel-title">
				<i class="far fa-edit"></i> <?php echo translate('edit') . " " . translate('voucher'). " " . translate('head'); ?>
			</h4>
		</header>
		<?php echo form_open('accounting/voucher_head_edit', array('class' => 'frm-submit')); ?>
			<div class="panel-body">
				<input type="hidden" name="voucher_head_id" id="evoucherhead_id" value="" />
				<?php if (is_superadmin_loggedin()): ?>
				<div class="form-group">
					<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
					<?php
						$arrayBranch = $this->app_lib->getSelectList('branch');
						echo form_dropdown("branch_id", $arrayBranch, "", "class='form-control' id='ebranch_id'
					   	data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					<span class="error"><?=form_error('branch_id')?></span>
				</div>
				<?php endif; ?>
				<div class="form-group mb-md">
					<label class="control-label"><?php echo translate('name'); ?> <span class="required">*</span></label>
					<input type="text" class="form-control" value="" name="voucher_head" id="ename" />
					<span class="error"></span>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-default" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
							<i class="fas fa-plus-circle"></i> <?=translate('update')?>
						</button>
						<button class="btn btn-default modal-dismiss"><?php echo translate('cancel'); ?></button>
					</div>
				</div>
			</footer>
		<?php echo form_close(); ?>
	</section>
</div>
<?php endif; ?>

<script type="text/javascript">
	// get voucher head
	function getVoucherHead(id) {
		$('.error').html("");
	    $.ajax({
	        url: base_url + 'accounting/voucherHeadDetails',
	        type: 'POST',
	        data: {'id': id},
	        dataType: "json",
	        success: function (data) {
				$('#evoucherhead_id').val(data.id);
	            if ($('#ebranch_id').length) {
	                $('#ebranch_id').val(data.branch_id).trigger('change');
	            }
				$('#ename').val(data.name);
				mfp_modal('#modal');
	        }
	    });
	}
</script>