<?php $widget = (is_superadmin_loggedin() ? 4 : 6); ?>
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <h4 class="panel-title"><?php echo translate('select_ground'); ?></h4>
            </header>
            <?php echo form_open($this->uri->uri_string(), array('class' => 'validate')); ?>
                <div class="panel-body">
                    <div class="row mb-sm">
                    <?php if (is_superadmin_loggedin()): ?>
                        <div class="col-md-4 mb-sm">
                            <div class="form-group">
                                <label class="control-label"><?php echo translate('branch'); ?> <span class="required">*</span></label>
                                <?php
                                    $arrayBranch = $this->app_lib->getSelectList('branch');
                                    echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control'
                                    data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                        <div class="col-md-<?=$widget?> mb-sm">
                            <div class="form-group">
                                <label class="control-label"><?php echo translate('role'); ?> <span class="required">*</span></label>
                                <?php
                                    $role_list = $this->app_lib->getRoles();
                                    echo form_dropdown("staff_role", $role_list, set_value('staff_role'), "class='form-control' required data-plugin-selectTwo
                                    data-width='100%' data-minimum-results-for-search='Infinity' ");
                                ?>
                            </div>
                        </div>
                        <div class="col-md-<?=$widget?> mb-sm">
                            <div class="form-group">
                                <label class="control-label"><?php echo translate('month'); ?> <span class="required">*</span></label>
                                <input type="text" class="form-control monthyear" autocomplete="off" name="month_year" value="<?php echo set_value('month_year', date("Y-m")); ?>" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-offset-10 col-md-2">
                            <button type="submit" name="search" value="1" class="btn btn-default btn-block"><i class="fas fa-filter"></i> <?php echo translate('filter'); ?></button>
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </section>

        <?php if(isset($stafflist)): ?>
            <section class="panel appear-animation" data-appear-animation="<?=$global_config['animations'] ?>" data-appear-animation-delay="100">
                <header class="panel-heading">
                    <h4 class="panel-title"><?php echo translate('staff') . " " . translate('list'); ?></h4>
                </header>
                <div class="panel-body">
                    <div class="mb-sm mt-xs">
                        <table class="table table-bordered table-hover table-condensed table_default" >
                            <thead>
                                <tr>
                                    <th><?php echo translate('staff_id'); ?></th>
                                    <th><?php echo translate('name'); ?></th>
                                    <th><?php echo translate('designation'); ?></th>
                                    <th><?php echo translate('department'); ?></th>
                                    <th><?php echo translate('mobile_no'); ?></th>
                                    <th><?php echo translate('salary') . " " . translate('grade'); ?></th>
                                    <th><?php echo translate('basic') . " " . translate('salary'); ?></th>
                                    <th><?php echo translate('status'); ?></th>
                                    <th><?php echo translate('action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stafflist as $row): ?>
                                <tr>
                                    <td><?php echo $row->staff_id; ?></td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $row->designation_name; ?></td>
                                    <td><?php echo $row->department_name; ?></td>
                                    <td><?php echo $row->mobileno; ?></td>
                                    <td><?php echo $row->template_name; ?></td>
                                    <td><?php echo $global_config['currency_symbol'] . $row->basic_salary; ?></td>
                                    <td>
                                        <?php
                                            $labelMode = '';
                                            $status = ($row->salary_id == 0 ? 'unpaid' : 'paid');
                                            if($status == 'paid') {
                                                $status_txt = translate('salary') . " " . translate('paid');
                                                $labelMode  = 'label-success-custom';
                                            } elseif($status == 'unpaid') {
                                                $status_txt = translate('salary') . " " . translate('unpaid');
                                                $labelMode  = 'label-info-custom';
                                            }
                                            echo "<span class='label " . $labelMode. "'>" . $status_txt . "</span>";
                                        ?>
                                    </td>
                                    <td class="min-w-c">
                                        <?php if($status == 'paid'): ?>
                                            <a href="<?php echo base_url('payroll/invoice/'.$row->salary_id.'/'.$row->salary_hash); ?>" class="btn btn-default btn-circle"><i class="fas fa-eye"></i> <?php echo translate('payslip'); ?></a>
                                         <?php else: ?>
                                            <a target="_blank" href="<?php echo base_url('payroll/create/' . $row->id . '/' . $month . '/' . $year); ?>" class="btn btn-default btn-circle"><i class="far fa-credit-card"></i> <?php echo translate('pay_now'); ?></a>
                                         <?php endif; ?>
                                    </td>
                                    <?php endforeach; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </div>
</div>