<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use CodeIgniter\Database\ConnectionInterface;

class Live extends BaseController{

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

	public function index($id = FALSE){
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();
		$categories = $sessionmodel->categories($id);
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
			$premium_user_info = $sessionmodel->premium_user_info($user['premium']);
  	}else{
			$user = null;
			$permissions = null;
			$premium_user_info = null;
		}
		if(empty($categories) && empty($id)){
			  $data = [
	          'title'  => "Lives",
	          'description' => "Découvrez tout nos lives",
	          'image' => "",
			  		'locale' => $this->request->getLocale(),
	          'content' => 'live/list',
			  		'user' => $sessionmodel->user(session('userData.id')),
						'sessionmodel' => new \App\Models\SessionModel(),
				  	'permissions' => $permissions,
						'premium_user_info' => $premium_user_info
	      ];
			  echo view('layouts/default', $data);
		}elseif(empty($categories) && !empty($id)){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}else{
		  $data = [
				  'categories' => $sessionmodel->categories($id),
          'title'  => $categories['name'],
          'description' => "Retrouvez les streams de ".$categories['name'],
          'image' => $categories['image'],
		  		'locale' => $this->request->getLocale(),
          'content' => 'live/categorie',
		  		'user' => $sessionmodel->user(session('userData.id')),
					'sessionmodel' => new \App\Models\SessionModel(),
			  	'permissions' => $permissions,
					'premium_user_info' => $premium_user_info
      ];
		  echo view('layouts/default', $data);
	  }
	}

	public function live($id = FALSE){
		header("Access-Control-Allow-Origin: *");
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();
		$streams = $sessionmodel->streams($id);
		if (session('isLoggedIn')) {
			$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
			$premium_user_info = $sessionmodel->premium_user_info($user['premium']);
  	}else{
			$user = null;
			$permissions = null;
			$premium_user_info = null;
		}
		if(empty($streams)){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}else{
		  $data = [
				  'streams' => $sessionmodel->streams($id),
					'categories' => $sessionmodel->categories_id($streams['id_categorie']),
          'title'  => $streams['titre'],
          'description' => $streams['description'],
          'image' => "",
		  		'locale' => $this->request->getLocale(),
          'content' => 'live/live',
		  		'user' => $sessionmodel->user(session('userData.id')),
					'sessionmodel' => new \App\Models\SessionModel(),
			  	'permissions' => $permissions,
					'premium_user_info' => $premium_user_info
      ];
		  echo view('layouts/default', $data);
	  }
	}
	//--------------------------------------------------------------------

}
