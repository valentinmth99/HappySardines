<?php

session_start();

?><html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Le Camping</title> 
        <link rel="stylesheet" type="text/css" href="style/lecamping.css">
    </head>

    <body>

      <?php require('header.php')?>

        <main>

            <h1> Découvrez le Camping<br><span id="camping_name">Happy Sardines</span> ! </h1>

            <section class="flexbox_images">

                <div><a href="#pins"><img src="assets/pins.JPG" id="pins_flex_image" alt="les_pins"></a></div>

                <div class="under_flex">
                    <div><a href="#plage"><img src="assets/laplage.JPG"  class="flex_image" alt="la_plage"></a></div>
                    <div><a href="#maquis"><img src="assets/maquis.JPG" class="flex_image"alt="le_maquis"></a></div>
                </div>

            </section>

            <section class="flex_descriptions">

                <h2 id="plage">La Plage</h2>                    

                    <div><img src="assets/laplage2.JPG" alt="la_plage_2" class="desc_image"></div>

                    <div class="description">
                        Venez vous installer au bord de l'eau, avec le bruit des vagues qui bercent votre sommeil. Ouh mais c'est cro mignon ! <br>
                        Pouvoir aller piquer une tête en 30 secondes depuis son chez-soi, c'est quand même le pied !
                    </div>

                <h2 id="pins">Les Pins</h2>

                    <div><img src="assets/pins2.JPG" alt="pins_2" class="desc_image"></div>

                    <div class="description">
                        Profitez d'un emplacement sous la protection des pins, qui vous garantiront ombre et fraîcheur. <br>
                        Vous serez à proximité de toutes les commodités du camping, dans un milieu naturel ressourçant !
                    </div>
                
                <h2 id="maquis">Le Maquis</h2>                    

                    <div><img src="assets/maquis2.PNG" alt="maquis_2" class="desc_image"></div>

                    <div class="description">
                        Venez profiter de l'emplacement le plus diversifié en terme de paysages ! <br>
                        Vous ne serez pas déçu. 
                    </div>
        
            </section>

        </main>

        <?php require('footer.php'); ?>
    
    </body>
</html>