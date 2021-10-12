<div class="container-fluid bg-warning yellowHeight"></div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-2">
                    <h1 class="text-warning">Autor</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3 d-flex flex-column align-items-center">
                    <div class="border border-warning">
                    <?php
                        $upit = "SELECT putanja,opis FROM slike WHERE naziv LIKE 'Autor%'";
                        $dohvati = $konekcija->query($upit)->fetch();
                        echo "<img src='$dohvati->putanja' alt='$dohvati->opis' class='w-100'/>";
                    ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 m-auto text-center">
                        <p class="boja">Rođen sam u Smederevskoj Palanci. Druga sam godina Visoke ICT škole, smer internet tehnologije. Želja mi je da do kraja školovanja proširim i usavršim svoje znanje o webu. Kontakt:</p>
                        <p>nikola.jockovic.23.18@ict.edu.rs</p>
                        <p><a href="sitemap.xml" class="text-warning p-2">Sitemap</a></p>  
                </div>    
            </div>
        </div>
    </div>   