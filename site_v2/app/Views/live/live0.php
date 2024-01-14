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
  $application_video = 'type="video/mp4"';
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
                                      <?= $streams['titre']; ?>  <?php if($streams['is_premium']){ ?><span class="badge badge-primary">STREAM PREMIUM</span><?php } ?><br>
                                      <?= $categories['name']; ?> <?php if($categories['is_premium']){ ?><span class="badge badge-brand">PREMIUM</span><?php } ?>
                                    </h1>
                                    <p class="lead mb-0" data-sr-item="blog-banner" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1.2s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1.2s cubic-bezier(0.5, 0, 0, 1) 0s;">

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <?php if($streams['stream_type'] != "vps"){ ?>

<?php }else{ ?>
  <link href="<?= base_url(); ?>/uploads/assets/videojs/video-js.css" rel="stylesheet">
  <script src='<?= base_url(); ?>/uploads/assets/videojs/video.js'></script>
  <script src="<?= base_url(); ?>/uploads/assets/videojs/videojs-http-streaming.js"></script>
<?php } ?>
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
                <div class="cyberpress-match" style="margin-bottom: 2rem;">
                  <?php if (session('isLoggedIn')) { ?>
                    <?php if($user['premium'] == 1 && $streams['is_premium'] == 1 || $streams['is_premium'] == 0){ ?>
                      <?php if($streams['launch'] < time() || $streams['launch'] == 0){ ?>
                  <video-js id="live_stream" class="vjs-default-skin" controls preload="auto" width="auto" height="auto" data-setup='{"language":"fr"}' style="margin-bottom: 2rem;">
                    <source src="<?= $stream_url; ?>" <?= $application_video; ?> data-setup='{"language":"fr"}'>
                  </video-js>
                  <?php }elseif($streams['launch'] != 0){ ?>
                    <h1><?= $streams['titre']; ?> commence à <?= date('d/m/Y H:i:s',$streams['launch']); ?></h1>
                  <?php } ?>
                    <?php } ?>
                  <?php } ?>
                  <p class="cyberpress-match-participant-title h4">
                    <?= $streams['description']; ?>
                  </p>
                  <ul class="cyberpress-match-info">
                    <?php if($streams['launch'] || $streams['launch'] != 0){ ?>
                      <li>
                          <a href="#" class="cyberpress-game-inline-link">
                              <i class="fa-solid fa-signal-stream"></i> Lancement : <?= date('d/m/Y H:i:s',$streams['launch']); ?>
                          </a>
                      </li>
                    <?php } ?>
                      <?php if($streams['end']){ ?>
                      <li>
                        <a href="#" class="cyberpress-game-inline-link">
                            <i class="fa-solid fa-signal-stream-slash"></i> Fin : <?= date('d/m/Y H:i:s',$streams['end']); ?>
                        </a>
                      </li>
                    <?php } ?>
                  </ul>
                </div>

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
                              <span class="mpl-post-title h4"><?= $row->titre; ?> <?php if($row->is_premium){ ?><span class="badge badge-brand">PREMIUM</span><?php } ?></span>
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
                            <span class="mpl-post-title h4"><?= $row->titre; ?> <?php if($row->is_premium){ ?><span class="badge badge-brand">PREMIUM</span><?php } ?></span>
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
