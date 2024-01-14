<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\HTTP\UserAgent;

class Connect extends BaseController{

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

	public function index($uid = FALSE){
		if (!is_file(APPPATH.'/Views/connect/'.$uid.'.php')){
			return redirect()->to(base_url())->withInput()->with('error', lang('Language.error__page_not_found'));
		}else{
		$sessionmodel = new \App\Models\SessionModel();
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
  	}else{
			return redirect()->to(base_url('login'))->withInput()->with('error', lang('Language.error__no_connected'));
		}

	  $db = \Config\Database::connect();

			$data = [
	        'title'  => 'Connexion externe',
	        'description' => '',
		      'twemoji' => false,
		      'adsense' => true,
	        'image' => '',
					'locale' => $this->request->getLocale(),
	        'content' => 'connect/'.$uid.'',
					'user' => $sessionmodel->user(session('userData.id')),
					'permissions' => $sessionmodel->permission($user['grade'])
	    ];
	  	echo view('layouts/default', $data);
		}

	//--------------------------------------------------------------------
  }

}
