<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta name="keywords" content=""/>
    <meta name="description" content="Ramom School Management System">
    <meta name="author" content="RamomCoder">
    <title>Ramom School - Installation</title>
    <link rel="shortcut icon" href="<?=base_url('assets/images/favicon.png')?>">
    <link href="<?=$this->_install->is_secure('fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light')?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.css')?>"/>
	<link rel="stylesheet" href="<?php echo base_url('assets/vendor/select2/css/select2.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/vendor/font-awesome/css/all.min.css')?>" />
    <link rel="stylesheet" href="<?=base_url('assets/css/install.css')?>" />
    <script src="<?=base_url('assets/vendor/jquery/jquery.js')?>"></script>
</head>
	<body>
		<div class="container pmx">
			<div class="logo">
		        <img src="<?=base_url('uploads/app_image/logo_inst.png');?>">
		    </div>
            <section class="panel p-shadow">
                <div class="tabs-custom">
                    <ul class="nav nav-tabs txt-font-et">
                        <li class="<?=($step == 1 ? 'active' : ''); ?>">
                            <a href="javascript:void(0);"><i class="fas fa-parachute-box"></i> <h5>Requirements</h5></a>
                        </li>
                        <li class="<?=($step == 2 ? 'active' : ''); ?>">
                            <a href="javascript:void(0);"><i class="fas fa-laptop-code"></i> <h5>Purchase Code</h5></a>
                        </li>
                        <li class="<?=($step == 3 ? 'active' : ''); ?>">
                            <a href="javascript:void(0);"><i class="fas fa-database"></i> <h5>Database</h5></a>
                        </li>
                        <li class="<?=($step == 4 ? 'active' : ''); ?>">
                            <a href="javascript:void(0);"><i class="fas fa-server"></i> <h5>Install</h5></a>
                        </li>
                        <li class="<?=($step == 5 ? 'active' : ''); ?>">
                            <a href="javascript:void(0);"><i class="fas fa-check"></i> <h5>Completed</h5></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <?php if ($step == 1): ?>
                            <div class="tab-pane active">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><b>Extensions</b></th>
                                            <th><b>Result</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>PHP 5.6+ </td>
                                            <td>
                                                <?php
                                                    $error = false;
                                                    if (phpversion() < "5.6") {
                                                        $error = true;
                                                        echo "<span class='label label-danger'>Your PHP version is " . phpversion() . "</span>";
                                                    } else {
                                                        echo "<span class='label label-success'>v." . phpversion() . "</span>";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>MySQLi PHP Extension</td>
                                            <td>
                                                <?php 
                                                    if (!extension_loaded('mysqli')) {
                                                        $error = true;
                                                        echo "<span class='label label-danger'>Not enabled</span>";
                                                    } else {
                                                        echo "<span class='label label-success'>Enabled</span>";
                                                    }
                                                ?>
                                             </td>
                                        </tr>
                                        <tr>
                                            <td>cURL PHP Extension</td>
                                            <td>
                                                <?php 
                                                    if (!extension_loaded('curl')) {
                                                        $error = true;
                                                        echo "<span class='label label-danger'>Not enabled</span>";
                                                    } else {
                                                        echo "<span class='label label-success'>Enabled</span>";
                                                    }
                                                ?>
                                             </td>
                                        </tr>
                                        <tr>
                                            <td>OpenSSL PHP Extension</td>
                                            <td>
                                                <?php
                                                    if (!extension_loaded('openssl')) {
                                                        $error = true;
                                                        echo "<span class='label label-danger'>Not enabled</span>";
                                                    } else {
                                                        echo "<span class='label label-success'>Enabled</span>";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>MBString PHP Extension</td>
                                            <td>
                                                <?php
                                                    if (!extension_loaded('mbstring')) {
                                                        $error = true;
                                                        echo "<span class='label label-danger'>Not enabled</span>";
                                                    } else {
                                                        echo "<span class='label label-success'>Enabled</span>";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>GD PHP Extension</td>
                                            <td>
                                                <?php
                                                    if (!extension_loaded('gd')) {
                                                        $error = true;
                                                        echo "<span class='label label-danger'>Not enabled</span>";
                                                    } else {
                                                        echo "<span class='label label-success'>Enabled</span>";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Zip PHP Extension</td>
                                            <td>
                                                <?php
                                                    if (!extension_loaded('zip')) {
                                                        $error = true;
                                                        echo  "<span class='label label-danger'>Zip Extension is not enabled</span>";
                                                    } else {
                                                        echo "<span class='label label-success'>Enabled</span>";
                                                    }
                                                ?>
                                             </td>
                                        </tr>
                                        <tr>
                                            <td>allow_url_fopen</td>
                                            <td>
                                                <?php
                                                    $url_f_open = ini_get('allow_url_fopen');
                                                    if ($url_f_open != "1"
                                                        && strcasecmp($url_f_open,'On') != 0
                                                        && strcasecmp($url_f_open,'true') != 0
                                                        && strcasecmp($url_f_open,'yes') != 0) {
                                                        $error = true;
                                                        echo "<span class='label label-danger'>Allow_url_fopen is not enabled!</span>";
                                                    } else {
                                                        echo "<span class='label label-success'>Enabled</span>";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Internet Connection</td>
                                            <td>
                                                <?php 
                                                    if ($this->_install->is_connected() == false) {
                                                        $error = true;
                                                        echo "<span class='label label-danger'>No</span>";
                                                    } else {
                                                        echo "<span class='label label-success'>Yes</span>";
                                                    }
                                                ?>
                                             </td>
                                        </tr>
                                        <tr>
                                            <td>application/config/autoload.php Writable</td>
                                            <td>
                                                <?php
                                                    if (!is_really_writable(APPPATH . 'config/autoload.php')) {
                                                        $error = true;
                                                        echo "<span class='label label-danger'>No (Make application/config/autoload.php writable) - Permissions - 755</span>";
                                                    } else {
                                                        echo "<span class='label label-success'>Yes</span>";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>application/config/config.php Writable</td>
                                            <td>
                                                <?php
                                                    if (!is_really_writable(APPPATH . 'config/config.php')) {
                                                        $error = true;
                                                        echo "<span class='label label-danger'>No (Make application/config/config.php writable) - Permissions - 755</span>";
                                                    } else {
                                                        echo "<span class='label label-success'>Yes</span>";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>application/config/database.php Writable</td>
                                            <td>
                                                <?php
                                                    if (!is_really_writable(APPPATH . 'config/database.php')) {
                                                        $error = true;
                                                        echo "<span class='label label-danger'>No (Make application/config/database.php writable) - Permissions - 755</span>";
                                                    } else {
                                                        echo "<span class='label label-success'>Yes</span>";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>application/config/routes.php Writable</td>
                                            <td>
                                                <?php
                                                    if (!is_really_writable(APPPATH . 'config/routes.php')) {
                                                        $error = true;
                                                        echo "<span class='label label-danger'>No (Make application/config/routes.php writable) - Permissions - 755</span>";
                                                    } else {
                                                        echo "<span class='label label-success'>Yes</span>";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <footer class="panel-footer">
                                    <?php 
                                        if ($error == false){
                                            echo '<div class="text-right">';
                                            echo form_open($this->uri->uri_string());
                                            echo '<button type="submit" name="step" class="btn btn-default" value="2">Start The Installation</button>';
                                            echo form_close();
                                            echo '</div>';
                                        }else{
                                            echo '<div class="text-right">';
                                            echo '<button class="btn btn-default" disabled value="2">Start The Installation</button>';
                                            echo '</div>';
                                        }
                                     ?>
                                </footer>
                            </div>
                        <?php elseif ($step == 2) : ?>
                            <div class="tab-pane active">
                                <?php if (isset($purchase_error) && $purchase_error != '') { ?>
                                    <div class="alert alert-danger text-left">
                                        <?php echo $purchase_error; ?>
                                    </div>
                                <?php } ?>
                                <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                                    <div class="form-group">
                                        <label for="username" class="col-md-3 control-label">Envato Username <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="purchase_username" value="<?=set_value('purchase_username')?>" autocomplete="off" />
											<?php echo form_error('purchase_username', '<label id="purchase_username-error" class="error" for="purchase_username">', '</label>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-md-3 control-label"> Purchase Code</label>
                                        <div class="col-md-9 mb-ma">
                                            <input type="text" class="form-control" name="purchase_code" value="<?=set_value('purchase_code')?>" autocomplete="off" />
											<?php echo form_error('purchase_code', '<label id="purchase_code-error" class="error" for="purchase_code">', '</label>'); ?>
                                        </div>
                                    </div>
                                    <footer class="panel-footer">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-default" name="step" value="3"> Next Step</button>
                                        </div>
                                    </footer>
                                <?php echo form_close(); ?>
                            </div>
                        <?php elseif ($step == 3) : ?>
                            <div class="tab-pane active">
                                <?php if (isset($mysql_error) && $mysql_error != '') { ?>
                                    <div class="alert alert-danger text-left">
                                        <?php echo $mysql_error; ?>
                                    </div>
                                <?php } ?>
                                <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                                    <div class="form-group">
                                        <label for="hostname" class="col-md-3 control-label">Hostname <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="hostname" value="localhost">
											<span class="error"><?=form_error('hostname')?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="database" class="col-md-3 control-label">Database Name <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="database" value="<?=set_value('database')?>">
                                            <?php echo form_error('database', '<label id="database-error" class="error" for="database">', '</label>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="col-md-3 control-label">Username <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="username" value="<?=set_value('username')?>">
											<?php echo form_error('username', '<label id="username-error" class="error" for="username">', '</label>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-md-3 control-label"> Password</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control mb-ma" name="password" value="" >
                                        </div>
                                    </div>
                                    <footer class="panel-footer">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-default" name="step" value="4"> Setup Database</button>
                                        </div>
                                    </footer>
                                <?php echo form_close(); ?>
                            </div>
                        <?php elseif ($step == 4) : ?>
                            <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
								<div class="form-group">
									<label class="col-md-3 control-label">School Name <span class="required">*</span></label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="school_name" placeholder="School Name" value="<?=set_value('school_name')?>" />
                                        <?php echo form_error('school_name', '<label id="school_name-error" class="error" for="school_name">', '</label>'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="superadmin_name">Superadmin Name <span class="required">*</span></label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="sa_name" placeholder="Superadmin Name" value="<?=set_value('superadmin_name')?>" />
										<?php echo form_error('sa_name', '<label id="sa_name-error" class="error" for="sa_name">', '</label>'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="sa_email">Superadmin Email <span class="required">*</span></label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="sa_email" placeholder="Superadmin Email (Login Username)" value="<?=set_value('sa_email')?>" />
                                        <?php echo form_error('sa_email', '<label id="sa_email-error" class="error" for="sa_email">', '</label>'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Superadmin Password <span class="required">*</span></label>
									<div class="col-md-9">
										<input type="password" class="form-control" name="sa_password" id="sa_password" placeholder="Superadmin Login Password" value="" />
										<?php echo form_error('sa_password', '<label id="sa_password-error" class="error" for="sa_password">', '</label>'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Timezone <span class="required">*</span></label>
									<div class="col-md-9 mb-ma">
										<?php
										$timezones = $this->_install->timezone_list();
										echo form_dropdown("timezone", $timezones, set_value('timezone'), "class='form-control' id='timezone' ");
										?>
										<?php echo form_error('timezone', '<label id="timezone-error" class="error" for="timezone">', '</label>'); ?>
									</div>
								</div>
                                <footer class="panel-footer">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-default" name="step" value="5"> Install</button>
                                    </div>
                                </footer>
                            <?php echo form_close(); ?>
                        <?php elseif ($step == 5) : ?>
                            <center>
                                <h4>Congratulations!! The installation was successfull</h4>
                                <ul class="fi-msg-s">
                                    <li><span>Enter the url for login and follow the instructions :</span></li>
                                    <li><a href="<?=base_url('authentication'); ?>" target="_blank"><?=base_url('authentication'); ?></a> </li>
                                </ul>
                                <br>
                            </center>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <center> 2020 © All Rights Reserved - <a href="about:blank">RamomCoder</a></center>
		</div>
		<script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/select2/js/select2.js');?>"></script>
		<script src="<?=base_url('assets/vendor/jquery-placeholder/jquery-placeholder.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#timezone').select2({
                    theme: "bootstrap"
                });
            });
        </script>
		
		
	</body>
</html>