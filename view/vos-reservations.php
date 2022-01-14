<?php

session_start();
require('../controller/compteController.php');


?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Vos réservations</title> 
        <link rel="stylesheet" type="text/css" href="style/compte.css">
    </head>

    <body>
        
        <?php require('header.php')?>

        <div class="reservationsbox">

            <div><h2 class="boxtitle"> Vos réservations </h2></div>

                <table border="1">
                    <tr>
                        <td>Date d'arrivée</td>
                        <td><?php echo $getinfos_booking->arrival;?></td>
                    </tr>
                    <tr>
                        <td>Date de départ</td>
                        <td><?php echo $getinfos_booking->departure;?></td>
                    </tr>
                    <tr>
                        <td>Equipement</td>
                        <td><?php echo $getinfos_booking->equipment;?></td>
                    </tr>
                    <tr>
                        <td>Emplacement</td>
                        <td><?php echo $getinfos_booking->location;?></td>
                    </tr>
                    <tr>
                        <td>Option borne électrique</td>
                        <td><?php echo $getinfos_booking->option_borne;?></td>
                    </tr>
                    <tr>
                        <td>Option accès au disco-club</td>
                        <td><?php echo $getinfos_booking->option_discoclub;?></td>
                    </tr>
                    <tr>
                        <td>Option accès aux activités</td>
                        <td><?php echo $getinfos_booking->option_activities;?></td>
                    </tr>
                    <tr>
                        <td>Prix total</td>
                        <td><?php echo $getinfos_booking->rate;?></td>
                    </tr>
                </table>

                <form action="update-booking.php" method="post">
                    <input type="submit" name="updatebooking" value="Modifier votre réservation">
                </form>
                
    </body>