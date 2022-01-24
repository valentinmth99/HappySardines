<?php 

session_start();

require('../controller/reservationController.php')

?>

<html>

    <head>
        <meta charset="utf-8">
        <title>Réservation</title>
        <link rel="stylesheet" href="style/reservations.css">
    </head>

    <body>

        <?php require("header.php"); ?> 

        <main>
              
            <section class="content">

                <h2 class="titre">RÉSERVER</h2>

                <?php if(isset($_SESSION['login'])) { 

                    if ($calculrate == 0){?>
                    
                        <p class="intro"> 
                            Remplissez le formulaire ci-dessous pour faire votre réservation. <br>
                            Votre séjour doit être d'une durée minimum d'une nuit. <br>
                        </p>

                        <div class="formbox">

                            <form action="reserver.php" method="post" class="styleform">

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

                                <input type="submit" name="calculate" value="Voir le tarif" class="submitbtn">
                            
                            </form>
                        </div>
                    <?php } 

                    else { ?>

                        <p> Vous devrez régler un total de <?php echo $rate ?> euros pour ce séjour. </p>
                        <form action="reservations.php" method="post">
                        <input type="submit" name="book" value="Confirmer votre réservation" class="submitbtn">
                        </form>
                    
                    <?php } 

                } 
                
                else { ?>

                    <p> <a href="compte.php">Connectez</a> vous pour réserver.</p>
                    
                <?php } ?>
               
            
            
            </section>

        </main>
    </body>
</html>
        