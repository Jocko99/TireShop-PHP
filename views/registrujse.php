<div class="container-fluid bg-warning yellowHeight"></div>
<div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="h2">Registracija</h1>
                </div>
            </div>
            <div class="row d-flex">
                <div class="col-lg-5  m-auto">
                    <form method="POST" action="logic/register.php">
                        <div class="form-group row">
                          <div class="col-sm-10  m-auto">
                            <input type="text" name="ime" class="form-control loginRegistracija text-center" id="ime" placeholder="Ime.. *">
                            <small class="form-text text-danger text-center mb-2 hide" id="imeInfo">Ime mora početi velikim slovom.</small>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-10 m-auto">
                            <input type="text" class="form-control loginRegistracija text-center" name="prezime" id="prezime" placeholder="Prezime.. *">
                            <small class="form-text text-danger text-center mb-2 hide" id="prezimeInfo">Prezime mora početi velikim slovom.</small>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 m-auto">
                              <input type="text" class="form-control loginRegistracija text-center" name="email" id="email" placeholder="Email.. *">
                              <small class="form-text text-danger text-center mb-2 hide" id="emailInfo">Email mora biti u formatu primer@gmail.com.</small>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-10 m-auto">
                              <input type="password" class="form-control loginRegistracija text-center" name="pass" id="pass" placeholder="Lozinka.. *">
                              <small class="form-text text-danger text-center mb-2 hide" id="lozinkaInfo">Lozinka mora sadržati najmanje 6 karaktera.</small>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-10 m-auto">
                              <input type="password" class="form-control loginRegistracija text-center" name="passPonovo" id="passPonovo" placeholder="Lozinka ponovo.. *">
                              <small class="form-text text-danger text-center mb-2 hide" id="lozinkaPInfo">Lozinke moraju biti iste.</small>
                            </div>
                          </div>
                        <div class="form-group row">
                            <div class="m-auto">
                                <input type="button" class="form-control loginRegistracija text-center pl-2 pr-2" name="btnReg" id="btnReg" value="Registruj se">
                              </div>
                        </div>
                      </form>
                      <div class="text-center">
                            <ul>
                            <?php
                                if(isset($_SESSION['greske'])):
                                 foreach($_SESSION['greske'] as $greska):
                            ?>
                                <li class="text-error"><?=$greska?></li>
                                 <?php endforeach;?>
                                 <?php unset($_SESSION['greske']);?>
                                 <?php endif;?>
                            </ul>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-warning yellowHeight"></div>