<?php
$db = \Config\Database::connect();
$request = \Config\Services::request(); ?>
<style>
.ostreamv2{
  padding: 12px 30px;
    font-family: var(--title-fonts);
    font-size: 16px;
    background: var(--primary-color);
    color: var(--white-color);
    text-transform: capitalize;
    color: var(--white-color) !important;
    display: inline-block;
    border: none;
    width: auto;
    height: auto;
    line-height: 2;
    text-transform: uppercase;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
    transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
    -ms-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    -webkit-transition: all 0.5s ease-in-out;
}
</style>

<section class="position-relative pb-0">
        <div class="gen-login-page-background" style="background-image: url('<?= base_url(); ?>/uploads/assets/images/background/asset-54.jpg');"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  <div id="result_ajax"></div>
                  <?php if (session()->has('success')) :
                    echo "<div class='alert alert-success'>".session('success')."</div>";
                  endif ?>
                    <div class="text-center">
                        <form id="pms_login">
                            <h4>Connexion à oStream</h4>
                            <p class="login-username">
                                <label for="user_login">Adresse email</label>
                                <input type="email" name="email" id="pseudo" class="input">
                            </p>
                            <p class="login-password">
                                <label for="user_pass">Mot de passe</label>
                                <input type="password" name="password" id="password" class="input">
                            </p>
                            <p class="login-submit">
                                <button type="button" onclick="login()" name="wp-submit" class="ostreamv2 button button-primary">Connexion</button>
                                <a href="<?= base_url('auth/discord'); ?>" id="wp-submit" class="ostreamv2 button button-primary" style="background: #5865F2;"><i class="fa-brands fa-discord"></i> Connexion Discord</a>
                            </p>
                            <a href="<?= base_url('register'); ?>">S'inscrire</a> | <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Mot de passe oublié ?</a>
                        </form>
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
