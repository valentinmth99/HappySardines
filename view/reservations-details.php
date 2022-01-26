<?php

session_start();

require('../model/classes/class_reservations.php');




?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Infos Réservation</title> 
        <link rel="stylesheet" type="text/css" href="style/compte.css">
    </head>

    <body>

      <?php require('header.php')?>

        <main>

            <section>
                <?php 
                    $get_reservation_details = new Reservations ;
                    $get_reservation_details->GetReservationsDetails();
                ?>

                <form action="update-booking.php" type="post">
                    <input type="submit" name="updatebookingform" value="Modifier votre réservation" class="submitbtn1">
                </form>

                <form action="cancel-booking.php" type="post">
                    <input type="submit" name="cancelbooking" value="Annuler votre réservation" class="submitbtn">
                </form>


            </section>

        
        </main>
    </body>
</html>





