<?php 

session_start();

require('../controller/reservationController.php')

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

                            <label for="arrival">Date d'arrivée* :</label>
                            <div><input type="date" name="arrival"></div>

                            <label for="departure">Date de départ* :</label>
                            <div><input type="date" name="departure"></div>

                            <label for="equipments">Tente ou camping-car* ?</label>
                            <div><select name="equipments" id="equipment-select">
                                <option value="tente">Tente</option>
                                <option value="campingcar">Camping-car</option>
                            </select></div>

                            <label for="location">Choisissez votre emplacement* :</label>
                            <div><select name="location" id="location-choice">
                                <option value="plage">La Plage</option>
                                <option value="pins">Les Pins</option>
                                <option value="maquis">Le Maquis</option>
                            </select></div>


                            <fieldset>
                                <legend>Désirez-vous des options ?</legend>
                                    <div><input type="checkbox" id="elec" name="option_borne">
                                    <label for="option_borne">Borne électrique</label></div>

                                    <div><input type="checkbox" id="club" name="option_discoclub">
                                    <label for="option_discoclub">Accès au Disco-Club</label></div>

                                    <div><input type="checkbox" id="activities" name="option_activities">
                                    <label for="activities">Accès aux activités</label></div>
                            </fieldset>

                            <input type="submit" name="calculate" value="Voir le tarif" class="submitbtn">

                        </form>

                    </div>

                <?php }  ?>