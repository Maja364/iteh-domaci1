<?php
require '../dbBroker.php';
require '../model/vrste_usluga.php';
require '../model/tretman.php';

$output = '';
$result=Tretman::pretraga($conn);

if(mysqli_num_rows($result)>0){
    $output="
    <thead class='thead'>
            <tr>
            <th scope='col'>Naziv tretmana</th>
            <th scope='col'>Trajanje(min)</th>
            <th scope='col'>Cena</th>
            <th scope='col'>Vrsta usluge</th>
            <th scope='col'> Opcije</th>
            </tr>
        </thead>
        <tbody> ";
        while($red=$result->fetch_array()):
        $output .="
        
        <tr>
        <td>".$red['naziv_tretmana']."</td>
        <td>".$red['trajanje']."</td>
        <td>".$red['cena']."</td>
        <td>".$red['naziv_usluge']."</td>
        <td>

            <button class='btn btn-success edit_tretman' data-bs-toggle='modal' data-bs-target='#izmeni-tretman-modal' data-id1='<?php echo $red[id_tretmana] ?>'><span class='fa fa-edit'></span></button>

            <button class='btn btn-danger' id='btnDelete' data-id='<?php echo $red[id_tretmana] ?>'><span class ='fa fa-trash'></span></button>
            </td>
        </tr>";
        
    endwhile;
    $output."</tbody>";
    echo $output;
        
    
}else{
    echo 'Data Not Found';
}


 ?>



