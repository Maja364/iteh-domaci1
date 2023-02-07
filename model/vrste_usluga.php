<?php

class Vrsta{
    public $id_usluge;
    public $naziv_usluge;

    public function __construct($id_usluge,$naziv_usluge){
        $this->id_usluge=$id_usluge;
        $this->naziv_usluge=$naziv_usluge;
    }

    
    public static function vratiSve($db){
        $query="SELECT * FROM vrste_usluga";
        $result=$db->query($query);
        $array=[];
        while($r = $result->fetch_assoc()){
            $vrsta=new Vrsta($r['id_usluge'],$r['naziv_usluge']);
            array_push($array,$vrsta);
            }
        return $array;

    }


}

?>