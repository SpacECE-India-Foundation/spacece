<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('fees/group')?>"><i class="fas fa-list-ul"></i> <?php echo translate('fees_group') . " " . translate('list'); ?></a>
			</li>
			<li class="active">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?php echo translate('edit') . " " . translate('fees_group'); ?></a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'frm-submit')); ?>
				<input type="hidden" name="group_id" value="<?=$group['id']?>">
					<div class="form-horizontal form-bordered mb-lg">
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo translate('group_name'); ?> <span class="required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="<?=$group['name']?>" autocomplete="off" />
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo translate('description'); ?></label>
							<div class="col-md-6 mb-md">
								<textarea class="form-control" id="description" name="description" placeholder="" rows="3" ><?=$group['description']?></textarea>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="tableID">
							<thead>
								<th>
									<div class="checkbox-replace">
										<label class="i-checks">
											<input type="checkbox" name="select_chkbox" id="selectAllchkbox"><i></i>
										</label>
									</div>
								</th>
								<th><?php echo translate('fees_type'); ?> <span class="required">*</span></th>
								<th><?php echo translate('due_date'); ?> <span class="required">*</span></th>
								<th><?php echo translate('amount'); ?> <span class="required">*</span></th>
							</thead>
							<tbody>
								<?php
								$this->db->where('branch_id', $group['branch_id']);
								$result = $this->db->get('fees_type')->result_array();
								foreach ($result as $key => $row) {
									$this->db->where('fee_groups_id', $group['id']);
									$this->db->where('fee_type_id', $row['id']);
									$details = $this->db->get('fee_groups_details')->row_array();
								?>
								<tr>
									<td class="checked-area" width="60">
										<div class="checkbox-replace">
											<label class="i-checks">
												<input type="checkbox" name="elem[<?=$key?>][fees_type_id]" <?=($row['id'] == $details['fee_type_id'] ? 'checked' : '')?> value="<?=$row['id']?>"> <i></i>
											</label>
										</div>
									</td>
									<td class="min-w-lg">
										<div class="form-group"><?php echo $row['name']; ?></div>
									</td>
									<td class="min-w-sm">
										<div class="form-group">
											<input type="text" class="form-control" name="elem[<?php echo $key; ?>][due_date]" value="<?=$details['due_date']?>" data-plugin-datepicker
											data-plugin-options='{"startView": 1}' autocomplete="off" />
											<span class="error"></span>
										</div>
									</td>
									<td class="min-w-lg">
										<div class="form-group">
											<input type="text" name="elem[<?php echo $key; ?>][amount]" class="form-control" autocomplete="off" value="<?=$details['amount']?>" />
											<span class="error"></span>
										</div>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-2 col-md-offset-10">
								<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
									<i class="fas fa-plus-circle"></i> <?php echo translate('update'); ?>
								</button>
							</div>
						</div>	
					</footer>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</section>