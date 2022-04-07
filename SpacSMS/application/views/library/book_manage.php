<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> <?=translate('books_list')?></a>
			</li>
<?php if (get_permission('book_manage', 'is_add')): ?>
			<li>
				<a href="#issue" data-toggle="tab"><i class="far fa-edit"></i> <?=translate('book_issue')?></a>
			</li>
<?php endif; ?>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane active">
				<table class="table table-bordered table-hover table-condensed mb-none tbr-top table-export">
					<thead>
						<tr>
							<th><?=translate('sl')?></th>
							<th><?=translate('branch')?></th>
							<th><?=translate('book_title')?></th>
							<th width='80px;'><?=translate('cover')?></th>
							<th><?=translate('role')?></th>
							<th><?=translate('user_name')?></th>
							<th><?=translate('date_of_issue')?></th>
							<th><?=translate('date_of_expiry')?></th>
							<th><?=translate('fine')?></th>
							<th><?=translate('status')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
						<?php $count = 1; foreach($booklist as $row){ ?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo $row['branch_name']; ?></td>
							<td><?php echo $row['title']; ?></td>
							<td><img src="<?php echo $this->application_model->get_book_cover_image($row['cover']); ?>" alt="" width="70"></td>
							<td><?php echo $row['role_name'];?></td>
							<td>
							<?php 
								if ($row['role_id'] == 7) {
								 	$getStudent = $this->application_model->getStudentDetails($row['user_id']);
								 	echo $getStudent['first_name'] . " " . $getStudent['last_name'] . '<br><small> - ' .
								 	$getStudent['class_name'] . ' (' . $getStudent['section_name'] . ')</small>';
								} else {
									$getStaff = $this->db->select('name,staff_id')->where('id', $row['user_id'])->get('staff')->row_array();
									echo $getStaff['name'] . '<br><small> - ' . $getStaff['staff_id'] . '</small>';
								}
							?>
							</td>
							<td><?php echo _d($row['date_of_issue']); ?></td>
							<td><?php echo _d($row['date_of_expiry']); ?></td>
							<td><?php echo $global_config['currency_symbol'] . $row['fine_amount']; ?></td>
							<td>
								<?php
								$status = $row['status'];
								if($status == 0)
									echo '<span class="label label-warning-custom">' . translate('pending') . '</span>';
								if ($status == 1)
									echo '<span class="label label-success-custom">' . translate('issued') . '</span>';
								if($status == 2)
									echo '<span class="label label-danger-custom">' . translate('rejected') . '</span>';
								if($status == 3)
									echo '<span class="label label-primary-custom">' . translate('returned') . '</span>';
								?>
							</td>
							<td class="min-w-md">
							<?php if (get_permission('book_manage', 'is_add')): ?>	
								<!--issue details moda -->
								<a href="javascript:void(0);" class="btn btn-circle btn-default" onclick="getBookApprovelDetails('<?=$row['id']?>');">
									<i class="fas fa-bars"></i> <?=translate('details')?>
								</a>
								<?php if($status == 1) { ?>
									<!-- return modal link -->
									<a href="javascript:void(0);" class="btn btn-circle btn-default" data-id="<?=$row['id']?>" data-fine="<?=$row['fine_amount']?>"
									data-expiry="<?=$row['date_of_expiry']?>"  onclick="getBookReturn(this);">
										<i class="fas fa-exchange-alt"></i> <?=translate('return')?>
									</a>
								<?php
								}
							endif;
							if (get_permission('book_manage', 'is_delete')):
								if ($status == 2 || $status == 3) { 
									echo btn_delete('library/issued_book_delete/' . $row['id']);
								}
							endif;
							?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
<?php if (get_permission('book_manage', 'is_add')): ?>
			<div class="tab-pane" id="issue">
				<?php echo form_open('library/bookIssued', array('class' => 'form-horizontal form-bordered frm-submit')); ?>
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
						<label class="col-md-3 control-label"><?=translate('book_category')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayCategory = $this->app_lib->getSelectByBranch('book_category', $branch_id);
								echo form_dropdown("category_id", $arrayCategory, set_value('category_id'), "class='form-control' id='category_id' 
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('book_title')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								if(!empty($category_id)){
									$arrayBook = array("" => translate('select'));
									$books = $this->db->get_where('book', array('category_id' => $category_id))->result();
									foreach ($books as $book){
										$arrayBook[$book->id] = $book->title;
									}
								}else{
									$arrayBook = array("" => translate('select_category_first'));
								}
								echo form_dropdown("book_id", $arrayBook, set_value('book_id'), "class='form-control' id='book_id' 
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
							<span class="error"></span>
						</div>
					</div>
			        <div class="form-group">
						<label class="col-md-3 control-label"><?=translate('role')?> <span class="required">*</span></label>
						<div class="col-md-6">
			                <?php
			                    $role_list = $this->app_lib->getRoles([1,6]);
			                    echo form_dropdown("role_id", $role_list, set_value('role_id'), "class='form-control' id='role_id'
			                    onchange='getStafflistRole()' data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
			                ?>
			                <span class="error"></span>
						</div>
					</div>
					<div class="form-group" id="classDiv" style="display: none;">
						<label class="col-md-3 control-label"><?=translate('class')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$array = array("" => translate('select'));
								echo form_dropdown("class_id", $array, set_value('class_id'), "class='form-control' id='class_id'
								data-plugin-selectTwo data-width='100%' ");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('user_name')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$array = array("" => translate('select'));
								echo form_dropdown("user_id", $array, set_value('user_id'), "class='form-control' id='user_id'
								data-plugin-selectTwo data-width='100%' ");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('date_of_expiry')?> <span class="required">*</span></label>
						<div class="col-md-6 mb-md">
							<input type="text" class="form-control" name="date_of_expiry" value="" data-plugin-datepicker
							data-plugin-options='{ "todayHighlight" : true }' />
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
				<?php echo form_close();?>
			</div>
<?php endif; ?>
		</div>
	</div>
</section>

<!-- View Modal -->
<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
	<section class="panel" id='modal_view'></section>
</div>

<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="bookReturn">
	<section class="panel">
		<header class="panel-heading">
			<h4 class="panel-title">
				<i class="fas fa-exchange-alt"></i> <?=translate('return')?></h4>
			</h4>
		</header>
		<?php echo form_open('library/bookReturn', array('class' => 'form-horizontal frm-submit')); ?>
			<div class="panel-body">
				<input type="hidden" name="issue_id" id="eissue_id" value="" >
				<input type="hidden" name="date_expiry" id="dateExpiry" value="" >
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('type')?> <span class="required">*</span></label>
					<div class="col-md-9">
						<?php
							$arrayType = array(
								'1' => translate('return'),
								'2' => translate('renewal')
							);
							echo form_dropdown("type", $arrayType, "", "class='form-control' id='returnType'
							data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label" id="returnDateText"><?=translate('date')?> <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" data-plugin-datepicker name="date" id="returnDate" value="<?=date("Y-m-d")?>"  />
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('fine_amount')?></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="fine_amount" id="fineAmount" value="" />
						<span class="error"></span>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-default">
							<i class="fas fa-plus-circle"></i> <?=translate('update')?>
						</button>
						<button class="btn btn-default modal-dismiss"><?=translate('cancel')?></button>
					</div>
				</div>
			</footer>
		<?php echo form_close(); ?>
	</section>
</div>

<script type="text/javascript">
	$(document).ready(function () {
        $('#class_id').on('change', function() {
            var class_id = $(this).val();
            var branch_id = ($( "#branch_id" ).length ? $('#branch_id').val() : '');
			$.ajax({
				url: base_url + 'ajax/getStudentByClass',
				type: 'POST',
				data: {
					branch_id: branch_id,
					class_id: class_id
				},
				success: function (data) {
					$('#user_id').html(data);
				}
			});
        });

        $('#branch_id').on('change', function() {
          	getStafflistRole();
          	var branchID = $(this).val();
			$.ajax({
				url: "<?=base_url('ajax/getDataByBranch')?>",
				type: 'POST',
				data: {
					table: 'book_category',
					branch_id: branchID
				},
				success: function (data) {
					$('#category_id').html(data);
				}
			});
        });

        $('#category_id').on('change', function() {
          	var categoryID = $(this).val();
			$.ajax({
				url: "<?=base_url('library/getBooksByCategory')?>",
				type: 'POST',
				data: {
					category_id : categoryID,
				},
				success: function (data) {
					$('#book_id').html(data);
				}
			});
        });

		$('#returnType').on('change', function() {
			var type = $(this).val();
			var date_of_expiry = $("#dateExpiry").val();
			if(type == "1") {
				$("#returnDate").val("<?=date("Y-m-d")?>");
			} else if(type == '2') {
				$("#returnDate").val(date_of_expiry);
			}
		});

	});

	function getStafflistRole() {
	    $('#user_id').html('');
	    $('#user_id').append('<option value=""><?=translate('select')?></option>');
    	var user_role = $('#role_id').val();
    	var branchID = ($( "#branch_id" ).length ? $('#branch_id').val() : "");
        $.ajax({
            url: base_url + 'leave/getCategory',
            type: "POST",
            data:{ 
            	role_id: user_role,
            	branch_id: branchID 
            },
            success: function (data) {
            	$('#leave_category').html(data);
            }
        });

    	if (user_role != "") {
	        if (user_role == 7) {
	        	$("#classDiv").show("slow");
		        $.ajax({
		            url: base_url + 'ajax/getClassByBranch',
		            type: "POST",
		            data:{ branch_id: branchID },
		            success: function (data) {
		            	$('#class_id').html(data);
		            }
		        });
	        }else{
	        	$("#classDiv").hide("slow");
		        $.ajax({
		            url: base_url + 'ajax/getStafflistRole',
		            type: "POST",
		            data:{ 
		            	role_id: user_role,
		            	branch_id: branchID 
		            },
		            success: function (data) {
		            	$('#user_id').html(data);
		            }
		        });
	        }
    	}
	}

	function getBookApprovelDetails(id) {
	    $.ajax({
	        url: base_url + 'library/getBookApprovelDetails',
	        type: 'POST',
	        data: {id: id},
	        dataType: "html",
	        success: function (data) {
				$('#modal_view').html(data);
				mfp_modal('#modal');
	        }
	    });
	}

	function getBookReturn(obj) {
		$('.error').html("");
		$('#returnType').val("1").trigger('change');
		var id = $(obj).data("id");
		var fine = $(obj).data("fine");
		var expiry = $(obj).data("expiry");
		$('#eissue_id').val(id);
		$('#fineAmount').val(fine);
		$('#dateExpiry').val(expiry);
	    mfp_modal('#bookReturn');
	}
</script>