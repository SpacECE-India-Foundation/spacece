<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> <?php echo translate('book_issued'); ?></a>
			</li>
<?php if (is_student_loggedin()) { ?>
			<li>
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?php echo translate('book_request'); ?></a>
			</li>
<?php } ?>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane active">
				<table class="table table-bordered table-hover table-condensed mb-none tbr-top table-export">
					<thead>
						<tr>
							<th><?=translate('sl')?></th>
							<th><?=translate('book_title')?></th>
							<th><?=translate('author')?></th>
							<th><?=translate('publisher')?></th>
							<th><?=translate('isbn_no')?></th>
							<th><?=translate('edition')?></th>
							<th><?=translate('date_of_issue')?></th>
							<th><?=translate('date_of_expiry')?></th>
							<th><?=translate('return_date')?></th>
							<th><?=translate('fine')?></th>
							<th><?=translate('status')?></th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$count = 1;
							$this->db->select('bi.*,b.title,b.isbn_no,b.edition,b.author,b.publisher,c.name as category_name');
							$this->db->from('book_issues as bi');
							$this->db->join('book as b', 'b.id = bi.book_id', 'left');
							$this->db->join('book_category as c', 'c.id = b.category_id', 'left');
							$this->db->where('bi.session_id', get_session_id());
							$this->db->where('bi.user_id', $stu['student_id']);
							$this->db->where('bi.role_id', 7);
							$this->db->order_by('bi.id', 'desc');
							$booklist =  $this->db->get()->result_array();
								foreach($booklist as $row){
							?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo $row['title']; ?></td>
							<td><?php echo $row['author']; ?></td>
							<td><?php echo $row['publisher']; ?></td>
							<td><?php echo $row['isbn_no']; ?></td>
							<td><?php echo $row['edition']; ?></td>
							<td><?php echo _d($row['date_of_issue']); ?></td>
							<td><?php echo _d($row['date_of_expiry']); ?></td>
							<td><?php
							if($row['return_date'] == ""){
								echo ' -- / -- / ----'; 
							} else {
								echo _d($row['return_date']);
							}
							?></td>
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
							<td>
							<?php if (is_student_loggedin()): ?>
								<button class="btn btn-danger btn-circle" <?=($status != 0 ? 'disabled' : '');?> onclick="confirm_modal('<?=base_url('library/request_delete/' . $row['id'] ) ?>')">
									<i class="fas fa-trash-alt"></i> <?=translate('delete')?>
								</button>
							<?php endif; ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
<?php if (is_student_loggedin()) { ?>
			<div class="tab-pane" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit')); ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('book_title')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
								$arrayBook = array("" => translate('select'));
								$books = $this->db->select('id,title')->get_where('book', array('branch_id' => $stu['branch_id']))->result();
								foreach ($books as $book){
									$arrayBook[$book->id] = $book->title;
								}
								echo form_dropdown("book_id", $arrayBook, set_value('book_id'), "class='form-control' id='book_id' 
								data-plugin-selectTwo data-width='100%' ");
							?>
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('date_of_issue')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="date_of_issue" value="<?=date('Y-m-d')?>" data-plugin-datepicker
							data-plugin-options='{ "todayHighlight" : true }' />
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
				<?php echo form_close(); ?>
			</div>
<?php } ?>
		</div>
	</div>
</section>