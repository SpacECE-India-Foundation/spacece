<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"><i class="fas fa-list-ul"></i> <?=translate('event_list')?></h4>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-hover mb-none tbr-top table-export">
			<thead>
				<tr>
					<th><?=translate('sl')?></th>
					<th><?=translate('title')?></th>
					<th><?=translate('type')?></th>
					<th><?=translate('date_of_start')?></th>
					<th><?=translate('date_of_end')?></th>
					<th><?=translate('audience')?></th>
					<th><?=translate('created_by')?></th>
					<th><?=translate('action')?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$count = 1;
				$stu = $this->userrole_model->getStudentDetails();
				$this->db->where('status', 1);
				$this->db->where('branch_id', $stu['branch_id']);
				$this->db->order_by('id', 'desc');
				$events = $this->db->get('event')->result();
				foreach ($events as $event):
				?>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $event->title; ?></td>
					<td><?php
							if($event->type != 'holiday'){
								echo get_type_name_by_id('event_types', $event->type);
							}else{
								echo translate('holiday'); 
							}
						?></td>
					<td><?php echo _d($event->start_date);?></td>
					<td><?php echo _d($event->end_date);?></td>
					<td><?php
						$auditions = array(
							"1" => "everybody",
							"2" => "class",
							"3" => "section",
						);
						$audition = $auditions[$event->audition];
						echo translate($audition);
						if($event->audition != 1){
							$selecteds = json_decode($event->selected_list); 
							foreach ($selecteds as $selected) {
								echo "<br> <small> - " . $this->db->get_where($audition , array('id' => $selected))->row()->name . '</small>' ;
							}
						}
					?></td>
					<td><?php echo get_type_name_by_id('staff', $event->created_by); ?></td>
					<td>
						<!-- view modal link -->
						<a href="javascript:void(0);" class="btn btn-circle btn-default icon" onclick="viewEvent('<?=$event->id?>');">
							<i class="far fa-eye"></i>
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</section>

<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
	<section class="panel">
		<header class="panel-heading">
			<div class="panel-btn">
				<button onclick="fn_printElem('printResult')" class="btn btn-default btn-circle icon" ><i class="fas fa-print"></i></button>
			</div>
			<h4 class="panel-title"><i class="fas fa-info-circle"></i> <?=translate('event_details')?></h4>
		</header>
		<div class="panel-body">
			<div id="printResult" class="pt-sm pb-sm">
				<div class="table-responsive">						
					<table class="table table-bordered table-condensed text-dark tbr-top" id="ev_table"></table>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-default modal-dismiss">
						<?=translate('close')?>
					</button>
				</div>
			</div>
		</footer>
	</section>
</div>