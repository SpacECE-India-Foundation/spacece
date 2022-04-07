<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"><i class="fas fa-list-ul"></i> <?=translate('books_list')?></h4>
	</header>
	<div class="panel-body">
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
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</section>