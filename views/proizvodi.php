<?php                         
require "logic/konekcija.php";
?>
<div class="container-fluid bg-warning yellowHeight"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="container">
            <div class="col-lg-12">
                <div class="row pt-4 pb-4" id="proizvodi">
                    <?php 
                        $limit = 6;
                        $offset = 0;                        
                        if(isset($_GET["strana"])) {
                            $offset = ($_GET["strana"] - 1) * $limit; 
                        }
                        $upitProizvod = "SELECT p.idProizvod as ID, p.naziv as Naziv,p.opis as Opis,p.slika as Slika,p.cena as Cena,sez.sezona as Sezona,s.sirina as Sirina,v.visina as Visina,pr.precnik as Precnik,pro.naziv as Proizvodjac,pro.slika as SlikaProizvodjaca FROM proizvod p INNER JOIN sirina s ON p.idSirina = s.idSirina INNER JOIN visina v ON p.idVisina = v.idVisina INNER JOIN precnik pr ON p.idPrecnik=pr.idPrecnik INNER JOIN proizvodjac pro ON p.idProizvodjac=pro.idProizvodjac INNER JOIN sezona sez ON p.idSezona= sez.idSezona LIMIT $limit offset $offset";
                        $izvrsiProizvod = $konekcija->query($upitProizvod)->fetchAll();
                        $ukupnoProizvoda = "SELECT COUNT(*) as UkupnoProizvoda FROM proizvod";
                        $izvrsiUkupno = $konekcija->query($ukupnoProizvoda)->fetch()->UkupnoProizvoda;
                        $ukupnoStranica = ceil($izvrsiUkupno / $limit);
                        foreach($izvrsiProizvod as $tp):?>
                            <div class='col-lg-4 col-md-6 col-sm-6 rounded-lg m-auto'>
                                    <div class='item-logo'>
                                        <img src="<?=$tp->SlikaProizvodjaca?>" alt="<?=$tp->Naziv?>"/>
                                    </div>
                                    <div class="product-item">
                                        <img src="<?=$tp->Slika?>" alt="<?=$tp->Opis?>"/>
                                    </div>
                                    <div class="item-title text-center">
                                        <h3><?=$tp->Naziv?></h3>
                                        <p><?=$tp->Opis?>
                                        <?php if($tp->Sezona == "leto"):?>
                                            <span><i class='fas fa-sun text-warning'></i></span>
                                        <?php else:?>
                                            <span><i class="fas fa-snowflake text-white"></i></span>
                                        <?php endif;?>
                                        </p>
                                    </div>
                                    <div class="item-desc text-center">
                                    <h4><?=$tp->Sirina?>/<?=$tp->Visina?> R<?=$tp->Precnik?></h4>
                                    <div class='d-flex justify-content-center'>
                                    <p class='text-success font-weight-bold h4'><?=$tp->Cena?> din</p>
                                    </div>
                                    <?php if(isset($_SESSION['korisnik'])):?>
                                    <a href='#'><button class='mb-3 dodajUkorpu' data-id="<?=$tp->ID?>"><i class="fas fa-shopping-cart pr-1"></i>Dodaj u korpu</button></a>
                                    <?php else:?>
                                    <a href='login.php'><button class='mb-3 '><i class="fas fa-shopping-cart pr-1"></i>Dodaj u korpu</button></a>
                                    <?php endif;?>
                                    </div>
                                </div>   
                        <?php endforeach;?>
                </div>
                <div class="float-right">
                <?php for($i = 0; $i < $ukupnoStranica ; $i++): ?>
                    <a class="h5 font-weight-bold text-warning" href="<?= $_SERVER["PHP_SELF"]."?strana=" . ($i + 1) ?>"><?= $i+1 ?></a>
                <?php endfor ?>
                </div>
            </div>
        </div>    
    </div>
</div>