<?php
include '../style/header.php';
if (isset($_GET['id'])) {
  $etudiant_info=$etudiant_obj->profil_etudiant($_GET['id']);
    if (isset($_POST['update_etudiant']) && $_GET['id'] === $_POST['id']) {
        $etudiant_obj->updateEtudiant($_POST);
    }
} else {
    header('Location: index.php');
}
?>
<div class="container " > 
    <div class="row content">
        
        <h3>Modifier vos choix : </h3>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p class='custom-alert'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>

        <hr/>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php if (isset($etudiant_info['id'])) {
            echo $etudiant_info['id'];
        } ?>" id=""  >
            
             <div class="form-group">
                <label >Niveau:</label>
                <select class="form-control" name="niveau" >
                    
                    <option value="1A" <?php if (isset($student_info['Niveau']) && $student_info['Niveau'] == '1A') {echo 'selected'; } ?>>1ére année</option>
                    <option value="2A" <?php if (isset($student_info['Niveau']) && $student_info['Niveau'] == '2A') {echo 'selected'; } ?>>2éme année</option>
                    <option value="3A" <?php if (isset($student_info['Niveau']) && $student_info['Niveau'] == '3A') {echo 'selected'; } ?>>3éme année</option>

                </select>

            </div> 
             <div class="form-group">
                <label >Filiére:</label>
                <select class="form-control" name="filiere" >
                    
                    <option value="Ac finance" <?php if (isset($student_info['Filiere']) && $student_info['Filiere'] == 'Ac finance') {echo 'selected'; } ?>>Actuariat-Finance</option>
                    <option value="Stat eco" <?php if (isset($student_info['Filiere']) && $student_info['Filiere'] == 'Stat eco') {echo 'selected'; } ?>>Statistique-Economie Appliquée</option>
                    <option value="Stat demo" <?php if (isset($student_info['Filiere']) && $student_info['Filiere'] == 'Stat demo') {echo 'selected'; } ?>>Statistique-Démographie</option>
                    <option value="RO" <?php if (isset($student_info['Filiere']) && $student_info['Filiere'] == 'RO') {echo 'selected'; } ?>>Recherche Opérationnelle et Aide à la Décision</option>
                    <option value="DSE" <?php if (isset($student_info['Filiere']) && $student_info['Filiere'] == 'DSE') {echo 'selected'; } ?>>Ingénierie des Données et des Logiciels</option>
                    <option value="DS" <?php if (isset($student_info['Filiere']) && $student_info['Filiere'] == 'DS') {echo 'selected'; } ?>>Science des Données</option>

                </select>

            </div> 
            <div class="form-group">
                <label >Cycle:</label>
                <select class="form-control" name="cycle" >
                    
                    <option value="Ingenieur" <?php if (isset($student_info['Cycle']) && $student_info['Cycle'] == 'Ingenieur') {echo 'selected'; } ?>>ingénieur d’Etat<option>
                    <option value="Master" <?php if (isset($student_info['Cycle']) && $student_info['Cycle'] == 'Master') {echo 'selected'; } ?>>Master</option>
                    <option value="Doctorat" <?php if (isset($student_info['Cycle']) && $student_info['Cycle'] == 'Doctorat') {echo 'selected'; } ?>>Doctorat</option>

                </select>

            </div> 
           

        
            <input type="submit" class="button button-pink  pull-right" name="update_etudiant" value="Enregister les modifications"/>
        </form> 
    </div>
</div>
<hr/>


<?php include '../style/footer.php';?>