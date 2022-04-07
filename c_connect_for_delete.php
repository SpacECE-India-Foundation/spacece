<?php
 
session_start(); 
  $servername = "localhost";
    $username = "ostechnix";
    $password = "Password123#@!";
    $dbname = "fcm";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
 // starting session
 //site url
/*
  define("SITEURL",'http://localhost/consult/');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }*/
?>