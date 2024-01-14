
<?php $db = \Config\Database::connect();
$request = \Config\Services::request(); ?>
<?php
$sessionmodel = new \App\Models\SessionModel();
if (session('isLoggedIn')) {
	$user = $sessionmodel->user(session('userData.id'));
	$permissions = $sessionmodel->permission($user['grade']);
}else{
	$user = "0";
	$permissions = "0";
}

$data = [
	'title'  => "Erreur 404",
	'description' => "Cette page n'a pas l'air d'exister !",
	'image' => '',
	'content' => 'errors/404',
	'user' => $user,
	'sessionmodel' => new \App\Models\SessionModel(),
	'permissions' => $permissions
];
view('layouts/head', $data);
echo view('layouts/default', $data); ?>
