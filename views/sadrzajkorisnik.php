<div class="container-fluid yellowHeight bg-warning"></div>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-4">
            <?php if(isset($_SESSION['korisnik'])){
                 echo "<h1>".$_SESSION['korisnik']->ime.", dobrodošli na Svet Guma!</h1>";
            }else{
                header("Location: index.php");
            }
                ?>
            </div>
            <div class="col-lg-12 d-flex flex-column text-center pt-5 pb-5">
                <?php
                    $idKorisnika = $_SESSION['korisnik']->idKorisnik; 
                    $daLiJeGlasao = "SELECT * FROM rezultat WHERE idKorisnika=$idKorisnika";
                    $proveri = $konekcija->query($daLiJeGlasao);
                    if($proveri->rowCount() == 1):?>
                        <h2>Rezultat <span class="text-warning">ankete:</span></h2>
                   <?php $ukupnoGlasova = "SELECT a.pitanje AS Pitanje,COUNT(rezultat) AS UkupnoGlasova,o.odgovori as Odgovori FROM rezultat r INNER JOIN anketa a ON r.idAnkete = a.idAnketa INNER JOIN odgovori o ON r.idOdgovori=o.idOdgovori WHERE a.idAnketa=2 GROUP BY o.idOdgovori";
                    $dohvatiGlasove = $konekcija->query($ukupnoGlasova)->fetchAll();
                    foreach($dohvatiGlasove as $glas):
                        ?>
                        
                        <p><?=$glas->Odgovori?>:<?=$glas->UkupnoGlasova?></p>
                    <?php endforeach;?>
                        <div id="popuni"></div>
                    <?php else:?>
                <h2>Anketa:</h2>
                <form class="text-center" action="logic/anketa.php" method="POST">
                    <?php 
                        $upitPitanje = "SELECT idAnketa as idAnk,pitanje as Pitanje FROM anketa WHERE aktivna = 1 ";
                        $pitanje = $konekcija->query($upitPitanje);
                        $pitanjeObj = $pitanje->fetchAll();
                        foreach($pitanjeObj as $p):?>
                        <label for="pitanje"><?=$p->Pitanje?></label>
                        <input type="hidden" name="anketa" value="<?=$p->idAnk?>"/>
                        <?php endforeach;?>
                    <?php 
                        $upitOdgovor = "SELECT a.idAnketa as idAnk,o.idOdgovori as idOdg, o.odgovori as Odgovori FROM anketa a INNER JOIN odgovori o ON a.idAnketa = o.idAnkete WHERE a.aktivna = 1";
                        $odgovor = $konekcija->query($upitOdgovor);
                        $odgovorObj = $odgovor->fetchAll();
                        foreach($odgovorObj as $o):?>
                        <input type="radio" name="pitanje" value="<?=$o->idOdg?>"/><?=$o->Odgovori?>
                        <?php endforeach;?>
                        <div class="br">
                        <input type="submit" id="glasaj" name="glasaj" value="Glasaj" class="pl-2 pr-2 "/>
                        </div>
                    </div>
                </form>
            </div>
        <div class="row">
            <div class="col-lg-12 text-center">
            <?php if(isset($_SESSION['anketaGreska'])):?>
                    <ul>
                        <?php foreach($_SESSION['anketaGreska'] as $gr):?>
                            <li class="text-danger"><?=$gr?></li>
                        <?php endforeach;?>
                    </ul>
                <?php endif; unset($_SESSION['anketaGreska']) ?>
                <?php if(isset($_SESSION['anketaGlasanje'])):?>
                    <ul>
                        <?php foreach($_SESSION['anketaGlasanje'] as $uspeh):?>
                            <li class="text-success"><?=$uspeh?></li>
                        <?php endforeach;?>
                    </ul>
                <?php endif; unset($_SESSION['anketaGlasanje']) ?>
            </div>
                        <?php endif;?>
                        </div>
        </div>
    </div>
</div>
<div class="container-fluid yellowHeight bg-warning"></div>


