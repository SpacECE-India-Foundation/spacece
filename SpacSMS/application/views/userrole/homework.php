<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="far fa-folder"></i>  <?php echo translate('homework') . "  " . translate('list'); ?></h4>
			</header>
			<div class="panel-body">
				<section class="panel-group mt-md" id="accordion">
					<?php foreach ( $homeworklist as $key => $row ): ?>
					<div class="panel panel-accordion">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $row['id']; ?>">
									<i class="far fa-sticky-note"></i> <?php echo $row['subject_name']?> - <?=_d($row['date_of_homework'])?>
								</a>
							</h4>
						</div>
						<div id="<?php echo $row['id']; ?>" class="accordion-body collapse">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-8">
										<p><?php echo $row['description']; ?></p>
									</div>
									<div class="col-md-4">
										<ul class="nav nav-stacked">
											<li><i class="far fa-calendar"></i> <span class="text-weight-semibold"><?=translate('date_of_homework')?></span> : <?=_d($row['date_of_homework'])?></li>
											<li><i class="far fa-calendar"></i> <span class="text-weight-semibold"><?=translate('date_of_submission')?></span> : <?=_d($row['date_of_submission'])?></li>
											<li><i class="far fa-calendar"></i> <span class="text-weight-semibold"><?=translate('evaluation_date')?></span> : <?=$row['evaluation_date'] != null ? _d($row['evaluation_date']) : "N/A";?></li>
											<li><span class="text-weight-semibold"><?=translate('created_by')?></span> : <?=$row['created_by'] != null ? get_type_name_by_id('staff',$row['created_by']) : "N/A";?></li>
											<li><span class="text-weight-semibold"><?=translate('status')?></span> : <?php 
											if ($row['ev_status'] == 'u' || $row['ev_status'] == '') {
												$labelmode = 'label-danger-custom';
												$status = translate('incomplete');
											} else {
												$status = translate('complete');
												$labelmode = 'label-success-custom';
											}
											echo "<span class='value label " . $labelmode . " '>" . $status . "</span>";
											 ?></li>
											<li><span class="text-weight-semibold"><?=translate('evaluated_by')?></span> : <?=!empty($row['evaluated_by']) ? get_type_name_by_id('staff',$row['evaluated_by']) : "N/A";?></li>
											<li><span class="text-weight-semibold"><?=translate('rank_out_of_5')?></span> : <?=!empty($row['rank']) ? $row['rank'] : "N/A";?></li>
											<li><span class="text-weight-semibold"><?=translate('remarks')?></span> : <?=!empty($row['ev_remarks']) ? $row['ev_remarks'] : "N/A";?></li>
										</ul>
										<ul class="nav nav-stacked mt-md">
											<li><span class="text-weight-semibold"><?=translate('subject')?></span> : <?=$row['subject_name']?></li>
											<li><span class="text-weight-semibold"><?=translate('class')?></span> : <?=$row['class_name']?></li>
											<li><span class="text-weight-semibold"><?=translate('section')?></span> : <?=$row['section_name']?></li>
											<li><span class="text-weight-semibold"><?=translate('documents')?></span> : <a href="<?=base_url('homework/download/' . $row['id'])?>" style="display: initial;" class="btn btn-default btn-circle icon" data-toggle="tooltip" data-original-title="<?=translate('download')?>"><i class="fas fa-cloud-download-alt"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</section>
			</div>
		</section>
	</div>
</div>
