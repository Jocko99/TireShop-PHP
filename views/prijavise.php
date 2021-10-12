<div class="container-fluid bg-warning yellowHeight"></div>
<div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-2" id="loginNaslov">
                    <h1 class="h2">Dobrodošli na Svet Guma</h1>
                    <h2 class="h3"><span class="text-warning">Prijavite</span> se</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 m-auto">
                    <form action="logic/logovanje.php" method="POST">
                        <div class="form-group row">
                          <label for="lgEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="text" name="lgEmail" class="form-control loginRegistracija" id="lgEmail" placeholder="email@example.com">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="lgPass" class="col-sm-2 col-form-label">Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control loginRegistracija" name="lgPass" id="lgPass">
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="m-auto">
                              <input type="submit" class="form-control loginRegistracija pl-2 pr-2" name="lgSubmit" id="lgSubmit" value="Prijavi se">
                            </div>
                        </div>
                        <div class="text-center text-danger">
                              <?php if(isset($_SESSION['greskeLogin'])):
                                  foreach($_SESSION['greskeLogin'] as $greska):?>
                                  <ul>
                                    <li><?=$greska?></li>
                                  </ul>
                                  <?php endforeach;?>
                                  <?php unset($_SESSION['greskeLogin']);
                                    endif;?>
                            </div>
                        <small class="form-text text-muted text-center mb-2">Nemate nalog? Registrujte se odmah!</small>
                        <div class="form-group row">
                            <div class="m-auto">
                                <input type="button" class="form-control loginRegistracija p-2" name="lgReg" id="lgReg" value="Registruj se">
                              </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-warning yellowHeight"></div>