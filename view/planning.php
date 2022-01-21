<?php

require('../model/classes/Month.php');
require('../model/classes/class_reservations.php');
require('../model/classes/class_user.php');


$month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
$start = $month->getStartingDay()->modify('last monday');

$currentmonth = date('m');
$currentyear = date('Y');

$dates = new Reservations();
$dates->BetweenDates();

var_dump($dates);




?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Planning</title> 
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style/planning.css">

    </head>

    <body>
        <main>

            <h1>Planning mensuel</h1>

            
            <div class="d-flex flex-row align-itmes-center justify-content-around">

                <a href="planning.php?location=plage&month=<?php echo $currentmonth; ?>&year=<?php echo $currentyear;?>">La Plage</a>
                <a href="planning.php?location=pins&month=<?php echo $currentmonth ;?>&year=<?php echo $currentyear;?>">Les Pins</a>
                <a href="planning.php?location=maquis&month=<?php echo $currentmonth; ?>&year=<?php echo $currentyear;?>">Le Maquis</a>

            </div>


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

                                <div class="planning__day"><?php echo $date->format('d')?></div>
                            </td>

                        <?php } ?>
                    </tr>



                <?php }?>


            </table>

            


        </main>

     <!-- REQUIRE LE FOOTER -->
    
    </body>
</html>