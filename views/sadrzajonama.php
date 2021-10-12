<div class="container-fluid bg-warning yellowHeight">
    </div>
    <div class="container-fluid">
        <div class="row">
                <div class="col-12 p-0">
                    <div id="onamaBG">
                        <div id="onamaBGText">
                            <h1 class="text-uppercase font-weight-bold">Svet guma,</h1>
                            <h2>Više od 10 godina sa Vama</h2>
                        </div>
                    </div>
                    <?php
                        $upit = "SELECT putanja,opis FROM slike WHERE naziv LIKE 'O nama%'";
                        $dohvati = $konekcija->query($upit)->fetch();
                        echo "<img src='$dohvati->putanja' alt='$dohvati->opis' class='w-100 '/>";
                    ?>
                </div>
        </div>
    </div>
    <div class="container-fluid bg-warning yellowHeight">
    </div>
    <div class="container-fluid" id="onamaInfo">
        <div class="container border-bottom border-warning">
            <div class="row">
                <div class="col-lg-6 m-auto text-center pt-3 pb-3">
                    <h2>Poručite već danas</h2>
                    <p class="boja"><span class="text-warning">Svet guma</span> je internet prodavnica koja postoji punih 10 godina. Nalazimo se u Beogradu i nudimo prodaju auto guma svih dimenzija. U našoj ponudi možete poručiti gume najpoznatijih stranih i domaćih proizvodjača. Moguće je lično preuzimanje na adresi: <a href="kontakt.html"></i>Zdravka Čelara 16</a>.</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-3 mb-3">
                <div class="col-xl-7 col-lg-12 text-center bezbednaGuma">
                <?php
                        $upit = "SELECT putanja,opis FROM slike WHERE naziv LIKE 'Bezbedna%'";
                        $dohvati = $konekcija->query($upit)->fetch();
                        echo "<img src='$dohvati->putanja' alt='$dohvati->opis' class='m-auto '/>";
                    ?>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-8 xs-8 m-auto text-center pt-3">
                    <h2>Kada je vreme za nove gume?</h2>
                    <p>Šta je ono što prvo treba pogledati kada kontrolišete stanje pneumatika, bilo da su u pitanju letnje ili zimske gume? Pa, to sigurno mora biti stanje šare ili dubina brazdi na gumi. Šare na gumama postoje kako bi između njih prolazila voda koja se nalazi na kolovozu i samim tim klizanje bilo izbegnuto. Kada ove šare nestanu, vaša bezbednost, kao i bezbednost drugih ljudi u saobraćaju, postaje ugrožena. Istrošenost šare na gumama može se utvrditi na nekoliko načina. Prvi od njih je jednostavno merenje dubine brazde. Ukoliko je dubina brazde 1.6 mm ili manja, vaše gume su definitivno zrele za menjanje.</p>
                </div>
            </div>
        </div>
        <div class="container border-top border-warning">
            <div class="row mt-3 mb-3">
                <div class="col-xl-5 col-lg-6 col-md-8 xs-8 m-auto text-center">
                    <h2>Zimske gume leti?</h2>
                    <p class="boja">1. NIVO SIGURNOSTI narušen je činjenicom da je smeša od koje je napravljena zimska guma značajno mekša i optimizovana za bolje prijanjanje pri niskim temperaturama. Drugim rečima, guma postaje previše meka pri visokim temperaturama što smanjuje njenu trakciju i produžava zaustavni put.</p>
                    <p class="boja">2.  HABANJE GUMA tokom letnje sezone značajno je izraženo iz gore pomenutih razloga. Zbog mekše smeše koja joj u zimskim uslovima omogućuje bolje performanse, ona se tokom letnje sezone, usled visokih temperatura lakše pregreva i značajno više troši.</p>
                    <p class="boja">3.  ISPLATIVOST, koja je u ovom slučaju dovedena u pitanje, ne posmatra se samo s aspekta kupovine novih pneumatika već i kroz mogućnost nastajanja eventualne štete koju možete pričiniti sebi ili drugome u saobraćaju iz, sada već očiglednih razloga.</p>
                </div>
                <div class="col-xl-7 col-lg-12 text-center bezbednaGuma pt-5">
                <?php
                        $upit = "SELECT putanja,opis FROM slike WHERE naziv LIKE 'Zimske%'";
                        $dohvati = $konekcija->query($upit)->fetch();
                        echo "<img src='$dohvati->putanja' alt='$dohvati->opis' class='m-auto '/>";
                    ?>
                </div>
            </div>
        </div>
    </div>