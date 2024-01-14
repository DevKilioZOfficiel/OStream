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
						<div class="card">
							<div class="card-header border-0 pb-0">
								<h4 class="fs-20 text-black"><?= $_GET['name_server']; ?></h4>
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
											<span class="donut2" data-peity="{ &quot;fill&quot;: [&quot;rgb(64, 24, 157)&quot;, &quot;rgba(239, 239, 239, 1)&quot;],   &quot;innerRadius&quot;: 38, &quot;radius&quot;: 10}" style="display: none;"><?= round($ram_percent,2); ?>/100</span><svg class="peity" height="110" width="110"><path d="M 55 0 A 55 55 0 1 1 7.368602791855885 82.50000000000001 L 22.09103465619134 74.00000000000001 A 38 38 0 1 0 55 17" data-value="6" fill="rgb(64, 24, 157)"></path><path d="M 7.368602791855885 82.50000000000001 A 55 55 0 0 1 54.99999999999999 0 L 54.99999999999999 17 A 38 38 0 0 0 22.09103465619134 74.00000000000001" data-value="3" fill="rgba(239, 239, 239, 1)"></path></svg>
											<small class="text-black fs-20"><?= round($ram_percent,2); ?>%</small>
										</div>
										<h6 class="fs-18 text-black font-w600 mb-0">Ram</h6>
										<span class="fs-14"><?= round($memused,2); ?>Go</span>/<?= $memtotal; ?>Go</span>
									</div>
									<div class="col-xl-3 col-xxl-6 col-md-3 col-6 mb-4 text-center">
										<div class="d-inline-block ms-auto me-auto mb-2 relative donut-chart-sale me-4">
											<span class="donut2" data-peity="{ &quot;fill&quot;: [&quot;rgb(64, 24, 157)&quot;, &quot;rgba(239, 239, 239, 1)&quot;],   &quot;innerRadius&quot;: 38, &quot;radius&quot;: 10}" style="display: none;"><?= round($cpuload,2); ?>/100</span><svg class="peity" height="110" width="110"><path d="M 55 0 A 55 55 0 0 1 102.63139720814414 82.49999999999999 L 87.90896534380867 74 A 38 38 0 0 0 55 17" data-value="3" fill="rgb(64, 24, 157)"></path><path d="M 102.63139720814414 82.49999999999999 A 55 55 0 1 1 54.99999999999999 0 L 54.99999999999999 17 A 38 38 0 1 0 87.90896534380867 74" data-value="6" fill="rgba(239, 239, 239, 1)"></path></svg>
											<small class="text-black fs-20"><?= round($cpuload,2); ?>%</small>
										</div>
										<h6 class="fs-18 text-black font-w600 mb-0">CPU</h6>
										<span class="fs-14"><?= round($cpuload,2); ?>%</span>/100% </span>
									</div>
									<div class="col-xl-3 col-xxl-6 col-md-3 col-6 mb-4 text-center">
										<div class="d-inline-block ms-auto me-auto mb-2 relative donut-chart-sale me-4">
											<span class="donut2" data-peity="{ &quot;fill&quot;: [&quot;rgb(64, 24, 157)&quot;, &quot;rgba(239, 239, 239, 1)&quot;],   &quot;innerRadius&quot;: 38, &quot;radius&quot;: 10}" style="display: none;"><?= round($storage_percent,2); ?>/100</span><svg class="peity" height="110" width="110"><path d="M 55 0 A 55 55 0 1 1 0 55.00000000000001 L 17 55.00000000000001 A 38 38 0 1 0 55 17" data-value="6" fill="rgb(64, 24, 157)"></path><path d="M 0 55.00000000000001 A 55 55 0 0 1 54.99999999999999 0 L 54.99999999999999 17 A 38 38 0 0 0 17 55.00000000000001" data-value="2" fill="rgba(239, 239, 239, 1)"></path></svg>
											<small class="text-black fs-20"><?= round($storage_percent,2); ?>%</small>
										</div>
										<h6 class="fs-18 text-black font-w600 mb-0">Stockage</h6>
										<span class="fs-14"><?= FileSizeConvert(disk_total_space(".")-disk_free_space(".")); ?></span>/<?= FileSizeConvert(disk_total_space(".")); ?></span>
									</div>
									<div class="col-xl-3 col-xxl-6 col-md-3 col-6 mb-4 text-center">
										<div class="d-inline-block ms-auto me-auto mb-2 relative donut-chart-sale me-4">
											<span class="donut2" data-peity="{ &quot;fill&quot;: [&quot;rgb(64, 24, 157)&quot;, &quot;rgba(239, 239, 239, 1)&quot;],   &quot;innerRadius&quot;: 38, &quot;radius&quot;: 10}" style="display: none;"><?= $connections; ?>/<?= $totalconnections; ?></span><svg class="peity" height="110" width="110"><path d="M 55 0 A 55 55 0 1 1 2.691891603766557 71.99593469062211 L 18.85985238078417 66.742645786248 A 38 38 0 1 0 55 17" data-value="7" fill="rgb(64, 24, 157)"></path><path d="M 2.691891603766557 71.99593469062211 A 55 55 0 0 1 54.99999999999999 0 L 54.99999999999999 17 A 38 38 0 0 0 18.85985238078417 66.742645786248" data-value="3" fill="rgba(239, 239, 239, 1)"></path></svg>
											<small class="text-black fs-20"><?= $totalconnections; ?>%</small>
										</div>
										<h6 class="fs-18 text-black font-w600 mb-0">Connexions</h6>
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
						          <div class="col-xl-3  col-xxl-3 col-md-12">
						           <p>OS: <span class="text-black me-2"><?= php_uname('s'); ?></span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-12">
						           <p>Hôte: <span class="text-black me-2"><?= php_uname('n'); ?></span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-12">
						           <p>Version: <span class="text-black me-2"><?= php_uname('r'); ?></span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-12">
						           <p>Infos de la version: <span class="text-black me-2"><?= php_uname('v'); ?></span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-12">
						           <p>Machine: <span class="text-black me-2"><?= php_uname('m'); ?></span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-12">
						           <p>CPU: <span class="text-black me-2"><?= $cpu_de; ?></span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-12">
						           <p>Fréquence du CPU: <span class="text-black me-2"><?= $MHz_de; ?> MHz</span></p>
						          </div>
						          <div class="col-xl-3  col-xxl-3 col-md-12">
						           <p>Coeurs: <span class="text-black me-2"><?= $core_de; ?></span></p>
						          </div>
						        </div>
						      </div>
								</div>
							</div>
						</div>
