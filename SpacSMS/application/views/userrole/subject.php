<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"><i class="fas fa-list-ul"></i> <?=translate('subject_list')?></h4>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-hover mb-none table-export">
			<thead>
				<tr>
					<th width="60"><?=translate('sl')?></th>
					<th><?=translate('subject_name')?></th>
					<th><?=translate('class_name')?></th>
					<th><?=translate('class_teacher')?></th>
					<th><?=translate('subject_code')?></th>
					<th><?=translate('subject_type')?></th>
					<th><?=translate('subject_author')?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$count = 1;
				$stu = $this->userrole_model->getStudentDetails();
				$this->db->select('sa.subject_id,sa.class_id,sa.teacher_id,s.name as subject_name,s.subject_code,s.subject_type,s.subject_author,t.name as teacher_name');
				$this->db->from('subject_assign as sa');
				$this->db->join('subject as s','s.id = sa.subject_id', 'left');
				$this->db->join('staff as t','t.id = sa.teacher_id', 'left');
				$this->db->where('sa.class_id', $stu['class_id']);
				$subjectlist = $this->db->get()->result_array();
				foreach($subjectlist as $row):
				?>
				<tr>
					<td><?php echo $count++ ;?></td>
					<td><?php echo $row['subject_name'];?></td>
					<td><?php echo $stu['class_name'];?></td>
					<td><?php echo $row['teacher_name'];?></td>
					<td><?php echo $row['subject_code'];?></td>
					<td><?php echo $row['subject_type'];?></td>
					<td><?php echo $row['subject_author'];?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</section>