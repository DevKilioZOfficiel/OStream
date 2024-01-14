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

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
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
$reader = new Reader('/www/wwwroot/ostream.online/geo/GeoLite2-City.mmdb');

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
      <!-- Preloader -->
      <!--<div class="mpl-preloader">
          <div class="mpl-preloader-content">
              <div class="mpl-preloader-title display-1 h1">oStream</div>
              <div class="mpl-preloader-progress">
                  <div></div>
              </div>
          </div>
      </div>
      <div class="mpl-preloader-bg"></div>-->
      <!-- /Preloader -->
      <!-- Navbar -->
      <nav class="mpl-navbar-top mpl-navbar">
          <div class="mpl-navbar-mobile-overlay"></div>
          <div class="container mpl-navbar-container">
              <a href="#" class="mpl-navbar-toggle"></a>
              <div class="mpl-navbar-brand">
                  <a href="<?= base_url(''); ?>">
                      <img src="<?= base_url(''); ?>/assets/images/logo.png?v=provisoire" alt="">
                  </a>
              </div>
              <div class="mpl-navbar-content">
                  <ul class="mpl-navbar-nav">
                      <li>
                          <a href="<?= base_url('/'); ?>" class="mpl-nav-link" role="button">
                              <span class="mpl-nav-link-name"> Accueil <i class="fa-duotone fa-house"></i> </span>
                          </a>
                      </li>
                      <li>
                          <a href="<?= base_url('/premium'); ?>" class="mpl-nav-link" role="button">
                              <span class="mpl-nav-link-name"> Premium <i class="fa-duotone fa-popcorn fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;" ></i> </span>
                          </a>
                      </li>
                      <li>
                          <a href="<?= base_url('/live'); ?>" class="mpl-nav-link" role="button">
                              <span class="mpl-nav-link-name"> Live <i class="fa-duotone fa-signal-stream"></i> </span>
                          </a>
                      </li>
                      <li>
                          <a href="<?= base_url('/films'); ?>" class="mpl-nav-link" role="button">
                              <span class="mpl-nav-link-name"> Films et Séries <i class="fa-duotone fa-clapperboard"></i> </span>
                          </a>
                      </li>
                      <li>
                          <a href="<?= base_url('/mangas'); ?>" class="mpl-nav-link" role="button">
                              <span class="mpl-nav-link-name"> Mangas/Animés
                                <span class="fa-layers fa-fw">
                                  <i class="fa-light fa-tv"></i>
                                  <i class="fa-duotone fa-circle" data-fa-transform="shrink-11 up-2 left-3"></i>
                                  <i class="fa-duotone fa-circle" data-fa-transform="shrink-11 up-2 right-3 fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i>
                                </span> </span>
                          </a>
                      </li>
                      <li>
                          <a href="<?= base_url('/trends'); ?>" class="mpl-nav-link" role="button">
                              <span class="mpl-nav-link-name"> Tendance <i class="fa-duotone fa-comet fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;" ></i> </span>
                          </a>
                      </li>
                  </ul>
                  <ul class="mpl-navbar-nav mpl-navbar-right">

                    <?php if (session('isLoggedIn')) { ?>
                      <li class="mpl-dropdown">
                          <a href="#" class="mpl-nav-link" role="button">
                              <span class="mpl-nav-link-name"><?= $permissions['badge__url']; ?> <?= $user['pseudo']; ?></span>
                          </a>
                          <div class="mpl-dropdown-menu">
                              <ul class="mpl-navbar-nav">
                                  <li>
                                      <a href="<?= base_url('dashboard'); ?>" class="mpl-nav-link">
                                          <span class="mpl-nav-link-name"> Paramètres </span>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="<?= base_url('profile/'.$user['id'].''); ?>" class="mpl-nav-link">
                                          <span class="mpl-nav-link-name"> Mon profil </span>
                                      </a>
                                  </li>
                                  <?php if (session('userParrain.id')) { ?>
                                  <li>
                                    <?php $sessionmodel = new \App\Models\SessionModel();
                                    $user_parrain = $sessionmodel->user(session('userParrain.id')); ?>
                                      <a href="<?= base_url('dashboard?primaryaccount=true'); ?>" class="mpl-nav-link">
                                          <span class="mpl-nav-link-name"> Revenir sur <?= $user_parrain['pseudo']; ?></span>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="<?= base_url('profile/'.$user_parrain['id'].''); ?>" class="mpl-nav-link">
                                          <span class="mpl-nav-link-name"> Profil de <?= $user_parrain['pseudo']; ?></span>
                                      </a>
                                  </li>
                                  <?php } ?>
                                  <?php if($permissions['is_admin'] == 1){ ?>
                                    <li>
                                        <a href="<?= base_url('admincp/index'); ?>" class="mpl-nav-link">
                                            <span class="mpl-nav-link-name"> Administration</span>
                                        </a>
                                    </li>
                                  <?php } ?>
                                  <li>
                                      <a href="<?= base_url('logout'); ?>" class="mpl-nav-link">
                                          <span class="mpl-nav-link-name"> Déconnexion </span>
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                    <?php }else{ ?>
                      <li>
                          <a class="mpl-nav-link" href="<?= base_url('login'); ?>">
                              <i class="fa-light fa-user"></i>
                          </a>
                      </li>
                    <?php } ?>
                      <li>
                          <a class="mpl-nav-link" href="#" data-fancybox data-src="#popup-search" data-touch="false" data-small-btn="false" data-toolbar="false" data-close-existing="true" data-auto-focus="true">
                              <svg class="icon" viewBox="0 0 24 24" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" />
                              </svg>
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>
      <!-- /Navbar -->
      <!-- Navbar Mobile -->
      <nav class="mpl-navbar mpl-navbar-mobile">
          <div class="mpl-navbar-container">
              <div class="mpl-navbar-head">
                  <a href="<?= base_url(''); ?>" class="mpl-navbar-brand">
                      <img src="<?= base_url(''); ?>/assets/images/logo.png?v=provisoire" alt="">
                  </a>
                  <a href="#" class="mpl-navbar-toggle">
                      <span></span><span></span><span></span><span></span>
                  </a>
              </div>

              <div class="mpl-navbar-body">
                  <ul class="mpl-navbar-nav">
                      <li>
                          <a href="<?= base_url('/'); ?>" class="mpl-nav-link" role="button">
                              <span class="mpl-nav-link-name"> Accueil <i class="fa-duotone fa-house"></i> </span>
                          </a>
                      </li>
                      <li>
                          <a href="<?= base_url('/premium'); ?>" class="mpl-nav-link" role="button">
                              <span class="mpl-nav-link-name"> Premium <i class="fa-duotone fa-popcorn fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;" ></i> </span>
                          </a>
                      </li>
                      <li>
                          <a href="<?= base_url('/live'); ?>" class="mpl-nav-link" role="button">
                              <span class="mpl-nav-link-name"> Live <i class="fa-duotone fa-signal-stream"></i> </span>
                          </a>
                      </li>
                      <li>
                          <a href="<?= base_url('/films'); ?>" class="mpl-nav-link" role="button">
                              <span class="mpl-nav-link-name"> Films et Séries <i class="fa-duotone fa-clapperboard"></i> </span>
                          </a>
                      </li>
                      <li>
                          <a href="<?= base_url('/mangas'); ?>" class="mpl-nav-link" role="button">
                              <span class="mpl-nav-link-name"> Mangas/Animés
                                <span class="fa-layers fa-fw">
                                  <i class="fa-light fa-tv"></i>
                                  <i class="fa-duotone fa-circle" data-fa-transform="shrink-11 up-2 left-3"></i>
                                  <i class="fa-duotone fa-circle" data-fa-transform="shrink-11 up-2 right-3 fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i>
                                </span>
                              </span>
                          </a>
                      </li>
                      <li>
                          <a href="<?= base_url('/trends'); ?>" class="mpl-nav-link" role="button">
                              <span class="mpl-nav-link-name"> Tendance <i class="fa-duotone fa-comet fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;" ></i> </span>
                          </a>
                      </li>
                      <?php if (session('isLoggedIn')) { ?>
                      <li>
                          <a href="#" class="mpl-nav-link mpl-nav-link-collapse mpl-collapsed" role="button">
                              <span class="mpl-nav-link-name"><?= $permissions['badge__url']; ?> <?= $user['pseudo']; ?></span>
                          </a>
                          <div class="mpl-navbar-collapse collapse">
                              <ul class="mpl-navbar-nav">
                                  <li>
                                      <a href="<?= base_url('dashboard'); ?>" class="mpl-nav-link">
                                          <span class="mpl-nav-link-name">Paramètres </span>
                                      </a>
                                  </li>
                                  <?php if (session('userParrain.id')) { ?>
                                  <li>
                                    <?php $sessionmodel = new \App\Models\SessionModel();
                                    $user_parrain = $sessionmodel->user(session('userParrain.id')); ?>
                                      <a href="<?= base_url('dashboard?primaryaccount=true'); ?>" class="mpl-nav-link">
                                          <span class="mpl-nav-link-name"> Revenir sur <?= $user_parrain['pseudo']; ?></span>
                                      </a>
                                  </li>
                                  <?php } ?>

                                  <?php if($permissions['is_admin'] == 1){ ?>
                                    <li>
                                        <a href="<?= base_url('admincp/index'); ?>" class="mpl-nav-link">
                                            <span class="mpl-nav-link-name"> Administration</span>
                                        </a>
                                    </li>
                                  <?php } ?>
                                  <li>
                                      <a href="<?= base_url('logout'); ?>" class="mpl-nav-link">
                                          <span class="mpl-nav-link-name">Déconnexion </span>
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                    <?php } ?>
                  </ul>
              </div>
              <div class="mpl-navbar-footer">
                  <ul class="mpl-navbar-nav">
                      <li>
                          <a class="mpl-nav-link" href="#" data-fancybox data-src="#popup-search" data-touch="false" data-small-btn="false" data-toolbar="false" data-close-existing="true" data-auto-focus="true">
                              <svg class="icon" viewBox="0 0 24 24" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" />
                              </svg>
                          </a>
                      </li>
                      <?php if (!session('isLoggedIn')) { ?>
                      <li>
                          <a class="mpl-nav-link" href="<?= base_url('login'); ?>">
                              <i class="fa-light fa-user"></i>
                          </a>
                      </li>
                    <?php } ?>
                  </ul>
              </div>
          </div>
      </nav>
      <!-- /Navbar Mobile -->
      <div class="content-wrap">
        <div class="mpl-navbar-mobile-overlay"></div>
        <div>
