<?php

require('../model/classes/class_locations.php');


$spaces = new Locations();
$availablespaces = $spaces->CheckSpaces($location);


echo $test;



?>