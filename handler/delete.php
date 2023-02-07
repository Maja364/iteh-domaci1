<?php
require '../dbBroker.php';
require '../model/vrste_usluga.php';
require '../model/tretman.php';
    
Tretman::delete_tretman($conn);

?>