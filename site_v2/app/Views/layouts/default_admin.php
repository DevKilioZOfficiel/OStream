<?php
$db = \Config\Database::connect(); ?>
<!DOCTYPE html>
<html lang="fr">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
    <meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="ADMIN" />
	<meta property="og:title" content="ADMIN" />
	<meta property="og:description" content="ADMIN" />
	<meta property="og:image" content="<?= base_url('/uploads/assets'); ?>/images/logo.png" />
	<meta name="format-detection" content="telephone=no">
    <title>Administration</title>
    <!-- Favicon icon -->

	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('/uploads/assets'); ?>/images/logo.png">

		 <link href="<?= base_url('/uploads/admin_assets'); ?>/vendor/chartist/css/chartist.min.css" rel="stylesheet" type="text/css"/>

		 <link href="<?= base_url('/uploads/admin_assets'); ?>/vendor/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>

     <link href="<?= base_url('/uploads/admin_assets'); ?>/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

		 <link href="<?= base_url('/uploads/admin_assets'); ?>/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>

		 <link href="<?= base_url('/uploads/admin_assets'); ?>/css/style.css?t=10" rel="stylesheet" type="text/css"/>
     <script src="<?= base_url(); ?>/uploads/assets/fontawesome/all.js?v=6.2.0" type="text/javascript" async></script>
</head>
<body data-typography="poppins" data-theme-version="dark" data-layout="vertical" data-nav-headerbg="color_3" data-headerbg="color_1" data-sidebar-style="full" data-sibebarbg="color_3" data-sidebar-position="fixed" data-header-position="fixed" data-container="wide" direction="ltr" data-primary="color_1">

    <!--*******************
        Preloader start
    ********************-->
    <!--*******************
        Preloader end
    ********************-->

	<!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
		<!--**********************************
	Nav header start
***********************************-->
<div class="nav-header">
	<a href="<?= base_url(); ?>" class="brand-logo">
    <img class="logo-abbr" src="<?= base_url('/uploads/assets'); ?>/images/logo.png">
    <img class="brand-title" src="<?= base_url('/uploads/assets'); ?>/images/logo.png">
	</a>
	<div class="nav-control">
		<div class="hamburger">
			<span class="line"></span><span class="line"></span><span class="line"></span>
		</div>
	</div>
</div>
<!--**********************************
	Nav header end
***********************************-->		<!--**********************************
	Header start
