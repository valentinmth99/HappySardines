<?php

    class Admin {

        public function CheckAdmin () {

            if ($_SESSION['admin'] =='0') {
                header('Location: compte.php');
            }
        }
    }
?>