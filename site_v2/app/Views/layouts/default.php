<?php ini_set('memory_limit', '-1'); ?>
<?php
$db = \Config\Database::connect();
$request = \Config\Services::request();
$agent0 = $request->getUserAgent();
if ($agent0->isBrowser()){
  $agent = $agent0->getBrowser().' '.$agent0->getVersion();
}elseif ($agent0->isRobot()){
  $robot = $agent0->getRobot();
}elseif ($agent0->isMobile()){
  $agent = $agent0->getMobile();
}else{
  $agent = 'Unidentified User Agent';
}

$agent_string = $agent0->getAgentString();
if(session('isLoggedIn')) {
  $builder3 = $db->table('user');
  $builder3->set('last_login', date('Y-m-d H:i:s'));
  $builder3->where('id', $user['id']);
  $builder3->update();
} ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= view('layouts/head0'); ?>
    <?php  $sessionmodel = new \App\Models\SessionModel();
    $agent0 = $request->getUserAgent();
		if ($agent0->isBrowser()){
			$agent = $agent0->getBrowser().' '.$agent0->getVersion();
		}elseif ($agent0->isRobot()){
			$agent = $agent0->getRobot();
		}elseif ($agent0->isMobile()){
			$agent = $agent0->getMobile();
		}else{
			$agent = 'Unidentified User Agent';
		}
		if ($agent0->isRobot()){
			$robot = $agent0->getRobot();
		}else{
			$robot = "0";
		}
		if ($agent0->isReferral()){
			$referer = $agent0->getReferrer();
		}else{
			$referer = "none";
		}
		$agent_version = $agent0->getVersion();
		$platform = $agent0->getPlatform();
		$agent_string = $agent0->getAgentString();

    $ip = $sessionmodel->get_ip();




// This reader object should be reused across lookups as creation of it is
// expensive.
require 'geo/vendor/autoload.php';
use GeoIp2\Database\Reader;
$reader = new Reader('/www/wwwroot/v2.ostream.online/geo/GeoLite2-City.mmdb');

$record = $reader->city($ip);
if(empty($record)){
  $city = "";
  $country = "";
}else{
  if(!empty($record->city->names['en'])){
    $city = $record->city->names['en'];
  }else{
    $city = "";
  }
  if(!empty($record->country->isoCode)){
    $country = $record->country->isoCode;
  }else{
    $country = "";
  }
}

//$city = "";
//$country = "";
    $sessionmodel->Statistiques_vues(site_url(uri_string()),$sessionmodel->get_ip(),$agent,$agent_version,$platform,$robot,$referer,$agent_string,0,$country,$city); ?>
  </head>

  <body>
    <!--=========== Loader =============-->
    <!--<div id="gen-loading">
      <div id="gen-loading-center">
        <img src="<?= base_url('uploads'); ?>/assets/images/logo.png?v=provisoire" alt="loading">
      </div>
    </div>-->
<!--=========== Loader =============-->

