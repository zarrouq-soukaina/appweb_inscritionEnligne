<?php



###########################################################Vous trouverez le script HTML DU formulaire en bas de la page################# ###########################################################################################################################
$errors = array(); 


require '../baseDonnée/db.php';
 
if (isset($_POST['login-admin'])) {


$mail= $_POST["mail"];
$pwd =  $_POST["pwd"];


 $sql = "SELECT * FROM admin WHERE emailAdmin = ?  ";
$stmt = mysqli_stmt_init($conn);
 if (!mysqli_stmt_prepare($stmt, $sql)) {

            
            array_push($errors, " erreur SQQL ! ");
        } 
         else {

            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
             if ($row = mysqli_fetch_assoc($result)) {
             	$mdpAdmin = $row['mdpAdmin'];
             	if( $mdpAdmin == $pwd ){ 

                     	session_start();
                     	$id=$row['idAdmin'];

               	        $_SESSION['adminid'] =$row['idAdmin'];
				       $_SESSION['adminmail'] =$row['emailAdmin'];
				      header("Location:../admin/index.php?idAdmin=$id");

                  
                    exit();

             	}

            
					
				
			
			     else if ($mdpAdmin !== $pwd){
			     	 array_push($errors, " le mot de passe est incorrecte ! "); }
				     
                     

               
           }         
			
		else {
			array_push($errors, "  L'email est incorrecte ! ");
		}


			}
		}



?>
<?php
include '../style/headerAdmin.php';


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content ="example of meta ">
	<meta name=viewport content="width=deviceçwidth, initial-scale">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../style/css/styleConnexion.css">
</head>
<body>
	
		
	
		<div class="container " > 
    <div class="row content">
    	<div class="loginbox">
    <img src="../photos/admin.png" class="pic">


            	<h1>Connexion</h1>
                
                <form action="" method="post">
             <?php  if (count($errors) > 0) : ?>
	          <div class="error">
	          	<i class="fa fa-times-circle"></i>
		     <?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
		      <?php endforeach ?>
	        </div>
          <?php  endif ?>
	             <p>Email</p>
	             <input type="text" name="mail" placeholder="E-mail" required>
           
            <p>Mot de passe </p>
            <input type="password" name="pwd" placeholder="Password" required>
           
            
            <input type="submit" name="login-admin"  value="Se connecter">
           

				
				
				

            </form>
        
            

          </div>  
		</div>
	</div>
	

</body>
</html>
<?php
include '../style/footer.php';
?>  