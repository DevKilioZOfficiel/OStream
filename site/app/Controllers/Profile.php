<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use CodeIgniter\Database\ConnectionInterface;

class Profile extends BaseController{

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

	public function index($user1 = FALSE){
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();
		$info_user = $sessionmodel->user($user1);
		if (session('isLoggedIn')) {
			$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
			$premium_user_info = $sessionmodel->premium_user_info($user['premium']);
		}else{
			$user = null;
			$permissions = null;
			$premium_user_info = null;
		}
		if(!empty($info_user)){
		$info_user__premium = $sessionmodel->premium_user_info($info_user['premium']);
		$info_user__permissions = $sessionmodel->permission($info_user['grade']);

		$data = [
				'title'  => $info_user['pseudo'].''.$info_user['tag'],
				'description' => 'Le compte de '.$info_user['pseudo'].''.$info_user['tag'].' sur OStream',
				'image' => $info_user['avatar'],
				'locale' => $this->request->getLocale(),
				'content' => 'profile/index',
				'user' => $sessionmodel->user(session('userData.id')),
				'permissions' => $permissions,
				'info_user' => $info_user,
				'info_user__permissions' => $info_user__permissions,
				'info_user__premium' => $info_user__premium,
				'premium_user_info' => $premium_user_info
		];
		echo view('layouts/default', $data);
		}
	}

	//--------------------------------------------------------------------

}
