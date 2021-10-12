<?php
session_start();
        header("Content-type: Application/json");
        if(isset($_GET['btnSearch'])){
            $sirina = $_GET['sirina'];
            $visina = $_GET['visina'];  
            $precnik = $_GET['precnik'];
            $sezona = $_GET['sezona'];
            $proizvodjac = $_GET['proizvodjac'];
            $greske = [];
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
                $pretragaUpit = "SELECT p.idProizvod as ID, p.naziv as Naziv,p.opis as Opis,p.slika as Slika,p.cena as Cena,sez.sezona as Sezona,s.sirina as Sirina,v.visina as Visina,pr.precnik as Precnik,pro.naziv as Proizvodjac,pro.slika as SlikaProizvodjaca FROM proizvod p INNER JOIN sirina s ON p.idSirina = s.idSirina INNER JOIN visina v ON p.idVisina = v.idVisina INNER JOIN precnik pr ON p.idPrecnik=pr.idPrecnik INNER JOIN proizvodjac pro ON p.idProizvodjac=pro.idProizvodjac INNER JOIN sezona sez ON p.idSezona= sez.idSezona WHERE p.idProizvodjac=:proizvodjac AND (p.idSezona = :sezona AND p.idSirina = :sirina OR p.idPrecnik = :precnik AND p.idVisina = :visina)";
                $pretragaPriprema = $konekcija->prepare($pretragaUpit);
                $pretragaPriprema->bindParam(":proizvodjac",$proizvodjac);
                $pretragaPriprema->bindParam(":sezona",$sezona);
                $pretragaPriprema->bindParam(":sirina",$sirina);
                $pretragaPriprema->bindParam(":precnik",$precnik);
                $pretragaPriprema->bindParam(":visina",$visina);
                try{
                    $pretragaPriprema->execute();
                    if($pretragaPriprema->rowCount() > 0){
                        $pretraga = $pretragaPriprema->fetchAll();
                        echo json_encode ($pretraga);
                        $_SESSION['pretragaUspeh']="Pretraga uspešna";
                        http_response_code(200);
                    }else{
                        $_SESSION['pretragaGreske']=["Izabranog proizvoda nema na stanju"];
                        http_response_code(404);
                    }
                }catch(PDOException $ex){
                    http_response_code(500);
                }
            }else{
                $_SESSION['pretragaGreske']=$greske;
            }
        }
        else{
            header("Location: ../index.php");
        }