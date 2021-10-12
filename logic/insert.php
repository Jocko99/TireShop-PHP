<?php
   header("Content-type: application/json");

   if(isset($_POST['btnUnos'])){
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $email = $_POST['email'];
        $lozinka = $_POST['lozinka'];
        $uloga = $_POST['uloga'];
        $status = $_POST ['status'];
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
        if($uloga == "0"){
            $greske[] = "Izaberite ulogu!";
        }
        if($status == "0"){
            $greske[] = "Izaberite status!";
        }
        if(count($greske) == 0){
            require "konekcija.php";
            $pripremi = $konekcija->prepare("INSERT INTO korisnik
            VALUES(NULL,:ime,:prezime,:email,:lozinka,NULL,:uloga_id,:status_id,:kod)");
            $pripremi->bindParam(":ime",$ime);
            $pripremi->bindParam(":prezime",$prezime);
            $pripremi->bindParam(":email",$email);
            $pass = md5($lozinka);
            $pripremi->bindParam(":lozinka",$pass);
            $pripremi->bindParam(":uloga_id",$uloga);
            if($status == "1"){
                $statusId = 1;
            }else if($status == "2"){
                $statusId = 0;
            }
            $kod = md5(md5($pass));
            $pripremi->bindParam(":status_id",$statusId);
            $pripremi->bindParam(":kod",$kod);
            try{
                $proveri = $pripremi->execute();
                echo json_encode(200);
            }catch(PDOException $e){
                echo json_encode(400);
            }
        }else{
            $_SESSION["greska"]=$greske;
            echo json_encode(400);
        }
   }




?>