<?php

session_start();

require('../model/classes/class_user.php');
require('../model/classes/class_admin.php');
require('../controller/reservationsController.php');

$check_admin = new Admin;
$check_admin->CheckAdmin();

?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Compte</title> 
        <link rel="stylesheet" type="text/css" href="style/compte.css">
    </head>

    <body>

      <?php require('header.php')?>

        <main>

            <section class="container">

                <div class="box">

                    <form action ="reservations.php" method="post">

                        <div><h2 class="boxtitle"> Rechercher une réservation</h2></div>
                        
                        <form action="reserver.php" method="post" class="styleform">

                        <label for="arrival">Date d'arrivée :</label>
                        <div><input class="date" type="date" name="arrival"></div>

                        <label for="departure">Date de départ :</label>
                        <div><input class="date" type="date" name="departure"></div>

                        <label for="firstname">Prénom :</label>
                        <div><input class="userinput" type="text" name="firstname"></div>

                        <label for="lastname">Nom :</label>
                        <div><input class="userinput" type="text" name="lastname"></div>

                        <label for="location">Emplacement :</label>

                        <div><select name="location" id="location-choice">
                            <option value="">Choisir une option</option>
                            <option value="plage">La Plage</option>
                            <option value="pins">Les Pins</option>
                            <option value="maquis">Le Maquis</option>
                        </select></div>

                        <input type="submit" name="research" value="Rechercher" class="submitbtn">
                    
                    </form>


                </div>

                <div class="box">

                    <div><h2 class="boxtitle"> Détailss </h2></div>

                </div>
            </section>

        
        </main>
    </body>
</html>
