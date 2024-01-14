<link href="<?= base_url('/uploads/admin_assets'); ?>/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css"/>

		 <link href="<?= base_url('/uploads/admin_assets'); ?>/vendor/lightgallery/css/lightgallery.min.css" rel="stylesheet" type="text/css"/>

		 <link href="<?= base_url('/uploads/admin_assets'); ?>/vendor/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>

		 <link href="<?= base_url('/uploads/admin_assets'); ?>/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>

		 <link href="<?= base_url('/uploads/admin_assets'); ?>/css/style.css" rel="stylesheet" type="text/css"/>
<?php
$start_time = microtime(TRUE);

function get_dir_size($directory){
	$size = 0;
	$files = glob($directory.'/*');
	if (is_array($files) || is_object($files)){
		foreach ($files as $key => $path) {
				is_file($path) && $size += filesize($path);
				is_dir($path)  && $size += get_dir_size($path);
		}
	}
	return $size;
}

	$operating_system = PHP_OS_FAMILY;

	if ($operating_system === 'Windows') {
		// Win CPU
		$wmi = new COM('WinMgmts:\\\\.');
		$cpus = $wmi->InstancesOf('Win32_Processor');
		$cpuload = 0;
		$cpu_count = 0;
		foreach ($cpus as $key => $cpu) {
			$cpuload += $cpu->LoadPercentage;
			$cpu_count++;
		}
		// WIN MEM
		$res = $wmi->ExecQuery('SELECT FreePhysicalMemory,FreeVirtualMemory,TotalSwapSpaceSize,TotalVirtualMemorySize,TotalVisibleMemorySize FROM Win32_OperatingSystem');
		$mem = $res->ItemIndex(0);
		$memtotal = round($mem->TotalVisibleMemorySize / 1000000,2);
		$memavailable = round($mem->FreePhysicalMemory / 1000000,2);
		$memused = round($memtotal-$memavailable,2);
		// WIN CONNECTIONS
		$connections = shell_exec('netstat -nt | findstr :80 | findstr ESTABLISHED | find /C /V ""');
		$totalconnections = shell_exec('netstat -nt | findstr :80 | find /C /V ""');
	} else {
		// Linux CPU
		$load = sys_getloadavg();
		$cpuload = $load[0];
		// Linux MEM
		$free = shell_exec('free');
		$free = (string)trim($free);
		$free_arr = explode("\n", $free);
		$mem = explode(" ", $free_arr[1]);
		$mem = array_filter($mem, function($value) { return ($value !== null && $value !== false && $value !== ''); }); // removes nulls from array
		$mem = array_merge($mem); // puts arrays back to [0],[1],[2] after
		$memtotal = round($mem[1] / 1000000,2);
		$memused = round($mem[2] / 1000000,2);
		$memfree = round($mem[3] / 1000000,2);
		$memfree_pourcent = round($memfree*100/$memtotal,2);
		$memshared = round($mem[4] / 1000000,2);
		$memshared_pourcent = round($memshared*100/$memtotal,2);
		$memcached = round($mem[5] / 1000000,2);
		$memcached_pourcent = round($memcached*100/$memtotal,2);
		$memavailable = round($mem[6] / 1000000,2);
		// Linux Connections
		$connections = `netstat -ntu | grep :80 | grep ESTABLISHED | grep -v LISTEN | awk '{print $5}' | cut -d: -f1 | sort | uniq -c | sort -rn | grep -v 127.0.0.1 | wc -l`;
		$totalconnections = `netstat -ntu | grep :80 | grep -v LISTEN | awk '{print $5}' | cut -d: -f1 | sort | uniq -c | sort -rn | grep -v 127.0.0.1 | wc -l`;
	}

  $ram_percent = round($memused*100/$memtotal,2);

  $storage_used = FileSizeConvert(disk_total_space(".")-disk_free_space("."));
  $storage_used2 = disk_total_space(".")-disk_free_space(".");
  $storage_percent = round($storage_used2*100/disk_total_space("."),2);

  $phpload = round(memory_get_usage() / 1000000,2);

  $end_time = microtime(TRUE);
	$time_taken = $end_time - $start_time;
	$total_time = round($time_taken,4);

function FileSizeConvert($bytes){
	  $result = "0";
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "To",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "Go",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "Mo",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "Ko",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "o",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}
 ?>
