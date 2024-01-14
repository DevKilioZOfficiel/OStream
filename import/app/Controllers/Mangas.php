<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use CodeIgniter\Database\ConnectionInterface;

class Mangas extends BaseController{

	protected $session;
	//protected $builder;


	public function __construct(){
		// start session
		$this->session = Services::session();
		helper(['form', 'url', 'text']);
		//$db = db_connect();
		//protected $db;
		//$this->db =& $db;
	}

	public function index(){
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
			$premium_user_info = $sessionmodel->premium_user_info($user['premium']);
  	}else{
			$user = null;
			$permissions = null;
			$premium_user_info = null;
		}
			  $data = [
	          'title'  => "Mangas et Animés",
	          'description' => "Découvrez tout nos mangas et animés",
	          'image' => "",
			  		'locale' => $this->request->getLocale(),
	          'content' => 'live/mangas',
			  		'user' => $sessionmodel->user(session('userData.id')),
						'sessionmodel' => new \App\Models\SessionModel(),
				  	'permissions' => $permissions,
						'premium_user_info' => $premium_user_info
	      ];
			  echo view('layouts/default', $data);

	}
}
