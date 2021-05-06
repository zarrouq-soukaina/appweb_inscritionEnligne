<?php
include '../style/headerAdmin.php';
require '../baseDonnée/db.php';
?>
<div class="container " > 
    <div class="row content">
        
        <h3>Liste des demandes validées </h3>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p class='custom-alert'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>
        <table class="table">
            <thead>
                <tr>
                <th> Matricule </th>
                <th> Nom </th>
                <th> Prénom </th>
                <th>  sexe </th>
                <th> E-mail </th>
                <th> Cycle </th>
                <th> Niveau </th>
                <th> Filiere</th>
                <th> Date de naissance</th>
                <th> Date d'inscription</th>
                
                
                <th> Photo</th>
                <th> Copie de la CIN</th>
                <th> Copie du Baccalauréat</th>
                <th> Attestation de réussite</th>
                <th> état </th>

                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                
<?php
$sql = "SELECT * FROM demandesvalidee";
 $result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    ?>
    
                <tr>
                
                <td> <?php  echo $row['Matricule']?></td>
                <td> <?php  echo $row['Nom']?></td>
                <td> <?php  echo $row['Prenom']?></td>
                <td> <?php  echo $row['Sexe']?></td>
                <td> <?php  echo $row['Email']?></td>
                
                <td> <?php  echo $row['Cycle']?></td>
                <td> <?php  echo $row['Niveau']?></td>
                <td> <?php  echo $row['Filiere']?></td>
                <td> <?php  echo $row['Date_naissance']?></td>
                <td> <?php  echo $row['Date_inscp']?></td>


                
                <td> <?php  echo $row['photos']?></td>
                <td> <?php  echo $row['copie_CIN']?></td>
                <td> <?php  echo $row['copie_BAC']?></td>
                <td> <?php  echo $row['attestation_R']?></td>
                <td> <?php  echo $row['valid']?></td>

                
                <td class="text-right">
                    <a  href="<?php echo 'deletevalid.php? id=' .$row["id"] ?>" class="button button-red">Supprimer</a> 
                   
                </td>
            </tr>
   <?php
    }
}
?>

           </tbody>
        </table>

    </div>
</div>
<?php
include '../style/footer.php';
?>  
