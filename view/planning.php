<?php

require('../model/classes/Month.php');


$month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
$start = $month->getStartingDay()->modify('last monday');






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

            <h2><?php echo $month->toString() ; ?></h2>

            <?php echo $month->getWeeks();?>


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