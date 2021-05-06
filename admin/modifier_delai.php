<?php
include '../style/headerAdmin.php';
require '../baseDonnée/db.php';
if (isset($_GET['idAdmin'])) {
  $etudiant_info=$etudiant_obj->view_deadline($_GET['idAdmin']);
    if (isset($_POST['update_deadline']) ) {
        $etudiant_obj->updatedeadline($_POST);
    }
} else {
    header('Location: index.php');
}
?>
<div class="container " > 
    <div class="row content">
        
        <h3>Modifier la date limite d'inscription : </h3>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p class='custom-alert'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>

        <hr/>
        <form method="post" action="">
            <input type="hidden" name="idAdmin" value="<?php if (isset($etudiant_info['idAdmin'])) {
            echo $etudiant_info['idAdmin'];
        } ?>" idAdmin=""  >
            <div class="form-group">
                <label >Date limite :</label>
                <input type="date" name="deadline" value="<?php if (isset($etudiant_info['deadline'])){echo $etudiant_info['deadline']; } ?>"  class="form-control" required maxlength="50" >

            </div>
   <input type="submit" class="button button-green  pull-right" name="update_deadline" value="Enregister les modifications"/>
        </form> 
    </div>
</div>
<hr/>
<?php
include '../style/footer.php';
?>
