<?php //require "Check.php"; ?>
<?php
$title = 'Student Forum Database - Admin Area';
ob_start(); //ob output buffering to store the variables and use later by UI file
//create as a empty buffer and add the item inside
include '../templates/admin_home.html.php'; //call the UI file
$output = ob_get_clean(); //return the items and clean the buffer
include '../templates/admin_layout.html.php'; 
?>