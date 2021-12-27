<?php
session_start();

$new_array = array_merge($_POST, $_GET);

echo json_encode(['success' => false, 'message' => $new_array]);
die();
