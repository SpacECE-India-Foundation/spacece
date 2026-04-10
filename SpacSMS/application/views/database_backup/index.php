<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#database_backup" data-toggle="tab">
				   <i class="fas fa-database"></i> <?=translate('database_list') ?>
				</a>
			</li>
<?php if(get_permission('backup_restore', 'is_add')) {?>
			<li>
				<a href="#restore_database" data-toggle="tab">
				   <i class="fas fa-upload"></i> <?=translate('restore_database') ?>
				</a>
			</li>
<?php } ?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane box active" id="database_backup">
			<div class="row">
			<div class="col-md-12">
				<div class="pull-right mb-md">
					<a href="<?php echo base_url('backup/create'); ?>" class="btn btn-default btn-sm">
						<i class="fas fa-paste"></i> <?=translate('create_backup') ?>
					</a>
				</div>
			</div>
			</div>
				<table class="table table-bordered table-hover table-export">
					<thead>
						<tr>
							<th width="60">#</th>
							<th><?=translate('backup')?></th>
							<th><?=translate('backup_size')?></th>
							<th><?=translate('date')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$count = 1;
						$files = get_filenames(FCPATH.'/uploads/db_backup/');
						if (!empty($files)){
							foreach ($files as $file):
							$_fullpath = FCPATH.'/uploads/db_backup/'.$file;
						?>
						<tr>
							<td><?php echo $count++;?></td>
							<td><?php echo $file?></td>
							<td><?php echo bytesToSize($_fullpath);?></td>
							<td><?php
							    $getFormat = get_global_setting('date_format');
							    echo  date($getFormat, filectime($_fullpath)) . ", " . date('g:i A', filectime($_fullpath));
							?></td>
							<td>
								<!-- download link -->
								<a href="<?=base_url('backup/download?file='.$file) ?>" class="btn btn-circle btn-default">
								<i class="fas fa-download"></i> <?=translate('download')?>
								</a>
								<?php if(get_permission('backup', 'is_delete')) { ?>
								<!-- deletion link -->
								<?php echo btn_delete('backup/delete_file/' . $file);?>
								<?php } ?>
							</td>
						</tr>
						<?php endforeach; }; ?>
					</tbody>
				</table>
			</div>
<?php if(get_permission('backup_restore', 'is_add')) { ?>
			<div class="tab-pane box" id="restore_database">
			<?php echo form_open_multipart('backup/restore_file', array('class' => 'form-horizontal frm-submit-data'));?>
				<div class="form-group mb-lg">
					<label class="col-md-3 control-label"><?=translate('file_upload')?> <span class="required" aria-required="true">*</span></label>
					<div class="col-md-7">
						<input type="file" name="uploaded_file" class="dropify" data-height="140" data-allowed-file-extensions="zip" />
						<span class="error"></span>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-2 col-sm-offset-3">
						 <button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
						 	<i class="fas fa-cloud-upload-alt"></i> <?=translate('upload')?> SQL
						 </button>
						</div>
					</div>	
				</footer>
			<?php echo form_close();?>
			</div>
<?php } ?>
		</div>
	</div>
</section>