<?php if(site_url(uri_string()) === site_url('login') || site_url(uri_string()) === site_url('register')){ ?>

<?php }else{ ?>
<!--========== Header ==============-->
<header id="gen-header" class="gen-header-style-1 gen-has-sticky">
    <div class="gen-bottom-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="#">
                            <img class="img-fluid logo" src="<?= base_url('uploads'); ?>/assets/images/logo.png?v=provisoire" alt="streamlab-image">
                        </a>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div id="gen-menu-contain" class="gen-menu-contain">
                                <ul id="gen-main-menu" class="navbar-nav ml-auto">
                                <li class="menu-item">
                                   <a href="<?= base_url('/'); ?>" aria-current="page">Accueil <i class="fa-duotone fa-house"></i></a>
                                </li>
                                <li class="menu-item">
                                   <a href="<?= base_url('/premium'); ?>" aria-current="page">Premium <i class="fa-duotone fa-popcorn fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;" ></i></a>
                                </li>
                                <li class="menu-item">
                                   <a href="<?= base_url('/live'); ?>" aria-current="page">Live <i class="fa-duotone fa-signal-stream"></i></a>
                                </li>
                                <li class="menu-item">
                                   <a href="<?= base_url('/films'); ?>" aria-current="page">Films et Séries <i class="fa-duotone fa-clapperboard"></i></a>
                                </li>
                                <li class="menu-item">
                                   <a href="<?= base_url('/mangas'); ?>" aria-current="page">Mangas et Animés <span class="fa-layers fa-fw">
                                     <i class="fa-light fa-tv"></i>
                                     <i class="fa-duotone fa-circle" data-fa-transform="shrink-11 up-2 left-3"></i>
                                     <i class="fa-duotone fa-circle" data-fa-transform="shrink-11 up-2 right-3 fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i>
                                   </span></a>
                                </li>
                                <li class="menu-item">
                                   <a href="<?= base_url('/trends'); ?>" aria-current="page">Tendance <i class="fa-duotone fa-comet fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;" ></i></a>
                                </li>
                                </ul>
                            </div>
                        </div>
                        <div class="gen-header-info-box">
                        <div class="gen-menu-search-block">
                           <a href="javascript:void(0)" id="gen-seacrh-btn"><i class="fa fa-search"></i></a>
                           <div class="gen-search-form">
                              <form role="search" method="get" class="search-form" action="<?= base_url('search'); ?>">
                                 <label>
                                    <span class="screen-reader-text"></span>
                                    <input type="search" class="search-field" placeholder="Rechercher …" value="" name="search">
                                 </label>
                                 <button type="submit" class="search-submit">
                                   <span class="screen-reader-text"></span>
                                 </button>
                              </form>
                           </div>
                        </div>
                        <?php if (session('isLoggedIn')) { ?>
                           <div class="gen-account-holder">
                             <a href="javascript:void(0)" id="gen-user-btn"><i class="fa fa-user"></i></a>
                             <div class="gen-account-menu">
                                <ul class="gen-account-menu">
                                   <!-- Pms Menu -->
                                   <li>
                                      <a href="<?= base_url('dashboard'); ?>">Paramètres </a>
                                   </li>
                                   <!--<li>
                                      <a href="<?= base_url('profile/'.$user['id'].''); ?>">Mon profil </a>
                                   </li>-->
                                   <?php if (session('userParrain.id')) { ?>
                                     <?php $sessionmodel = new \App\Models\SessionModel();
                                     $user_parrain = $sessionmodel->user(session('userParrain.id')); ?>
                                   <li>
                                      <a href="<?= base_url('dashboard?primaryaccount=true'); ?>">Revenir sur <?= $user_parrain['pseudo']; ?> </a>
                                   </li>
                                 <?php } ?>
                                 <?php if($permissions['is_admin'] == 1){ ?>
                               <li>
                                   <a href="<?= base_url('admincp/index'); ?>">
                                      Administration
                                   </a>
                               </li>
                             <?php } ?>
                             <li>
                                 <a href="<?= base_url('logout'); ?>">
                                     Déconnexion
                                 </a>
                             </li>
                                </ul>
                             </div>
                           </div>
                         <?php }else{ ?>
                           <div class="gen-account-holder">
                             <a href="javascript:void(0)" id="gen-user-btn"><i class="fa fa-user"></i></a>
                             <div class="gen-account-menu">
                                <ul class="gen-account-menu">
                                   <!-- Pms Menu -->
                                   <li>
                                     <a href="<?= base_url('login'); ?>">
                                       Se connecter
                                     </a>
                                   </li>
                                   <li>
                                     <a href="<?= base_url('register'); ?>">
                                       S'inscrire
                                     </a>
                                   </li>
                                </ul>
                             </div>
                           </div>
                         <?php } ?>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-bars"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!--========== Header ==============-->
<?php } ?>

