<?php


?>



<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Inscription</title>
    
    </head>

    <body>

     <!-- REQUIRE LE HEADER -->

        <main>

            <form action="inscription.php" method="post">
                
                <div><input type="text" name="login" placeholder="login"></div>
                <div><input type="text" name="prenom" placeholder="prenom"></div>
                <div><input type="text" name="email" placeholder="email"></div>
                <div><input type="text" name="confemail" placeholder="Confirmer l'email"></div>
                <div><input type="password" name="password" placeholder="Mot de passe"></div>
                <div><input type="password" name="confpassword" placeholder="Confirmer le mot de passe"></div>
                <div><input type="submit" name="inscription" value="Inscription"></div>
            </form>
        </main>

     <!-- REQUIRE LE FOOTER -->
    
   
    </body>
</html>