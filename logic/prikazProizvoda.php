<?php
    header("Content-type: Application/json");
    require "konekcija.php";
    
    
    $upit = "SELECT p.idProizvod as ID, p.naziv as Naziv,p.opis as Opis,p.slika as Slika,p.cena as Cena,sez.sezona as Sezona,s.sirina as Sirina,v.visina as Visina,pr.precnik as Precnik,pro.naziv as Proizvodjac,pro.slika as SlikaProizvodjaca FROM proizvod p INNER JOIN sirina s ON p.idSirina = s.idSirina INNER JOIN visina v ON p.idVisina = v.idVisina INNER JOIN precnik pr ON p.idPrecnik=pr.idPrecnik INNER JOIN proizvodjac pro ON p.idProizvodjac=pro.idProizvodjac INNER JOIN sezona sez ON p.idSezona= sez.idSezona";
    try{
        $product = $konekcija->query($upit);
        if($product->rowCount()>0){
            $products = $product->fetchAll();
            echo json_encode($products);
            http_response_code(200);
        }else{
            http_response_code(500);
        }
    }catch(PDOException $ex){
        http_response_code(404);
    }
    