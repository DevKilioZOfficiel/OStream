<?php
$request = \Config\Services::request();
$sessionmodel = new \App\Models\SessionModel();
$session = \Config\Services::session();
$db = \Config\Database::connect();
if(empty($request->GetPost('key'))){
  echo "403";
}else{
$builder = $db->table('list');
$builder->where('on_air', 1);
$builder->where('stream_url', $request->GetPost('key'));
$verify_stream_key = $builder->countAllResults();
if($verify_stream_key == 1){
  $builder2 = $db->table('list');
  $builder2->where('stream_url', $request->GetPost('key'));
  $query = $builder2->get();
  foreach ($query->getResult() as $row){
    $builder3 = $db->table('list');
    $builder3->set('on_air', 0);
    $builder3->where('stream_url', $request->GetPost('key'));
    $builder3->update();
    echo "200";
  }
}else{
  echo "403";
}
}
?>
