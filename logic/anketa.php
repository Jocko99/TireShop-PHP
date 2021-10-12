<?php

    session_start();

    $idKorisnika = $_SESSION['korisnik']->idKorisnik;

    if(isset($_POST['glasaj'])){
        if(isset($_POST['pitanje'])){
            $odgovor = $_POST['pitanje'];
            $idAnketeUpit = $_POST['anketa'];
            $rez = $rez+1;
            $upit = "INSERT INTO rezultat VALUES(NULL,$idAnketeUpit,$odgovor,$idKorisnika,$rez)";
            try{
                require "konekcija.php";
                $upisi = $konekcija->query($upit);
                if($upisi->rowCount() == 1){
                    $_SESSION["anketaGlasanje"]=["Uspešno ste glasali."];
                    header("Location: ../korisnik.php");
                }else{
                    $_SESSION['anketaGreska']=["Greška u upitu."];
                    header("Location: ../korisnik.php");
                }
            }catch(PDOException $e){

            }
        }else{
            $_SESSION['anketaGreska']=["Morate da izaberete odgovor!"];
            header("Location: ../korisnik.php");
        }
    }else{
        header("Location: ../korisnik.php");
    }