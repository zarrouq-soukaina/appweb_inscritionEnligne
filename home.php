 

 <?php
include 'style/headerHome.php';
require 'baseDonnée/db.php'; 

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container " > 
    <div class="row content">
    	<div class="blocktext" >
	

	<P ><h3><img src="photos/INSEA_logo.png " width="50" height="50"><FONT color="seagreen">Bienvenue au site d'inscription à l'institut national de statistique et d'economie appliquée </FONT></h3></P></br>
  <?php
        $sql = "SELECT * FROM admin";
       $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
       $row = mysqli_fetch_assoc($result);
       $deadline= $row['deadline'];
        }

    ?>

  <p ><h4 ><FONT color="firebrick">Veuillez vous inscrire avant la date limite :<?php echo $deadline ;?></FONT> </h4></p>
</div>
	
	<table class="center">
     <tr>
    <th><img src="photos/etudiant.png " width="200" height="200"></th> 
    <th width="250" height="200"></th>
    <th ><img src="photos/admin.png " width="200" height="200"></th>
    
   
  </tr>
<tr>
    <td ><h1><a href="connexion_Etudiant/index.php">Espace étudiant </a></h1></td>
    <td width="250" height="200"></td>
    <td ><h1><a href="connexion_Admin/index.php">Espace admin</a></h1></td>
    
   
  </tr>
  </table>





</div>
</div>

</body>
</html>








 <?php
 include 'style/footer.php';
 ?>
