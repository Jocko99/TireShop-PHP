<?php 
    if(isset($_GET['kod'])){
        $kod = $_GET['kod'];

        require "konekcija.php";
        
        $upit = "SELECT * FROM korisnik WHERE aktivacioni_kod = :kod ";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(":kod",$kod);
        $priprema->execute();
        if($priprema->rowCount() == 1){
            $korisnik = $priprema->fetch();
            $azuriraj = $konekcija->prepare("UPDATE korisnik SET status = 1 WHERE aktivacioni_kod = :kod");
            $azuriraj->bindParam(":kod",$kod);
            $azuriraj->execute();
            header("Location: ../login.php");
        }else{
            header("Location: ../404.php");
        }

    }