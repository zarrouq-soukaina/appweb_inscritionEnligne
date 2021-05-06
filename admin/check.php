


<?php

require '../baseDonnée/db.php';
date_default_timezone_set("Africa/Casablanca");
$todays_date = date("Y-m-d");


$sql_d="SELECT deadline FROM admin WHERE idAdmin='1' ";


$result = mysqli_query($conn,$sql_d) or die(mysqli_error());
$row = mysqli_fetch_array($result) or die(mysqli_error());
$deadline = $row['deadline'];
$today = strtotime($todays_date);

$expiration_date = strtotime($deadline);


$email = mysqli_real_escape_string($conn,$_GET['Email']);
$token = mysqli_real_escape_string($conn,$_GET['token']);

$sql = "SELECT id FROM demandesvalidee WHERE Email='$email' AND token='$token' AND valid =0";
$query= mysqli_query($conn,$sql);
$count= mysqli_num_rows($query);
		   
if ($count > 0)  {
	
	$sql2= "UPDATE demandesvalidee SET valid=1 , token='' WHERE Email='$email'";
	$query2= mysqli_query($conn,$sql2);


	if ($expiration_date > $today) {
    header("Location:activer.php");
     
} elseif ($expiration_date < $today) {
	
     header("Location:../closer.php"); 
}



}


?>















