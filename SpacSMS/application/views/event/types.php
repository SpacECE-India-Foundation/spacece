<div class="row">
<?php if (get_permission('event_type', 'is_add')): ?>
	<div class="col-md-5">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><?=translate('add') . " " . translate('event_type')?></h4>
			</header>
			<?php echo form_open($this->uri->uri_string());?>
				<div class="panel-body">
					<?php if (is_superadmin_loggedin()): ?>
					<div class="form-group">
						<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
						<?php
							$arrayBranch = $this->app_lib->getSelectList('branch');
							echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' id='branch_id'
							data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"><?=form_error('branch_id')?></span>
					</div>
					<?php endif; ?>
					<div class="form-group">
						<label class="control-label"><?=translate('name')?> <span class="required">*</span></label>
						<input type="text" class="form-control" name="type_name" value="<?=set_value('type_name')?>" />
						<span class="error"><?=form_error('type_name')?></span>
					</div>
					<div class="form-group mb-xs">
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="bullhorn" checked name="event_icon" id="bullhorn">
							<label for="bullhorn"><i class="fas fa-bullhorn"></i></label>
						</div>

						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="flag-checkered" name="event_icon" id="flag">
							<label for="flag"><i class="fas fa-flag-checkered"></i></label>
						</div>

						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="comments" name="event_icon" id="comments">
							<label for="comments"><i class="fas fa-comments"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="concierge-bell" name="event_icon" id="concierge-bell">
							<label for="concierge-bell"><i class="fas fa-concierge-bell"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="envelope" name="event_icon" id="envelope">
							<label for="envelope"><i class="fas fa-envelope"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="comment-alt" name="event_icon" id="comment-alt">
							<label for="comment-alt"><i class="fas fa-comment-alt"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="users" name="event_icon" id="users">
							<label for="users"><i class="fas fa-users"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="star" name="event_icon" id="star">
							<label for="star"><i class="far fa-star"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="stamp" name="event_icon" id="stamp">
							<label for="stamp"><i class="fas fa-stamp"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="search" name="event_icon" id="search">
							<label for="search"><i class="fas fa-search"></i></label>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-default pull-right" type="submit" name="save" value="1">
								<i class="fas fa-plus-circle"></i> <?=translate('save')?>
							</button>
						</div>	
					</div>
				</div>
			<?php echo form_close();?>
		</section>
	</div>
<?php endif; ?>
<?php if (get_permission('event_type', 'is_view')): ?>
	<div class="col-md-<?php if (get_permission('event_type', 'is_add')){ echo "7"; }else{ echo "12"; } ?>">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-list-ul"></i> <?=translate('event_type') . " " . translate('list')?></h4>
			</header>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-condensed mb-none">
						<thead>
							<tr>
								<th><?=translate('sl')?></th>
								<th><?=translate('branch')?></th>
								<th><?=translate('icon')?></th>
								<th><?=translate('term_name')?></th>
								<th><?=translate('action')?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$count = 1;
							if (count($typelist)){
								foreach ($typelist as $row):
							?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['branch_name']; ?></td>
								<td><i class="text-xl fas fa-<?=html_escape($row['icon'])?>"></i></td>
								<td><?php echo $row['name']; ?></td>
								<td>
								<?php if (get_permission('event_type', 'is_edit')): ?>
									<!-- update link -->
									<a class="btn btn-default btn-circle icon evt_modal" href="javascript:void(0);" data-id="<?=$row['id']?>" data-name="<?=$row['name']?>"
									data-branch="<?=$row['branch_id']?>" data-icon="<?=$row['icon']?>">
										<i class="fas fa-pen-nib"></i>
									</a>
								<?php endif; if (get_permission('event_type', 'is_delete')): ?>
									<!-- delete link -->
									<?php echo btn_delete('event/type_delete/' . $row['id']);?>
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
<?php if (get_permission('event_type', 'is_edit')): ?>
<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
	<section class="panel">
		<?php echo form_open('event/types_edit', array('class' => 'frm-submit')); ?>
			<header class="panel-heading">
				<h4 class="panel-title"><i class="far fa-edit"></i> <?=translate('edit') . " " . translate('event_type')?></h4>
			</header>
			<div class="panel-body">
				<input type="hidden" name="type_id" id="etype_id" value="" />
				<?php if (is_superadmin_loggedin()): ?>
				<div class="form-group">
					<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
					<?php
						$arrayBranch = $this->app_lib->getSelectList('branch');
						echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' id='ebranch_id'
						id='branch_id' data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					<span class="error"></span>
				</div>
				<?php endif; ?>
				<div class="form-group mb-md">
					<label class="control-label"><?=translate('name')?> <span class="required">*</span></label>
					<input type="text" class="form-control" name="type_name" id="ename" value="" />
					<span class="error"></span>
				</div>
					<div class="form-group mb-xs">
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="bullhorn" checked name="event_icon" id="bullhorn">
							<label for="bullhorn"><i class="fas fa-bullhorn"></i></label>
						</div>

						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="flag-checkered" name="event_icon" id="flag">
							<label for="flag"><i class="fas fa-flag-checkered"></i></label>
						</div>

						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="comments" name="event_icon" id="comments">
							<label for="comments"><i class="fas fa-comments"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="concierge-bell" name="event_icon" id="concierge-bell">
							<label for="concierge-bell"><i class="fas fa-concierge-bell"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="envelope" name="event_icon" id="envelope">
							<label for="envelope"><i class="fas fa-envelope"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="comment-alt" name="event_icon" id="comment-alt">
							<label for="comment-alt"><i class="fas fa-comment-alt"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="users" name="event_icon" id="users">
							<label for="users"><i class="fas fa-users"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="star" name="event_icon" id="star">
							<label for="star"><i class="far fa-star"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="stamp" name="event_icon" id="stamp">
							<label for="stamp"><i class="fas fa-stamp"></i></label>
						</div>
						<div class="radio-custom radio-success radio-inline">
							<input type="radio" value="search" name="event_icon" id="search">
							<label for="search"><i class="fas fa-search"></i></label>
						</div>
					</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-default" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
							<i class="fas fa-plus-circle"></i> <?=translate('update')?>
						</button>
						<button class="btn btn-default modal-dismiss"><?=translate('cancel')?></button>
					</div>
				</div>
			</footer>
		<?php echo form_close();?>
	</section>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('.evt_modal').on('click', function() {
			var id = $(this).data('id');
			var name = $(this).data('name');
			var icon = $(this).data('icon');
			var branch = $(this).data('branch'); 
			$('#etype_id').val(id);
			$('#ename').val(name);
			$(".frm-submit input[name=event_icon][value=" + icon + "]").prop('checked', true);
            if ($('#ebranch_id').length) {
                $('#ebranch_id').val(branch).trigger('change');
            }
			mfp_modal('#modal');
		});
	});
</script>
<?php endif; ?>