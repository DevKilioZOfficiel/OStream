<?php if($type == "90*728"){ ?>
<div id="67413-1"><script src="//ads.themoneytizer.com/s/gen.js?type=1"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=67413&formatId=1"></script></div>
<?php } ?>
<?php if($type == "90*728_bas"){ ?>
<div id="67413-28"><script src="//ads.themoneytizer.com/s/gen.js?type=28"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=67413&formatId=28"></script></div>
<?php } ?>
<?php if($type == "in_image"){ ?>
<div id="67413-30"><script src="//ads.themoneytizer.com/s/gen.js?type=30"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=67413&formatId=30"></script></div>
<?php } ?>
<?php if($type == "300*600"){ ?>
<div id="67413-3"><script src="//ads.themoneytizer.com/s/gen.js?type=3"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=67413&formatId=3"></script></div>
<?php } ?>
<?php if($type == "video0"){ ?>

<script src="https://cdn.fluidplayer.com/v3/current/fluidplayer.min.js"></script>
<video id="video-id"><source src="https://i.razicord.com/images/demo.mp4" type="video/mp4" />
<script>
    var myFP = fluidPlayer(
        'video-id',	{
	"layoutControls": {
		"controlBar": {
			"autoHideTimeout": 3,
			"animated": true,
			"autoHide": true
		},
		"htmlOnPauseBlock": {
			"html": "",
			"height": null,
			"width": null
		},
		"autoPlay": false,
		"mute": true,
		"allowTheatre": true,
		"playPauseAnimation": true,
		"playbackRateEnabled": true,
		"allowDownload": false,
		"playButtonShowing": true,
		"fillToContainer": false,
		"posterImage": ""
	},
	"vastOptions": {
		"adList": [
			{
				"roll": "preRoll",
				"vastTag": "https://www.videosprofitnetwork.com/watch.xml?key=5d8b4caa5a9887bb463cad384dffe6c5",
				"adText": ""
			},
			{
				"roll": "midRoll",
				"vastTag": "https://www.videosprofitnetwork.com/watch.xml?key=5d8b4caa5a9887bb463cad384dffe6c5",
				"adText": ""
			},
			{
				"roll": "postRoll",
				"vastTag": "https://www.videosprofitnetwork.com/watch.xml?key=5d8b4caa5a9887bb463cad384dffe6c5",
				"adText": ""
			},
			{
				"roll": "onPauseRoll",
				"vastTag": "https://www.videosprofitnetwork.com/watch.xml?key=5d8b4caa5a9887bb463cad384dffe6c5",
				"adText": ""
			}
		],
		"adCTAText": "PUB",
		"adCTATextPosition": "left"
	}
});
</script>
<?php } ?>
<?php if($type == "video"){ ?>
  <link href="http://vjs.zencdn.net/4.7.1/video-js.css" rel="stylesheet">
  <link href="<?= base_url('uploads/videojs/ads'); ?>/lib/videojs-contrib-ads/videojs.ads.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url('uploads/videojs/ads'); ?>/videojs.vast.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    .description {
      background-color:#eee;
      border: 1px solid #777;
      padding: 10px;
      font-size: .8em;
      line-height: 1.5em;
      font-family: Verdana, sans-serif;
    }
    .example-video-container {
      display: inline-block;
    }
  </style>
  <!--[if lt IE 9]><script src="lib/es5.js"></script><![endif]-->
  <script src="http://vjs.zencdn.net/4.7.1/video.js"></script>
  <script src="<?= base_url('uploads/videojs/ads'); ?>/lib/videojs-contrib-ads/videojs.ads.js"></script>

  <script src="<?= base_url('uploads/videojs/ads'); ?>/lib/vast-client.js"></script>
  <script src="<?= base_url('uploads/videojs/ads'); ?>/videojs.vast.js"></script>

  <video id="vid1" class="video-js vjs-default-skin" autoplay controls autoplay="true" muted="muted" preload="auto"
        poster="https://i.razicord.com/images/razicord_fond.jpg"
        data-setup='{}'
        width='640'
        height='400'
        >
      <source src="https://i.razicord.com/images/demo.mp4" type='video/mp4'>
      <p>Video Playback Not Supported</p>
    </video>
  <script>
    var vid1 = videojs('vid1');
    vid1.play(true);
    vid1.muted(true);
    vid1.ads();
    vid1.vast({
      url: 'https://www.videosprofitnetwork.com/watch.xml?key=5d8b4caa5a9887bb463cad384dffe6c5'
    });
  </script>
