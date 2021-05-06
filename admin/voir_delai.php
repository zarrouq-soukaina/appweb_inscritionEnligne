<?php
 include '../style/headerAdmin.php';
 

 if(isset($_GET['idAdmin'])){
  $etudiant_info=$etudiant_obj->view_deadline($_GET['idAdmin']);
  


     
 }else{
  header('Location: index.php');
 }
 
 
 ?>
<div class="container " > 
    
  <div class="row content">

       
          
           
             
 <h3></h3>
       
    
     <hr/>
   
   
 
      
    <label ><h1>Late limite d'inscription:</h1></label>
   <h1><?php  if(isset($etudiant_info['deadline'])){echo  $etudiant_info['deadline']; }?></h1>

<br/>
<a href="<?php echo 'modifier_delai.php?idAdmin=' ?>" class="button button-blue">Modifier la date limite</a>

  
   
  
     
   
  </div>
     
</div>
<hr/>
 <?php
 include '../style/footer.php';
 ?>
