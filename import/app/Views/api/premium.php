<?php
$db = \Config\Database::connect();
$request = \Config\Services::request();

$builder = $db->table('user');
$builder->where('premium !=', 0);
$query = $builder->get();
foreach ($query->getResult() as $key => $row) {
if($row->premium_expiration < time()){
    echo $row->pseudo;

    $builder_solde = $db->table('user');
    $builder_solde->set('premium', "0");
    $builder_solde->set('premium_expiration', "0");
    $builder_solde->where('id', $row->id);
    $builder_solde->update();
}
} ?>
