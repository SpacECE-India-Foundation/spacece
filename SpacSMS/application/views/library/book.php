<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> <?=translate('books_list')?></a>
			</li>
<?php if (get_permission('book', 'is_add')): ?>
			<li>
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?=translate('create_book')?></a>
			</li>
<?php endif; ?>	
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane active">
				<table class="table table-bordered table-hover table-condensed mb-none tbr-top table-export">
					<thead>
						<tr>
							<th><?=translate('sl')?></th>
						<?php if (is_superadmin_loggedin()): ?>
							<th><?=translate('branch')?></th>
						<?php endif; ?>
							<th><?=translate('book_title')?></th>
							<th width='80px;'><?=translate('cover')?></th>
							<th><?=translate('edition')?></th>
							<th><?=translate('isbn_no')?></th>
							<th><?=translate('category')?></th>
							<th><?=translate('description')?></th>
							<th><?=translate('purchase_date')?></th>
							<th><?=translate('price')?></th>
							<th><?=translate('total_stock')?></th>
							<th><?=translate('issued_copies')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
						<?php $count = 1; foreach($booklist as $row): ?>
						<tr>
							<td><?php echo $count++; ?></td>
						<?php if (is_superadmin_loggedin()): ?>
							<td><?php echo $row['branch_name']; ?></td>
						<?php endif; ?>
							<td><?php echo $row['title']; ?></td>
							<td><img src="<?php echo $this->application_model->get_book_cover_image($row['cover']);?>" alt="" width="70"></td>
							<td><?php echo $row['edition']; ?></td>
							<td><?php echo $row['isbn_no']; ?></td>
							<td><?php echo get_type_name_by_id('book_category', $row['category_id']);?></td>
							<td><?php echo $row['description']; ?></td>
							<td><?php echo _d($row['purchase_date']);?></td>
							<td><?php echo $global_config['currency_symbol'] . ' ' . $row['price']; ?></td>
							<td><?php 
								if($row['total_stock'] == 0){
									echo '<span class="label label-danger">' . translate('unavailable') . '</span>';
								}else{
									echo $row['total_stock'];
								}
								?></td>
							<td><?php echo $row['issued_copies']; ?></td>
							<td class="min-w-c">
							<?php if (get_permission('book', 'is_edit')): ?>
								<!--update link-->
								<a href="<?php echo base_url('library/book_edit/' .  $row['id'] );?>" class="btn btn-default btn-circle icon">
									<i class="fas fa-pen-nib"></i>
								</a>
							<?php endif; if (get_permission('book', 'is_delete')): ?>
								<!--deletion link-->
								<?php echo btn_delete('library/book_delete/' . $row['id']);?>
							<?php endif; ?>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
<?php if (get_permission('book', 'is_add')): ?>
			<div class="tab-pane" id="create">
				<?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit-data'));?>
					<?php if (is_superadmin_loggedin()): ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('branch')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, "", "class='form-control' id='branch_id'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
					<?php endif; ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('book_title')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="book_title" value="" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('book_isbn_no')?></label>
						<div class="col-md-6"><input type="text" class="form-control" name="isbn_no"/></div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('author')?></label>
						<div class="col-md-6"><input type="text" class="form-control" name="author"/></div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('edition')?></label>
						<div class="col-md-6"><input type="text" class="form-control" name="edition"/></div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('purchase_date')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="purchase_date" value="<?=set_value('purchase_date', date('Y-m-d'))?>" data-plugin-datepicker
							data-plugin-options='{ "todayHighlight" : true }' />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('book_category')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$array = $this->app_lib->getSelectByBranch('book_category', $branch_id);
								echo form_dropdown("category_id", $array, set_value('category_id'), "class='form-control' id='book_category_holder' data-plugin-selectTwo
								data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('publisher')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="publisher" value="" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('description')?></label>
						<div class="col-md-6"><input type="text" class="form-control" name="description"/></div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('price')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="price" value="" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('cover_image')?></label>
						<div class="col-md-6"><input type="file" name="cover_image" class="dropify" data-allowed-file-extensions="jpg png" /></div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"> <?=translate('total_stock')?> <span class="required">*</span></label>
						<div class="col-md-6  mb-md">
							<div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0 }'>
								<div class="input-group">
									<input type="text" class="spinner-input form-control" name="total_stock" value="0" maxlength="3" />
									<div class="spinner-buttons input-group-btn">
										<button type="button" class="btn btn-default spinner-up">
											<i class="fas fa-angle-up"></i>
										</button>
										<button type="button" class="btn btn-default spinner-down">
											<i class="fas fa-angle-down"></i>
										</button>
									</div>
								</div>
							</div>
							<span class="error"></span>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-offset-3 col-md-2">
								<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
									<i class="fas fa-plus-circle"></i> <?=translate('save')?>
								</button>
							</div>
						</div>
					</footer>
				<?php echo form_close(); ?>
			</div>
<?php endif; ?>	
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function () {
		$('#branch_id').on('change', function(){
			var branchID = $(this).val();
			$.ajax({
				url: "<?=base_url('ajax/getDataByBranch')?>",
				type: 'POST',
				data: {
					table : 'book_category',
					branch_id : branchID
				},
				success: function (data) {
					$('#book_category_holder').html(data);
				}
			});
		});
	});
</script>