<?php // DEBUT PAIEMENT FONDS
$builder__maintenance = $db->table('maintenance_mode');
$query__maintenance = $builder__maintenance->get();
foreach ($query__maintenance->getResult() as $row__maintenance) { ?>
<?php if($row__maintenance->maintenance_mode != 0){ ?>



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
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                    <?php if (session()->has('error')) :
                      echo "<div class='alert alert-danger'>".session('error')."</div>";
                    endif ?>
                    <?php if (session()->has('errors')) : ?>
                        <?php foreach (session('errors') as $error) : ?>
                          <div class='alert alert-danger'><?= $error ?></div>
                        <?php endforeach ?>
                    <?php endif ?>
                    <?php if (session()->has('success')) :
                      echo "<div class='alert alert-success'>".session('success')."</div>";
                    endif ?>
                        <div class="text-center">
                          <h3 class="display-1 mb-60"><?= $row__maintenance->title; ?></h3>
                          <h5 class="display-1 mb-60"><?= $row__maintenance->description; ?></h5>
                        </div>
                        <div class="gen-icon-box-style-1">
                          <div class="gen-icon-box-content">
                            <h3 class="pt-icon-box-title mb-2">
                              <span>Il reste encore...</span>
                            </h3>
                            <h2 class="gen-icon-box-description" id="demo">Calcul en cours...</h2>

                            <script>
                            // Set the date we're counting down to
var countDownDate = new Date("<?= $row__maintenance->expiration; ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "j " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
                          </div>
                        </div>
                        <br><br>
                        <div class="text-center">
                        <?php if($row__maintenance->register == 1){ ?>
                          <form method="POST" action="<?= base_url('preregister_post'); ?>" id="pms_login">
                              <h4>Pré-inscription à oStream</h4>
                              <p class="login-username">
                                  <label for="user_login">Pseudo</label>
                                  <input type="text" name="pseudo" class="input">
                              </p>
                              <p class="login-username">
                                  <label for="user_login">Adresse email</label>
                                  <input type="email" name="email" class="input">
                              </p>
                              <p class="login-password">
                                  <label for="user_pass">Mot de passe</label>
                                  <input type="password" name="password" class="input">
                              </p>
                              <p class="login-password">
                                  <label for="user_pass">Confirmation du mot de passe</label>
                                  <input type="password" name="password2" class="input">
                              </p>
                              <p class="login-password">
                                  <label for="user_pass">Code parrain (Ex: 1) FACULTATIF</label>
                                  <input type="number" name="parrain" class="input">
                              </p>
                              <p class="login-remember">
                                  <label><input name="checkbox" type="checkbox"> J'accepte les conditions et la politique.</label>
                              </p>
                              <p class="login-submit">
                                  <button type="submit" class="ostreamv2 button button-primary">Inscription</button>
                                  <a href="<?= base_url('auth/discord'); ?>" id="wp-submit" class="ostreamv2 button button-primary" style="background: #5865F2;"><i class="fa-brands fa-discord"></i> Inscription Discord</a>
                              </p>
                          </form>
                        <?php } ?>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <br><br>



<?php
  }else{
    $data = [
      'title'  => $title,
      'description' => $description,
      'image' => $image
    ];
    echo view($content, $data);
  }
} ?>
<?php
  echo view("api/ecowatt");
?>
<script>
  document.getElementById('chat-circle').onclick = function() {
    console.log("Clique");
    document.getElementById("chat-circle").style.display = "none";
    document.querySelector(".chat-box").style.display = "block";
  }

  document.getElementById('close_ecowatt').onclick = function() {
    document.getElementById("chat-circle").style.display = "block";
    document.querySelector(".chat-box").style.display = "none";
  }
  </script>
<?php if (session('isLoggedIn')) { ?>
<?php if($user['premium'] == 0){ ?>
<div id="103864-24"><script src="//ads.themoneytizer.com/s/gen.js?type=24"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=103864&formatId=24"></script></div>
<div id="103864-44"><script src="//ads.themoneytizer.com/s/gen.js?type=44"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=103864&formatId=44"></script></div>
<?php }
}else{ ?>
  <?php if(site_url(uri_string()) === site_url('login') || site_url(uri_string()) === site_url('register')){ ?>

  <?php }else{ ?>
<div id="103864-24"><script src="//ads.themoneytizer.com/s/gen.js?type=24"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=103864&formatId=24"></script></div>
<div id="103864-44"><script src="//ads.themoneytizer.com/s/gen.js?type=44"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=103864&formatId=44"></script></div>
  <?php } ?>
<?php } ?>

<?php if(site_url(uri_string()) === site_url('login') || site_url(uri_string()) === site_url('register')){ ?>

<?php }else{ ?>
<!-- footer start -->
<footer id="gen-footer">
   <div class="gen-footer-style-1">
      <div class="gen-footer-top">
         <div class="container">
            <div class="row">
               <div class="col-xl-4 col-md-6">
                  <div class="widget">
                     <div class="row">
                        <div class="col-sm-12">
                           <img src="<?= base_url(); ?>/assets/images/logo.png?v=provisoire" class="gen-footer-logo" alt="gen-footer-logo">
                           <p>oStream, le site de streaming.</p>
                           <ul class="social-link">
                              <li><a href="https://discord.gg/PvBA2BEUnH" class="facebook"><i class="fa-brands fa-discord"></i></a></li>
                              <li><a href="https://twitter.com/OStream_FR" class="facebook"><i class="fa-brands fa-twitter"></i></a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-4 col-md-6">
                  <div class="widget">
                     <h4 class="footer-title">Explorer</h4>
                     <div class="menu-explore-container">
                        <ul class="menu">
                           <li class="menu-item">
                              <a href="<?= base_url('/'); ?>" aria-current="page">Accueil</a>
                           </li>
                           <li class="menu-item"><a href="<?= base_url('/films'); ?>">Films et Séries</a></li>
                           <li class="menu-item"><a href="<?= base_url('/live'); ?>">En direct</a></li>
                           <li class="menu-item"><a href="<?= base_url('/mangas'); ?>">Mangas et Animés</a></li>
                           <li class="menu-item"><a href="<?= base_url('/trends'); ?>">Tendance</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-xl-4 col-md-6">
                  <div class="widget">
                     <h4 class="footer-title">Liens utiles</h4>
                     <div class="menu-about-container">
                        <ul class="menu">
                           <li class="menu-item"><a href="<?= base_url('uploads/cgu.pdf'); ?>">Conditions Générales d'Utilisations</a></li>
                           <li class="menu-item"><a href="<?= base_url('uploads/cgv.pdf'); ?>">Conditions Générales de Ventes</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="gen-copyright-footer">
         <div class="container">
            <div class="row">
               <div class="col-md-12 align-self-center">
                  <span class="gen-copyright">2022-<?= date('Y'); ?> &copy; <a href="https://dev-time.eu/" target="_blank">Dev-Time Development  Team</a>. Tous droits réservés</span>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
<!-- footer End -->
<?php } ?>

<!-- Back-to-Top start -->
<div id="back-to-top">
   <a class="top" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
</div>
<!-- Back-to-Top end -->

<!-- js-min -->
<script src="<?= base_url('uploads'); ?>/assets/js/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('uploads'); ?>/assets/js/asyncloader.min.js"></script>
<!-- JS bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- owl-carousel -->
<script src="<?= base_url('uploads'); ?>/assets/js/owl.carousel.min.js"></script>
<!-- counter-js -->
<script src="<?= base_url('uploads'); ?>/assets/js/jquery.waypoints.min.js"></script>
<script src="<?= base_url('uploads'); ?>/assets/js/jquery.counterup.min.js"></script>
<!-- popper-js -->
<script src="<?= base_url('uploads'); ?>/assets/js/popper.min.js"></script>
<script src="<?= base_url('uploads'); ?>/assets/js/swiper-bundle.min.js"></script>
<!-- Iscotop -->
<script src="<?= base_url('uploads'); ?>/assets/js/isotope.pkgd.min.js"></script>

<script src="<?= base_url('uploads'); ?>/assets/js/jquery.magnific-popup.min.js"></script>

<script src="<?= base_url('uploads'); ?>/assets/js/slick.min.js"></script>

<script src="<?= base_url('uploads'); ?>/assets/js/streamlab-core.js"></script>

<script src="<?= base_url('uploads'); ?>/assets/js/script.js"></script>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog gen-footer">
    <div class="modal-content" style="background: var(--black-color);">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mot de passe oublié ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="<?= base_url(); ?>/forgot_post">
        <div class="modal-body">
          <input type="email" name="devtime__email_forgot" class="input" placeholder="Email">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>

</html>
