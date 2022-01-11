<?php 

class Locations {

    private $id;
    public $name, $spaces, $location, $connexion;

    public function __construct(){
        
        try {

            $bdd = new PDO('mysql:host=localhost;dbname=camping', 'root', '');
            echo "Connecté à la bdd";
            $this->connexion=$bdd;
            
        }

        catch (PDOException $e) {

            echo $e->getMessage();
            die();
        
        }
    
    }

    public function CalculSpaces($spaces){
        
        

    }

    public function CheckSpaces($location){

        $checkspaces = $this->connexion->prepare("SELECT spaces FROM locations WHERE name='".$location."'");
        $checkspaces->setFetchMode(PDO::FETCH_ASSOC);
        $checkspaces->execute();
        var_dump($checkspaces);

        $getcheckspaces = $checkspaces->fetchall();

        return $getcheckspaces[0]['spaces'];

    }

}