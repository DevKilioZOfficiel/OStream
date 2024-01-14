<?php
header('Access-Control-Allow-Origin: *'); ?>
<?php
require 'geo/vendor/autoload.php';
use GeoIp2\Database\Reader;
$reader2 = new Reader('/www/wwwroot/ostream.online/geo/GeoLite2-City.mmdb');
$reader3 = new Reader('/www/wwwroot/ostream.online/geo/GeoIP2-ISP.mmdb');


$sessionmodel = new \App\Models\SessionModel();
$ip = $sessionmodel->get_ip();
$db = \Config\Database::connect();
$record2 = $reader2->city($ip);
//$record3 = $reader3->isp($ip); ?>
<script>
//window.onload = function(){
//  setTimeout(function(){ api__api(); }, 3000);
//}
setTimeout(function(){ api__api(); }, 2500);

function servers(url,element_id){
  oData = new FormData();
  var oReq = new XMLHttpRequest();
  oReq.open("GET", url, true);
  oReq.onload = function(oEvent) {
    console.log(oReq);
    console.log(oReq.status);
    console.log(oReq.responseText);
    if (oReq.status == 200) {
      var texte = oReq.responseText;
      document.getElementById(element_id).innerHTML = oReq.responseText;
    } else {
      var texte = "Erreur " + oReq.status;
      document.getElementById(element_id).innerHTML = oReq.status;
    }
  };
  oReq.send(oData);
}
function api__api(){
    servers("https://ostream.online/admincp/render__servers?advanced=true&name_server=Serveur%20Web","server1");
    servers("https://vmi1084305.contaboserver.net/infos.php?advanced=true&name_server=Serveur%20Stream%201","server2");
}
</script>