***********************************-->
<div class="header">
	<div class="header-content">
		<nav class="navbar navbar-expand">
			<div class="collapse navbar-collapse justify-content-between">
				<div class="header-left">
					<div class="dashboard_bar">
						OStream
          </div>
				</div>

				<ul class="navbar-nav header-right">
					<!--<li class="nav-item">
						<div class="input-group search-area d-xl-inline-flex d-none">
							<input type="text" class="form-control" placeholder="Rechercher...">
							<div class="input-group-append">
								<button class="input-group-text"><i class="flaticon-381-search-2"></i></button>
							</div>
						</div>
					</li>
					<li class="nav-item dropdown notification_dropdown">
						<a class="nav-link  ai-icon" href="#" role="button" data-bs-toggle="dropdown">
							<svg width="26" height="28" viewBox="0 0 26 28" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9.45251 25.6682C10.0606 27.0357 11.4091 28 13.0006 28C14.5922 28 15.9407 27.0357 16.5488 25.6682C15.4266 25.7231 14.2596 25.76 13.0006 25.76C11.7418 25.76 10.5748 25.7231 9.45251 25.6682Z" fill="#3E4954"/>
								<path d="M25.3531 19.74C23.8769 17.8785 21.3995 14.2195 21.3995 10.64C21.3995 7.09073 19.1192 3.89758 15.7995 2.72382C15.7592 1.21406 14.5183 0 13.0006 0C11.4819 0 10.2421 1.21406 10.2017 2.72382C6.88095 3.89758 4.60064 7.09073 4.60064 10.64C4.60064 14.2207 2.12434 17.8785 0.647062 19.74C0.154273 20.3616 0.00191325 21.1825 0.240515 21.9363C0.473484 22.6721 1.05361 23.2422 1.79282 23.4595C3.08755 23.8415 5.20991 24.2715 8.44676 24.491C9.84785 24.5851 11.3543 24.64 13.0007 24.64C14.646 24.64 16.1524 24.5851 17.5535 24.491C20.7914 24.2715 22.9127 23.8415 24.2085 23.4595C24.9477 23.2422 25.5268 22.6722 25.7597 21.9363C25.9983 21.1825 25.8448 20.3616 25.3531 19.74Z" fill="#3E4954"/>
							</svg>
							<span class="badge light text-white bg-primary rounded-circle">52</span>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<div id="DZ_W_Notification1" class="widget-media dz-scroll p-3 height380">
								<ul class="timeline">
									<li>
										<div class="timeline-panel">
											<div class="media me-2">
												<img alt="image" width="50" src="https://www.gravatar.com/avatar/<?= md5($user['email']); ?>">
											</div>
											<div class="media-body">
												<h6 class="mb-1">Exemple</h6>
												<small class="d-block">29 juillet 2022 - 02:26</small>
											</div>
										</div>
									</li>
									<li>
										<div class="timeline-panel">
											<div class="media me-2 media-info">
												EX
											</div>
											<div class="media-body">
												<h6 class="mb-1">Exemple</h6>
												<small class="d-block">29 juillet 2022 - 02:26</small>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<a class="all-notification" href="#">Voir toutes les notifications <i class="ti-arrow-right"></i></a>
						</div>
					</li>-->
					<li class="nav-item dropdown header-profile">
						<a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
							<img src="https://www.gravatar.com/avatar/<?= md5($user['email']); ?>" width="20" alt=""/>
							<div class="header-info">
								<span class="text-black"><?= $user['pseudo']; ?></span>
								<p class="fs-12 mb-0"><?= $permissions['nom']; ?></p>
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a href="<?= base_url('dashboard'); ?>" class="dropdown-item ai-icon">
								<svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
								<span class="ms-2">Paramètres </span>
							</a>
              <?php if (session('userParrain.id')) { ?>
                <?php $sessionmodel = new \App\Models\SessionModel();
                $user_parrain = $sessionmodel->user(session('userParrain.id')); ?>
              <a href="<?= base_url('dashboard?primaryaccount=true'); ?>" class="dropdown-item ai-icon">
								<svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
								<span class="ms-2">Revenir sur <?= $user_parrain['pseudo']; ?> </span>
							</a>
              <?php } ?>
							<a href="<?= base_url('logout'); ?>" class="dropdown-item ai-icon">
								<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
								<span class="ms-2">Déconnexion </span>
							</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>
<!--**********************************
	Header end ti-comment-alt
***********************************-->        <!--**********************************
	Sidebar start
