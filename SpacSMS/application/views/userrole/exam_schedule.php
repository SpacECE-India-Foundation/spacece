<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"><i class="fas fa-user-clock"></i> <?=translate('schedule') . " " . translate('list')?></h4>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-hover table-condensed table-export mt-md">
			<thead>
				<tr>
					<th>#</th>
					<th><?=translate('exam_name')?></th>
					<th><?=translate('action')?></th>
				</tr>
			</thead>
			<tbody>
			<?php $count = 1; foreach($exams as $row): ?>
				<tr>
					<td><?php echo $count++ ?></td>
					<td><?php echo $this->application_model->exam_name_by_id($row['exam_id']);?></td>
					<td>
						<!-- view link -->
						<a href="javascript:void(0);" class="btn btn-circle btn-default icon" onclick="getExamTimetableM('<?=$row['exam_id']?>','<?=$row['class_id']?>','<?=$row['section_id']?>');"> 
							<i class="far fa-eye"></i> 
						</a>
					</td>
				</tr>
			<?php endforeach;  ?>
			</tbody>
		</table>
	</div>
</section>
<div class="zoom-anim-dialog modal-block modal-block-lg mfp-hide" id="modal">
	<section class="panel" id='quick_view'></section>
</div>