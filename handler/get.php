<?php
require '../dbBroker.php';
require '../model/vrste_usluga.php';
require '../model/tretman.php';
 

if(isset($_POST['id_tretmana'])) {
    $myArray = Tretman::getById($_POST['id_tretmana'], $conn);
    echo json_encode($myArray);
}
?>

