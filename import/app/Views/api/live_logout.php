<?php
$request = \Config\Services::request();
$sessionmodel = new \App\Models\SessionModel();
$session = \Config\Services::session();
$db = \Config\Database::connect();
if(empty($request->GetPost('name'))){
  http_response_code(403);
	die();
}else{
$builder = $db->table('list');
$builder->where('on_air', 0);
$builder->where('stream_url', $request->GetPost('name'));
$verify_stream_key = $builder->countAllResults();
if($verify_stream_key == 1){
  $builder2 = $db->table('list');
  $builder2->where('stream_url', $request->GetPost('name'));
  $query = $builder2->get();
  foreach ($query->getResult() as $row){
    $builder3 = $db->table('list');
    $builder3->set('on_air', 1);
    $builder3->where('stream_url', $request->GetPost('name'));
    $builder3->update();
    http_response_code(200);
  }
}else{
  http_response_code(403);
	die();
}
}
?>
