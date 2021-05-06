



<!DOCTYPE html>
<html >
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../style/css/style.css">

    </head>
    <body >
         <?php
        include '../class/etudiant.php';
        $etudiant_obj = new Etudiant();
        ?>  



        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                                                
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                          <li> <img src="../photos/INSEA_logo.png" alt="CE" class="tlogo"> </li>
                       
                        
                         <?php if(isset($_SESSION['adminid'])): ?>
                             <li class="active" ><a href="../connexion_Admin/logout.php" > Se déconnecter</a></li>
                        <li class="active"><a href="index.php">Home</a></li>
                           
                        <?php else: ?>
                              
                            <li class="active"><a href="../index.php">Home</a></li>
                        <li class="active"><a href="../connexion_Admin/index.php" >Se connecter </a></li>

                           
                        
                        <?php endif; ?>
                        
                    </ul>

                </div>
            </div>
        </nav>