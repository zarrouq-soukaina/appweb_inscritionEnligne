<?php
 include '../style/header.php';
 

 if(isset($_GET['id'])){
  $etudiant_info=$etudiant_obj->profil_etudiant($_GET['id']);
  


     
 }else{
  header('Location: index.php');
 }
 
 
 ?>
<div class="container " > 
    
  <div class="row content">

       
          
           
             
 <h3></h3>
 <p><h4>Vous trouverez ici l'ensemble des informations que vous avez saisis, veuillez les vérifier. Vous pouvez effectuer des modifications en cas d'erreur avant la date limite fixée.</p></h4>
       
    
     <hr/>
   
   
 
      
    <label >Matricule:</label>
   <?php  if(isset($etudiant_info['Matricule'])){echo $etudiant_info['Matricule']; }?>

<br/>
 <label > Nom :</label>
   <?php  if(isset($etudiant_info['Nom'])){echo $etudiant_info['Nom']; }?>
   <br/>
    <label > Prénom :</label>
   <?php  if(isset($etudiant_info['Prenom'])){echo $etudiant_info['Prenom']; }?>
   <br/>

   <label >Email :</label>
   <?php  if(isset($etudiant_info['Email'])){echo $etudiant_info['Email']; }?>
   <br/>
   
 <label >Sexe:</label>
   <?php  if(isset($etudiant_info['Sexe'])){echo $etudiant_info['Sexe']; }?>
   <br/>
   <label >Date de naissance :</label>
   <?php  if(isset($etudiant_info['Date_naissance'])){echo $etudiant_info['Date_naissance']; }?>
   <br/>
    <label >Date d'inscription :</label>
   <?php  if(isset($etudiant_info['Date_inscp'])){echo $etudiant_info['Date_inscp']; }?>
   <br/>
 <label >Cycle :</label>
   <?php  if(isset($etudiant_info['Cycle'])){echo $etudiant_info['Cycle']; }?>
   <br/>
 <label >Niveau :</label>
   <?php  if(isset($etudiant_info['Niveau'])){echo $etudiant_info['Niveau']; }?>
   <br/>
 <label >Filiere :</label>
   <?php  if(isset($etudiant_info['Filiere'])){echo $etudiant_info['Filiere']; }?>
   <br/>

 <label >photo:</label>
   <?php  if(isset($etudiant_info['photos'])){echo $etudiant_info['photos']; }?>
   <br/>
 <label> copie de CIN :</label>
  <?php  if(isset($etudiant_info['copie_CIN'])){echo $etudiant_info['copie_CIN'];} ?>
    
    <br/>
    <label >copie de BAC :</label>
      <?php  if(isset($etudiant_info['copie_BAC'])){echo $etudiant_info['copie_BAC'];} ?>
    <br/>

  <label > attestation_R :</label>
   <?php  if(isset($etudiant_info['attestation_R'])){echo $etudiant_info['attestation_R'];} ?>
  <br/>
    
 <a href="<?php echo 'EditEtudiant.php?id='.$etudiant_info["id"] ?>" class="button button-purple">Modifier </a>
          

  
   
  <hr/>
     
   
  </div>
     
</div>

 <?php include '../style/footer.php';?>