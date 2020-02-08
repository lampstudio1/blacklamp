#!/usr/bin/php -q
<?php
$con = new mysqli("localhost","root","ieelte1214","user_db");
$query = "TRUNCATE partypost_tb";
mysqli_query($con,$query);
?>
