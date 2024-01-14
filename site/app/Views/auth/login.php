<?php
$db = \Config\Database::connect();
$request = \Config\Services::request(); ?>
    <section class="mpl-banner mpl-banner-top mpl-banner-parallax">
                  <div class="mpl-image" data-speed="0.8" style="z-index: 0;">

                    <div id="jarallax-container-0" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; z-index: -100; clip-path: polygon(0px 0px, 100% 0px, 100% 100%, 0px 100%);">
                      <img src="<?= base_url(); ?>/assets/images/dark/banner-bg.png" alt="" class="jarallax-img" style="object-fit: cover; object-position: 50% 50%; max-width: none; position: absolute; top: 0px; left: 0px; width: 1735.15px; height: 1321.27px; overflow: hidden; pointer-events: none; transform-style: preserve-3d; backface-visibility: hidden; margin-top: -0.13335px; transform: translate3d(0px, 0.1146px, 0px);">
                    </div>
                  </div>
                    <div class="mpl-banner-content mpl-box-sm" style="opacity: 0.999929; transform: translate3d(0px, -0.0106453px, 0px);">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                  <div id="result_ajax"></div>
                                  <?php if (session()->has('success')) :
                                    echo "<div class='alert alert-success'>".session('success')."</div>";
                                  endif ?>
                                    <div class="mpl-sign-form" data-sr="sign" data-sr-interval="100" data-sr-duration="1000" data-sr-distance="20">
                                        <h1 data-sr-item="sign" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1s cubic-bezier(0.5, 0, 0, 1) 0s;">Connexion à oStream</h1>

                                        <form>
                                            <div class="row hgap-xs vgap-sm align-items-center">
                                                <div class="col-12" data-sr-item="sign" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                                    <input class="form-control" type="text" id="pseudo" name="signin_login" placeholder="Email"><span class="form-control-bg"></span>
                                                </div>
                                                <div class="col-12" data-sr-item="sign" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                                    <input class="form-control" type="password" id="password" name="signin_password" placeholder="Mot de passe"><span class="form-control-bg"></span>
                                                </div>
                                                <div class="col-auto" data-sr-item="sign" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                                    <span data-bs-toggle="modal" data-bs-target="#exampleModal" class="small">Mot de passe oublié ?</span>
                                                </div>
                                                <div class="col-12" data-sr-item="sign" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                                    <button type="button" onclick="login()" class="btn btn-md btn-block">Connexion</button>
                                                </div>
                                                <div class="col-12" data-sr-item="sign" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                                   Êtes-vous nouveau ? <a href="<?= base_url('register'); ?>">S'inscrire</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


<script>
function login(){
  oData = new FormData();
  oData.append("pseudo", document.getElementById("pseudo").value);
  oData.append("password", document.getElementById("password").value);

  var oReq = new XMLHttpRequest();
  oReq.open("POST", "<?= base_url(); ?>/api/auth/login", true);
  oReq.onload = function(oEvent) {
    console.log(oReq);
    console.log(oReq.status);
    console.log(oReq.responseText);
    if (oReq.status == 200) {
      if(oReq.responseText === "<div class='alert alert-success'>Connexion réussie</div>"){
        document.getElementById("result_ajax").innerHTML = oReq.responseText;
        location.reload();
      }else{
        document.getElementById("result_ajax").innerHTML = oReq.responseText;
      }
    } else {
      document.getElementById("result_ajax").innerHTML = "<div class='alert alert-danger'>Erreur " + oReq.status+"</div>";
    }
  };
  oReq.send(oData);
  }
</script>
