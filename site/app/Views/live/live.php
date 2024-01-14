<?php $db = \Config\Database::connect();
$request = \Config\Services::request(); ?>
<?php
// Allow from any origin
header("Access-Control-Allow-Origin: *");
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // should do a check here to match $_SERVER['HTTP_ORIGIN'] to a
    // whitelist of safe domains
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

}
if($streams['stream_type'] === "vps"){
  $builder = $db->table('servers');
  $builder->where('id', $streams['server_id']);
  $query = $builder->get();
  foreach ($query->getResult() as $row) {
    $server_url = $row->url;
    $stream_url = "https://".$server_url."/hls/".$streams['stream_url']."/index.m3u8";
    $vps_ip = $row->vps_ip;
    $application_video = 'type="application/x-mpegURL"';
  }
}else{
  $stream_url = $streams['stream_url'];
  $vps_ip = "";
  //$application_video = 'type="video/mp4"';
  $application_video = 'type=\'video/x-matroska; codecs="theora, vorbis"\' autoplay controls onerror="failed(event)"';
}

view('api/simple_html_dom');
$url_stats_live = 'http://'.$vps_ip.':8082/stat.xsl'; ?>
<section class="mpl-banner mpl-banner-top mpl-banner-parallax mpl-banner-small">
                    <div class="mpl-image" data-speed="0.8" style="z-index: 0;">

                       <div id="jarallax-container-0" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; z-index: -100; clip-path: polygon(0px 0px, 100% 0px, 100% 100%, 0px 100%);">
                         <img src="<?= $categories['image']; ?>" alt="" class="jarallax-img" style="object-fit: cover; object-position: 50% 50%; max-width: none; position: absolute; top: 0px; left: 0px; width: 1355.15px; height: 748.667px; overflow: hidden; pointer-events: none; transform-style: preserve-3d; backface-visibility: hidden; margin-top: 286.167px; transform: translate3d(0px, -286.185px, 0px);">
                       </div>
                    </div>
                    <div class="mpl-banner-content mpl-box-lg" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10" data-sr="blog-banner" data-sr-interval="200" data-sr-duration="1200" data-sr-distance="20">
                                    <h1 class="display-1" data-sr-item="blog-banner" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1.2s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1.2s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                      <?= $streams['titre']; ?>  <?php if($streams['is_premium'] != "0"){?><span class="badge badge-primary">STREAM PREMIUM</span><?php } ?><br>
                                      <?= $categories['name']; ?> <?php if($categories['is_premium']){ ?><span class="badge badge-brand">PREMIUM</span><?php } ?>
                                    </h1>
                                    <p class="lead mb-0" data-sr-item="blog-banner" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1.2s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1.2s cubic-bezier(0.5, 0, 0, 1) 0s;">

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

