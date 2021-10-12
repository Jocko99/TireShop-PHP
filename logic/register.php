<?php
session_start();
header("Content-type: Application/json");
    if(isset($_POST['btnRegister'])){
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $email = $_POST['email'];
        $lozinka = $_POST['pass'];
        $lozinkaPonovo = $_POST['passPonovo'];
        $greske = [];
        $regexImePrezime = "/^([A-ZŽĐŠ][a-zčćžšđ]{2,15}\s*)+$/";
        $regexEmail = "/^[\w\d\.]+@([a-z\.])+\.[a-z]{2,5}$/";
        $regexLozinka = "/^.{6,50}$/";
        if(!preg_match($regexImePrezime,$ime)){
            $greske[] = "Ime mora početi velikim slovom.";
        }
        if(!preg_match($regexImePrezime,$prezime)){
            $greske[] = "Prezime mora početi velikim slovom.";
        }
        if(!preg_match($regexEmail,$email)){
            $greske[] = "Email mora biti u formatu primer@gmail.com.";
        }
        if(!preg_match($regexLozinka,$lozinka)){
            $greske[] = "Lozinka mora sadržati najmanje 6 karaktera.";
        }
        if($lozinka != $lozinkaPonovo){
            $greske[] = "Lozinke moraju biti iste.";
        }
        if(count($greske) == 0){
            require "konekcija.php";

            $upit = "INSERT INTO korisnik VALUES (NULL,:ime,:prezime,:email,:lozinka,NULL,:uloga,:aktivan,:kod)";
            $priprema = $konekcija->prepare($upit);
            $priprema->bindParam(":ime",$ime);
            $priprema->bindParam(":prezime",$prezime);
            $priprema->bindParam(":email",$email);
            $pass = md5($lozinka);
            $priprema->bindParam(":lozinka",$pass);
            $uloga = 2;
            $priprema->bindParam(":uloga",$uloga);
            $active = 1;
            $priprema->bindParam(":aktivan",$active);
            $aKod = md5(md5($pass));
            $priprema->bindParam(":kod",$aKod);
            try{
                $izvrsi=$priprema->execute();
                echo json_encode($izvrsi);
                http_response_code(201);
            }catch(PDOException $ex){
                header("Location: ../login.php");
                http_response_code(404);
                $_SESSION['greske'] = "Već postoji korisnik sa tim emailom!";
            }
        }else{
            header("Location: ../registracija.php");
            http_response_code(404);
        }

    }else{
        header("Location: ../registracija.php");
    }