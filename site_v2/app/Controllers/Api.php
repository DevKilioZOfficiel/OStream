<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use Models\SessionModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\HTTP\Files\UploadedFile;

class Api extends BaseController{

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

	public function index($page = FALSE, $token = FALSE){
		helper(['form', 'url', 'text']);
		$ref = $token;
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
  	}else{
			$user = 0;
			$permissions = 0;
		}
		if (!is_file(APPPATH.'/Views/api/'.$page.'.php')){
			return redirect()->to(base_url())->withInput()->with('error', lang('Language.error__page_not_found'));
		}else{
		  $data = [
		  		'locale' => $this->request->getLocale(),
		  		'user' => $sessionmodel->user(session('userData.id')),
		  		'permission' => $permissions,
					'ref' => $ref,
					'request' => \Config\Services::request()
      ];
			echo view('api/'.$page, $data);
	  }
	}

	//--------------------------------------------------------------------

}
