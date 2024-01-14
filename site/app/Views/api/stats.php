<?php
function elkirstats($name,$form,$to){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://analytics.elkir.fr/api/v1/stats/8?name='.$name.'&from='.$form.'&to='.$to.'&per_page=100',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Authorization: Bearer JMRHrZlcvXImVOZ4n7gGpPfDoTXaPubQGaE8Gv3HICwOSV2IzzjXZbwzrcvh'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$api = json_decode($response);
$count = 0;
if(!empty($api->data)){
foreach ($api->data as $key => $value) {
  $count += $value->count;
}
}else{
  $count += 0;
}
return $count;
} ?>
<?php if(!empty($_GET['name'])){
  $name = $_GET['name'];
}else{
  $name = "visitors";
} ?>
<?php if($_GET['duration'] == "year"){ ?>
[<?= elkirstats($name,date('Y-01-01'),date('Y-01-31')); ?>,<?= elkirstats($name,date('Y-02-01'),date('Y-02-31')); ?>,<?= elkirstats($name,date('Y-03-01'),date('Y-03-31')); ?>,<?= elkirstats($name,date('Y-04-01'),date('Y-04-31')); ?>,<?= elkirstats($name,date('Y-05-01'),date('Y-05-31')); ?>,<?= elkirstats($name,date('Y-06-01'),date('Y-06-31')); ?>,<?= elkirstats($name,date('Y-07-01'),date('Y-07-31')); ?>,<?= elkirstats($name,date('Y-08-01'),date('Y-08-31')); ?>,<?= elkirstats($name,date('Y-09-01'),date('Y-09-31')); ?>,<?= elkirstats($name,date('Y-10-01'),date('Y-10-31')); ?>,<?= elkirstats($name,date('Y-11-01'),date('Y-11-30')); ?>,<?= elkirstats($name,date('Y-12-01'),date('Y-12-31')); ?>]
<?php } ?>
<?php if($_GET['duration'] == "difference30d"){
  $mois_actuel = elkirstats($name,date('Y-m-01'),date('Y-m-t'));
  if(date('m') < "10"){
    if(date('m') == "01"){
      $mois_dernier1 = "12";
    }else{
      $mois_dernier1 = date('m')-1;
    }
  }else{
    $mois_dernier1 = date('m')-1;
  }
  $mois_dernier = elkirstats($name,date('Y-'.$mois_dernier1.'-01'),date('Y-'.$mois_dernier1.'-31'));
  if($mois_dernier == 0){
    $mois_dernier = 1;
  }
  $pourcentage = $mois_actuel*100/$mois_dernier;
  if($poucentage > 100){
    $pourcentage_reel = $pourcentage-100;
    $icon = '<svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M14.3514 7.5C15.9974 9.37169 19.0572 12.8253 20 14H1V1L8.18919 10.75L14.3514 7.5Z" fill="url(#paint0_linear1)" />
      <path d="M19.5 13.5C18.582 12.4157 15.6027 9.22772 14 7.5L8 10.5L1 1.5" stroke="#FF2E2E" stroke-width="2" stroke-linecap="round" />
      <defs>
        <linearGradient id="paint0_linear1" x1="10.5" y1="2.625" x2="9.64345" y2="13.9935" gradientUnits="userSpaceOnUse">
          <stop offset="0" stop-color="#FF2E2E" />
          <stop offset="1" stop-color="#FF2E2E" stop-opacity="0.03" />
        </linearGradient>
      </defs>
    </svg>';
    $symbol = '';
  }else{
    $pourcentage_reel = $pourcentage-100;
    $icon = '<svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0.999939 13.5C1.91791 12.4157 4.89722 9.22772 6.49994 7.5L12.4999 10.5L19.4999 1.5" stroke="#2BC155" stroke-width="2" />
      <path d="M6.49994 7.5C4.89722 9.22772 1.91791 12.4157 0.999939 13.5H19.4999V1.5L12.4999 10.5L6.49994 7.5Z" fill="url(#paint0_linear)" />
      <defs>
        <linearGradient id="paint0_linear" x1="10.2499" y1="3" x2="10.9999" y2="13.5" gradientUnits="userSpaceOnUse">
          <stop offset="0" stop-color="#2BC155" stop-opacity="0.73" />
          <stop offset="1" stop-color="#2BC155" stop-opacity="0" />
        </linearGradient>
      </defs>
    </svg>';
    $symbol = '+';
  }
  echo $icon.' '.$symbol.''.$pourcentage_reel.'%';
}

if($_GET['duration'] == "total_year"){
  echo elkirstats($name,date('Y-01-01'),date('Y-01-31'))+elkirstats($name,date('Y-02-01'),date('Y-02-31'))+elkirstats($name,date('Y-03-01'),date('Y-03-31'))+elkirstats($name,date('Y-04-01'),date('Y-04-31'))+elkirstats($name,date('Y-05-01'),date('Y-05-31'))+elkirstats($name,date('Y-06-01'),date('Y-06-31'))+elkirstats($name,date('Y-07-01'),date('Y-07-31'))+elkirstats($name,date('Y-08-01'),date('Y-08-31'))+elkirstats($name,date('Y-09-01'),date('Y-09-31'))+elkirstats($name,date('Y-10-01'),date('Y-10-31'))+elkirstats($name,date('Y-11-01'),date('Y-11-30'))+elkirstats($name,date('Y-12-01'),date('Y-12-31'));
} ?>
