<?php $currency_symbol = $global_config['currency_symbol'];?>
<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('fees/reminder')?>"><i class="fas fa-list-ul"></i> <?php echo translate('reminder') . " " . translate('list'); ?></a>
			</li>
			<li class="active">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?php echo translate('edit') . " " . translate('reminder'); ?></a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'frm-submit')); ?>
					<div class="form-horizontal form-bordered mb-lg">
						<input type="hidden" name="reminder_id" value="<?=$reminder['id']?>">
					<?php if (is_superadmin_loggedin() ): ?>
						<div class="form-group">
							<label class="control-label col-md-3"><?=translate('branch')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<?php
									$arrayBranch = $this->app_lib->getSelectList('branch');
									echo form_dropdown("branch_id", $arrayBranch, $reminder['branch_id'], "class='form-control' id='branch_id'
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
									echo form_dropdown("frequency", $arrayType, $reminder['frequency'], "class='form-control'
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
								?>
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('days')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="days" value="<?=$reminder['days']?>" autocomplete="off" />
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('message')?></label>
							<div class="col-md-6">
								<textarea class="form-control" id="message" name="message" placeholder="" rows="3"><?=$reminder['message']?></textarea>
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
									<label class="i-checks"><input type="checkbox" <?=($reminder['student'] == 1 ? 'checked' : '')?> name="chk_student"><i></i> <?=translate('student')?></label>
								</div>
								<div class="checkbox-replace mt-sm pr-xs">
									<label class="i-checks"><input type="checkbox" <?=($reminder['guardian'] == 1 ? 'checked' : '')?> name="chk_guardian"><i></i> <?=translate('guardian')?></label>
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