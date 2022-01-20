<?php
include('Employee.php');
$emp = new Employee();
if(!empty($_POST['action']) && $_POST['action'] == 'listEmployee') {
	$emp->activityList();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addEmployee') {
	$emp->addActivity();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getEmployee') {
	$emp->getActivity();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateEmployee') {
	$emp->updateActivity();
}
if(!empty($_POST['action']) && $_POST['action'] == 'empDelete') {
	$emp->deleteActivity();
}
?>