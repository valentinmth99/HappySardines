<?php 

session_start();

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Réservation</title>
    </head>
    <body>

        <?php require("header.php"); ?> 

        <main>
              
            <section class="content">

                <h2 class="titre">RÉSERVATION</h2>

                <?php if(isset($_SESSION['login'])) { ?>

                    <p class="intro"> 
                        Remplissez le formulaire ci-dessous pour faire votre réservation. <br>
                        Votre séjour doit être d'une durée minimum d'une nuit. <br>
                    </p>

                    <div class="formbox">

                        <form action="reservations.php" method="post" class="styleform">

                            <div class="errform"><?php if (isset($err_arrival)) { echo $err_arrival ;} ?></div>
                            <label for="arrival-date">Date d'arrivée :</label>
                            <div><input type="date" name="arrival"></div>

                            <div class="errform"><?php if (isset($err_depart)) { echo $err_depart ;} ?></div>
                            <label for="depart-date">Date de départ :</label>
                            <div><input type="date" name="depart"></div>

                            <label for="habit">Tente ou camping-car ?</label>
                            <div><select name="habit" id="habit-select">
                                <option value="tente">Tente</option>
                                <option value="campingcar">Camping-car</option>
                            </select></div>

                            <label for="emplacement">Choisissez votre emplacement :</label>
                            <div><select name="emplacement" id="emplacement-choice">
                                <option value="plage">La Plage</option>
                                <option value="pins">Les Pins</option>
                                <option value="maquis">Le Maquis</option>
                            </select></div>

                            <div class="errform"><?php if (isset($err_dispo)) { echo $err_dispo ;} ?></div>

                            <fieldset>
                                <legend>Désirez-vous des options ?</legend>
                                    <div><input type="checkbox" id="elec" name="option">
                                    <label for="elec">Borne électrique</label></div>

                                    <div><input type="checkbox" id="club" name="option">
                                    <label for="club">Accès au Disco-Club</label></div>

                                    <div><input type="checkbox" id="activites" name="option">
                                    <label for="activites">Accès aux activités</label></div>
                            </fieldset>

                            <input type="submit" name="calcul_tarif" value="Voir le tarif" class="submitbtn">

                        </form>

                    </div>

                <?php }  ?>