<body style="background: #251e35;" data-typography="poppins" data-theme-version="dark" data-layout="vertical" data-nav-headerbg="color_3" data-headerbg="color_1" data-sidebar-style="full" data-sibebarbg="color_3" data-sidebar-position="fixed" data-header-position="fixed" data-container="wide" direction="ltr" data-primary="color_1">
	 <div class="row">
	 		<div class="col-xl-12">
						<div class="card" style="background: #28253b;color: #768690;">
							<div class="card-header border-0 pb-0">
								<h4 class="fs-20 text-white"><?= $_GET['name_server']; ?></h4>
								<div class="dropdown float-right custom-dropdown mb-0">
									<div class="" data-bs-toggle="dropdown" role="button" aria-expanded="false">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
										</svg>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="row sp10">
                  <div class="col-xl-3 col-xxl-6 col-md-3 col-6 mb-4 text-center">
										<div class="d-inline-block ms-auto me-auto mb-2 relative donut-chart-sale me-4">
												<span class="donut2" data-peity='{ "fill": ["rgb(64, 24, 157)", "rgba(239, 239, 239, 1)"],   "innerRadius": 38, "radius": 10}'><?= round($ram_percent,2); ?>/100</span>
											<small class="text-white fs-20"><?= round($ram_percent,2); ?>%</small>
										</div>
										<h6 class="fs-18 text-white font-w600 mb-0">Ram</h6>
										<span class="fs-14"><?= round($memused,2); ?>Go</span>/<?= $memtotal; ?>Go</span>
									</div>
									<div class="col-xl-3 col-xxl-6 col-md-3 col-6 mb-4 text-center">
										<div class="d-inline-block ms-auto me-auto mb-2 relative donut-chart-sale me-4">
											<span class="donut2" data-peity='{ "fill": ["rgb(64, 24, 157)", "rgba(239, 239, 239, 1)"],   "innerRadius": 38, "radius": 10}'><?= round($cpuload,2); ?>/100</span>
											<small class="text-white fs-20"><?= round($cpuload,2); ?>%</small>
										</div>
										<h6 class="fs-18 text-white font-w600 mb-0">CPU</h6>
										<span class="fs-14"><?= round($cpuload,2); ?>%</span>/100% </span>
									</div>
									<div class="col-xl-3 col-xxl-6 col-md-3 col-6 mb-4 text-center">
										<div class="d-inline-block ms-auto me-auto mb-2 relative donut-chart-sale me-4">
											<span class="donut2" data-peity='{ "fill": ["rgb(64, 24, 157)", "rgba(239, 239, 239, 1)"],   "innerRadius": 38, "radius": 10}'><?= round($storage_percent,2); ?>/100</span>
											<small class="text-white fs-20"><?= round($storage_percent,2); ?>%</small>
										</div>
										<h6 class="fs-18 text-white font-w600 mb-0">Stockage</h6>
										<span class="fs-14"><?= FileSizeConvert(disk_total_space(".")-disk_free_space(".")); ?></span>/<?= FileSizeConvert(disk_total_space(".")); ?></span>
									</div>
									<div class="col-xl-3 col-xxl-6 col-md-3 col-6 mb-4 text-center">
										<div class="d-inline-block ms-auto me-auto mb-2 relative donut-chart-sale me-4">
											<span class="donut2" data-peity='{ "fill": ["rgb(64, 24, 157)", "rgba(239, 239, 239, 1)"],   "innerRadius": 38, "radius": 10}'><?= $connections; ?>/<?= $totalconnections; ?></span>
											<small class="text-white fs-20"><?= $totalconnections; ?>%</small>
										</div>
										<h6 class="fs-18 text-white font-w600 mb-0">Connexions</h6>
										<span class="fs-14"><?= $connections; ?></span>/<?= $totalconnections; ?></span>
									</div>
						      <div class="col-xl-12  col-xxl-12 col-md-12">
						        <div class="row g-3">
						          <?php $cpuget = file('/proc/cpuinfo');
						          $cpu['name'] = explode(':', $cpuget[4]);
						          $cpu_de = $cpu['name'][1];
						          $cpu['name'] = explode(':', $cpuget[7]);
						          $MHz_de = $cpu['name'][1];
						          $cpu['name'] = explode(':', $cpuget[12]);
						          $core_de = $cpu['name'][1];  ?>
						          <div class="col-xl-3  col-xxl-3 col-md-3">
						           <p>OS: <span class="text-white me-2"><?= php_uname('s'); ?></span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-3">
						           <p>Hôte: <span class="text-white me-2"><?= php_uname('n'); ?></span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-3">
						           <p>Version: <span class="text-white me-2"><?= php_uname('r'); ?></span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-3">
						           <p>Infos de la version: <span class="text-white me-2"><?= php_uname('v'); ?></span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-3">
						           <p>Machine: <span class="text-white me-2"><?= php_uname('m'); ?></span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-3">
						           <p>CPU: <span class="text-white me-2"><?= $cpu_de; ?></span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-3">
						           <p>Fréquence du CPU: <span class="text-white me-2"><?= $MHz_de; ?> MHz</span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-3">
						           <p>Coeurs: <span class="text-white me-2"><?= $core_de; ?></span></p>
						          </div>
						        </div>
						      </div>
								</div>
							</div>
						</div>
		</div>
	</div>
</body>
						<script src="<?= base_url('/uploads/admin_assets'); ?>/vendor/global/global.min.js"></script>
			<script src="<?= base_url('/uploads/admin_assets'); ?>/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

			<script src="<?= base_url('/uploads/admin_assets'); ?>/vendor/chart.js/Chart.bundle.min.js"></script>
			<script src="<?= base_url('/uploads/admin_assets'); ?>/vendor/peity/jquery.peity.min.js"></script>
			<script src="<?= base_url('/uploads/admin_assets'); ?>/vendor/apexchart/apexchart.js"></script>
			<script src="<?= base_url('/uploads/admin_assets'); ?>/js/dashboard/statistics.js"></script>

			<script src="<?= base_url('/uploads/admin_assets'); ?>/js/custom.js"></script>
			<script src="<?= base_url('/uploads/admin_assets'); ?>/js/deznav-init.js"></script>
