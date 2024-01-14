<?php
if(!empty($_POST['hier']) && !empty($_POST['aujourdhui'])){
$hier = $_POST['hier'];
$aujourdhui = $_POST['aujourdhui'];
}else{
if(date('d') < 11){
	if(date('d') == 10){
		$hier_date = "09";
	}
	elseif(date('d') == 9){
		$hier_date = "08";
	}
	elseif(date('d') == 8){
		$hier_date = "07";
	}
	elseif(date('d') == 7){
		$hier_date = "06";
	}
	elseif(date('d') == 6){
		$hier_date = "05";
	}
	elseif(date('d') == 5){
		$hier_date = "04";
	}
	elseif(date('d') == 4){
		$hier_date = "03";
	}
	elseif(date('d') == 3){
		$hier_date = "02";
	}elseif(date('d') == 2){
		$hier_date = "01";
	}elseif(date('d') == 1){
		$hier_date = cal_days_in_month(CAL_GREGORIAN, date('m')-1, date('Y'));
	}else{
	$hier_date = date('d')-1;
	}
}
if(date('m') != 1){
	$mois_dernier = date('m')-1;
	$jour_hier = $hier_date;
	$mois_hier = date('m');
	$annee_hier = date('Y');
}else{
	$mois_dernier = 12;
	$jour_hier = $hier_date;
	$mois_hier = date('m');
	$annee_hier = date('Y');
}
$hier = $annee_hier.'-'.$mois_hier.'-'.$jour_hier;
$aujourdhui = date('Y').'-'.date('m').'-'.date('d');
}

$db = \Config\Database::connect();
$builder__count_total_visites = $db->table('views');

$an_dernier = date('Y')-1;
$builder__count_total_visites->like('date', $an_dernier);
$an_dernier = $builder__count_total_visites->countAllResults();
if($an_dernier == 0){
	$an_dernier = 1;
}else{
	$an_dernier = $an_dernier;
}
$builder__count_total_visites->like('date', date('Y'));
$cette_annee = $builder__count_total_visites->countAllResults();
$pourcentage_views_year = round($cette_annee*100/$an_dernier,2);

$builder__count_total_visites->like('date', $hier);
$visites_hier = $builder__count_total_visites->countAllResults();
$builder__count_total_visites->like('date', $aujourdhui);
$visites_today = $builder__count_total_visites->countAllResults();
if($visites_hier == 0){
	$visites_hier0 = 1;
}else{
	$visites_hier0 = $visites_hier;
}
$pourcentage_visites_today = round($visites_today*100/$visites_hier0,2);

$builder__count_total_users = $db->table('user');
$builder__count_total_users->like('date', $aujourdhui);
$users_today = $builder__count_total_users->countAllResults();
$builder__count_total_users->like('date', $hier);
$users_hier = $builder__count_total_users->countAllResults();
if($users_hier == 0){
	$users_hier0 = 1;
}else{
	$users_hier0 = $users_hier;
}
$pourcentage_users_today = round($users_today*100/$users_hier0,2);

$invoices = $db->table('invoice');
$invoices->like('date', $aujourdhui);
$invoices_today = $invoices->countAllResults();
$invoices->like('date', $hier);
$invoices_hier = $invoices->countAllResults();
if($invoices_hier == 0){
	$invoices_hier0 = 1;
}else{
	$invoices_hier0 = $invoices_hier;
}
$pourcentage_invoices_today = round($invoices_today*100/$invoices_hier0,2);

$builder__counts_visites_uniques = $db->table('views');
$builder__counts_visites_uniques->distinct();
$builder__counts_visites_uniques->select('ip');
$builder__counts_visites_uniques->like('date', $aujourdhui);
$visites_today_unique = $builder__counts_visites_uniques->countAllResults();

$builder__counts_visites_uniques = $db->table('views');
$builder__counts_visites_uniques->distinct();
$builder__counts_visites_uniques->select('ip');
$builder__counts_visites_uniques->like('date', $hier);
$visites_hier_unique = $builder__counts_visites_uniques->countAllResults();
if($visites_hier_unique == 0){
	$visites_hier_unique0 = 1;
}else{
	$visites_hier_unique0 = $visites_hier_unique;
}

$pourcentage_visite_today = round($visites_today_unique*100/$visites_hier_unique0,2);
?>
<div class="col">
	<div class="card radius-10 bg-gradient-deepblue">
	 <div class="card-body">
		<div class="d-flex align-items-center">
			<h5 class="mb-0 text-white"><?= $invoices_today; ?></h5>
			<div class="ms-auto">
				<i class='bx bx-cart fs-3 text-white'></i>
			</div>
		</div>
		<div class="progress my-3 bg-light-transparent" style="height:3px;">
			<div class="progress-bar bg-white" role="progressbar" style="width: <?= $pourcentage_invoices_today; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
		<div class="d-flex align-items-center text-white">
			<p class="mb-0">Factures</p>
			<p class="mb-0 ms-auto"></p>
		</div>
	</div>
	</div>
</div>
<div class="col">
	<div class="card radius-10 bg-gradient-orange">
	<div class="card-body">
		<div class="d-flex align-items-center">
			<h5 class="mb-0 text-white"><?= $users_today; ?></h5>
			<div class="ms-auto">
				<i class='bx bx-group fs-3 text-white'></i>
			</div>
		</div>
		<div class="progress my-3 bg-light-transparent" style="height:3px;">
			<div class="progress-bar bg-white" role="progressbar" style="width: <?= $pourcentage_users_today; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
		<div class="d-flex align-items-center text-white">
			<p class="mb-0">nouveaux membres</p>
			<p class="mb-0 ms-auto">+<?= $pourcentage_users_today; ?>%<span><i class='bx bx-up-arrow-alt'></i></span></p>
		</div>
	</div>
	</div>
</div>
<div class="col">
	<div class="card radius-10 bg-gradient-ohhappiness">
	<div class="card-body">
		<div class="d-flex align-items-center">
			<h5 class="mb-0 text-white"><?= $visites_today_unique; ?></h5>
			<div class="ms-auto">
					<i class='bx bx-group fs-3 text-white'></i>
			</div>
		</div>
		<div class="progress my-3 bg-light-transparent" style="height:3px;">
			<div class="progress-bar bg-white" role="progressbar" style="width: <?= $pourcentage_visites_today; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
		<div class="d-flex align-items-center text-white">
			<p class="mb-0">Visiteurs uniques</p>
			<p class="mb-0 ms-auto">+<?= $pourcentage_visites_today; ?>%<span><i class='bx bx-up-arrow-alt'></i></span></p>
		</div>
	</div>
</div>
</div>
<div class="col">
	<div class="card radius-10 bg-gradient-ibiza">
	 <div class="card-body">
		<div class="d-flex align-items-center">
			<h5 class="mb-0 text-white"><?= $visites_today; ?></h5>
			<div class="ms-auto">
					<i class='bx bx-group fs-3 text-white'></i>
			</div>
		</div>
		<div class="progress my-3 bg-light-transparent" style="height:3px;">
			<div class="progress-bar bg-white" role="progressbar" style="width: <?= $pourcentage_visites_today; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
		<div class="d-flex align-items-center text-white">
			<p class="mb-0">Visites aujourd'hui</p>
			<p class="mb-0 ms-auto">+<?= $pourcentage_visites_today; ?>%<span><i class='bx bx-up-arrow-alt'></i></span></p>
		</div>
	</div>
 </div>
</div>
