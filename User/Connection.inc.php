<?php
session_start();
$server= "localhost";
$password = "";
$username="root";
$dbname = "foodwebsite";

$conn = mysqli_connect($server,$username,$password,$dbname);
?>