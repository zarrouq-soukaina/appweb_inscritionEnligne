

<?php

###########################################################Vous trouverez le script HTML DU formulaire en bas de la page################# ###########################################################################################################################

$errors = array(); 

require '../baseDonnée/db.php';

	if (isset($_POST['envoyer'])) {
		
		
  

		$Matricule =mysqli_real_escape_string($conn, $_POST["matricule"]); 
		$Nom = mysqli_real_escape_string($conn , $_POST["nom"]);
		$Prenom = mysqli_real_escape_string($conn, $_POST["prenom"]);
		$Cycle = mysqli_real_escape_string($conn, $_POST["cycle"]);
		$Niveau = mysqli_real_escape_string($conn,$_POST["niveau"]);
		$sexe = mysqli_real_escape_string($conn, $_POST["sexe"]);
		$filiere=mysqli_real_escape_string($conn, $_POST["filiere"]);
		$date_naissance=mysqli_real_escape_string($conn, $_POST["date_naiss"]);
		
		$Email = mysqli_real_escape_string($conn, $_POST["mail"]);
		$password =mysqli_real_escape_string($conn, $_POST["pwd"]);
		$passwordRepeat = mysqli_real_escape_string($conn, $_POST["pwd-repeat"]);	
	
		#invalid email
		if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
				 array_push($errors, " Format d'email invalide "); }
		else{
		$sqlemai = "SELECT Email FROM informations WHERE Email = ?  ";
		$sqlemai2 = "SELECT Email FROM demandesvalidee WHERE Email = ?  ";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt,$sqlemai) || !mysqli_stmt_prepare($stmt,$sqlemai2) ) {

				array_push($errors, " erreur SQQL ! ");
			}
			else{
				mysqli_stmt_bind_param($stmt, "s",$Email );
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$result = mysqli_stmt_num_rows($stmt);
				
				if ($result > 0) {



					array_push($errors, " Cet email est déjà pris  ! ");
				 }
				}
			}
			
		
		if (!preg_match("/^[a-zA-Z0-9]*/",$Nom)) 
			 { array_push($errors, " invalide nom : seules les lettres et les espaces blancs sont autorisés "); }
		
		
		
		if (!preg_match("/^[a-zA-Z0-9]*/",$Prenom)) 
			
			{ array_push($errors, " invalide prénom :seules les lettres et les espaces blancs sont autorisés "); }
		
		
	if(strlen($password) < 6)
		{ array_push($errors, " Le mot de passe doit comporter plus de 6 caractères! "); }

		
if ($password !== $passwordRepeat) 
			{ array_push($errors, " les deux mots de passe doivent être identiques  "); }
		
 

//inserer les fichiers 
$imagename =  $_FILES['image']['name'] ;
$fileExp = explode('.',$imagename ) ;
$fileActualExt_img = strtolower(end($fileExp));



$CINname =  $_FILES['CIN']['name'] ;
$fileExp_cin = explode('.',$CINname ) ;
$fileActualExt_cin = strtolower(end($fileExp_cin));



$bacname =  $_FILES['Baccalaureat']['name'] ;
$fileExp_bac = explode('.',$bacname ) ;
$fileActualExt_bac = strtolower(end($fileExp_bac));


$attesname =  $_FILES['attestation']['name'] ;
$fileExp_attes = explode('.',$attesname ) ;
$fileActualExt_attes = strtolower(end($fileExp_attes));








$allowd = array('jpg','jpeg','png' );


