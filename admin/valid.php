 <?php
 include '../style/headerAdmin.php';





 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
 require '../baseDonnée/db.php';










if(!empty($_GET["id"])){
    //valider l'etudiant dont l'id est envoyé avec l'URL
	$id_etudiant = mysqli_real_escape_string($conn,$_GET["id"]);
	$sql="SELECT * FROM informations WHERE id=$id_etudiant";
	$res=$conn->query($sql);
	$row=$res->fetch_assoc();
	$email = $row['Email'];
	$token = $row['token'];
	
	#vérifier si le date de validation 

	date_default_timezone_set("Africa/Casablanca");
    $todays_date = date("Y-m-d");


    $sql1="SELECT deadline FROM admin WHERE idAdmin='1' ";


   $result = mysqli_query($conn,$sql1) or die(mysqli_error());
   $roww = mysqli_fetch_array($result) or die(mysqli_error());
   $deadline = $roww['deadline'];
   $today = strtotime($todays_date);

   $expiration_date = strtotime($deadline);

if ($expiration_date > $today) {
	$msg="Veuillez confirmer l'enregistrement de votre compte en cliquant sur  le lien ci-dessous :
	<a href='http://execution//projetdev/admin/check.php?Email=$email&token=$token'>Cliquez ici</a>";
    
     
} elseif ($expiration_date < $today) {
	$msg="Votre demande d'inscription a été bien validée";

}

	
	
	
    $mail = new PHPMailer;
	
	$mail->IsSMTP(); 
	$mail->SMTPDebug = 1; 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;; 
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587; 

	$mail->IsHTML(true);
	$mail->CharSet = '';
	$mail->Username = "inscription.insea2020@gmail.com";
	$mail->Password = "inscriptioninseaprojet2020";
	$mail->SetFrom('inscriptioninsea@gmail.com', 'Admin');
	
	$mail->Subject = 'Validation de demande d inscription ;
	$mail->Body =$msg;
	
	$mail->AddAddress($email);

	

	
	if(!$mail->Send()){
		$_SESSION['message']=" erreur d'envoi d'email de vérification de compte  ";

	}else{
		
		$req="INSERT INTO demandesvalidee SELECT * FROM informations WHERE id=$id_etudiant";
		$quer= mysqli_query($conn,$req);
		$req2 = "DELETE FROM informations WHERE id=$id_etudiant";
		$quer2= mysqli_query($conn,$req2);
	
		$_SESSION['message']="demande validée avec succés ";
	}
	 header("Location:index.php");
	}


 ?>