<?php } ?>
<?php if($type == "video2"){ ?>
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
          <video class="video" id="video" src="https://www.videosprofitnetwork.com/watch.xml?key=5d8b4caa5a9887bb463cad384dffe6c5" controlsList="nodownload">Désolé... On dirait que vous utilisez un navigateur trop vieux. Utilisez Edge Chromium pour être à jour.</video>
          <div class="overlay2">
            <h2><img src="https://razicord.com/uploads/assets/img/logo_slim.png" style="width: 30px;"> Publicité</h2>
          </div>
       <div>
       <div class="controls bg-blue-dt">
          <button class="btn btn-lg btn-video-playpause" type="button" title="Pause/Play">
              <i class="fa-light fa-play clair"></i>
              <i class="fa-light fa-play-pause d-none clair"></i>
          </button>
          <div class="px-1 w-100">
              <div class="progress w-100">
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
          <div class="dropup">
              <button class="btn btn-lg" data-bs-toggle="dropdown" title="Autre...">
                  <!--<i class="bi bi-three-dots-vertical"></i>-->
                  <i class="fa-light fa-ellipsis clair"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end player-dropdown">
                  <span class="dropdown-item player-dropdown" data-bs-toggle="modal" data-bs-target="#informations" style="color:#fff;">
                      <i class="fa-light fa-ellipsis"></i> Informations
                  </span>
              </div>
          </div>
       </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="informations" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">A propos de la vidéo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <script>
        setInterval(function() {
          var vid = document.querySelector('video');
          if ( vid.readyState === 4 ) {
              console.log("ReadyState: "+vid.readyState);
              var hours = Math.floor(vid.currentTime / 3600);
              var minutes = Math.floor(vid.currentTime % 3600 / 60);
              var seconds = Math.floor(vid.currentTime % 3600 % 60);
              var hourValue;
              var minuteValue;
              var secondValue;

              if (hours < 0) {
                hourValue = '';
              } else if (hours < 10) {
                hourValue = '0' + hours+':';
              } else {
                hourValue = hours2+':';
              }
              if (minutes < 10) {
                minuteValue = '0' + minutes;
              } else {
                minuteValue = minutes;
              }
              if (minutes < 10) {
                minuteValue = '0' + minutes;
              } else {
                minuteValue = minutes;
              }

              if (seconds < 10) {
                secondValue = '0' + seconds;
              } else {
                secondValue = seconds;
              }

              var hours2 = Math.floor(vid.duration / 3600);
              var minutes2 = Math.floor(vid.duration % 3600 / 60);
              var seconds2 = Math.floor(vid.duration % 3600 % 60);
              var hourValue2;
              var minuteValue2;
              var secondValue2;

              if (hours2 < 0) {
                hourValue2 = '';
              } else if (hours2 < 10) {
                hourValue2 = '0' + hours2+':';
              } else {
                hourValue2 = hours2+':';
              }
              if (minutes2 < 10) {
                minuteValue2 = '0' + minutes2;
              } else {
                minuteValue2 = minutes2;
              }
              if (minutes2 < 10) {
                minuteValue2 = '0' + minutes2;
              } else {
                minuteValue2 = minutes2;
              }

              if (seconds2 < 10) {
                secondValue2 = '0' + seconds2;
              } else {
                secondValue2 = seconds2;
              }


            document.getElementById('duration').innerHTML = hourValue+""+minuteValue+":"+secondValue+"/"+hourValue2+""+minuteValue2+":"+secondValue2+"";
            console.log("ReadyState: "+vid.readyState);
          }else{
            console.log("ReadyState: "+vid.readyState);
          }
        }, 1000);
        var getJSON = function(url, callback) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);

            xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
            xhr.setRequestHeader("Access-Control-Allow-Methods", "GET,HEAD,OPTIONS,POST,PUT");
            xhr.setRequestHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, x-client-key, x-client-token, x-client-secret, Authorization");

            xhr.responseType = 'json';
            xhr.onload = function() {
              var status = xhr.status;
              if (status === 200) {
                callback(null, xhr.response);
              } else {
                callback(status, xhr.response);
              }
            };
            xhr.send();
        };

        getJSON('https://www.videosprofitnetwork.com/watch.xml?key=5d8b4caa5a9887bb463cad384dffe6c5',
        function(err, data) {
          if (err !== null) {
            console.log('Something went wrong: ' + err);
            document.getElementById('auteur').innerHTML = "Erreur...";
            document.getElementById('sizer').innerHTML = "Introuvable...";
          } else {
            console.log('REUSSITE: ' + data);
            document.getElementById('auteur').innerHTML = data.info.author;
            document.getElementById('sizer').innerHTML = data.info.size;
          }
        });
        </script>
        <?php $api_video1 = json_encode("https://www.videosprofitnetwork.com/watch.xml?key=5d8b4caa5a9887bb463cad384dffe6c5");
        $api_video = json_decode($api_video1); ?>
        Durée de la vidéo: <span id="duration"></span><br>
        Auteur de la vidéo: <span id="auteur"></span><br>
        Taille de la vidéo: <span id="sizer"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button class="btn btn-primary">Impossible de télécharger la vidéo</button>
      </div>
    </div>
  </div>
</div>

<?php } ?>
