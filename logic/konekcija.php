<?php
    try{
        $serverBaze="localhost";
        $baza="gume";
        $user="root";
        $pass="";
        $konekcija= new PDO("mysql:host=$serverBaze; dbname=$baza", $user, $pass);
        $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }catch(PDOException $e){
        echo "Greska pri konekciji: ". $e->getMessage();
    }

    ?>