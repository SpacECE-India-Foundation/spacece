<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
                <a href="<?=base_url('live_class');?>">
                    <i class="fas fa-list-ul"></i> <?=translate('lessons') ." ". translate('list')?>
                </a>
			</li>
			<li class="active">
                <a href="#add" data-toggle="tab">
                   <i class="far fa-edit"></i> <?=translate('edit') ." ". translate('live_class')?>
                </a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="add">
					<?php echo form_open($this->uri->uri_string(), array('class' => 'form-bordered form-horizontal frm-submit'));?>
					<input type="hidden" name="live_id" value="<?=$live['id']?>">
					<?php if (is_superadmin_loggedin()): ?>
						<div class="form-group">
							<label class="control-label col-md-3"><?=translate('branch')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<?php
									$arrayBranch = $this->app_lib->getSelectList('branch');
									echo form_dropdown("branch_id", $arrayBranch, $live['branch_id'], "class='form-control' data-width='100%' onchange='getClassByBranch(this.value)'
									data-plugin-selectTwo  data-minimum-results-for-search='Infinity'");
								?>
								<span class="error"></span>
							</div>
						</div>
					<?php endif; ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('title')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="title" value="<?=$live['title']?>" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('zoom_meeting_id')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="zoom_meeting_id" value="<?=$live['meeting_id']?>" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('zoom_meeting_password')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="zoom_meeting_password" value="<?=$live['meeting_password']?>" />
							<span class="error"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('class')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayClass = $this->app_lib->getClass($live['branch_id']);
								echo form_dropdown("class_id", $arrayClass, $live['class_id'], "class='form-control' id='class_id' onchange='getSectionByClass(this.value,0,1)'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('section')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$sel = json_decode($live['section_id'], true);
								$arraySections = $this->app_lib->getSections($live['class_id'], false, true);
								echo form_dropdown("section[]", $arraySections, $sel, "class='form-control' id='section_id' data-plugin-selectTwo data-width='100%' multiple
								data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"></span>
							<div class="checkbox-replace mt-sm pr-xs pull-right">
								<label class="i-checks"><input type="checkbox" class="chk-sendsmsmail" name="chk_section"><i></i> Select All</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('date')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
								<input type="text" class="form-control" name="date" value="<?=$live['date']?>" data-plugin-datepicker
								data-plugin-options='{ "todayHighlight" : true }' />
							</div>
						</div>
						<span class="error"></span>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('time_slot'); ?> <span class="required">*</span></label>
						<div class="col-md-6">
							<div class="row">
								<div class="col-xs-6">
									<div class="input-group">
										<span class="input-group-addon"><i class="far fa-clock"></i></span>
										<input type="text" data-plugin-timepicker class="form-control" name="time_start" value="<?=$live['start_time']?>" />
									</div>
								</div>
								<div class="col-xs-6">
									<div class="input-group">
										<span class="input-group-addon"><i class="far fa-clock"></i></span>
										<input type="text" data-plugin-timepicker class="form-control" name="time_end" value="<?=$live['end_time']?>" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('remarks')?></label>
						<div class="col-md-6 mb-md">
							<textarea name="remarks" rows="2" class="form-control" aria-required="true"><?=$live['remarks']?></textarea>
						</div>
					</div>
				
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-offset-3 col-md-2">
								<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
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
	$(document).ready(function () {
		$('.chk-sendsmsmail').on('change', function() {
			if($(this).is(':checked') ){
				$(this).parents('.form-group').find('select > option').prop("selected","selected");
				$(this).parents('.form-group').find('select').trigger("change");
			} else {
				$(this).parents('.form-group').find('select').val(null).trigger('change');
			}
		});
	});
</script>