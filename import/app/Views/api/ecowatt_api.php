<?php
$request = \Config\Services::request();
$sessionmodel = new \App\Models\SessionModel();
$db = \Config\Database::connect();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://digital.iservices.rte-france.com/token/oauth/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic MzFhYjVlNzctODJlZC00NGQ5LThmOWUtM2U0MWZiZTUxYWVlOjVjMWM0NzY5LTc3MjUtNDZiZS04N2I4LTMxZWZlMjI2YWY5YQ=='
  ),
));

$response = curl_exec($curl);
echo $response;

curl_close($curl);
$api = json_decode($response);
$token = $api->access_token;
echo $token;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://digital.iservices.rte-france.com/open_api/ecowatt/v4/signals',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer '.$api->access_token.''
  ),
));

$response_ecowatt = curl_exec($curl);

curl_close($curl);
echo $response_ecowatt;

$api_ecowatt = json_decode($response_ecowatt);
$api_encode = json_encode($api_ecowatt);



$builder3 = $db->table('ecowatt');
$builder3->set('api', $api_encode) ;
$builder3->where('id', 1);
$builder3->update();
