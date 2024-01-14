<?php if($permissions['admin'] != 1){
return redirect()->to(base_url('/settings'))->withInput()->with('error', lang('Language.error__page_not_found'));
} ?>
<style>
@font-face {
  font-family: 'DevTimeSansEVO';
  src: url('https://dev-time.eu/uploads/cdn/DevTimeSans-Bold_5.eot');
  src: url('https://dev-time.eu/uploads/cdn/DevTimeSans-Bold_5.eot?#iefix') format('embedded-opentype'),
       url('https://dev-time.eu/uploads/cdn/DevTimeSans-Bold_5.woff2') format('woff2'),
       url('https://dev-time.eu/uploads/cdn/DevTimeSans-Bold_5.ttf') format('truetype');
  font-weight: normal;
  font-style: normal;
}

@font-face {
  font-family: 'DevTimeSansEVO-Medium';
  src: url('https://dev-time.eu/uploads/cdn/DevTimeSansEVO-Medium.svg#DevTimeSansEVO-Medium') format('svg'),
       url('https://dev-time.eu/uploads/cdn/DevTimeSansEVO-Medium.woff') format('woff');
  font-weight: normal;
  font-style: normal;
}
</style>
<?php
$db = \Config\Database::connect();
$request = \Config\Services::request(); ?>
<?php if(empty($request->GetGet('date'))){
	$date = date('Y').'-'.date('m').'-'.date('d');
}else{
	$date = $request->GetGet('date'); //date('Y').'-'.date('m').'-'.date('d')
}
$builder__counts_downloads = $db->table('2020__downloads');
$builder__counts_downloads->like('date', $date);
$devtime_protector_count = $builder__counts_downloads->countAllResults();

$builder__counts_downloads_total = $db->table('2020__downloads');
$devtime_protector_count_total = $builder__counts_downloads_total->countAllResults();

$builder__counts_downloads_total_uniques = $db->table('2020__downloads');
$builder__counts_downloads_total_uniques->distinct();
$builder__counts_downloads_total_uniques->select('ip');
$devtime_protector_count_total_uniques = $builder__counts_downloads_total_uniques->countAllResults();

$builder__counts_user = $db->table('user');
$builder__counts_user->like('date', $date);
$devtime_user_count = $builder__counts_user->countAllResults();
$builder__counts_user_total = $db->table('user');
$devtime_user_count_total = $builder__counts_user_total->countAllResults();

$builder__counts_invoices = $db->table('invoice');
$builder__counts_invoices->like('date', $date);
$invoices_count_today = $builder__counts_invoices->countAllResults();
$builder__counts_invoices_total = $db->table('invoice');
$invoices_count_total = $builder__counts_invoices_total->countAllResults();

$builder__counts_downloads_uniques = $db->table('2020__downloads');
$builder__counts_downloads_uniques->distinct();
$builder__counts_downloads_uniques->select('ip');
$builder__counts_downloads_uniques->like('date', $date);
$count_uniques_downloads = $builder__counts_downloads_uniques->countAllResults();

$builder__counts_visites_uniques = $db->table('views');
$builder__counts_visites_uniques->distinct();
$builder__counts_visites_uniques->select('ip');
$builder__counts_visites_uniques->like('date', $date);
$count_uniques_visites = $builder__counts_visites_uniques->countAllResults();

$builder__count_total_visites = $db->table('views');
$count_total_visites = $builder__count_total_visites->countAllResults();

$builder__count_total_visites->like('date', $date);
$count_total_visites_today = $builder__count_total_visites->countAllResults();

$builder_views_year = $db->table('views');
$builder_views_year->where('annee', "2019");
$count_2019 = $builder_views_year->countAllResults();
$builder_views_year->where('annee', "2020");
$count_2020 = $builder_views_year->countAllResults();
$builder_views_year->where('annee', "2021");
$count_2021 = $builder_views_year->countAllResults();

