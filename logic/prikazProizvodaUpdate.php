<?php
header("Content-type: application/json");

if(isset($_POST['btnUpdate'])){
    $id = $_POST['idProizvoda'];
    require "konekcija.php";
    $dohvati = "SELECT * FROM proizvod WHERE idProizvod=:id";
    $proizvod = $konekcija->prepare($dohvati);
    $proizvod->bindParam(":id",$id);
    try{
        $proizvod->execute();
        if($proizvod->rowCount() == 1){
            $objProizvod = $proizvod->fetch();
            echo json_encode($objProizvod);
            http_response_code(200);
        }else{
            http_response_code(500);
        }
    }catch(PDOException $ex){
        http_response_code(404);
    }
}
?>