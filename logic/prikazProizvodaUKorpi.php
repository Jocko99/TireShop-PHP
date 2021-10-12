<?php

    header("Content-type: Application/json");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $upit = "SELECT p.idProizvod as ID, p.naziv as Naziv,p.opis as Opis,p.slika as Slika,p.cena as Cena,sez.sezona as Sezona,s.sirina as Sirina,v.visina as Visina,pr.precnik as Precnik,pro.naziv as Proizvodjac,pro.slika as SlikaProizvodjaca FROM proizvod p INNER JOIN sirina s ON p.idSirina = s.idSirina INNER JOIN visina v ON p.idVisina = v.idVisina INNER JOIN precnik pr ON p.idPrecnik=pr.idPrecnik INNER JOIN proizvodjac pro ON p.idProizvodjac=pro.idProizvodjac INNER JOIN sezona sez ON p.idSezona= sez.idSezona WHERE p.idProizvod = :id";
        require "konekcija.php";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(":id",$id);
        try{
            $priprema->execute();
            if($priprema->rowCount() == 1){
                $proizvodi = $priprema->fetch();
                echo json_encode($proizvodi);
                http_response_code(200);
            }else{
                http_response_code(500);
            }
        }catch(PDOException $e){
            http_response_code(404);
        }

    }else{
        http_response_code(404);
    }

    




?>