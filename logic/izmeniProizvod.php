<?php

    header("Content-type: application/json");

    if(isset($_POST['btnEdit'])){
        $hiddenId = $_POST['hiddenID'];
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
                $pripremiZaUpdate = $konekcija->prepare("UPDATE proizvod SET naziv = :naziv,opis = :opis,slika = :slika, cena = :cena, idSirina = :idSirina, idVisina = :idVisina, idPrecnik = :idPrecnik, idSezona = :idSezona, idProizvodjac = :idProizvodjac WHERE idProizvod = :id");
                
                $pripremiZaUpdate->bindParam(":naziv",$naziv);
                $pripremiZaUpdate->bindParam(":opis",$opis);
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
                $pripremiZaUpdate->bindParam(":slika",$slika);
                $pripremiZaUpdate->bindParam(":cena",$cena);
                $pripremiZaUpdate->bindParam(":idSirina",$sirina);
                $pripremiZaUpdate->bindParam(":idVisina",$visina);
                $pripremiZaUpdate->bindParam(":idPrecnik",$precnik);
                $pripremiZaUpdate->bindParam(":idSezona",$sezona);
                $pripremiZaUpdate->bindParam(":idProizvodjac",$proizvodjac);
                $pripremiZaUpdate->bindParam(":id",$hiddenId);
                $pripremiZaUpdate->execute();
                echo json_encode($pripremiZaUpdate);
                http_response_code(204);
        }else{
            http_response_code(404);
        }

        
    }else{
        http_response_code(404);
    }

?>