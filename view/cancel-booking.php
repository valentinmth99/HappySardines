<?php 

session_start();
require('../controller/cancel-bookingController.php');

?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Annuler votre réservation</title> 
        <link rel="stylesheet" type="text/css" href="style/reserver.css">
    </head>

    <body>
        
        <?php require('header.php')?>

        <main>

            <div><h2 class="boxtitle"> Annuler votre réservation </h2></div>

                <p class="intro">Êtes-vous sûr de vouloir annuler cette réservation ?</p>

                <form action="cancel-booking.php" method="post">
                    <input class="submitbtn" type="submit" name="confirmcancel" value="Confirmer l'annulation">
                </form>

                <form action="compte.php">
                    <input class="submitbtn" type="submit" name="nocancel" value="Je n'annule pas">
                </form>

        </main>
        
        <!-- REQUIRE FOOTER -->

    </body>