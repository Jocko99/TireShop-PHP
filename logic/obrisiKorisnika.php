<?php

    header("Content-type: application/json");

    if(isset($_POST['idKorisnika'])){
        $id = $_POST['idKorisnika'];
        require "konekcija.php";
        $pipremiKorisnika = $konekcija->prepare("SELECT * FROM korisnik WHERE idKorisnik=:id");
        $pipremiKorisnika->bindParam(":id",$id);
        $pipremiKorisnika->execute();
        if($pipremiKorisnika->rowCount() == 1){
            $korisnik = $pipremiKorisnika->fetch();
            $pripremiZaBrisanje = $konekcija->prepare("DELETE FROM korisnik WHERE idKorisnik=:id");
            $pripremiZaBrisanje->bindParam(":id",$id);
            $pripremiZaBrisanje->execute();
            header("admin.php");
            echo json_encode($pripremiZaBrisanje);
            http_response_code(204);
        }else{
            http_response_code(500);
        }
    }

?>