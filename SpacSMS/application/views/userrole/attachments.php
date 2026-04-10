<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"><i class="fas fa-cloud-upload-alt"></i> <?=translate('attachments')?></h4>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-hover table-condensed mb-none table-export">
			<thead>
				<tr>
					<th><?=translate('sl')?></th>
					<th><?=translate('title')?></th>
					<th><?=translate('type')?></th>
					<th><?=translate('class')?></th>
					<th><?=translate('subject')?></th>
					<th><?=translate('remarks')?></th>
					<th><?=translate('publisher')?></th>
					<th><?=translate('date')?></th>
					<th><?=translate('action')?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$count = 1;
					$stu = $this->userrole_model->getStudentDetails();
					$this->db->where('class_id', $stu['class_id'])->or_where('class_id', 'unfiltered');
					$this->db->where('session_id', get_session_id());
					$this->db->order_by('id', 'desc');
					$query = $this->db->get('attachments');
					$attachmentss = $query->result();
					foreach($attachmentss as $row):
				?>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $row->title; ?></td>
					<td><?php echo get_type_name_by_id('attachments_type', $row->type_id);?></td>
					<td><?php echo $row->class_id == 'unfiltered' ? '<span class="text-dark">All</span>' : get_type_name_by_id('class', $row->class_id);?></td>
					<td><?php echo $row->subject_id == 'unfiltered' ? '<span class="text-dark">Unfiltered</span>' : get_type_name_by_id('subject', $row->subject_id);?></td>
					<td><?php echo $row->remarks; ?></td>
					<td><?php echo get_type_name_by_id('staff', $row->uploader_id);?></td>
					<td><?php echo _d($row->date);?></td>
					<td>
						<!--download link-->
						<a href="<?=base_url('attachments/download?file=' . $row->enc_name)?>" class="btn btn-default btn-circle icon" data-toggle="tooltip" data-original-title="<?=translate('download')?>">
							<i class="fas fa-cloud-download-alt"></i>
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</section>