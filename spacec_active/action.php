<?php
include('ActivityData.php');
$emp = new ActivityData();
if(!empty($_POST['action']) && $_POST['action'] == 'listActivity') {
	$emp->activityList();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addActivity') {
	$emp->addActivity();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getActivity') {
	$emp->getActivity();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateActivity') {
	$emp->updateActivity();
}
if(!empty($_POST['action']) && $_POST['action'] == 'activityDelete') {
	$emp->deleteActivity();
}
?>