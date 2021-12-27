<?php
session_start();

echo '$_SESSION: <br>';
print_r($_SESSION);
echo "<br><br>";

echo '$_POST: <br>';
print_r($_POST);
echo "<br><br>";

echo '$_GET: <br>';
print_r($_GET);
echo "<br><br>";

$new_array = array_merge($_SESSION, $_POST, $_GET);

echo json_encode(['success' => false, 'message' => $new_array]);
die();