<div class="mpl-box-sm">
    <div class="container">
        <div class="row vgap-md">
            <div class="col-12 col-sm-12 col-md-12">
              <?php if (session('isLoggedIn')) { ?>
              <?php if($user['premium'] == 0 && $streams['is_premium'] != 0 || $streams['is_premium'] > $user['premium']){ ?>
                <div class="alert alert-danger mb-60" role="alert">
                    <strong>PREMIUM</strong> Vous devez être Premium pour accéder à ce live.
                </div>
              <?php } ?>
            <?php }else{ ?>
              <div class="alert alert-danger mb-60" role="alert">
                  <strong>CONNEXION</strong> Vous devez être connecté pour accéder à ce live.
              </div>
            <?php } ?>
            <?php
            if (session('isLoggedIn')) {
              if($streams['stream_type'] != "vps"){
            $duration_month_seconds = 0;
            $builder = $db->table('durations_streams');
            $builder->where('user', $user['id']);
            $builder->where('mois', date('m'));
            $builder->where('annee', date('Y'));
            $query = $builder->get();
            foreach ($query->getResult() as $row) {
              $duration_month_seconds += $row->duration;
            }
          }else{
            $duration_month_seconds = 0;
          }
            } ?>
            <?php
            if (session('isLoggedIn')) {
            if($premium_user_info['duration_stream']*3600-$duration_month_seconds < 0){ ?>
              <div class="alert alert-warning mb-60" role="alert">
                  <strong>INFORMATION</strong> Il semblerait que votre quota du mois est au maximum ! Pour cela, veuillez attendre le mois prochain ou alors, optez pour l'offre Premium supérieure !
              </div>
            <?php }else{ ?>
              <?php if($premium_user_info['duration_stream']*3600-$duration_month_seconds < 3600){ ?>
                <div class="alert alert-warning mb-60" role="alert">
                    <strong>INFORMATION</strong> Il serait temps de passer a la vitesse supérieure ! Il vous reste moins d'une heure de streaming disponible ce mois !
                </div>
              <?php } ?>
                <div class="cyberpress-match" style="margin-bottom: 2rem;">
                  <?php if (session('isLoggedIn')) { ?>
                    <?php if($user['premium'] != 0 && $streams['is_premium'] == 1 || $streams['is_premium'] == 0){ ?>
                      <?php if($streams['launch'] < time()){ ?>
                        <?php if($streams['stream_type'] === "vps"){ ?>
                          <link href="<?= base_url(); ?>/uploads/assets/videojs/video-js.css" rel="stylesheet">
                          <script src='<?= base_url(); ?>/uploads/assets/videojs/video.js'></script>
                          <script src="<?= base_url(); ?>/uploads/assets/videojs/videojs-http-streaming.js"></script>
                  <video-js id="live_stream" class="vjs-default-skin" controls preload="auto" width="auto" height="auto" data-setup='{"language":"fr"}' style="margin-bottom: 2rem;">
                    <source src="<?= $stream_url; ?>" <?= $application_video; ?> data-setup='{"language":"fr"}'>
                  </video-js>
                <?php }else{ ?>

                  <script type="text/javascript" src="<?= base_url('uploads/assets/js/videoplayer.min.js?v1.0.1'); ?>"></script>
                  <style>
                .videoplayer {
                  position: relative;
                  display: block;
                }
                .videoplayer video {
                  width: 100%;
                  height: auto;
                  border-top-left-radius: 15px;
                  border-top-right-radius: 15px;
                  border-bottom-left-radius: 15px;
                  border-bottom-right-radius: 15px;

                }
                .videoplayer .controls {
                  position: absolute;
                  bottom: 0;
                  display: flex;
                  width: 100%;
                  align-items: center;
                  bottom: 0;
                  background-color: #22242e;
                  border-bottom-left-radius: 15px;
                  border-bottom-right-radius: 15px;
                }
                .videoplayer .controls .progress {
                  background-color: #333;
                }
                .videoplayer .controls .progress .progress-bar {
                  transition: none !important;
                  background-color: #666;
                }
                .videoplayer .controls.controls-light .bi {
                  color: #2b2b2b;
                }
                .videoplayer .controls.controls-dark {
                  background-color: #2b2b2b;
                }
                .videoplayer .controls.controls-dark .bi {
                  color: #eee;
                }
                .videoplayer .controls.controls-dark .progress {
                  background-color: #ccc;
                }
                .videoplayer .controls.controls-dark .progress .progress-bar {
                  background-color: #999;
                }
                .videoplayer .controls.auto-hide {
                  opacity: 0;
                  transition: opacity 0.5s ease-in-out;
                  transition-delay: 0.5s;
                }
                .videoplayer .controls button > *,
                .videoplayer .controls .btn > * {
                  pointer-events: none !important;
                }
                .videoplayer .overlay {
                  position: absolute;
                  z-index: 300;
                  top: 0;
                  left: 0;
                }
                .videoplayer .overlay .title {
                  font-size: inherit;
                  color: white;
                  padding: 0.5rem;
                  font-weight: bold;
                }
                .videoplayer .dropup-volume {
                  position: absolute !important;
                  bottom: calc(100% + 5px) !important;
                  padding: 0.75rem 1rem;
                  transform: none !important;
                  min-width: inherit;
                }
                .videoplayer .dropup-volume .form-range {
                  -webkit-appearance: slider-vertical;
                  width: 1rem !important;
                  height: 100% !important;
                }
                .videoplayer:hover .controls.auto-hide {
                  opacity: 1;
                }

                .tooltip {
                  z-index: 1400;
                }
                .clair{
                  color: #fff;
                }
                .overlay2 {
                  display: flex;
                  position: absolute;
                  top: 0;
                  z-index: 10;
                }
                .overlay2 h2 {
                  margin-left: 15px;
                  margin-top: 15px;
                  background: #22242e7a;
                  color: #fff;
                  mix-blend-mode: overlay;
                  padding: 5px 15px 5px 15px;
                  border-radius: 15px;
                }
                .player-dropdown{
                  background-color: rgb(34, 36, 46);
                  border-radius: 15px;
                }
                .player-dropdown:hover{
                  background-color: rgb(34, 36, 46);
                  border-radius: 15px;
                }
                </style>
                <script>
                var myPlayer = new BootstrapVideoplayer('myCustomPlayer',{
                    selectors:{
                        video: '.video',
                        playPauseButton: '.btn-video-playpause',
                        playIcon: '.fa-play',
                        pauseIcon: '.fa-play-pause',
                        progress: '.progress',
                        progressbar: '.progress-bar',
                        pipButton: '.btn-video-pip',
                        fullscreenButton: '.btn-video-fullscreen',
                        volumeRange: '.form-range-volume'
                   }
                })
                </script>
                <div class="videoplayer" id="myCustomPlayer">
                     <div class="bg-dark-dt" style="border-top-left-radius: 15px;border-top-right-radius: 15px;">
                       <?php if(str_contains($stream_url, '.mkv')){ ?>
                        <video class="video" id="video" src="<?= $stream_url; ?>" type='video/x-matroska; codecs="theora, vorbis"' controlsList="nodownload" autoplay>
                          <source src="<?= $stream_url; ?>">
                          Désolé... On dirait que vous utilisez un navigateur trop vieux. Utilisez Edge Chromium pour être à jour.
                        </video>
                      <?php } ?>
                      <?php if(str_contains($stream_url, '.mp4')){ ?>
                        <video class="video" id="video" src="<?= $stream_url; ?>" type="video/mp4" controlsList="nodownload" autoplay>
                          <source src="<?= $stream_url; ?>" type="video/mp4">
                          Désolé... On dirait que vous utilisez un navigateur trop vieux. Utilisez Edge Chromium pour être à jour.
                        </video>
                      <?php } ?>
                        <div class="overlay2">
                          <h2><img src="https://ostream.online/assets/images/logo.png?v=provisoire" style="width: 30px;"> BÊTA</h2>
                        </div>
                     <div>
                       <div class="controls bg-blue-dt">
                         <button class="btn btn-lg btn-video-playpause" type="button" title="Pause/Play">
                            <i class="fa-light fa-play clair"></i>
                            <i class="fa-light fa-play-pause d-none clair"></i>
                          </button>
                          <div class="px-1 w-100">
                            <div class="progress w-100" style="height: 35px;margin-bottom: 0px;">
                                <div class="progress-bar"></div>
                            </div>
                          </div>
                          <button class="btn btn-lg btn-video-pip" title="Image en incrustation">
                            <i class="fa-light fa-down-left-and-up-right-to-center clair"></i>
                          </button>
                          <button class="btn btn-lg btn-video-fullscreen">
                            <i class="fa-light fa-arrows-maximize clair"></i>
                          </button>
                          <div class="dropup">
                            <button class="btn btn-lg btn-video-volume" data-bs-toggle="dropdown" title="Volume">
                                <i class="fa-light fa-volume clair"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end dropup-volume player-dropdown">
                                <input type="range" class="form-range form-range-volume">
                            </div>
                          </div>
                        <!--<div class="dropup">
                            <button class="btn btn-lg" data-bs-toggle="dropdown" title="Autre...">
                                <i class="bi bi-three-dots-vertical"></i>
                                <i class="fa-light fa-ellipsis clair"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end player-dropdown">
                                <span class="dropdown-item player-dropdown" data-bs-toggle="modal" data-bs-target="#informations" style="color:#fff;">
                                    <i class="fa-light fa-ellipsis"></i> Informations
                                </span>
                            </div>
                        </div>-->
                       </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
                  <?php }elseif($streams['launch'] != 0){ ?>
                    <h1><?= $streams['titre']; ?> commence à <?= date('d/m/Y H:i:s',$streams['launch']); ?></h1>
                  <?php } ?>
                    <?php } ?>
                  <?php } ?>
                  <p class="cyberpress-match-participant-title h4">
                    <?=  html_entity_decode($streams['description']); ?>
                  </p>
                  <ul class="cyberpress-match-info">
                    <?php if(!empty($streams['launch']) || $streams['launch'] != "0"){ ?>
                      <li>
                          <a href="#" class="cyberpress-game-inline-link">
                              <i class="fa-solid fa-signal-stream"></i> Lancement : <?= date('d/m/Y H:i:s',$streams['launch']); ?>
                          </a>
                      </li>
                    <?php } ?>
                      <?php if(!empty($streams['end']) || $streams['end'] != "0"){ ?>
                      <li>
                        <a href="#" class="cyberpress-game-inline-link">
                            <i class="fa-solid fa-signal-stream-slash"></i> Fin : <?= date('d/m/Y H:i:s',$streams['end']); ?>
                        </a>
                      </li>
                    <?php } ?>
                  </ul>
                </div>
              <?php } ?>
              <?php } ?>

                <?php if($streams['tags']){ ?>
                  <div class="row vgap-md" style="margin-bottom: 2rem;">
                    <h2>Similaire à <?= $streams['titre']; ?></h2>

                    <?php $tags = explode(",", $streams['tags']); ?>
                    <?php // DEBUT PAIEMENT FONDS
                    $key_tag0 = 0;

                    foreach ($tags as $key => $tag) {
                    $builder0 = $db->table('list');
                    $builder0->where('id !=', $streams['id']);
                    $builder0->like('tags', $tag);
                    $builder0->orderBy('id', 'ASC');
                    $query0 = $builder0->get();
                    foreach ($query0->getResult() as $row) { ?>
                      <div class="col-12 col-sm-6 col-md-4">
                        <a href="<?= base_url('streaming/'.$row->slug); ?>" class="mpl-post-item mpl-post-overlay">
                          <span class="mpl-post-image">
                              <span class="mpl-image">
                                  <img src="<?= $row->image; ?>" alt="">
                              </span>
                          </span>
                          <span class="mpl-post-content">
                              <span class="mpl-post-title h4"><?= $row->titre; ?> <?php if($row->is_premium != "0"){ ?><span class="badge badge-brand">PREMIUM</span><?php } ?></span>
                              <!--<div class="mpl-hexagon-rating mpl-hexagon-rating-small" data-hexagon="0"><span>0</span></div>-->
                          </span>
                        </a>
                      </div>
                    <?php } ?>
                  <?php } ?>
                  </div>
                <?php } ?>

              <?php // DEBUT COUNT
              $builder = $db->table('list');
              $builder->where('id_categorie', $streams['id_categorie']);
              $count_films = $builder->countAllResults(); ?>
              <?php if($count_films != 0){ ?>
                <div class="row vgap-md" style="margin-bottom: 2rem;">
                  <h2>Contenu similaire</h2>
                  <?php // DEBUT PAIEMENT FONDS
                  $builder = $db->table('list');
                  $builder->where('id_categorie', $streams['id_categorie']);
                  $builder->orderBy('id', 'ASC');
                  $builder->limit(9);
                  $query = $builder->get();
                  foreach ($query->getResult() as $row) { ?>
                    <div class="col-12 col-sm-6 col-md-4">
                      <a href="<?= base_url('streaming/'.$row->slug); ?>" class="mpl-post-item mpl-post-overlay">
                        <span class="mpl-post-image">
                            <span class="mpl-image">
                                <img src="<?= $row->image; ?>" alt="">
                            </span>
                        </span>
                        <span class="mpl-post-content">
                            <span class="mpl-post-title h4"><?= $row->titre; ?> <?php if($row->is_premium != "0"){ ?><span class="badge badge-brand">PREMIUM</span><?php } ?></span>
                            <!--<div class="mpl-hexagon-rating mpl-hexagon-rating-small" data-hexagon="0"><span>0</span></div>-->
                        </span>
                      </a>
                    </div>
                  <?php } ?>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<script>
  var player = videojs('live_stream');
  player.one("loadedmetadata", onLoadedMetadata);
  function onLoadedMetadata() {
    oData = new FormData();
    oData.append("duration", player.duration());
    oData.append("quality", player.currentWidth()+"x"+player.currentHeight());
    oData.append("slug", "<?= $streams['slug']; ?>");
    oData.append("categorie", "<?= $streams['id_categorie']; ?>");
    var oReq = new XMLHttpRequest();
    oReq.open("POST", "<?= base_url('api/video/0'); ?>", true);
    oReq.onload = function(oEvent) {
      console.log("VIDEO LANCE !");
      console.log(oReq);
      console.log(oReq.status);
      console.log(oReq.responseText);
    };
    oReq.send(oData);
    }

</script>
