<?php

    header("Content-type: application/json");

    if(isset($_POST['btnIzmeni'])){
        $hiddenId = $_POST['hiddenID'];
        $updateIme = $_POST['updateIme'];
        $updatePrezime = $_POST['updatePrezime'];
        $updateEmail = $_POST['updateEmail'];
        $updateLozinka = $_POST['updateLozinka'];
        $updateUloga = $_POST['updateUloga'];
        $updateStatus = $_POST ['updateStatus'];        
        $greske = [];
        $regexImePrezime = "/^([A-ZŽĐŠ][a-zčćžšđ]{2,15}\s*)+$/";
        $regexEmail = "/^[\w\d\.]+@([a-z\.])+\.[a-z]{2,5}$/";
        $regexLozinka = "/^.{6,50}$/";

        if(!preg_match($regexImePrezime,$updateIme)){
            $greske[] = "Ime mora početi velikim slovom.";
        }
        if(!preg_match($regexImePrezime,$updatePrezime)){
            $greske[] = "Prezime mora početi velikim slovom.";
        }
        if(!preg_match($regexEmail,$updateEmail)){
            $greske[] = "Email mora biti u formatu primer@gmail.com.";
        }
        if(!preg_match($regexLozinka,$updateLozinka)){
            $greske[] = "Lozinka mora sadržati najmanje 6 karaktera.";
        }
        if($updateUloga == "0"){
            $greske[] = "Izaberite ulogu!";
        }
        if($updateStatus == "0"){
            $greske[] = "Izaberite status!";
        }
        
        if(count($greske) == 0){
            require "konekcija.php";
                $pripremiZaUpdate = $konekcija->prepare("UPDATE korisnik SET ime = :ime,prezime = :prezime,email = :email, lozinka = :lozinka, uloga_id = :uloga, status = :updateStatus WHERE idKorisnik=:id");
                $pripremiZaUpdate->bindParam(":ime",$updateIme);
                $pripremiZaUpdate->bindParam(":prezime",$updatePrezime);
                $pripremiZaUpdate->bindParam(":email",$updateEmail);
                $pass = md5($updateLozinka);
                $pripremiZaUpdate->bindParam(":lozinka",$pass);
                $pripremiZaUpdate->bindParam(":uloga",$updateUloga);
                if($updateStatus == "1"){
                    $statusId = 1;
                }else if($updateStatus == "2"){
                    $statusId = 0;
                }
                $pripremiZaUpdate->bindParam(":updateStatus",$statusId);
                $pripremiZaUpdate->bindParam(":id",$hiddenId);
                $pripremiZaUpdate->execute();
                header("admin.php");
                echo json_encode($pripremiZaUpdate);
                http_response_code(204);
        }else{
            http_response_code(404);
        }

        
    }else{
        http_response_code(404);
    }

?>