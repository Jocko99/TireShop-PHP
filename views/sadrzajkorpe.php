<div class="container-fluid bg-warning yellowHeight"></div>
<?php if(isset($_SESSION['korisnik'])){
                http_response_code(200);
            }else{
                header("Location: login.php");
            }
        ?>
    <!--TABELA-->
    <div class="container-fluid">
        <div class="container" id="tabelaKorpe">
        </div>
    </div>
    <div class="container-fluid">
      <div class="container text-center">
        <form>
          <button name="nastaviKupovinu" id="kupi">Nastavi kupovinu</button>
        </form>
        
      </div>
    </div>