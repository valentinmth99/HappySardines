<?php

session_start();

require('../model/classes/class_reservations.php');

$get_reservation_details = new Reservations ;
$get_reservation_details->GetReservationsDetails();


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

            <section class="container">

                

            </section>

        
        </main>
    </body>
</html>