$builder_users_year = $db->table('user');
$builder_users_year->like('date', '2019');
$count_users_2019 = $builder_users_year->countAllResults();
$builder_users_year->like('date', '2020');
$count_users_2020 = $builder_users_year->countAllResults();
$builder_users_year->like('date', '2021');
$count_users_2021 = $builder_users_year->countAllResults();



// Image canvas
if(empty($request->GetGet('year'))){
	$year = date('Y');
}else{
	$year = $request->GetGet('year');
}
$builder_users_year->like('date', $year);
$count_users_current_year = $builder_users_year->countAllResults();
$builder_views_year->like('date', $year);
$count_views_current_year = $builder_views_year->countAllResults();

$count_likes_current_year0 = $db->table('posts_likes');
$count_likes_current_year0->like('date', $year);
$count_likes_current_year = $count_likes_current_year0->countAllResults();

$count_posts_current_year0 = $db->table('posts');
$count_posts_current_year0->like('date', $year);
$count_posts_current_year = $count_posts_current_year0->countAllResults();

$count_comments_current_year0 = $db->table('posts_comment');
$count_comments_current_year0->like('date', $year);
$count_comments_current_year = $count_comments_current_year0->countAllResults();

$count_follow_current_year0 = $db->table('follow');
$count_follow_current_year0->like('date', $year);
$count_follow_current_year = $count_follow_current_year0->countAllResults();

$builder__views_uniques_year = $db->table('views');
$builder__views_uniques_year->distinct();
$builder__views_uniques_year->select('ip');
$builder__views_uniques_year->like('date', $year);
$count_uniques_views_current_year = $builder__views_uniques_year->countAllResults();

