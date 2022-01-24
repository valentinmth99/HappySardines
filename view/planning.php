<?php

session_start();

require('../model/classes/Month.php');
require('../model/classes/class_reservations.php');
require('../model/classes/class_user.php');
require('../model/classes/class_admin.php');

$check_admin = new Admin;
$check_admin->CheckAdmin();


$month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
$start = $month->getStartingDay()->modify('last monday');

$currentmonth = date('m');
$currentyear = date('Y');








?>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <title>Planning</title> 
        <!-- CSS only -->
        <link rel="stylesheet" type="text/css" href="style/planning.css">

    </head>

    <body>
        <main>

            <?php require('header.php');?>

            <h1>Planning mensuel</h1>

            
                
                <div class="d-flex flex-row align-itmes-center justify-content-around">

                    <a href="planning.php?location=plage&month=<?php echo $currentmonth; ?>&year=<?php echo $currentyear;?>">La Plage</a>
                    <a href="planning.php?location=pins&month=<?php echo $currentmonth ;?>&year=<?php echo $currentyear;?>">Les Pins</a>
                    <a href="planning.php?location=maquis&month=<?php echo $currentmonth; ?>&year=<?php echo $currentyear;?>">Le Maquis</a>

                </div>

             <?php if (@$_GET['location']== null) { 
                echo "<div> Choisissez un lieu pour afficher son planning </div>" ; ?>

            <?php } else {?>


                <div class="d-flex flex-row align-itmes-center justify-content-between">

                    <h2><?php echo $month->toString() ; ?></h2>

                    <div>
                        <a href="planning.php?location=<?php echo @$_GET['location']?>&month=<?php echo $month->previousMonth()->month?>&year=<?php echo $month->previousMonth()->year?>" class="btn btn-primary">&lt;</a>
                        <a href="planning.php?location=<?php echo @$_GET['location']?>&month=<?php echo $month->nextMonth()->month?>&year=<?php echo $month->nextMonth()->year?>" class="btn btn-primary">&gt;</a>
                    </div>

                </div>

                <table class="planning__table planning__table--<?php echo $month->getWeeks(); ?>weeks">

                    <?php for ($i=0; $i < $month->getWeeks(); $i++) {?>

                        <tr>

                            <?php foreach($month->days as $k => $day) {

                            $date = (clone $start)->modify("+" .($k + $i * 7). "days")?>

                                
                                <td class="<?php if($month->withinMonth($date)===false) {echo "planning__othermonth";}?>">

                                    <?php if ($i === 0 ) { ?> <div class="planning__weekday"><?php echo $day ; } ?></div>

                                    <div class="planning__day">
                                
                                        <?php echo $date->format('d') ;?>
                    
                                    </div>

                                    <div> 
                                        <?php 
                                            $newdate = new Reservations;
                                            $newdate->DisplayReservation($date);
                                            
                                        ?>
                                    </div>

                                    <div>
                                        <?php
                                    

                                        ?>


                                    </div>

                                    


                                </td>

                            <?php } ?>
                        </tr>



                    <?php }?>


                </table>
            <?php }?>

            


        </main>

     <!-- REQUIRE LE FOOTER -->
    
    </body>
</html>