<?php
require 'baseDonnée/db.php';

date_default_timezone_set("Africa/Casablanca");
$todays_date = date("Y-m-d");


$sql="SELECT deadline FROM admin WHERE idAdmin='1' ";


$result = mysqli_query($conn,$sql) or die(mysqli_error());
$row = mysqli_fetch_array($result) or die(mysqli_error());
$deadline = $row['deadline'];
$today = strtotime($todays_date);

$expiration_date = strtotime($deadline);

if ($expiration_date > $today) {
	session_start();
	$_SESSION['deadline'] = "oui";
     header("Location:home.php") ;
     
} elseif ($expiration_date < $today) {
	# code...
     header("Location:closer.php"); 
}
?>
