<?php $currency_symbol = $global_config['currency_symbol'];?>
<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> <?php echo translate('reminder') . " " . translate('list'); ?></a>
			</li>
<?php if (get_permission('fees_reminder', 'is_add')){ ?>
			<li class="">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?php echo translate('add') . " " . translate('reminder'); ?></a>
			</li>
<?php } ?>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane active">
				<div class="mb-md">
					<div class="export_title">Fees Type List</div>
					<table class="table table-bordered table-hover table-condensed table-export">
						<thead>
							<tr>
								<th width="50"><?php echo translate('sl'); ?></th>
							<?php if (is_superadmin_loggedin()): ?>
								<th><?=translate('branch')?></th>
							<?php endif; ?>
								<th><?=translate('frequency')?></th>
								<th><?=translate('days')?></th>
								<th><?=translate('notify')?></th>
								<th><?=translate('action')?></th>
							</tr>
						</thead>
						<tbody>
							<?php $count = 1; foreach ($reminderlist as $row): ?>
							<tr>
								<td><?php echo $count++; ?></td>
							<?php if (is_superadmin_loggedin()): ?>
								<td><?php echo $row['branch_name'];?></td>
							<?php endif; ?>
								<td><?php echo ucfirst($row['frequency']); ?></td>
								<td><?php echo $row['days']; ?></td>
								<td><?php 
								echo ($row['student'] == 1 ? '- Student <br>' : '');
								echo ($row['guardian'] == 1 ? '- Guardian' : '');
								?></td>
								<td>
									<?php if (get_permission('fees_reminder', 'is_edit')): ?>
										<a href="<?php echo base_url('fees/edit_reminder/' . $row['id']); ?>" class="btn btn-circle btn-default icon"
										data-toggle="tooltip" data-original-title="<?php echo translate('edit'); ?>"> 
											<i class="fas fa-pen-nib"></i>
										</a>
									<?php endif; if (get_permission('fees_reminder', 'is_delete')): ?>
										<?php echo btn_delete('fees/reminder_delete/' . $row['id']); ?>
									<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
<?php if (get_permission('fees_reminder', 'is_add')){ ?>
			<div class="tab-pane" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'frm-submit')); ?>
					<div class="form-horizontal form-bordered mb-lg">
					<?php if (is_superadmin_loggedin() ): ?>
						<div class="form-group">
							<label class="control-label col-md-3"><?=translate('branch')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<?php
									$arrayBranch = $this->app_lib->getSelectList('branch');
									echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id', $branch_id), "class='form-control' id='branch_id'
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
								?>
								<span class="error"></span>
							</div>
						</div>
						<?php endif; ?>
						<div class="form-group">
							<label class="control-label col-md-3"><?=translate('frequency')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<?php
									$arrayType = array(
										'' => translate('select'), 
										'before' => translate('before'), 
										'after' => translate('after'), 
									);
									echo form_dropdown("frequency", $arrayType, set_value('frequency', $branch_id), "class='form-control'
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
								?>
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('days')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="days" value="<?=set_value('days')?>" autocomplete="off" />
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('message')?></label>
							<div class="col-md-6">
								<textarea class="form-control" id="message" name="message" placeholder="" rows="3" ></textarea>
								<span class="error"></span>
								<div class="pull-right pr-xs pl-xs alert-danger"> 
									<span id="remaining_count"> 160 characters remaining</span> <span id="messages">1 message </span>
								</div>
								<div class="mt-xlg">
									<strong>Dynamic Tag : </strong>
									<a data-value=" {guardian_name} " class="btn btn-default btn-xs btn_tag ">{guardian_name}</a>
									<a data-value=" {child_name} " class="btn btn-default btn-xs btn_tag ">{child_name}</a>
									<a data-value=" {due_date} " class="btn btn-default btn-xs btn_tag">{due_date}</a>
									<a data-value=" {due_amount} " class="btn btn-default btn-xs btn_tag">{due_amount}</a>
									<a data-value=" {fee_type} " class="btn btn-default btn-xs btn_tag">{fee_type}</a>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('notify')?></label>
							<div class="col-md-6 mb-md">
								<div class="checkbox-replace mt-sm pr-xs">
									<label class="i-checks"><input type="checkbox" name="chk_student"><i></i> <?=translate('student')?></label>
								</div>
								<div class="checkbox-replace mt-sm pr-xs">
									<label class="i-checks"><input type="checkbox" name="chk_guardian"><i></i> <?=translate('guardian')?></label>
								</div>
							</div>
						</div>

					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-2 col-md-offset-3">
								<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
									<i class="fas fa-plus-circle"></i> <?php echo translate('save'); ?>
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

<script type="text/javascript">
	// SMS characters counter
    var $remaining = $('#remaining_count'),
        $messages = $remaining.next();
    $('#message').keyup(function(){
        var chars = this.value.length,
            messages = Math.ceil(chars / 160),
            remaining = messages * 160 - (chars % (messages * 160) || messages * 160);

        $remaining.text(remaining + ' characters remaining');
        $messages.text(messages + ' message');
    });

	$('.btn_tag').on('click', function() {
		var $txt = $("#message");
     	var caretPos = $txt[0].selectionStart;
        var textAreaTxt = $txt.val();
        var txtToAdd = $(this).data("value");
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos) );
	});
</script>