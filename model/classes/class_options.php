<?php 

class Options {

    private $id;
    public $name, $rate;

    public function Contruct(){
        
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

    public function ModifRate($rate) {
        
        

    }
    
}