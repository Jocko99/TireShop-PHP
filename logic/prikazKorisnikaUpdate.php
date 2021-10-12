<?php
header("Content-type: application/json");

if(isset($_POST['btnUpdate'])){
    $id = $_POST['idKorisnika'];
    require "konekcija.php";
    $dohvati = "SELECT * FROM korisnik WHERE idKorisnik=:id";
    $korisnik = $konekcija->prepare($dohvati);
    $korisnik->bindParam(":id",$id);
    try{
        $korisnik->execute();
        if($korisnik->rowCount() == 1){
            $objKorisnik = $korisnik->fetch();
            echo json_encode($objKorisnik);
            http_response_code(200);
        }else{
            http_response_code(500);
        }
    }catch(PDOException $ex){
        http_response_code(404);
    }
}
?>