***********************************-->
<div class="deznav">
	<div class="deznav-scroll">
		<ul class="metismenu" id="menu">
      <li>
        <a class="ai-icon" href="<?= base_url('admincp/index'); ?>" aria-expanded="false">
					<i class="flaticon-381-networking"></i>
					<span class="nav-text">Accueil</span>
				</a>
			</li>
      <li class="has-menu"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="flaticon-381-networking"></i>
					<span class="nav-text">Utilisateurs</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="<?= base_url('admincp/users'); ?>">Liste des utilisateurs</a></li>
					<li><a href="<?= base_url('admincp/permissions'); ?>">Permissions des rôles</a></li>
				</ul>
			</li>
      <li class="has-menu"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="flaticon-381-networking"></i>
					<span class="nav-text">Streaming</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="<?= base_url('admincp/categories'); ?>">Catégories</a></li>
					<li><a href="<?= base_url('admincp/lives'); ?>">Liste des lives</a></li>
					<li><a href="<?= base_url('admincp/films'); ?>">Liste des films</a></li>
					<li><a href="<?= base_url('admincp/series'); ?>">Liste des séries</a></li>
					<li><a href="<?= base_url('admincp/mangas'); ?>">Liste des mangas/animés</a></li>
				</ul>
			</li>
      <li class="has-menu"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="flaticon-381-networking"></i>
					<span class="nav-text">Premium</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="<?= base_url('admincp/premiums'); ?>">Abonnements</a></li>
  				<li><a href="<?= base_url('admincp/codes'); ?>">Codes</a></li>
				</ul>
			</li>
      <li class="has-menu"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="flaticon-381-networking"></i>
					<span class="nav-text">Administration</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="<?= base_url('admincp/maintenance'); ?>">Maintenance</a></li>
				</ul>
			</li>
		</ul>

		<div class="copyright">
			<p><strong>OStream</strong> © 2022 Tous droits réservés</p>
			<p>par Dev-Time</p>
		</div>
	</div>
</div>
<?= view($content); ?>
<div class="footer">
	<div class="copyright">
		<p>Copyright © OStream &amp; Développé par <a href="http://dev-time.eu/" target="_blank">Dev-Time</a> 2022</p>
	</div>
</div>
<!--**********************************
	Footer end
***********************************-->	</div>

			<script src="<?= base_url('/uploads/admin_assets'); ?>/vendor/global/global.min.js"></script>
			<script src="<?= base_url('/uploads/admin_assets'); ?>/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
      <script src="<?= base_url('/uploads/admin_assets'); ?>/vendor/datatables/js/jquery.dataTables.min.js"></script>
			<script src="<?= base_url('/uploads/admin_assets'); ?>/js/plugins-init/datatables.init.js"></script>

			<script src="<?= base_url('/uploads/admin_assets'); ?>/vendor/chart.js/Chart.bundle.min.js"></script>
			<script src="<?= base_url('/uploads/admin_assets'); ?>/vendor/owl-carousel/owl.carousel.js"></script>
			<script src="<?= base_url('/uploads/admin_assets'); ?>/vendor/peity/jquery.peity.min.js"></script>
			<script src="<?= base_url('/uploads/admin_assets'); ?>/js/dashboard/dashboard-1.js"></script>

			<script src="<?= base_url('/uploads/admin_assets'); ?>/js/custom.js"></script>
			<script src="<?= base_url('/uploads/admin_assets'); ?>/js/deznav-init.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>


      <script src="<?= base_url('/arc-sw.js'); ?>"></script>
      <script async src="https://arc.io/widget.min.js#RTqoWeeb"></script>
			<script>
		jQuery(document).ready(function(){
			setTimeout(function() {
				dezSettingsOptions.version = 'dark';
				new dezSettings(dezSettingsOptions);
			},1500)
		});

		function carouselReview(){
			/*  testimonial one function by = owl.carousel.js */
			function checkDirection() {
				var htmlClassName = document.getElementsByTagName('html')[0].getAttribute('class');
				if(htmlClassName == 'rtl') {
					return true;
				} else {
					return false;

				}
			}
			jQuery('.testimonial-one').owlCarousel({
				loop:true,
				autoplay:true,
				margin:15,
				nav:false,
				dots: false,
				left:true,
				rtl: checkDirection(),
				navText: ['', ''],
				responsive:{
					0:{
						items:1
					},
					800:{
						items:2
					},
					991:{
						items:2
					},

					1200:{
						items:2
					},
					1600:{
						items:2
					}
				}
			})
			jQuery('.testimonial-two').owlCarousel({
				loop:true,
				autoplay:true,
				margin:15,
				nav:false,
				dots: true,
				left:true,
				rtl: checkDirection(),
				navText: ['', ''],
				responsive:{
					0:{
						items:1
					},
					600:{
						items:2
					},
					991:{
						items:3
					},

					1200:{
						items:3
					},
					1600:{
						items:4
					}
				}
			})
		}
		jQuery(window).on('load',function(){
			setTimeout(function(){
				carouselReview();
			}, 1000);
		});
	</script>

  <script>

  statistiques("mois");
