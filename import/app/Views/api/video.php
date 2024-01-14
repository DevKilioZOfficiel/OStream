<?php
$request = \Config\Services::request();
$sessionmodel = new \App\Models\SessionModel();
$session = \Config\Services::session();
$db = \Config\Database::connect();
if(!empty($_SERVER['HTTP_REFERER'])){
  $findme = "ostream.online";
  $pos = strpos($_SERVER['HTTP_REFERER'], $findme);
  if($pos == true){
    if($request->GetPost('duration') === "Infinity"){
      $duration = "0";
    }else{
      $duration = $request->GetPost('duration');
    }
    $quality = $request->GetPost('quality');
    $slug = $request->GetPost('slug');
    $categorie = $request->GetPost('categorie');
    $sessionmodel = new \App\Models\SessionModel();
    $ip = $sessionmodel->durations_streams($user['id'],$slug,$categorie,$duration,$quality);
  }else{
    echo "403";
  }
}else{
  echo "401";
}
