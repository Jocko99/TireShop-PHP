<?php
    header("Content-type: application/json");
    require "konekcija.php";
    $upit = "SELECT k.idKorisnik as ID, k.ime as Ime,k.prezime as Prezime,k.email as Email,k.lozinka as Lozinka, k.status ,u.naziv as Uloga FROM korisnik k INNER JOIN uloga u ON k.uloga_id=u.uloga_id";
    try{
        $i=1;
        $prikazKorisnika = $konekcija->query($upit);
        if($prikazKorisnika->rowCount() > 0){
            $korisnikObj = $prikazKorisnika->fetchAll();
            echo json_encode($korisnikObj);
            http_response_code(200);
        }else{
            http_response_code(404);
        }

    }catch(PDOException $ex){
        http_response_code(500);
    }
    
?>