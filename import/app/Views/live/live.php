<?php $db = \Config\Database::connect();
$request = \Config\Services::request(); ?>

<style>
#live_stream_html5_api {
  position: relative;
  display: block;
}
#live_stream_html5_api video {
  width: 100%;
  height: auto;
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
  border-bottom-left-radius: 15px;
  border-bottom-right-radius: 15px;

}
.overlay2 {
  display: flex;
  position: absolute;
  top: 78px;
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
</style>
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
$live = false;
$spectateurs = 0;
if($streams['stream_type'] === "vps"){
$url_stats_live = 'https://'.$vps_ip.'/stat';
$html_stats_live = file_get_html($url_stats_live);
if($html_stats_live != ""){ ?>
<?php $infos__live0 = $html_stats_live->find('application');
foreach($infos__live0 as $data1_info_live) { ?>
  <?php
  if (str_contains($data1_info_live, '<name>live</name>') !== FALSE) {
    $data1_info_live2 = $data1_info_live->find('stream');
    foreach($data1_info_live2 as $stream_infos) { ?>
      <?php if($stream_infos->find('name', 0)->plaintext == $streams['stream_url']){
        $spectateurs = $stream_infos->find('nclients', 0)->plaintext;
        $live = true;
        $duration = $stream_infos->find('time', 0)->plaintext;
        $bw_in = $stream_infos->find('bw_in', 0)->plaintext;
        $bytes_in = $stream_infos->find('bytes_in', 0)->plaintext;
        $bw_out = $stream_infos->find('bw_out', 0)->plaintext;
        $bytes_out = $stream_infos->find('bytes_out', 0)->plaintext;
        $bw_audio = $stream_infos->find('bw_audio', 0)->plaintext;
        $bw_video = $stream_infos->find('bw_video', 0)->plaintext;
        $meta_live = $stream_infos->find('meta');
        foreach($meta_live as $meta_live1) {
        $meta_live_video1 = $meta_live1->find('video');
          foreach($meta_live_video1 as $meta_live_video) {
            $width_live = $meta_live_video->find('width', 0)->plaintext;
            $height_live = $meta_live_video->find('height', 0)->plaintext;
            $frame_rate = $meta_live_video->find('frame_rate', 0)->plaintext;
            $codec = $meta_live_video->find('codec', 0)->plaintext;
            $profile = $meta_live_video->find('profile', 0)->plaintext;
            $compat = $meta_live_video->find('compat', 0)->plaintext;
            $level = $meta_live_video->find('level', 0)->plaintext;
          }
        }
      }
    }
  }else{
  }
}
}
} ?>


<!-- owl-carousel Banner Start -->
    <section class="pt-0 pb-0">
        <div class="container-fluid px-0">
            <div class="row no-gutters">
                <div class="col-12">
                    <div class="gen-banner-movies banner-style-3">
                        <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true"
                            data-desk_num="1" data-lap_num="1" data-tab_num="1" data-mob_num="1" data-mob_sm="1"
                            data-autoplay="true" data-loop="true" data-margin="0">
                            <div class="item" style="background: url('<?= $streams['image']; ?>')">
                                <div class="gen-movie-contain-style-3 h-100">
                                    <div class="container h-100">
                                        <div class="row justify-content-center h-100">
                                            <div class="col-xl-6" style="z-index: 10;">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    class="playBut">
                                                    <!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In  -->
                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                        width="213.7px" height="213.7px" viewBox="0 0 213.7 213.7"
                                                        enable-background="new 0 0 213.7 213.7" xml:space="preserve">
                                                        <polygon class="triangle" id="XMLID_18_" fill="none"
                                                            stroke-width="7" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-miterlimit="10" points="
                                                     73.5,62.5 148.5,105.8 73.5,149.1 "></polygon>
                                                        <circle class="circle" id="XMLID_17_" fill="none"
                                                            stroke-width="7" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-miterlimit="10" cx="106.8"
                                                            cy="106.8" r="103.3"></circle>
                                                    </svg>
                                                    <span>Regarder</span>
                                                </a>
                                                <div class="gen-movie-info">
                                                    <h3><?= $streams['titre']; ?></h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul class="gen-meta-after-title">
                                                      <?php if(!empty($streams['launch']) || $streams['launch'] != "0"){ ?>
                                                        <li><i class="fa-solid fa-signal-stream"></i> Lancement : <?= date('d/m/Y H:i:s',$streams['launch']); ?></li>
                                                      <?php } ?>
                                                        <?php if(!empty($streams['end']) || $streams['end'] != "0"){ ?>
                                                        <li><i class="fa-solid fa-signal-stream-slash"></i> Fin : <?= date('d/m/Y H:i:s',$streams['end']); ?></li>
                                                      <?php } ?>
                                                        <?php if($streams['is_premium'] != "0"){?>
                                                        <li>
                                                            <a href="<?= base_url('premium'); ?>"><span>Stream Premium</span></a>
                                                        </li>
                                                      <?php } ?>
                                                      <?php if($categories['is_premium'] != "0"){?>
                                                      <li>
                                                          <a href="<?= base_url('premium'); ?>"><span>Catégorie Premium</span></a>
                                                      </li>
                                                      <?php } ?>
                                                      <?php if($live){ ?>
                                                        <li>
                                                            <i class="fas fa-eye"></i>
                                                            <span><?= $spectateurs; ?> Spectateurs</span>
                                                        </li>
                                                      <?php } ?>
                                                    </ul>
                                                    <p><?=  html_entity_decode($streams['description']); ?></p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Single-tv-Shows -->
    <?php if(!empty($categories['serie_name'])){ ?>
    <section class="position-relative gen-section-padding-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="gen-tv-show-wrapper style-1">

                      <div class="gen-season-holder">
                          <ul class="nav">
                            <?php
                            $builder = $db->table('categories');
                            $builder->where('serie_name', $categories['serie_name']);
                            $builder->orderBy('id', 'ASC');
                            $query = $builder->get();
                            foreach ($query->getResult() as $key => $row) { ?>
                              <li class="nav-item">
                                  <a class="nav-link <?php if($key === 0){ ?>active show<?php } ?>" data-bs-toggle="tab" data-bs-target="#season_<?= $key; ?>" href="#season_<?= $key; ?>">Saison <?= $row->id_season; ?></a>
                              </li>
                            <?php } ?>
                          </ul>
                          <div class="tab-content">
                            <?php
                            $builder = $db->table('categories');
                            $builder->where('serie_name', $categories['serie_name']);
                            $builder->orderBy('id', 'ASC');
                            $query = $builder->get();
                            foreach ($query->getResult() as $key => $row0) { ?>
                              <div id="season_<?= $key; ?>" class="tab-pane <?php if($key === 0){ ?>active show<?php } ?>">
                                  <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true"
                                      data-desk_num="4" data-lap_num="3" data-tab_num="2" data-mob_num="1"
                                      data-mob_sm="1" data-autoplay="false" data-loop="false" data-margin="30">

                                      <?php
                                      $builder2 = $db->table('list');
                                      $builder2->where('season_id', $row0->id);
                                      $builder2->orderBy('id', 'ASC');
                                      $query2 = $builder2->get();
                                      foreach ($query2->getResult() as $key_episode => $row) { ?>
                                      <div class="item">
                                          <div class="gen-episode-contain">
                                              <div class="gen-episode-img">
                                                  <img src="<?= $row->image; ?>" alt="stream-lab-image">
                                                  <div class="gen-movie-action">
                                                      <a href="<?= base_url('live/'.$row->slug); ?>" class="gen-button">
                                                          <i class="fa fa-play"></i>
                                                      </a>
                                                  </div>
                                              </div>
                                              <div class="gen-info-contain">
                                                  <div class="gen-episode-info">
                                                      <h3>
                                                          S<?= $key+1; ?>E<?= $key_episode+1; ?> <span>-</span>
                                                          <a href="#">
                                                              <?= $row->titre; ?>
                                                          </a>
                                                      </h3>
                                                  </div>
                                                  <div class="gen-single-meta-holder">
                                                      <ul>
                                                          <li class="run-time"></li>
                                                          <?php if($row->is_premium != "0"){ ?>
                                                          <li class="release-date">
                                                            Premium
                                                          </li>
                                                          <?php } ?>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <?php } ?>

                                  </div>
                              </div>
                              <?php } ?>

                          </div>
                      </div>

                    </siv>
                </div>
            </div>
        </div>
    </section>
    <!-- owl-carousel Banner End -->
  <?php } ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen gen-footer">
    <div class="modal-content" style="background: var(--black-color);">
      <div class="modal-body" style="background: url('<?= $categories['image']; ?>');background-repeat: no-repeat;background-size: cover;">
        <div class="row justify-content-center" style="padding-bottom: 25px;">
          <div class="col-md-8">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $streams['titre']; ?></h1>
            <i style="float:right;margin-top: -25px;" data-bs-dismiss="modal" class="fa-light fa-xmark fa-2x"></i>
          </div>
        </div>
        <?php if (session('isLoggedIn')) { ?>
          <?php if($user['premium'] != 0 && $streams['is_premium'] == 1 || $streams['is_premium'] == 0){ ?>
            <?php if($streams['launch'] < time()){ ?>
              <?php if($streams['stream_type'] === "vps"){ // SI VP ?>
                <link href="<?= base_url(); ?>/uploads/assets/videojs/video-js.css" rel="stylesheet">
                <script src='<?= base_url(); ?>/uploads/assets/videojs/video.js'></script>
                <script src="<?= base_url(); ?>/uploads/assets/videojs/videojs-http-streaming.js"></script>
                <div class="row justify-content-center">
                  <div class="col-md-8">
                   <video-js id="live_stream" class="vjs-default-skin vjs-big-play-centered" controls preload="auto" width="auto" height="auto" data-setup='{"language":"fr"}' style="margin-bottom: 2rem;">
                     <source src="<?= $stream_url; ?>" <?= $application_video; ?> data-setup='{"language":"fr"}'>
                   </video-js>
                   <div class="overlay2">
                     <h2><img src="https://ostream.online/assets/images/logo.png?v=provisoire" style="width: 30px;"> LIVE</h2>
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
                 </div>
               </div>
              <?php }else{ // SI URL CLASSIQUE ?>

      <style>
      .video-js .vjs-control-bar {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
}
      </style>
      <link href="<?= base_url(); ?>/uploads/assets/videojs/video-js.css" rel="stylesheet">

      <script src='<?= base_url(); ?>/uploads/assets/videojs/video.js'></script>
      <script src="<?= base_url(); ?>/uploads/assets/videojs/videojs-http-streaming.js"></script>

      <!-- Brightcove DVRUX plugin -->
  <link href="//players.brightcove.net/videojs-live-dvrux/1/videojs-live-dvrux.min.css" rel="stylesheet">
  <script src="//players.brightcove.net/videojs-live-dvrux/1/videojs-live-dvrux.min.js"></script>

      <!-- Brightcove quality picker -->
    <link href="//players.brightcove.net/videojs-quality-menu/1/videojs-quality-menu.css" rel="stylesheet">
    <script src="//players.brightcove.net/videojs-quality-menu/1/videojs-quality-menu.min.js"></script>

    <script src="https://cdn.streamroot.io/videojs-hlsjs-plugin/1/stable/videojs-hlsjs-plugin.js"></script>

      <div class="row justify-content-center">
        <div class="col-md-8" id="videoArea">
         <video-js id="live_stream" class="vjs-default-skin vjs-big-play-centered" controls preload="auto" width="auto" height="auto" data-setup='{"language":"fr"}' style="margin-bottom: 2rem;">
           <source src="<?= $stream_url; ?>" type="video/mp4" codecs='"a_ac3, avc"' data-setup='{"language":"fr"}'>
         </video-js>
         <div class="overlay2">
           <h2><img src="https://ostream.online/assets/images/logo.png?v=provisoire" style="width: 30px;"> BÊTA</h2>
         </div>
         <!-- NEW -->

         <script>

         var options = {
            plugins: {
                // JSON config added by Brightcove player generator
                streamrootHls: {
                    hlsjsConfig: {
                        // Your Hls.js config
                    },
                    // captionConfig: {
                    //     line: -1,
                    //     align: 'center',
                    //     position: 50,
                    //     size: 40,
                    // }
                },
                qualityMenu: {
                    useResolutionLabels: true
                }
            }
        };

         var player = videojs('live_stream', options);
         player.qualityMenu();
         player.dvrux();

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

var videoArea = document.getElementById('videoArea');
videoArea.onkeydown = function() {
var myPlayer = player;
var currentTime = myPlayer.currentTime();
var volume = myPlayer.volume();
var e = window.event;
switch (window.event.keyCode) {
case 37:
  myPlayer.currentTime(currentTime - 5);
  break;
case 38:
myPlayer.volume(volume + 0.1);
break;
case 39:
  myPlayer.currentTime(currentTime + 5);
  break;
case 40:
myPlayer.volume(volume - 0.1);
e.preventDefault();
break;
case 32:
if (myPlayer.paused()) {
  e.preventDefault();
  myPlayer.play();
  break;
} else {
  e.preventDefault();
  myPlayer.pause();
  break;
}
}
};
</script>
      <?php } ?>
        <?php }elseif($streams['launch'] != 0){ ?>
          <h1><?= $streams['titre']; ?> commence à <?= date('d/m/Y H:i:s',$streams['launch']); ?></h1>
        <?php } ?>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
</div>
</div>
