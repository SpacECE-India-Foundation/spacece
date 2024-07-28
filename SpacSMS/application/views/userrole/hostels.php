<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#assigned" data-toggle="tab"><i class="fas fa-store-alt"></i> <?=translate('assigned')?></a>
			</li>
			<li>
				<a href="#list" data-toggle="tab"><i class="far fa-edit"></i> <?=translate('room_list')?></a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="assigned" class="tab-pane active">
                <?php
                if (!empty($student['hostel_id']) && !empty($student['room_id'])):
                $route_info = $this->userrole_model->getHostelDetails($student['hostel_id'], $student['room_id']);
                ?>
                <div class="table-responsive mb-md">
                    <table class="table table-bordered table-hover mb-none">
                        <tbody>
                            <tr>
                                <th><?=translate('hostel_name')?></th>
                                <td align="right"><?=$route_info->hostel_name?></td>
                            </tr>
                            <tr>
                                <th><?=translate('hostel_category')?></th>
                                <td align="right"><?=$route_info->hcategory_name?></td>
                            </tr>
                            <tr>
                                <th><?=translate('watchman_name')?></th>
                                <td align="right"><?=$route_info->watchman?></td>
                            </tr>
                            <tr>
                                <th><?=translate('hostel_address')?></th>
                                <td align="right"><?=$route_info->address?></td>
                            </tr>
                            <tr>
                                <th><?=translate('room_name')?></th>
                                <td align="right"><?=$route_info->room_name?></td>
                            </tr>
                            <tr>
                                <th><?=translate('room_category')?></th>
                                <td align="right"><?=$route_info->rcategory_name?></td>
                            </tr>
                            <tr>
                                <th><?=translate('no_of_beds')?></th>
                                <td align="right"><?=$route_info->no_beds?></td>
                            </tr>
                            <tr>
                                <th><?=translate('cost_per_bed')?></th>
                                <td align="right"><?=$global_config['currency_symbol'] . $route_info->bed_fee?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
	            <?php else: ?>
					<div class="alert alert-subl text-center">
						<i class="fas fa-exclamation-triangle"></i> <?=translate('there_is_no_room_allocation')?>
					</div>
	        	<?php endif;?>
			</div>
			
			<div class="tab-pane" id="list">
				<table class="table table-bordered table-hover table-export">
					<thead>
						<tr>
							<th><?=translate('sl')?></th>
							<th><?=translate('room_name')?></th>
							<th><?=translate('hostel_name')?></th>
							<th><?=translate('room_category')?></th>
							<th><?=translate('no_of_beds')?></th>
							<th><?=translate('cost_per_bed')?></th>
							<th><?=translate('remarks')?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						$branchID = $student['branch_id'];
						$this->db->order_by('id', 'desc');
						$this->db->where('branch_id', $branchID);
						$rooms = $this->db->get('hostel_room')->result();
							foreach($rooms as $room):
						?>
						<tr>
							<td><?php echo $count++;?></td>
							<td><?php echo $room->name;?></td>
							<td><?php echo get_type_name_by_id('hostel', $room->hostel_id);?></td>
							<td><?php echo get_type_name_by_id('hostel_category', $room->category_id);?></td>
							<td><?php echo $room->no_beds;?></td>
							<td><?php echo $global_config['currency_symbol'].$room->bed_fee;?></td>
							<td><?php echo $room->remarks;?></td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>