$builder__views_non_uniques_year = $db->table('views');
$builder__views_non_uniques_year->like('date', $year);
$count_views_current_year = $builder__views_non_uniques_year->countAllResults();
?>
<main>
    <div class="container-fluid site-width">
        <!-- START: Breadcrumbs-->
        <div class="row">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Dev-Time 8.0</h4> <p>Bienvenue sur le nouveau panel !</p></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="#">Dev-Time Administration</a></li>
                        <li class="breadcrumb-item active">Stats des visites</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 col-lg-12  mt-3">
                <div class="row">
									<div class="col-12 col-lg-12">
											<div class="row">
								     	    <div class="col-12 col-sm-9">
											     <form method="GET">
								     		  	<div class="row">
								     					<input type="date" class="form-control" name="date" placeholder="Date" value="<?= $date ;?>">
								     		  	</div>
								     		  </div>
								     	  	<div class="col-12 col-sm-3">
								     	  		<div class="row">
								     					<button type="submit" class="btn btn-info" style="width: 100%;">Voir les stats</button>
								     	  		</div>
									     	   </form>
								     	  	</div>
							    		</div>
							    	</div>
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12 col-sm-6 mt-3">
                                <div class="card bg-primary">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <i class="icon-basket icons card-liner-icon mt-2 text-white"></i>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title text-white"><?= $count_uniques_downloads; ?></h2>
                                                <h6 class="card-liner-subtitle text-white">Dev-Time Protector</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <i class="icon-user icons card-liner-icon mt-2"></i>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title"><?= $devtime_user_count; ?></h2>
                                                <h6 class="card-liner-subtitle">nouveaux membres</h6>
                                            </div>
                                        </div>
                                        <span class="bg-primary card-liner-absolute-icon text-white card-liner-small-tip">+4.8%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6  mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <i class="icon-bag icons card-liner-icon mt-2"></i>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title"><?= $invoices_count_today; ?></h2>
                                                <h6 class="card-liner-subtitle">Factures</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <span class="card-liner-icon mt-1">?</span>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title"><?= $count_uniques_visites; ?></h2>
                                                <h6 class="card-liner-subtitle">Visiteurs uniques</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <span class="card-liner-icon mt-1">?</span>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title"><?= $count_total_visites; ?></h2>
                                                <h6 class="card-liner-subtitle">Visiteurs totales</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <span class="card-liner-icon mt-1">/</span>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title"><?= $count_total_visites_today; ?></h2>
                                                <h6 class="card-liner-subtitle">Visiteurs du <?= $date; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
														<div class="col-12 col-sm-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <span class="card-liner-icon mt-1">?</span>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title"><?= $count_2021; ?></h2>
                                                <h6 class="card-liner-subtitle">Visiteurs en 2021</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
														<div class="col-12 col-sm-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <span class="card-liner-icon mt-1">?</span>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title"><?= $count_2020; ?></h2>
                                                <h6 class="card-liner-subtitle">Visiteurs en 2020</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <span class="card-liner-icon mt-1">?</span>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title"><?= $count_2019; ?></h2>
                                                <h6 class="card-liner-subtitle">Visiteurs en 2019</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

														<div class="col-12 col-sm-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <span class="card-liner-icon mt-1">?</span>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title"><?= $count_users_2021; ?></h2>
                                                <h6 class="card-liner-subtitle">Membres en 2021</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
														<div class="col-12 col-sm-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <span class="card-liner-icon mt-1">?</span>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title"><?= $count_users_2020; ?></h2>
                                                <h6 class="card-liner-subtitle">Membres en 2020</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <span class="card-liner-icon mt-1">/</span>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title"><?= $count_users_2019; ?></h2>
                                                <h6 class="card-liner-subtitle">Membres en 2019</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mt-3">
                        <div class="card">
													<div class="card-header  justify-content-between align-items-center">
										  			<h6 class="card-title">Visites par pays du <?= $date; ?></h6>
													</div>
                            <div class="card-content">
                                <div class="card-body">

                                    <div id="devtime__best_country2" class="height-500"></div>
                                </div>
                            </div>
                        </div>
                    </div>

										<div class="col-12 col-lg-12 mt-3">
                        <div class="card">
													<div class="card-header  justify-content-between align-items-center">
										  			<h6 class="card-title">Statistiques de l'année en image</h6>
													</div>
                            <div class="card-content">
                                <div class="card-body">
									              	<canvas id="canvas" width="1920px" height="1080px" style="width: 100%;"></canvas>
									              	<div style="display:none;">
									              			<img id="source" src="https://statics.dev-time.eu/Dev-Time/devtime__generator_stats_image.png">
									              	</div>
									              	<script>
									              			var canvas = document.getElementById("canvas");

									              			var ctx = canvas.getContext("2d");
									              			var image = document.getElementById("source");

									              			ctx.drawImage(image, 0, 0, 1920, 1080);

									              			ctx.font = "50px DevTimeSansEVO";
									              			const name0 = "Text";
									              			const name = name0.length > 13 ? name0.substring(0, 13) + '...': name0;
																			ctx.fillStyle = "#2299f8";
																			ctx.textAlign = "center";
									              			ctx.fillText(<?= $count_uniques_views_current_year; ?>, 555, 470);
																			ctx.textAlign = "center";
									              			ctx.fillText(<?= $count_users_current_year; ?>, 997, 470);
																			ctx.textAlign = "center";
									              			ctx.fillText(<?= $count_views_current_year; ?>, 1415, 470);
																			ctx.textAlign = "center";

									              			ctx.fillText(<?= $count_posts_current_year; ?>, 400, 710);
																			ctx.textAlign = "center";
									              			ctx.fillText(<?= $count_comments_current_year; ?>, 750, 710);
																			ctx.textAlign = "center";
									              			ctx.fillText(<?= $count_likes_current_year; ?>, 1130, 710);
																			ctx.textAlign = "center";
									              			ctx.fillText(<?= $count_follow_current_year; ?>, 1500, 710);

																			ctx.font = "25px DevTimeSansEVO";
																			ctx.textAlign = "start";
																			ctx.fillStyle = "#ffffff";
									              			ctx.fillText("Ces statistiques proviennent de l'année <?= $year; ?>.", 250, 1040);
										              </script>
																</div>
														</div>
												</div>
										</div>

                </div>
            </div>

        </div>
        <!-- END: Card DATA-->
    </div>
</main>
