<?php

//ETAPE 1 : DEFINITION DES VARIABLES 

    $year = date("Y");

    if(!isset($_GET['month'])) {

        $monthnb = date("n");
    }

    else {
        $monthnb = $_GET['month'];
        $year = $_GET['year'];
    }

    if($monthnb <= 0) {
        $monthnb = 12;
        $year = $year - 1;
    }

    elseif($monthnb > 12) {
        $monthnb = 1;
        $year = $year + 1;
    }

    $day = date("w");
    $nbdays = date("t", mktime(0,0,0,$monthnb,1,$year));
    $firstday = date("w",mktime(0,0,0,$monthnb,1,$year));

    //ETAPE 2 : TRADUCTION JOURS EN FR

    $daytab[1] = 'Lu';
    $daytab[2] = 'Ma';
    $daytab[3] = 'Me';
    $daytab[4] = 'Je';
    $daytab[5] = 'Ve';
    $daytab[6] = 'Sa';
    $daytab[7] = 'Di';

    //ETAPE 3 : INITIALISATION DE LA TABLE DU CALENDRIER

    $calendar = array();

    $z = (int)$firstday;

    if($z == 0) {$z =7;}

    for($i = 1; $i <= ($nbdays/5); $i++){
    
        for($j = 1; $j <= 7 && $j-$z+1+(($i*7)-7) <= $nbdays; $j++){
            
            if($j < $z && ($j-$z+1+(($i*7)-7)) <= 0){
                $calendar[$i][$j] = null;
            }

            else {
                $calendar[$i][$j] = $j-$z+1+(($i*7)-7);
            }
        }
    
    }  

    //ETAPE 4: TRADUCTION DES MOIS EN FRANCAIS

switch($monthnb) {
    case 1: $month = 'Janvier'; break;
    case 2: $month = 'Fevrier'; break;
    case 3: $month = 'Mars'; break;
    case 4: $month = 'Avril'; break;
    case 5: $month = 'Mai'; break;
    case 6: $month = 'Juin'; break;
    case 7: $month = 'Juillet'; break;
    case 8: $month = 'Août'; break;
    case 9: $month = 'Septembre'; break;
    case 10: $month = 'Octobre'; break;
    case 11: $month = 'Novembre'; break;
    case 12: $month = 'Décembre'; break;
    }

?>

<!-- ETAPE 5: CALENDRIER EN HTML -->

<html>
    <head>
        <meta charset="utf-8">
        <title>Planning</title>
        <link rel="stylesheet" href="style/header.css">
        <link rel="stylesheet" href="planning.css">
    </head>

    <body>

        <?php require('header.php') ; ?>
        
        <main>

    <div id="calendrierMain">

    <div id="TopCalendrier">
        <span class="linkcal"><a href="testplanning.php?month=<?php echo $monthnb - 1; ?>&year=<?php echo $year; ?>"> << </a></span>
        <span class="headcal"><?php echo($month.' '.$year); ?></span>
        <span class="linkcal"><a href="testplanning.php?month=<?php echo $monthnb + 1; ?>&year=<?php echo $year; ?>"> >> </a></span>
    </div>

    <?php
    
    echo('<div id="JCalendrier">');

    for($i = 1; $i <= 7; $i++){
        
        echo('<div id="JCalContenu">'.$daytab[$i].'</div>');
    }

    echo('</div>');

    for($i = 1; $i <= count($calendar); $i++) {

        echo('<div class="LigneJour">');

        for($j = 1; $j <= 7 && $j-$z+1+(($i*7)-7) <= $nbdays; $j++){

            if($j-$z+1+(($i*7)-7) == date("j") && $monthnb == date("n") && $year == date("Y"))

                echo('<div class="currentday"><a href="#">'.$calendar[$i][$j].'</a></div>');

            else{

                if ( $calendar[$i][$j] == "" ) {

                    echo ('<div class="jourVide"></div>');
                }

                else{

                    $jour = $calendar[$i][$j];
                    $datecomplete = $year."-".$monthnb."-".$jour;

                    echo ('<div class="otherDay">'.$calendar[$i][$j].'</div>');

                }
            }
        }

        echo('</div>');

    }
?>

</div>