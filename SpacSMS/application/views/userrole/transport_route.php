<section class="panel">
    <div class="tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#assigned" data-toggle="tab"><i class="fas fa-bus"></i> <?=translate('assigned')?></a>
            </li>
            <li>
                <a href="#list" data-toggle="tab"><i class="far fa-edit"></i> <?=translate('route_list')?></a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="assigned" class="tab-pane active">
               <?php if(!empty($route)){ ?>
                <div class="table-responsive mb-md">
                    <table class="table table-bordered table-hover mb-none">
                        <tbody>
                            <tr>
                                <th><?=translate('route_name')?></th>
                                <td align="right"><?=$route['route_name']?></td>
                            </tr>
                            <tr>
                                <th><?=translate('start_place')?></th>
                                <td align="right"><?=$route['start_place']?></td>
                            </tr>
                            <tr>
                                <th><?=translate('stop_place')?></th>
                                <td align="right"><?=$route['stop_place']?></td>
                            </tr>
                            <tr>
                                <th><?=translate('stoppage')?></th>
                                <td align="right"><?=$route['stop_position']?></td>
                            </tr>
                            <tr>
                                <th><?=translate('stop_time')?></th>
                                <td align="right"><?=date("g:i A", strtotime($route['stop_time']))?></td>
                            </tr>
                            <tr>
                                <th><?=translate('route_fare')?></th>
                                <td align="right"><?=$route['route_fare']?></td>
                            </tr>
                            <tr>
                                <th><?=translate('vehicle_no')?></th>
                                <td align="right"><?=$route['vehicle_no']?></td>
                            </tr>
                            <tr>
                                <th><?=translate('driver_name')?></th>
                                <td align="right"><?=$route['driver_name']?></td>
                            </tr>
                            <tr>
                                <th><?=translate('driver_phone')?></th>
                                <td align="right"><?=$route['driver_phone']?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php
                } else {
                    echo '<div class="alert alert-subl text-center"><i class="fas fa-exclamation-triangle"></i> ' . translate('no_information_available') . ' </div>';
                }
                ?>
            </div>

            <div class="tab-pane" id="list">
                <table class="table table-bordered table-hover mb-none table-export tbr-top">
                    <thead>
                        <tr>
                            <th><?=translate('sl')?></th>
                            <th><?=translate('route_name')?></th>
                            <th><?=translate('start_place')?></th>
                            <th><?=translate('stoppage')?></th>
                            <th><?=translate('stop_place')?></th>
                            <th><?=translate('route_fare')?></th>
                            <th><?=translate('vehicle_no')?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                            $branchID = get_loggedin_branch_id();
                            $assigns = $this->userrole_model->getAssignList($branchID);
                            foreach ($assigns as $assign):  
                        ?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $assign['name'];?></td>
                            <td><?php echo $assign['start_place'];?></td>
                            <td><?php 
                                echo $assign['stop_position'];
                                echo '<br> <small class="text-dark">' . translate('stop_time') . ' : ' . date("g:i A", strtotime($assign['stop_time'])) . '</small>';
                                ?>
                            </td>
                            <td><?php echo $assign['stop_place'];?></td>
                            <td><?php echo $assign['route_fare'];?></td>
                            <td><?php echo $this->userrole_model->getVehicleList($assign['route_id']);?></td>
                        </tr>
                        <?php endforeach;  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>