<html>
    <head>
        <meta charset="utf-8">
        <title>Réservation</title>
    </head>
    <body>

        <?php require("header.php"); ?> 

        <main>
              
            <section class="content">


                <h1 class="titre">RÉSERVATION</h1>

                <?php if(isset($_SESSION['login'])) { ?>

                    <p class="intro"> 
                        Remplissez le formulaire ci-dessous pour faire votre réservation. <br>
                        Votre séjour doit être d'une durée minimum d'une nuit. <br>
                    </p>

                    <div class="formbox">

                        <form action="reservation-form.php" method="post" class="styleform">


                            <div class="errform"><?php if (isset($err_title)) { echo $err_title ;} ?></div>
                            <div><input type="text" class="basicinput" name="title" placeholder="Titre de l'évènement" value=<?php if(isset($_POST['title'])) {echo $_POST['title'];}?>></div>

                            <div class="errform"><?php if (isset($err_description)) { echo $err_description ;} ?></div>
                            <div><textarea class="textinput" name="description" placeholder="Description"  value=<?php if (isset($_POST['description'])){echo $_POST['description'];}?>></textarea></div>

                            <!-- AJOUTER UN COMPTEUR DE CARACTERES -->

                            <div class="errform"><?php if (isset($err_indisponible)) { echo $err_indisponible ;} ?></div>
                            <div><input type= "datetime-local" name="day" step="3600"></div>

                            <input type="submit" name="reserver" value="Réserver" class="submitbtn">

                        </form>

                    </div>

                <?php }  ?>