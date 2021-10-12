<?php
session_start();
        header("Content-type: Application/json");
        if(isset($_POST['btnAdd'])){
            $naziv = $_POST['nazivGume'];
            $opis = $_POST['opisGume'];
            $cena = $_POST['cenaGume'];
            $sirina = $_POST['sirinaGume'];
            $visina = $_POST['visinaGume'];  
            $precnik = $_POST['precnikGume'];
            $sezona = $_POST['sezonaGume'];
            $proizvodjac = $_POST['proizvodjacGume'];
            $greske = [];
            $regexNaziv = "/^[\w\s]{3,}$/";
            $regexOpis = "/^.{3,200}$/";
            if(!preg_match($regexNaziv,$naziv)){
                $greske[]= "Unesite naziv!";
            }
            if(!preg_match($regexOpis,$opis)){
                $greske[]= "Unesite opis!";
            }
            if($sirina == "0"){
                $greske[]= "Izaberite sirinu!";
            }
            if($visina == "0"){
                $greske[]= "Izaberite visinu!";    
            }
            if($precnik == "0"){
                $greske[]= "Izaberite precnik!";
            }
            if($sezona == "0"){
                $greske[]= "Izaberite precnik!";
            }
            if($proizvodjac == "0"){
                $greske[]= "Izaberite proizvodjaca!";
            }

            if(count($greske) == 0){
                require "konekcija.php";
                $insertUpit = "INSERT INTO proizvod VALUES(NULL, :naziv, :opis, :slika, :cena, :idSirina, :idVisina, :idPrecnik, :idSezona, :idProizvodjac)";
                $insertPriprema = $konekcija->prepare($insertUpit);
                $insertPriprema->bindParam(":naziv",$naziv);
                $insertPriprema->bindParam(":opis",$opis);
                if($proizvodjac == "1"){
                    $slika = "assets/images/bridgstone/bridgestoneGuma.jpg";
                }
                else if($proizvodjac == "2" && $sezona == "1"){
                    $slika = "assets/images/micheline/michelinGuma.jpg";
                }
                else if($proizvodjac == "2" && $sezona == "2"){
                    $slika = "assets/images/micheline/michelinGumaWinter.png";
                }
                else if($proizvodjac == "3" && $sezona == "1"){
                    $slika = "assets/images/pireli/pireliGuma.jpg";
                }
                else if($proizvodjac == "3" && $sezona == "2"){
                    $slika = "assets/images/pireli/pireliGumaWinter.jpg";
                }
                else if($proizvodjac == "4" && $sezona == "1"){
                    $slika = "assets/images/tigar/tigarGuma.jpg";
                }
                else if($proizvodjac == "4" && $sezona == "2"){
                    $slika = "assets/images/tigar/tigarGumaWinter.jpg";
                }
                else if($proizvodjac == "5" && $sezona == "1"){
                    $slika = "assets/images/hankook/hankookGuma.jpg";
                }
                else if($proizvodjac == "5" && $sezona == "2"){
                    $slika = "assets/images/hankook/hankookGumaWinter.jpg";
                }
                else if($proizvodjac == "6" && $sezona == "1"){
                    $slika = "assets/images/goodyear/goodyearGuma.jpg";
                }
                else if($proizvodjac == "6" && $sezona == "2"){
                    $slika = "assets/images/goodyear/goodyearGumaWinter.jpg";
                }
                $insertPriprema->bindParam(":slika",$slika);
                $insertPriprema->bindParam(":cena",$cena);
                $insertPriprema->bindParam(":idSirina",$sirina);
                $insertPriprema->bindParam(":idVisina",$visina);
                $insertPriprema->bindParam(":idPrecnik",$precnik);
                $insertPriprema->bindParam(":idSezona",$sezona);
                $insertPriprema->bindParam(":idProizvodjac",$proizvodjac);
                try{
                    $insertPriprema->execute();
                    http_response_code(204);
                }catch(PDOException $ex){
                    http_response_code(500);
                }
            }else{
                http_response_code(404);
            }
        }
        else{
            http_response_code(404);
        }