    <div class="container-fluid yellowHeight bg-warning"></div>
    <div class="container-fluid">        
        <div class="row">
            <div id="carouselExampleControls" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div id="rgbaMicheline"><div id="michelinP"><h1>Michelin... i više od samih pneumatika</h1><p><a href="gume.php">Više..</a></p></div></div>
                    <?php
                        $slajder = $konekcija->query("SELECT naziv,putanja,opis FROM slike WHERE naziv LIKE 'slajder%'");
                        $slajderObj = $slajder->fetchAll();
                        foreach ($slajderObj as $slajd ):
                            if($slajd->naziv == "slajderMichelin"):
                    ?>
                    <img src="<?=$slajd->putanja?>" class="d-block w-100" alt="<?=$slajd->opis?>">
                  </div>
                  <div class="carousel-item">
                            <?php else:?>
                    <img src="<?=$slajd->putanja?>" class="d-block w-100" alt="<?= $slajd->opis?>">
                  </div>
                            <?php endif;?>
                        <?php endforeach;?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
        </div>
    </div>
    <div class="container-fluid yellowHeight bg-warning"></div>
    <div class="container-fluid">
        <!--Forma pretrazivanja-->
        <div class="container">
            <div class="row pt-4">
                <div class="col-12">
                    <form id="pretragaForme" class="rounded-lg bg-warning w-100 text-center p-3">
                        <h2>Pretražite gume svih dimenzija</h2>
                        <select id="sirina" name="sirina" class="selectStyle rounded-lg ">
                            <option value="0">širina</option>
                            <?php 
                            $sirina = $konekcija->query("SELECT * FROM sirina");
                            $sirinaObj = $sirina->fetchAll();
                            foreach($sirinaObj as $s):
                            ?>
                            <option value="<?=$s->idSirina?>"><?=$s->sirina?></option>
                            <?php endforeach; ?>
                        </select>
                        <select id="visina" name="visina" class="selectStyle rounded-lg ">
                            <option value="0">visina</option>
                            <?php 
                            $visina = $konekcija->query("SELECT * FROM visina");
                            $visinaObj = $visina->fetchAll();
                            foreach($visinaObj as $v):
                            ?>
                            <option value="<?=$v->idVisina?>"><?=$v->visina?></option>
                            <?php endforeach; ?>
                        </select>
                        <select id="precnik" name="precnik" class="selectStyle rounded-lg ">
                            <option value="0">prečnik</option>
                            <?php 
                            $precnik = $konekcija->query("SELECT * FROM precnik");
                            $precnikObj = $precnik->fetchAll();
                            foreach($precnikObj as $p):
                            ?>
                            <option value="<?=$p->idPrecnik?>"><?=$p->precnik?></option>
                            <?php endforeach; ?>
                        </select>
                        <select id="sezona" name="sezona" class="selectStyle rounded-lg ">
                            <option value="0">sezona</option>
                            <?php 
                            $sezona = $konekcija->query("SELECT * FROM sezona");
                            $sezonaObj = $sezona->fetchAll();
                            foreach($sezonaObj as $s):
                            ?>
                            <option value="<?=$s->idSezona?>"><?=$s->sezona?></option>
                            <?php endforeach; ?>
                        </select>
                        <select id="proizvodjac" name="proizvodjac" class="selectStyle rounded-lg ">
                            <option value="0">proizvođač</option>
                            <?php 
                            $proizvodjac = $konekcija->query("SELECT * FROM proizvodjac");
                            $proizvodjacObj = $proizvodjac->fetchAll();
                            foreach($proizvodjacObj as $marka):
                            ?>
                            <option value="<?=$marka->idProizvodjac?>"><?=$marka->naziv?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if(isset($_SESSION['korisnik'])):?>
                        <div class="search rounded-lg m-auto">
                            <button type="button" name="posalji" id="posalji">Pronađi<i class="fa fa-search pl-1"></i></button>
                        </div>
                        <?php else:?>
                        <div class="search rounded-lg m-auto">
                            <a href="login.php"><button type="button">Pronađi<i class="fa fa-search pl-1"></i></button></a>
                        </div>
                        <?php endif;?>
                    </form>
                    <div id="searchGreske" class="rounded-lg">
                    </div>
                </div>
            </div>
            <div class="row pt-4 pb-4" id="rezultatPretrage">
                <div id="greske" class="hide">
                <ul>
            <?php if(isset($_SESSION['pretragaGreske'])):
                   foreach($_SESSION['pretragaGreske'] as $gr):?>
                        <li class="h2 text-center font-weight-light"><?=$gr?></li>
                   <?php endforeach;?>
                   <?php unset($_SESSION['pretragaGreske'])?>
            <?php endif;?>
                </ul>          
                   </div>  
            </div>
            <!--Najtrazenije-->
            <div class="row">
                <div class="col-12 p-4 text-center">
                    <h2>Trenutno <span class="text-warning">najtraženije</span></h2>
                </div>
            </div>
            <div class="row" id="proizvodi">
            <!--Proizvodi-->
            <?php
            $topTri = "SELECT p.idProizvod as ID, p.naziv as Naziv,p.opis as Opis,p.slika as Slika,p.cena as Cena,sez.sezona as Sezona,s.sirina as Sirina,v.visina as Visina,pr.precnik as Precnik,pro.naziv as Proizvodjac,pro.slika as SlikaProizvodjaca FROM proizvod p INNER JOIN sirina s ON p.idSirina = s.idSirina INNER JOIN visina v ON p.idVisina = v.idVisina INNER JOIN precnik pr ON p.idPrecnik=pr.idPrecnik INNER JOIN proizvodjac pro ON p.idProizvodjac=pro.idProizvodjac INNER JOIN sezona sez ON p.idSezona= sez.idSezona WHERE Sezona = 'zima' AND Cena <=5400 LIMIT 3";

            $objTopTri=$konekcija->query($topTri)->fetchAll();
            foreach($objTopTri as $tp):?>
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
            <!--BRENDOVI-->
            <div class="row text-warning"><div class="col-12 text-center"><h3>Brendovi</h3></div></div>
            <div class="row bg-warning d-flex rounded-lg mb-5" id="marke">
                <?php
                    $brendovi = $konekcija->query("SELECT * FROM slike WHERE naziv LIKE 'brend%'");
                    $brendObj = $brendovi->fetchAll();
                    
                    foreach($brendObj as $brend):
                ?>
                <div class="col-lg-4 col-md-6 d-flex justify-content-around">
                    <img src="<?=$brend->putanja?>" alt="<?=$brend->opis?>" class="brend"/>
                </div>
                    <?php endforeach;?>
                    <?php $konekcija=null;?>
            </div>
        </div>
    </div>