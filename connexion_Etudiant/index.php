
<?php
###########################################################Vous trouverez le script HTML DU formulaire en bas de la page################# ###########################################################################################################################


$errors = array(); 


require '../baseDonnée/db.php';

if (isset($_POST['login-submit'])) {


$mail=mysqli_real_escape_string($conn, $_POST["mail"]);
$pwd =  mysqli_real_escape_string($conn,$_POST["pwd"]);


 $sql = "SELECT * FROM informations WHERE Email = ?  ";
$stmt = mysqli_stmt_init($conn);
$sql1 = "SELECT * FROM demandesvalidee WHERE Email = ?  ";
 if (!mysqli_stmt_prepare($stmt, $sql) || !mysqli_stmt_prepare($stmt, $sql1) ) {

            
            { array_push($errors, " ERREUR SQL! "); }
            exit();
        } 
         else {

            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
             if ($row = mysqli_fetch_assoc($result)) {

             $pwdCheck = password_verify($pwd , $row['password']);
				if ($pwdCheck == false) 
					{ array_push($errors, " le mot de passe est incorrect ! "); }
				
			
			     else if ($pwdCheck==true){
				    
				     
		            $valid = $row['valid'];

                          if($valid==0){
               	        array_push($errors, " Votre demande est en cours de traitement. Veuillez vérifier votre boîte de réception  "); 
                        }
                     elseif ($valid==1) {
                     	session_start();

               	       $_SESSION['Etudiantid'] =$row['id'];
				       $_SESSION['Etudiantmail'] =$row['Email'];
				       $_SESSION['Etudiantnom'] =$row['Nom'];
				       $_SESSION['Etudiantprenom'] =$row['Prenom'];

				       
	                   $id = $row['id'];
	
                    header("Location:../profil_Etudiant/profilEtudiant.php?id=$id");
 

				       

                
                  
                    exit();

               }

                    

			
		}


			}else {







			array_push($errors, "  L'email est incorrecte ! ");
		}
		}
	}



?>
<?php
include '../style/header.php';


?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content ="example of meta ">
	<meta name=viewport content="width=deviceçwidth, initial-scale">
	<title></title>
	<link rel="stylesheet" href="../style/css/styleConnexion.css"  type="text/css">

</head>
<body>
		<div class="container " > 
    <div class="row content">
	
    	
<div class="loginbox">
    <img src="../photos/etudiant.png" class="pic">


            	<h1>Connexion</h1>

                 
                <form action="" method="post">
                	<?php  if (count($errors) > 0) : ?>
	          <div class="error">
	          	
		     <?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
		      <?php endforeach ?>
	        </div>
          <?php  endif ?>

	
            
	      <p>Email</p>
	             <input type="text" name="mail" placeholder="E-mail" required>
           
            <p>Mot de passe </p>
            <input type="password" name="pwd" placeholder="Password" required>
           
            
            <input type="submit" name="login-submit"  value="Se connecter">
 
           
		        
				


				<p>Vous êtes nouveau ici? <a href="../inscription_Etudiant/index.php"><FONT color="red">S'inscrire</FONT></a></p>
				

            </form>
        
            
</div>	
</div>
</div>
         
	

</body>
</head>
</html>

<?php
include '../style/footer.php';
?>  