function statistiques(duration){
  document.getElementById("stats_chart").innerHTML = '&nbsp;';
document.getElementById("stats_chart").innerHTML = '<canvas id="statsChart" class="Vacancy-chart"></canvas>';

	let draw = Chart.controllers.line.__super__.draw; //draw shadow
  const statsChart = document.getElementById("statsChart").getContext('2d');
			//generate gradient
			const statsChart_3gradientStroke1 = statsChart.createLinearGradient(500, 0, 100, 0);
			statsChart_3gradientStroke1.addColorStop(0, "rgba(100, 24, 195, 1)");
			statsChart_3gradientStroke1.addColorStop(1, "rgba(100, 24, 195, 0.5)");

			const statsChart_3gradientStroke2 = statsChart.createLinearGradient(500, 0, 100, 0);
			statsChart_3gradientStroke2.addColorStop(0, "rgba(27, 208, 132, 1)");
			statsChart_3gradientStroke2.addColorStop(1, "rgba(27, 208, 132, 1)");

      const statsChart_3gradientStroke3 = statsChart.createLinearGradient(500, 0, 100, 0);
			statsChart_3gradientStroke3.addColorStop(0, "rgb(255, 66, 77)");
			statsChart_3gradientStroke3.addColorStop(1, "rgb(255, 66, 77)");

			Chart.controllers.line = Chart.controllers.line.extend({
				draw: function () {
					draw.apply(this, arguments);
					let nk = this.chart.chart.ctx;
					let _stroke = nk.stroke;
					nk.stroke = function () {
						nk.save();
						nk.shadowColor = 'rgba(78, 54, 226, .5)';
						nk.shadowBlur = 10;
						nk.shadowOffsetX = 0;
						nk.shadowOffsetY = 0;
						_stroke.apply(this, arguments)
						nk.restore();
					}
				}
			});

      if(duration === "mois"){
        duration_label = [<?php for ($i=1; $i < date('t')+1; $i++) {
          if($i < 10){
            $i = "0".$i;
          }
          if($i === date('t')){
            echo '"'.$i.'/'.date('m').'"';
          }else{
            echo '"'.$i.'/'.date('m').'",';
          }
        } ?>];

        reguliers = [<?php for ($i=1; $i < date('t')+1; $i++) {
          if($i < 10){
            $i = "0".$i;
          }
          $builder = $db->table('views');
          $builder->where('jour', $i);
          $builder->where('mois', date('m'));
          $builder->where('annee', date('Y'));
          $count_regulier = $builder->countAllResults();
          if($i === date('t')){
            echo $count_regulier;
          }else{
            echo $count_regulier.',';
          }
        } ?>];

        uniques = [<?php for ($i=1; $i < date('t')+1; $i++) {
          if($i < 10){
            $i = "0".$i;
          }
          $builder = $db->table('views');
          $builder->select('ip');
          $builder->where('jour', $i);
          $builder->where('mois', date('m'));
          $builder->where('annee', date('Y'));
          $builder->distinct();
          $count_unique = $builder->countAllResults();
          if($i === date('t')){
            echo $count_unique;
          }else{
            echo $count_unique.',';
          }
        } ?>];

        on_live_user = [<?php for ($i_live=1; $i_live < date('t')+1; $i_live++) {
          if($i_live < 10){
            $i_live = "0".$i_live;
          }
          $builder_live = $db->table('views');
          $builder_live->select('url,ip');
          $builder_live->like('url', "%streaming%");
          $builder_live->where('jour', $i_live);
          $builder_live->where('mois', date('m'));
          $builder_live->where('annee', date('Y'));
          $builder_live->distinct();
          $count_unique_stream_live = $builder_live->countAllResults();
          if($i_live === date('t')){
            echo $count_unique_stream_live;
          }else{
            echo $count_unique_stream_live.',';
          }
        } ?>];
      }

      if(duration === "annuel"){
        duration_label = [<?php for ($i=1; $i < 13; $i++) {
          if($i < 10){
            $i = "0".$i;
          }
          if($i === 13){
            echo '"'.$i.'/'.date('Y').'"';
          }else{
            echo '"'.$i.'/'.date('Y').'",';
          }
        } ?>];

        reguliers = [<?php for ($i=1; $i < 13; $i++) {
          if($i < 10){
            $i = "0".$i;
          }
          $builder = $db->table('views');
          $builder->where('mois', $i);
          $builder->where('annee', date('Y'));
          $count_regulier = $builder->countAllResults();
          if($i === 13){
            echo $count_regulier;
          }else{
            echo $count_regulier.',';
          }
        } ?>];

        uniques = [<?php for ($i=1; $i < 13; $i++) {
          if($i < 10){
            $i = "0".$i;
          }
          $builder = $db->table('views');
          $builder->select('ip');
          $builder->where('mois', $i);
          $builder->where('annee', date('Y'));
          $builder->distinct();
          $count_unique = $builder->countAllResults();
          if($i === 13){
            echo $count_unique;
          }else{
            echo $count_unique.',';
          }
        } ?>];

        on_live_user = [<?php for ($i=1; $i < 13; $i++) {
          if($i < 10){
            $i = "0".$i;
          }
          $builder = $db->table('views');
          $builder->select('url,ip');
          $builder->like('url', "%streaming%");
          $builder->where('mois', $i);
          $builder->where('annee', date('Y'));
          $builder->distinct();
          $count_unique_stream = $builder->countAllResults();
          if($i === date('t')){
            echo $count_unique_stream;
          }else{
            echo $count_unique_stream.',';
          }
        } ?>];
      }

			statsChart.height = 20;
  new Chart(statsChart, {
				type: 'line',
				data: {
					defaultFontFamily: 'Poppins',
					labels: duration_label,
					datasets: [
						{
							label: "Visiteurs réguliers",
							data: reguliers,
							borderColor: 'rgba(78, 54, 226, 1)',
							borderWidth: "5",
							pointHoverRadius:10,
							backgroundColor: 'transparent',
							pointBackgroundColor: 'rgba(78, 54, 226, 1)',
						}, {
							label: "Visiteurs uniques",
							data: uniques,
							borderColor: statsChart_3gradientStroke2,
							borderWidth: "5",
							backgroundColor: 'transparent',
							pointHoverRadius:10,
							pointBorderWidth:5,
							pointBorderColor:'rgba(255, 255, 255, 1)',
							pointBackgroundColor: 'rgba(27, 208, 132, 1)'
						}, {
							label: "Dans les streams",
							data: on_live_user,
							borderColor: statsChart_3gradientStroke3,
							borderWidth: "5",
							backgroundColor: 'transparent',
							pointHoverRadius:10,
							pointBorderWidth:5,
							pointBorderColor:'rgba(255, 255, 255, 1)',
							pointBackgroundColor: 'rgb(255, 66, 77)'
						}
					]
				},
				options: {
					legend: false,
					tooltips: {
						mode: 'index',
						intersect: false,
					},
					hover: {
						mode: 'nearest',
						intersect: true
					},
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true,
								min: 0,
								//stepSize: 20,
								padding: 10
							}
						}],
						xAxes: [{
							ticks: {
								padding: 5
							}
						}]
					},
					elements: {
						point: {
							radius: 0
						}
					}
				}
			});
}
      </script>

    <!--**********************************
        Main wrapper end
    ***********************************-->
</body>
</html>