<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-3 col-xxl-6 col-sm-6">
				<div class="card bg-primary">
					<div class="card-body">
						<div class="media align-items-center">
							<span class="p-3 me-3 feature-icon rounded">
                <i class="fa-duotone fa-signal-stream"></i>
							</span>
							<div class="media-body text-end">
								<p class="fs-18 text-white mb-2">Streams en cours</p>
								<span class="fs-48 text-white font-w600">N/A</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-xxl-6 col-sm-6">
				<div class="card bg-info">
					<div class="card-body">
						<div class="media align-items-center">
							<span class="p-3 me-3 feature-icon rounded">
                <i class="fa-light fa-globe"></i>
							</span>
							<div class="media-body text-end">
								<p class="fs-18 text-white mb-2">Visiteurs ce mois</p>
								<span class="fs-48 text-white font-w600"><?php $builder = $db->table('views');
                $builder->where('mois', date('m'));
                $builder->where('annee', date('Y'));
                $builder->distinct();
                echo $builder->countAllResults(); ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-xxl-6 col-sm-6">
				<div class="card bg-success">
					<div class="card-body">
						<div class="media align-items-center">
							<span class="p-3 me-3 feature-icon rounded">
                <i class="fa-regular fa-users"></i>
							</span>
							<div class="media-body text-end">
								<p class="fs-18 text-white mb-2">Utilisateurs inscrit</p>
								<span class="fs-48 text-white font-w600"><?php $builder = $db->table('user');
                $builder->distinct();
                echo $builder->countAllResults(); ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-xxl-6 col-sm-6">
				<div class="card bg-secondary">
					<div class="card-body">
						<div class="media align-items-center">
							<span class="p-3 me-3 feature-icon rounded">
                <i class="fa-light fa-airplay"></i>
							</span>
							<div class="media-body text-end">
								<p class="fs-18 text-white mb-2">Utilisateurs en stream</p>
								<span class="fs-48 text-white font-w600"><?php $builder = $db->table('views');
                $builder->select('url,ip');
                $builder->like('url', "%streaming%");
                $builder->where('jour', date('d'));
                $builder->where('mois', date('m'));
                $builder->where('annee', date('Y'));
                $builder->distinct();
                echo $builder->countAllResults(); ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-xxl-4">
				<div class="row">
					<div class="col-xl-12">
						<div class="card d-flex flex-xl-column flex-sm-column flex-md-row flex-column">
							<div class="card-body text-center profile-bx">
								<div class="profile-image mb-4">
									<img src="https://www.gravatar.com/avatar/<?= md5($user['email']); ?>" class="rounded-circle" alt="">
								</div>
								<h4 class="fs-22 text-black mb-1"><?= $user['pseudo']; ?></h4>
								<p class="mb-4"><?= $user['pseudo']; ?></p>
							</div>
							<div class="card-body col-xl-12 col-md-6 col-sm-12 activity-card">
								<h4 class="fs-18 text-black mb-3">Activités récentes</h4>
								<div class="media mb-4">
									<span class="p-3 border me-3 rounded">
										<svg class="primary-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M20.3955 10.8038C19.9733 10.8038 19.5767 10.8742 19.2057 11.0213V4.79104H12.9883C13.1226 4.42004 13.193 4.01066 13.193 3.58849C13.193 1.60554 11.5874 0 9.60447 0C7.62152 0 6.01598 1.60554 6.01598 3.58849C6.01598 4.01066 6.08634 4.41365 6.22067 4.79104H0.00958252V11.7441C0.642845 11.1684 1.48719 10.8102 2.4083 10.8102C4.39125 10.8102 5.99679 12.4158 5.99679 14.3987C5.99679 16.3817 4.39125 17.9872 2.4083 17.9872C1.48719 17.9872 0.642845 17.629 0.00958252 17.0533V24H19.2121V17.7697C19.5831 17.9104 19.9797 17.9872 20.4019 17.9872C22.3912 17.9872 23.9904 16.3817 23.9904 14.3987C23.9904 12.4158 22.3912 10.8038 20.3955 10.8038Z" fill="#40189D"/>
										</svg>
									</span>
									<div class="media-body">
										<p class="fs-14 mb-1 text-black font-w500">Connexion au panel en <strong><?= $record2->country->name; ?></strong></p>
										<span class="fs-14">Un instant</span>
									</div>

                  <?php //echo json_encode($record3); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-9 col-xxl-8">
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header border-0 pb-0 flex-wrap">
								<h4 class="fs-20 text-black me-4 mb-2">Statistiques</h4>
                <select onchange="statistiques(document.getElementById('statistics').value)" id="statistics" class="form-control style-3 default-select mt-3 mt-sm-0 me-3">
									<option value="mois">Ce mois</option>
									<option value="annuel">Cette année</option>
								</select>
							</div>
							<div class="card-body">
                <div id="stats_chart"></div>
								<div class="d-flex flex-wrap align-items-center justify-content-center mt-3">
									<div class="fs-14 text-black me-4">
										<svg class="me-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect width="19" height="19" rx="9.5" fill="#4E36E2"/>
										</svg>
										Visiteurs réguliers
									</div>
									<div class="fs-14 text-black me-4">
										<svg class="me-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect width="19" height="19" rx="9.5" fill="#1BD084"/>
										</svg>
										Visiteurs unique
									</div>
									<div class="fs-14 text-black">
										<svg class="me-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect width="19" height="19" rx="9.5" fill="#FF424D"/>
										</svg>
										Dans des streams
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
      <div class="col-xl-12">
            <div class="card">
              <div class="card-header d-block d-sm-flex border-0">
                <div class="me-3">
                  <h4 class="fs-20 text-black">Dernières factures</h4>
                  <p class="mb-0 fs-13">Toutes les dernières factures sur le site</p>
                </div>
                <div class="custom-tab-1 mt-3 mt-sm-0">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-bs-toggle="tab" href="#products" role="tab">Premium</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#paypal" role="tab">Paypal</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body tab-content p-0">
                <div class="tab-pane active show fade" id="products" role="tabpanel">
                  <div class="table-responsive">
                    <table class="table table-responsive-md card-table previous-transactions">
                      <tbody>
                        <?php $builder = $db->table('invoices');
                        $builder->where('type','0');
                        $builder->orderBy('id', 'DESC');
                        $builder->limit(20);
                        $query = $builder->get();
                        foreach ($query->getResult() as $row) { ?>
                          <?php $builder2 = $db->table('premium');
                          $builder2->where('id', $row->product_id);
                          $query = $builder2->get();
                          foreach ($query->getResult() as $row_product) { ?>
                        <tr>
                          <td>
                            <?php if($row->etat == "COMPLETED"){ ?>
                            <svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <rect x="1.00002" y="1" width="61" height="61" rx="29" stroke="#2BC155" stroke-width="2" />
                              <g clip-path="url(#clip0)">
                                <path d="M35.2219 42.9875C34.8938 42.3094 35.1836 41.4891 35.8617 41.1609C37.7484 40.2531 39.3453 38.8422 40.4828 37.0758C41.6477 35.2656 42.2656 33.1656 42.2656 31C42.2656 24.7875 37.2125 19.7344 31 19.7344C24.7875 19.7344 19.7344 24.7875 19.7344 31C19.7344 33.1656 20.3523 35.2656 21.5117 37.0813C22.6437 38.8477 24.2461 40.2586 26.1328 41.1664C26.8109 41.4945 27.1008 42.3094 26.7727 42.993C26.4445 43.6711 25.6297 43.9609 24.9461 43.6328C22.6 42.5063 20.6148 40.7563 19.2094 38.5578C17.7656 36.3047 17 33.6906 17 31C17 27.2594 18.4547 23.743 21.1016 21.1016C23.743 18.4547 27.2594 17 31 17C34.7406 17 38.257 18.4547 40.8984 21.1016C43.5453 23.7484 45 27.2594 45 31C45 33.6906 44.2344 36.3047 42.7852 38.5578C41.3742 40.7508 39.3891 42.5063 37.0484 43.6328C36.3648 43.9555 35.55 43.6711 35.2219 42.9875Z" fill="#2BC155" />
                                <path d="M36.3211 31.7274C36.5891 31.9953 36.7203 32.3453 36.7203 32.6953C36.7203 33.0453 36.5891 33.3953 36.3211 33.6633L32.8812 37.1031C32.3781 37.6063 31.7109 37.8797 31.0055 37.8797C30.3 37.8797 29.6273 37.6008 29.1297 37.1031L25.6898 33.6633C25.1539 33.1274 25.1539 32.2633 25.6898 31.7274C26.2258 31.1914 27.0898 31.1914 27.6258 31.7274L29.6437 33.7453L29.6437 25.9742C29.6437 25.2196 30.2562 24.6071 31.0109 24.6071C31.7656 24.6071 32.3781 25.2196 32.3781 25.9742L32.3781 33.7508L34.3961 31.7328C34.9211 31.1969 35.7852 31.1969 36.3211 31.7274Z" fill="#2BC155" />
                              </g>
                              <defs>
                                <clipPath id="clip0">
                                  <rect width="28" height="28" fill="white" transform="matrix(-4.37114e-08 1 1 4.37114e-08 17 17)" />
                                </clipPath>
                              </defs>
                            </svg>
                          <?php }else{ ?>
                            <svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <rect x="1" y="1" width="61" height="61" rx="29" stroke="#FF2E2E" stroke-width="2" />
                              <g clip-path="url(#clip1)">
                                <path d="M35.2219 19.0125C34.8937 19.6906 35.1836 20.5109 35.8617 20.8391C37.7484 21.7469 39.3453 23.1578 40.4828 24.9242C41.6476 26.7344 42.2656 28.8344 42.2656 31C42.2656 37.2125 37.2125 42.2656 31 42.2656C24.7875 42.2656 19.7344 37.2125 19.7344 31C19.7344 28.8344 20.3523 26.7344 21.5117 24.9187C22.6437 23.1523 24.2461 21.7414 26.1328 20.8336C26.8109 20.5055 27.1008 19.6906 26.7726 19.007C26.4445 18.3289 25.6297 18.0391 24.9461 18.3672C22.6 19.4937 20.6148 21.2437 19.2094 23.4422C17.7656 25.6953 17 28.3094 17 31C17 34.7406 18.4547 38.257 21.1015 40.8984C23.743 43.5453 27.2594 45 31 45C34.7406 45 38.257 43.5453 40.8984 40.8984C43.5453 38.2516 45 34.7406 45 31C45 28.3094 44.2344 25.6953 42.7851 23.4422C41.3742 21.2492 39.389 19.4937 37.0484 18.3672C36.3648 18.0445 35.55 18.3289 35.2219 19.0125Z" fill="#FF2E2E" />
                                <path d="M36.3211 30.2726C36.589 30.0047 36.7203 29.6547 36.7203 29.3047C36.7203 28.9547 36.589 28.6047 36.3211 28.3367L32.8812 24.8969C32.3781 24.3937 31.7109 24.1203 31.0055 24.1203C30.3 24.1203 29.6273 24.3992 29.1297 24.8969L25.6898 28.3367C25.1539 28.8726 25.1539 29.7367 25.6898 30.2726C26.2258 30.8086 27.0898 30.8086 27.6258 30.2726L29.6437 28.2547L29.6437 36.0258C29.6437 36.7804 30.2562 37.3929 31.0109 37.3929C31.7656 37.3929 32.3781 36.7804 32.3781 36.0258L32.3781 28.2492L34.3961 30.2672C34.9211 30.8031 35.7851 30.8031 36.3211 30.2726Z" fill="#FF2E2E" />
                              </g>
                              <defs>
                                <clipPath id="clip1">
                                  <rect width="28" height="28" fill="white" transform="translate(17 45) rotate(-90)" />
                                </clipPath>
                              </defs>
                            </svg>
                          <?php } ?>
                          </td>
                          <td>
                            <h6 class="fs-16 font-w600 mb-0">
                              <a href="#" class="text-black"><?= $row_product->name; ?></a>
                            </h6>
                            <span class="fs-14"><?= $row->code; ?></span>
                          </td>
                          <td>
                            <?php $d=strtotime("".$row->date.""); ?>
                            <h6 class="fs-16 text-black font-w400 mb-0"><?= date('d/m/Y', $d); ?></h6>
                            <span class="fs-14"><?= date('H:i:s', $d); ?></span>
                          </td>
                          <td>
                            <span class="fs-16 text-black font-w500"><?= $row->price; ?>€</span>
                          </td>
                          <td>
                            <?php if($row->etat == "COMPLETED"){ ?>
                            <span class="text-success fs-16 font-w500 text-end d-block">Terminé</span>
                          <?php }else{ ?>
                            <span class="text-dark fs-16 font-w500 text-end d-block">Annulé</span>
                          <?php } ?>
                          </td>
                        </tr>
                        <?php } ?>
                      <?php } ?>
                      <tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane" id="paypal" role="tabpanel">
                  <div class="table-responsive">
                    <table class="table card-table previous-transactions">
                      <tbody>
                        <?php $builder = $db->table('invoices');
                        $builder->where('type','1');
                        $builder->orderBy('id', 'DESC');
                        $builder->limit(20);
                        $query = $builder->get();
                        foreach ($query->getResult() as $row) { ?>
                        <tr>
                          <td>
                            <?php if($row->etat == "COMPLETED"){ ?>
                            <svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <rect x="1.00002" y="1" width="61" height="61" rx="29" stroke="#2BC155" stroke-width="2" />
                              <g clip-path="url(#clip0)">
                                <path d="M35.2219 42.9875C34.8938 42.3094 35.1836 41.4891 35.8617 41.1609C37.7484 40.2531 39.3453 38.8422 40.4828 37.0758C41.6477 35.2656 42.2656 33.1656 42.2656 31C42.2656 24.7875 37.2125 19.7344 31 19.7344C24.7875 19.7344 19.7344 24.7875 19.7344 31C19.7344 33.1656 20.3523 35.2656 21.5117 37.0813C22.6437 38.8477 24.2461 40.2586 26.1328 41.1664C26.8109 41.4945 27.1008 42.3094 26.7727 42.993C26.4445 43.6711 25.6297 43.9609 24.9461 43.6328C22.6 42.5063 20.6148 40.7563 19.2094 38.5578C17.7656 36.3047 17 33.6906 17 31C17 27.2594 18.4547 23.743 21.1016 21.1016C23.743 18.4547 27.2594 17 31 17C34.7406 17 38.257 18.4547 40.8984 21.1016C43.5453 23.7484 45 27.2594 45 31C45 33.6906 44.2344 36.3047 42.7852 38.5578C41.3742 40.7508 39.3891 42.5063 37.0484 43.6328C36.3648 43.9555 35.55 43.6711 35.2219 42.9875Z" fill="#2BC155" />
                                <path d="M36.3211 31.7274C36.5891 31.9953 36.7203 32.3453 36.7203 32.6953C36.7203 33.0453 36.5891 33.3953 36.3211 33.6633L32.8812 37.1031C32.3781 37.6063 31.7109 37.8797 31.0055 37.8797C30.3 37.8797 29.6273 37.6008 29.1297 37.1031L25.6898 33.6633C25.1539 33.1274 25.1539 32.2633 25.6898 31.7274C26.2258 31.1914 27.0898 31.1914 27.6258 31.7274L29.6437 33.7453L29.6437 25.9742C29.6437 25.2196 30.2562 24.6071 31.0109 24.6071C31.7656 24.6071 32.3781 25.2196 32.3781 25.9742L32.3781 33.7508L34.3961 31.7328C34.9211 31.1969 35.7852 31.1969 36.3211 31.7274Z" fill="#2BC155" />
                              </g>
                              <defs>
                                <clipPath id="clip0">
                                  <rect width="28" height="28" fill="white" transform="matrix(-4.37114e-08 1 1 4.37114e-08 17 17)" />
                                </clipPath>
                              </defs>
                            </svg>
                          <?php }else{ ?>
                            <svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <rect x="1" y="1" width="61" height="61" rx="29" stroke="#FF2E2E" stroke-width="2" />
                              <g clip-path="url(#clip1)">
                                <path d="M35.2219 19.0125C34.8937 19.6906 35.1836 20.5109 35.8617 20.8391C37.7484 21.7469 39.3453 23.1578 40.4828 24.9242C41.6476 26.7344 42.2656 28.8344 42.2656 31C42.2656 37.2125 37.2125 42.2656 31 42.2656C24.7875 42.2656 19.7344 37.2125 19.7344 31C19.7344 28.8344 20.3523 26.7344 21.5117 24.9187C22.6437 23.1523 24.2461 21.7414 26.1328 20.8336C26.8109 20.5055 27.1008 19.6906 26.7726 19.007C26.4445 18.3289 25.6297 18.0391 24.9461 18.3672C22.6 19.4937 20.6148 21.2437 19.2094 23.4422C17.7656 25.6953 17 28.3094 17 31C17 34.7406 18.4547 38.257 21.1015 40.8984C23.743 43.5453 27.2594 45 31 45C34.7406 45 38.257 43.5453 40.8984 40.8984C43.5453 38.2516 45 34.7406 45 31C45 28.3094 44.2344 25.6953 42.7851 23.4422C41.3742 21.2492 39.389 19.4937 37.0484 18.3672C36.3648 18.0445 35.55 18.3289 35.2219 19.0125Z" fill="#FF2E2E" />
                                <path d="M36.3211 30.2726C36.589 30.0047 36.7203 29.6547 36.7203 29.3047C36.7203 28.9547 36.589 28.6047 36.3211 28.3367L32.8812 24.8969C32.3781 24.3937 31.7109 24.1203 31.0055 24.1203C30.3 24.1203 29.6273 24.3992 29.1297 24.8969L25.6898 28.3367C25.1539 28.8726 25.1539 29.7367 25.6898 30.2726C26.2258 30.8086 27.0898 30.8086 27.6258 30.2726L29.6437 28.2547L29.6437 36.0258C29.6437 36.7804 30.2562 37.3929 31.0109 37.3929C31.7656 37.3929 32.3781 36.7804 32.3781 36.0258L32.3781 28.2492L34.3961 30.2672C34.9211 30.8031 35.7851 30.8031 36.3211 30.2726Z" fill="#FF2E2E" />
                              </g>
                              <defs>
                                <clipPath id="clip1">
                                  <rect width="28" height="28" fill="white" transform="translate(17 45) rotate(-90)" />
                                </clipPath>
                              </defs>
                            </svg>
                          <?php } ?>
                          </td>
                          <td>
                            <h6 class="fs-16 font-w600 mb-0">
                              <a href="#" class="text-black">Solde Paypal</a>
                            </h6>
                            <span class="fs-14"><?= $row->code; ?></span>
                          </td>
                          <td>
                            <?php $d=strtotime("".$row->date.""); ?>
                            <h6 class="fs-16 text-black font-w400 mb-0"><?= date('d/m/Y', $d); ?></h6>
                            <span class="fs-14"><?= date('H:i:s', $d); ?></span>
                          </td>
                          <td>
                            <span class="fs-16 text-black font-w500"><?= $row->price; ?>€</span>
                          </td>
                          <td>
                            <?php if($row->etat == "COMPLETED"){ ?>
                            <span class="text-success fs-16 font-w500 text-end d-block">Terminé</span>
                          <?php }else{ ?>
                            <span class="text-dark fs-16 font-w500 text-end d-block">Annulé</span>
                          <?php } ?>
                          </td>
                        </tr>
                      <?php } ?>
                      <tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
			<div class="col-xl-12">
				<div class="d-sm-flex align-items-center mb-3 mt-sm-0 mt-2">
					<h4 class="text-black fs-20 me-auto">Serveurs</h4>
				</div>
        <div class="row">
        <div class="vps col-xl-6">
          <iframe src="https://ostream.online/admincp/render__servers?advanced=true&name_server=Serveur%20Web" style="border-radius: 10px;height: 77vh;" name="ostream2" scrolling="no" frameborder="1" marginheight="0px" marginwidth="0px" height="100vh" width="100%"  ></iframe>
        </div>
        <div class="vps col-xl-6">
          <iframe src="https://vmi1084305.contaboserver.net/infos.php?advanced=true&name_server=Serveur%20Stream%201" style="border-radius: 10px;height: 77vh;" name="ostream2" scrolling="no" frameborder="1" marginheight="0px" marginwidth="0px" height="100vh" width="100%" allowfullscreen></iframe>
        </div>
        </div>
			</div>
		</div>
	</div>
</div>
