<?php
    session_start();
    if(isset($_POST['lgSubmit'])){
        $email = $_POST['lgEmail'];
        $lozinka = $_POST['lgPass'];
        $greske = [];
        $regexEmail = "/^[\w\d\.]+@([a-z\.])+\.[a-z]{2,5}$/";
        $regexLozinka = "/^.{6,50}$/";

        if(!preg_match($regexEmail,$email)){
            $greske[] = "Email mora biti u formatu primer@gmail.com.";
        }
        if(!preg_match($regexLozinka,$lozinka)){
            $greske[] = "Lozinka mora sadržati najmanje 6 karaktera.";
        }
        if(count($greske) == 0){
            require "konekcija.php";
            
            $priprema = $konekcija->prepare("SELECT k.idKorisnik, k.ime, u.naziv AS nazivUloge FROM korisnik k INNER JOIN uloga u ON k.uloga_id = u.uloga_id WHERE email = :email AND lozinka = :pass AND status = 1");
            $priprema->bindParam(":email",$email);
            $pass = md5($lozinka);
            $priprema->bindParam(":pass",$pass);
            $priprema->execute();

            if($priprema->rowCount() == 1){
                $korisnik = $priprema->fetch();

                $_SESSION['korisnik']=$korisnik;

                if($korisnik->nazivUloge == "korisnik"){
                    header("Location: ../korisnik.php");
                }else if($korisnik->nazivUloge == "admin"){
                    header("Location: ../admin.php");
                }
            }else{
                $_SESSION['greskeLogin'] = ["Korisnik nije pronadjen,pokušajte ponovo!"];
                header("Location: ../login.php");
            }
        } else {
            $_SESSION['greskeLogin'] = ["Pogrešno unet email ili lozinka!"];
            header("Location: ../login.php");
        }
    }


?>