<?php // DEBUT PAIEMENT FONDS
$builder__maintenance = $db->table('maintenance_mode');
$query__maintenance = $builder__maintenance->get();
foreach ($query__maintenance->getResult() as $row__maintenance) { ?>
  <?php if($row__maintenance->maintenance_mode != 0){ ?>
<style>
.mpl-countdown-item{
  background: #232129c2;
  border-radius: 25px;
  margin: 5px;
}
</style>
                  <section style="padding-top: 190px;padding-bottom: 190px;width: 100%;background: url('<?= base_url('assets/images/ostream2.jpg'); ?>');background-repeat: no-repeat;background-size: cover;background-position: center;" class="mpl-banner-top mpl-banner-parallax">
                      <div style="position: relative;width: 100%;">
                        <div class="container text-center">
                            <h1 class="display-1 mb-60">OStream.online</h1>
                            <h3 class="display-1 mb-60"><?= $row__maintenance->title; ?></h3>
                            <h5 class="display-1 mb-60"><?= $row__maintenance->description; ?></h5>
                            <div style="margin-bottom: 75px;" class="mpl-countdown mpl-countdown-transparent h4" data-end="<?= $row__maintenance->expiration; ?>" data-timezone="CET"></div>

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

                            <?php if($row__maintenance->register == 1){ ?>
                              <form method="POST" action="<?= base_url('preregister_post'); ?>">
                                <div class="row hgap-xs vgap-sm align-items-center">
                                    <div class="col-12"  style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                        <input class="form-control" type="text" name="pseudo" placeholder="Entrez votre pseudo"><span class="form-control-bg"></span>
                                    </div>
                                    <div class="col-12"  style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                        <input class="form-control" type="email" name="email" placeholder="Entrez votre email"><span class="form-control-bg"></span>
                                    </div>
                                    <div class="col-12"  style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                        <input class="form-control" type="password" name="password" placeholder="Entrez votre mot de passe"><span class="form-control-bg"></span>
                                    </div>
                                    <div class="col-12"  style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                        <input class="form-control" type="password" name="password2" placeholder="Entrez la confirmation de votre mot de passe"><span class="form-control-bg"></span>
                                    </div>
                                    <div class="col-12"  style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                        <input class="form-control" type="number" name="parrain" placeholder="Code parrain (Ex: 1) Facultatif"><span class="form-control-bg"></span>
                                    </div>

                                    <div class="col-12"  style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="checkbox"><label class="form-check-label" for="signup_agreement">J'accepte les conditions et la politique.</label>
                                        </div>
                                    </div>

                                    <div class="col-12"  style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                        <button type="submit" class="btn btn-md btn-block" >Pré-Inscription</button>
                                    </div>
                                  </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                  </section>

<?php }else{

  ?>
  <?php if(time() < strtotime("01 January 2023")){
  echo '<div class="i-large"></div>
  <div class="i-medium"></div>
  <div class="i-small"></div>';
}
  $data = [
    'title'  => $title,
    'description' => $description,
    'image' => $image
  ];
  echo view($content, $data);

  }
} ?>
<?php if (session('isLoggedIn')) { ?>
  <?php if($user['premium'] == 0){ ?>
<div id="103864-24"><script src="//ads.themoneytizer.com/s/gen.js?type=24"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=103864&formatId=24"></script></div>
<div id="103864-44"><script src="//ads.themoneytizer.com/s/gen.js?type=44"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=103864&formatId=44"></script></div>
<?php }
}else{ ?>
<div id="103864-24"><script src="//ads.themoneytizer.com/s/gen.js?type=24"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=103864&formatId=24"></script></div>
<div id="103864-44"><script src="//ads.themoneytizer.com/s/gen.js?type=44"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=103864&formatId=44"></script></div>
<?php } ?>
<!-- Footer -->
<footer class="mpl-footer mpl-footer-parallax mpl-footer-social">
    <!--<div class="mpl-image">
        <img src="<?= base_url('uploads/assets'); ?>/images/dark/bg-footer.jpg" alt="" class="jarallax-img">
    </div>-->
    <div class="mpl-footer-wrapper">
        <div class="mpl-footer-container container">
                <div class="row">
                  <div class="col-12 col-sm-4">
                    <iframe src="https://discord.com/widget?id=1041818984716173322&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
                  </div>
                  <div class="col-12 col-sm-4">
                    <h2>Liens utiles</h2>
                    <ul style="text-decoration: none;list-style-type: none;text-align: center;">
                      <li><a href="<?= base_url('uploads/cgu.pdf'); ?>"> CGU</a></li>
                        <li><a href="<?= base_url('uploads/cgv.pdf'); ?>"> CGV</a></li>
                    </ul>
                  </div>
                  <div class="col-12 col-sm-4">
                    <h2>Réseaux</h2>
                    <ul style="text-decoration: none;list-style-type: none;text-align: center;">
                      <li><a href="https://discord.gg/PvBA2BEUnH"><i class="fa-brands fa-discord"></i> Discord</a></li>
                      <li><a href="https://twitter.com/OStream_FR"><i class="fa-brands fa-twitter"></i> Twitter</a></li>
                    </ul>
                  </div>
                </div>
        </div>
    </div>
</footer>
<div class="mpl-footer-copyright">
    <div class="container">
        <p>2022-<?= date('Y'); ?> &copy; <a href="https://dev-time.eu/" target="_blank">Dev-Time Development  Team</a>. Tous droits réservés</p>
    </div>
</div>
<!-- /Footer -->
</div>
</div>
<!-- Popup Search -->
<div class="mpl-fancybox-search mpl-fancybox-content" id="popup-search">
<div class="container">
<form action="<?= base_url('search'); ?>" method="GET" class="mpl-fancybox-search-content">
    <input class="form-control mpl-fancybox-search-input" type="text" name="search" placeholder="Rechercher un stream, un film ou une série">
    <button class="mpl-fancybox-search-btn" type="button">
        <svg class="icon" viewBox="0 0 24 24" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" />
        </svg>
    </button>
    <div class="mpl-fancybox-search-line"></div>
</form>
</div>
</div>
<!-- START: Scripts -->
<!-- Popper -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/%40popperjs/core/dist/umd/popper.min590d.js?v=2.11.0"></script>
<!-- ScrollReveal -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/scrollreveal/dist/scrollreveal.minbc3e.js?v=4.0.9"></script>
<!-- Animejs -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/animejs/lib/anime.minf77b.js?v=3.2.1"></script>
<!-- Bootstrap -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/bootstrap/dist/js/bootstrap.minc420.js?v=5.1.3"></script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mot de passe oublié ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="<?= base_url(); ?>/forgot_post">
        <div class="modal-body">
          <input type="email" name="devtime__email_forgot" class="form-control" placeholder="Email">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Jarallax -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/jarallax/dist/jarallax.min5fab.js?v=1.12.8"></script>
<!-- Swiper -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/swiper/swiper-bundle.min7316.js?v=6.8.2"></script>
<!-- Fancybox -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/fancybox/dist/jquery.fancybox.min438f.js?v=3.5.7"></script>
<!-- jQuery Countdown -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/jquery-countdown/dist/jquery.countdown.mind1f1.js?v=2.2.0"></script>
<!-- Moment.js -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/moment/min/moment.min63eb.js?v=2.29.1"></script>
<script src="<?= base_url('uploads/assets'); ?>/vendor/moment-timezone/builds/moment-timezone-with-data.minc112.js?v=0.5.34"></script>
<!-- Revolution Slider -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/slider-revolution/js/jquery.themepunch.tools.min4ed6.js?v=5.4.8"></script>
<script src="<?= base_url('uploads/assets'); ?>/vendor/slider-revolution/js/jquery.themepunch.revolution.min4ed6.js?v=5.4.8"></script>
<!-- ImagesLoaded -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/imagesloaded/imagesloaded.pkgd.mine781.js?v=4.1.4"></script>
<!-- Isotope -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/isotope-layout/dist/isotope.pkgd.minaf3e.js?v=3.0.6"></script>
<!-- Ion Range Slider -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/ion-rangeslider/js/ion.rangeSlider.min7317.js?v=2.3.1"></script>
<!-- Bootstrap TouchSpin -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.mine0a5.js?v=4.3.0"></script>
<!-- Bootstrap Validator -->
<script src="<?= base_url('uploads/assets'); ?>/vendor/bootstrap-validator/dist/validator.minfb28.js?v=0.11.9"></script>
<!-- MonsterPlay -->
<script src="<?= base_url('uploads/assets'); ?>/js/monsterplay.min5438.js?v=1.2.0.2"></script>
<script src="<?= base_url('uploads/assets'); ?>/js/monsterplay-init5438.js?v=1.2.0.2"></script>
<!-- END: Scripts -->
<script>
$('.mpl-countdown').each(function()
            {
                const $this = $(this);
                const tz = $this.attr('data-timezone');
                let end = $this.attr('data-end');
                end = moment.tz(end, tz).toDate();
                $this.countdown(end, function(event)
                {
                    $this.html(event.strftime(['<div class="mpl-countdown-item">', '<span>Jours</span>', '<span><span>%D</span></span>', '</div>', '<div class="mpl-countdown-item">', '<span>Heures</span>', '<span><span>%H</span></span>', '</div>', '<div class="mpl-countdown-item">', '<span>Minutes</span>', '<span><span>%M</span></span>', '</div>', '<div class="mpl-countdown-item">', '<span>Secondes</span>', '<span><span>%S</span></span>', '</div>'].join('')));
                });
            });
            if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
            }
</script>
</body>
</html>
