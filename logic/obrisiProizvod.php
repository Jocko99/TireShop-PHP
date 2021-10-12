<?php

    header("Content-type: application/json");

    if(isset($_POST['idProizvoda'])){
        $id = $_POST['idProizvoda'];
        require "konekcija.php";
        $pipremiProizvod = $konekcija->prepare("SELECT * FROM proizvod WHERE idProizvod=:id");
        $pipremiProizvod->bindParam(":id",$id);
        $pipremiProizvod->execute();
        if($pipremiProizvod->rowCount() == 1){
            $proizvod = $pipremiProizvod->fetch();
            $pripremiZaBrisanje = $konekcija->prepare("DELETE FROM proizvod WHERE idProizvod=:id");
            $pripremiZaBrisanje->bindParam(":id",$id);
            $pripremiZaBrisanje->execute();
            header("admin.php");
            echo json_encode($pripremiZaBrisanje);
            http_response_code(204);
        }else{
            http_response_code(500);
        }
    }

?>