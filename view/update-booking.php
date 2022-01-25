<?php 

session_start();

require('../controller/update-bookingController.php')

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Modifier votre réservation</title>
        <link rel="stylesheet" href="style/reserver.css">
    </head>
    <body>

        <?php require("header.php"); ?> 

        <main>
              
            <section class="content">

                <h2 class="titre">MODIFIER VOTRE RÉSERVATION</h2>

                <?php if(isset($_SESSION['login'])) { ?>

                    <p class="intro"> 
                        Remplissez le formulaire ci-dessous pour modifier votre réservation. <br>
                        Votre séjour doit être d'une durée minimum d'une nuit. <br>
                    </p>

                    <div class="formbox">

                        <form action="update-booking.php" method="post" class="styleform">

                            <label for="arrival">Date d'arrivée* :</label>
                            <div><input class="date" type="date" name="arrival"></div>

                            <label for="departure">Date de départ* :</label>
                            <div><input class="date" type="date" name="departure"></div>

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
                                    <input type="checkbox" id="elec" name="option_borne">
                                    <label for="option_borne">Borne électrique</label>

                                    <input type="checkbox" id="club" name="option_discoclub">
                                    <label for="option_discoclub">Accès au Disco-Club</label>

                                    <input type="checkbox" id="activities" name="option_activities">
                                    <label for="option_activities">Accès aux activités</label>
                            </fieldset>

                            <?php if(isset($err_field)){echo $err_field;} 
                                  if(isset($err_date)){echo $err_date;}
                                  if(isset($err_reservation)){echo $err_reservation;}?>
                            <br>
                            <input type="submit" name="updatebooking" value="Modifier votre réservation" class="submitbtn">

                        </form>

                    </div>

                <?php }  ?>