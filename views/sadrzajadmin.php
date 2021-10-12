<div class="container-fluid yellowHeight bg-warning"></div>
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center pt-4">
            <?php
                if(isset($_SESSION["korisnik"])) {
                    if($_SESSION["korisnik"]->nazivUloge == "admin") {
                        echo "<h2><span class='text-warning'>".$_SESSION["korisnik"]->ime."</span>, dobrodošli na Admin Panel</h2>";
                    } else {
                        header("Location: index.php");
                    }
                } else {
                    header("Location: index.php");
                }
            ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center pb-5 pt-5">
                <h2 class="text-warning">Korisnici</h2>
                <table class="table"> 
                    <form> 
                        <thead>
                            <tr>
                                <th>Ime</th>
                                <th>Prezime</th>
                                <th>Email</th>
                                <th>Lozinka</th>
                                <th>Uloga</th>
                                <th>Status</th>
                                <th>Dodaj</th>
                                <th>Izmeni<th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <input type="hidden" name="hiddenId" id="hiddenId" />
                                <td><input type="text" name="insertIme" id="insertIme" class="adminPanelUredi"/></td>
                                <td><input type="text" name="insertPrezime" id="insertPrezime" class="adminPanelUredi"/></td>
                                <td><input type="text" name="insertEmail" id="insertEmail" class="adminPanelUredi"/></td>
                                <td><input type="password" name="insertLozinka" id="insertLozinka" class="adminPanelUredi"/></td>
                                <td><select name="insertUloga" id="insertUloga" class="adminPanelUredi">
                                <option value="0">Izaberite</option>
                                <option value="1">Admin</option>
                                <option value="2">Korisnik</option>
                                </select></td>
                                <td><select name="insertStatus" id="insertStatus" class="adminPanelUredi">
                                <option value="0">Izaberite</option>
                                <option value="1">Aktivan</option>
                                <option value="2">Neaktivan</option>
                                </select></td>
                                <td><input type="button" id="dodaj" class="adminPanelUredi" value="Dodaj"/></td>
                                <td><input type="button" id="izmeni" class="adminPanelUredi" value="Izmeni"/></td>
                            </tr>
                        </tbody>
                    </form>
                </table>
            <div id="greske">
            
            </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 pb-5 pt-5">
            <table class="table">
                <form>
                    <thead>
                        <tr>
                            <th>RB.</th>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Email</th>
                            <th>Uloga</th>
                            <th>Status</th>
                            <th>Obrisi</th>
                            <th>Ažuriraj</th>
                        </tr>
                    </thead>
                    <tbody id="adminPrikazi">

                    </tbody>
                </form>
            </table>
            </div>
        </div>
    <!--Proizvodi-->
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="text-warning">Proizvodi</h2>
                <table class="table">
                    <form>
                        <thead>
                            <tr>
                                <th>Naziv</th>
                                <th>Opis</th>
                                <th>Cena</th>
                                <th>Širina</th>
                                <th>Visina</th>
                                <th>Prečnik</th>
                                <th>Sezona</th>
                                <th>Proizvođač</th>
                                <th>Dodaj</th>
                                <th>Izmeni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <input type="hidden" name="idGume" id="idGume" class="adminPanelUredi"/>
                                <td><input type="text" name="nazivGume" id="nazivGume" class="adminPanelUredi"/></td>
                                <td><input type="text" name="opisGume" id="opisGume" class="adminPanelUredi"/></td>
                                <td><input type="number" name="cenaGume" id="cenaGume" class="adminPanelUredi"/></td>
                                <td><select id="sirinaGume" name="sirinaGume" class="adminPanelUredi">
                                        <option value="0">širina</option>
                                        <?php 
                                        $sirina = $konekcija->query("SELECT * FROM sirina");
                                        $sirinaObj = $sirina->fetchAll();
                                        foreach($sirinaObj as $s):
                                        ?>
                                        <option value="<?=$s->idSirina?>"><?=$s->sirina?></option>
                                        <?php endforeach; ?>
                                    </select></td>
                                <td><select id="visinaGume" name="visinaGume" class="adminPanelUredi">
                                        <option value="0">visina</option>
                                        <?php 
                                        $visina = $konekcija->query("SELECT * FROM visina");
                                        $visinaObj = $visina->fetchAll();
                                        foreach($visinaObj as $v):
                                        ?>
                                        <option value="<?=$v->idVisina?>"><?=$v->visina?></option>
                                        <?php endforeach; ?>
                                    </select></td>
                                <td><select id="precnikGume" name="precnikGume" class="adminPanelUredi">
                                        <option value="0">prečnik</option>
                                        <?php 
                                        $precnik = $konekcija->query("SELECT * FROM precnik");
                                        $precnikObj = $precnik->fetchAll();
                                        foreach($precnikObj as $p):
                                        ?>
                                        <option value="<?=$p->idPrecnik?>"><?=$p->precnik?></option>
                                        <?php endforeach; ?>
                                    </select></td>
                                <td><select id="sezonaGume" name="sezonaGume" class="adminPanelUredi">
                                        <option value="0">sezona</option>
                                        <?php 
                                        $sezona = $konekcija->query("SELECT * FROM sezona");
                                        $sezonaObj = $sezona->fetchAll();
                                        foreach($sezonaObj as $s):
                                        ?>
                                        <option value="<?=$s->idSezona?>"><?=$s->sezona?></option>
                                        <?php endforeach; ?>
                                    </select></td>
                                <td> <select id="proizvodjacGume" name="proizvodjacGume" class="adminPanelUredi">
                                        <option value="0">proizvođač</option>
                                        <?php 
                                        $proizvodjac = $konekcija->query("SELECT * FROM proizvodjac");
                                        $proizvodjacObj = $proizvodjac->fetchAll();
                                        foreach($proizvodjacObj as $marka):
                                        ?>
                                        <option value="<?=$marka->idProizvodjac?>"><?=$marka->naziv?></option>
                                        <?php endforeach; ?>
                                    </select></td>
                                    <td><input type="button" id="dodajGumu" value="Unesi" class="adminPanelUredi"/></td>
                                    <td><input type="button" id="izmeniGumu" value="Izmeni" class="adminPanelUredi"/></td>
                            </tr>
                        </tbody>
                    </form>
                </table>
                <div id="greskeUnosProizvodi">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center" id="prikaziGume">
                
            </div>
        </div>
</div>
<div class="container-fluid yellowHeight bg-warning"></div>

