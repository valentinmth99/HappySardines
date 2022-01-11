<?php

require('../model/classes/class_equipments.php');

$equipment = "Tente";
$size = new Equipments();
$equipmentsize = $size->CheckSize($equipment);

echo $equipmentsize;


?>