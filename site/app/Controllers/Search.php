<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\HTTP\UserAgent;

class Search extends BaseController{

	protected $session;
	//protected $builder;


	public function __construct(){
		// start session
		$this->session = Services::session();
		helper(['form', 'url']);
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
        'title'  => 'Recherche',
        'description' => 'Recherchez ce dont vous souhaitez. Que ce soit, un film, un live, une série, un animé.',
        'image' => '',
				'locale' => $this->request->getLocale(),
        'content' => 'search/index',
				'user' => $sessionmodel->user(session('userData.id')),
				'permissions' => $permissions,
				'premium_user_info' => $premium_user_info
    ];
		echo view('layouts/default', $data);

	}
}
