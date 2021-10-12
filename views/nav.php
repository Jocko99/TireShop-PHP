<body>
<?php   require "logic/konekcija.php"; 
if(isset($_SESSION['korisnik'])):?>
<div class="alert text-center hide">
        <span class="zatvori">&times;</span> 
        <strong><i class="fa fa-check" aria-hidden="true"></i></strong> Uspešno dodat proizvod u korpu
    </div>
<?php endif;?>
    <div class="container-fluid">
        <div class="container">
            <div class="row bg-warning d-flex align-items-center rounded-lg" id="info">
                <div class="col-lg-8 col-md-8 col-sm-1" id="infoMail">
                    <p class="pt-3"><i class="far fa-envelope pr-1"></i>svetguma@gmail.com</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-11 text-right" id="korisnickaKorpa">
                <?php if(isset($_SESSION['korisnik'])):?>
                    <?php if($_SESSION['korisnik']->nazivUloge == "admin"):?>
                    <a href="admin.php"><i class="fas fa-user"></i></a>
                    <?php else:?>
                    <a href="korisnik.php"><i class="fas fa-user pr-1"></i>Moj profil</a>
                    <?php endif;?>
                    <a href="korpa.php"><i class="fas fa-shopping-cart pl-2 pr-2"></i></a>
                    <i class="fas fa-sign-out-alt"></i><a href="logic/logout.php">Log out</a>
                <?php else:?>    
                <a href="login.php" class="pr-1"><i class="fas fa-sign-in-alt pr-1"></i>Log In</a>
                <?php endif;?>
            </div>
            </div>
            <!--NAV-->
            <div class="row d-flex justify-content-between">
                <div class="col-3 float-left" id="logo">
                    <h1><?php
                     $logo = $konekcija->query("SELECT * FROM slike WHERE naziv='logo'");
                     $objLogo = $logo->fetch();
                     echo "<a href='index.php'><img src='$objLogo->putanja' alt='$objLogo->opis'/></a>";
                     ?></h1>
                </div>
                <div class="col-8" id="sakrij">
                    <ul id="meni" class="d-flex justify-content-around">
                        <?php
                            function meni(){
                                 require "logic/konekcija.php"; 
                                $navUpit = "SELECT * FROM navigacija";
                                $navigacija = $konekcija->query($navUpit);
                                $navObj = $navigacija->fetchAll();
                                foreach($navObj as $nav){
                                    echo "<li><a href='$nav->putanja'>$nav->naziv</a></li>";
                                }
                        }
                        meni();
                        ?>
                    </ul>
                </div>
                <div class="col-1 p-3 float-right" id="sendvic">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12" id="prikazi">
                    <ul id="srkivenMeni">
                        <?php
                            meni();
                            
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>