<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use Models\SessionModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\HTTP\Files\UploadedFile;

class Dashboard extends BaseController{

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

			$builder = $db->table('user__share');
			$builder->where('email', $user['email']);
			$query = $builder->get();
			foreach ($query->getResult() as $row) {
				if(isset($_POST['account_'.$row->id])){
					$builder = $db->table('user');
					$builder->where('id', $row->user);
					$query = $builder->get();
					foreach ($query->getResult() as $row_user) {
					$this->session->set('userParrain', [
						 'id' => $user['id']
					]);
					$this->session->remove(['userData']);
					$this->session->set('userData', [
						 'id' => $row_user->id
					]);
					}
				}
			}
			if(!empty($_GET['primaryaccount']) && session('userParrain.id')){
				$this->session->set('userData', [
					 'id' => session('userParrain.id')
				]);
				$this->session->remove(['userParrain']);
				redirect()->to(base_url('dashboard'));
			}
  	}else{
			$user = "0";
			$permissions = "0";
			return redirect()->to(base_url('login'))->withInput()->with('error', lang('Language.error__no_connected'));
		}
		$data = [
        'title'  => 'Dashboard',
        'description' => '',
        'image' => '',
				'locale' => $this->request->getLocale(),
        'content' => 'dashboard/index',
				'user' => $sessionmodel->user(session('userData.id')),
				'request' => \Config\Services::request(),
				'permissions' => $sessionmodel->permission($user['grade']),
				'premium_user_info' => $sessionmodel->premium_user_info($user['premium']),
				'session' => Services::session()
    ];
		if (!session('isLoggedIn')) {
			return redirect()->to(base_url('login'))->withInput()->with('error', lang('Language.error__no_connected'));
		}else{
		  echo view('layouts/default', $data);
	  }
	}

	//--------------------------------------------------------------------

}
