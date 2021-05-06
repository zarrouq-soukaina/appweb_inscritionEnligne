 <?php
 include '../style/headerAdmin.php';
 require '../baseDonnée/db.php';
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



if(!empty($_GET["id"])){
    //Supprimer l'etudiant dont l'id est envoyé avec l'URL
	$id_etudiant = mysqli_real_escape_string($conn,$_GET["id"]);
    $sql_email="SELECT * FROM demandesvalidee WHERE id=$id_etudiant";
	$res=$conn->query($sql_email);
	$row=$res->fetch_assoc();
	$email = $row['Email'];
	#envoyer un email pour informer l'étudiant ue sa demande est supprimée


	$msg="En réponse à votre demande d'inscription à l'institut nationale de statistique et d'économie appliquée , nous avons le regret de devoir vous informer que celle-ci n'a pas été retenue.";

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
	
	$mail->Subject = 'Reponse a votre demande d inscription' ;
	$mail->Body =$msg;
	
	$mail->AddAddress($email);
	













if($mail->Send()){

	$sql = "DELETE FROM demandesvalidee WHERE id=$id_etudiant";
	echo $sql;
	if (mysqli_query($conn, $sql)) {

    	$_SESSION['message']="Demande supprimées avec succès";
	} 
}
	//Redirection vers la page exercice.php avec un message résultat de la suppression 
   header("Location:indexvalid.php");

}
 ?>