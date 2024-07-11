<?php
$srv = "localhost";
$usr = "root";
$psw = "";
$dbname = "flightbooking";
$con = mysqli_connect($srv, $usr, $psw, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>