if ( empty($imagename) || empty($CINname) || empty($bacname) || empty($attesname) ) {
	array_push($errors, " inserer toutes les fichiers demandés ");
}

		                      

		
if (count($errors) == 0){

$hashpwd = password_hash($password, PASSWORD_DEFAULT);
$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
$token = str_shuffle($token);
$token = substr($token, 0, 10);


#$sql1="SELECT * FROM informations WHERE Email=$Email";
#$res=$conn->query($sql1);
#$row=$res->fetch_assoc();
#$id_etudiant = $row['id'];

#renommer les fichiers  :


	$New_image = "$Matricule"."_"."$filiere"."_"."$Niveau"."."."$fileActualExt_img";
    

    $New_cin = "$Matricule"."_"."$filiere"."_"."$Niveau"."."." $fileActualExt_cin";
    
    $New_bac = "$Matricule"."_"."$filiere"."_"."$Niveau"."."." $fileActualExt_bac";
    

    $New_attes = "$Matricule"."_"."$filiere"."_"."$Niveau"."."." $fileActualExt_attes";
    # le chemin pour stocker l'image téléchargée 

    $target_img="../fichiers_Etudiant/images/".$New_image ;
    $target_cin="../fichiers_Etudiant/CIN/". $New_cin;
    $target_bac="../fichiers_Etudiant/copie_BAC/".$New_bac;
    $target_attes="../fichiers_Etudiant/attestation_reussite/".$New_attes ;
   
   



   	
			

if(in_array($fileActualExt_img, $allowd) and in_array($fileActualExt_cin, $allowd) and in_array($fileActualExt_bac, $allowd) and in_array($fileActualExt_attes, $allowd)){
   if (move_uploaded_file($_FILES['image']['tmp_name'], $target_img  ) && move_uploaded_file($_FILES['CIN']['tmp_name'],$target_cin ) && move_uploaded_file($_FILES['Baccalaureat']['tmp_name'],$target_bac ) && move_uploaded_file($_FILES['attestation']['tmp_name'],$target_attes)) {

   	


	$sql = "INSERT INTO informations (Matricule ,Nom , Prenom , Cycle , Niveau , Date_naissance , Sexe, Filiere , photos, copie_CIN , copie_BAC, attestation_R, Email, password , valid ,token  )values ('$Matricule','$Nom','$Prenom','$Cycle' , '$Niveau' ,'$date_naissance' , '$sexe','$filiere' , '$New_image' , '$New_cin' , '$New_bac' , '$New_attes', '$Email', '$hashpwd' ,'0','$token'  ) " ;
	if ($conn->query($sql) === TRUE) {
	
  header("Location:pageattente.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

	 }else {echo "erreur à l'enregistrement"; }
	}else{echo "les fichiers doivent etre de type:'jpg','jpeg','png' ";}

$conn->close(); 
  





		}


	}
	?>



<?php
include '../style/header.php';


?>




	<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  

	
	<title>Inscription </title>
	
		
	
	<link rel="stylesheet" href="../style/css/style.css">
	<link rel="stylesheet" href="../style/css/inscription.css">

	
	

	
</head>
<body>

			
				<div class="container " > 
    <div class="row content">
    	<form class="regForm" action="" method="post"  enctype="multipart/form-data">
  <h1>Inscription</h1>



	          	<?php  if (count($errors) > 0) : ?>
	          <div class="error">
	          	<i class="fa fa-times-circle"></i>
		     <?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
		      <?php endforeach ?>
	        </div>
          <?php  endif ?>

			
			
                <div class="tab">
				  <label>Nom :</label>
    <p><input placeholder="Nom" type="text"  name="nom" required></p>
    <label> Prénom : </label>
    <p><input placeholder="Prénom" type="text" name="prenom" required> </p>
    <label>Matricule</label>
    <p><input placeholder="Matricule" type="text" name="matricule"></p>
     <label >Date de naissance :</label>

      <p><input  name="date_naiss" type="date" required></p>

    
     <div class="box">

                                  
         <p><select name="sexe" required></p>
         <option disabled="disabled" selected="selected">Sexe</option>
        <option value="F">Femme</option>
      <option value="H">Homme</option>
                                  
        </select>
      </div>
  </div>
   <div class="tab">
    <label>Adresse Email:</label>
    <p><input placeholder="E-mail" type="text" name="mail" required></p>
    <label>Mot de passe</label>
    <p><input placeholder="Mot de passe" name="pwd" type="password" required></p>
     <label>Confirmation de mot de passe</label>
    <p><input placeholder="Répetez votre mot de passe" name="pwd-repeat" type="password" required></p>
  </div>

  <div class="tab">

   <div class="box">
  
                                    
    <p> <select name="cycle" required></p>
   <option disabled="disabled" selected="selected">Cycle</option>
     <option value="Ingenieur"> ingénieur d’Etat</option>
      <option value="Master">Master</option>
    <option value="Doctorat">  Doctorat</option>
                                  
    </select>
    </div>
 

     
      <div class="box">
       
       
     
      <p><select name="niveau" required>
       <option disabled="disabled" selected="selected">Niveau</option>
      <option value="1A">1ere Annee</option>
       <option value="2A">2eme Annee</option>
      <option value="3A">3eme Annee</option>
                                  
      </select>
    </div>
     

       <div class="box">
        
                             <p> <select name="filiere"  required>
                                <option disabled="disabled" selected="selected">Filiére</option>
                                    <option value="Ac finance">Actuariat-Finance</option>
                                    <option value="Stat eco">Statistique-Economie Appliquée</option>
                                    <option value="Stat demo">Statistique-Démographie</option>
                                    <option value="RO"> Recherche Opérationnelle et Aide à la Décision</option>
                                    <option value="DSE">Ingénierie des Données et des Logiciels</option>
                                    <option value="DS">Science des Données</option>
                                </select></p>
                              </div>






    
  </div>
 
  


  <div class="tab">
  	 <div align="center">
  
  <p><h4><FONT color="#0000CD"><u>Assurez-vous que  toutes les images insérés soient lisibles et de haute qualité</u></FONT></h4></p>
</div>

                            <label >photo:</label>
                          <p>  <input placeholder="photo" type="file" name="image" required></p>
                    
                       
                            <label >Copie de la CIN:</label>
                           <p> <input  type="file" name="CIN" required></p>
                    
                       
                            <label >Copie du Baccalauréat</label>
                            <p><input  type="file" name="Baccalaureat" required></p>
                 
                      
                            <label >Attestation de réussite</label>
                          <p>  <input  type="file" name="attestation" required></p>
                        
                     
   
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Précedants</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Suivant</button>
      

    </div>
  </div>
 <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
  <div align="center">
  <p><h3>vous avez déja un compte ?<a href="../connexion_Etudiant/index.php">Connectez-vous ici</a></h3></p>
  </div>
					
                    </form>

                    <script>
var currentTab = 0;
showTab(currentTab);

function showTab(n) {
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn"). innerHTML= "envoyer";
    document.getElementById("nextBtn").type = "submit";
     document.getElementById("nextBtn").name = "envoyer";

  } else {
    document.getElementById("nextBtn").innerHTML = "Suivant";
  }
  fixStepIndicator(n)
}

function nextPrev(n) {
  var x = document.getElementsByClassName("tab");
  if (n == 1 && !validateForm()) return false;
  x[currentTab].style.display = "none";
  currentTab = currentTab + n;
  if (currentTab >= x.length) {
    document.getElementById("regForm").submit();
    return false;
  }
  showTab(currentTab);
}

function validateForm() {
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  for (i = 0; i < y.length; i++) {
    if (y[i].value == "") {
      y[i].className += " invalid";
      valid = false;
    }
  }
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid;
}
function fixStepIndicator(n) {
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  x[n].className += " active";
}
</script>
			

				

				


			
	
	
</div>
</div>
				
			
			
		</section>
		
		
	

	
		

		
	


</body>
</html>
<?php
include '../style/footer.php';


?>