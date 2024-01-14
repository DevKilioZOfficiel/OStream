<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use Models\SessionModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\HTTP\Files\UploadedFile;

class Invoices extends BaseController{

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
		$agent0 = $this->request->getUserAgent();
		if ($agent0->isBrowser()){
			$agent = $agent0->getBrowser().' '.$agent0->getVersion();
		}elseif ($agent0->isRobot()){
			$robot = $agent0->getRobot();
		}elseif ($agent0->isMobile()){
			$agent = $agent0->getMobile();
		}else{
			$agent = 'Unidentified User Agent';
		}
		if ($agent0->isRobot()){
			$robot = $agent0->getRobot();
		}else{
			$robot = "0";
		}
		if ($agent0->isReferral()){
			$referer = $agent0->getReferrer();
		}else{
			$referer = "none";
		}
		$agent_version = $agent0->getVersion();
		$platform = $agent0->getPlatform();
		$agent_string = $agent0->getAgentString();
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();

		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
  	}else{
			$permissions = "0";
		}
		$data = [
        'title'  => 'Paramètres',
        'description' => '',
        'image' => '',
		'twemoji' => false,
		'adsense' => false,
				'locale' => $this->request->getLocale(),
        'content' => 'invoices/index',
				'user' => $sessionmodel->user(session('userData.id')),
				'request' => \Config\Services::request(),
				'permissions' => $sessionmodel->permission($user['grade'])
    ];
		if (!session('isLoggedIn')) {
			return redirect()->to(base_url('login'))->withInput()->with('error', lang('Language.error__no_connected'));
		}else{
			$sessionmodel->Statistiques_vues(base_url('/'.$data['content']),$sessionmodel->get_ip(),$agent,$agent_version,$platform,$robot,$referer,$agent_string);
		  echo view('layouts/default__dashboard', $data);
	  }
	}

	public function store(){
		$agent0 = $this->request->getUserAgent();
		if ($agent0->isBrowser()){
			$agent = $agent0->getBrowser().' '.$agent0->getVersion();
		}elseif ($agent0->isRobot()){
			$robot = $agent0->getRobot();
		}elseif ($agent0->isMobile()){
			$agent = $agent0->getMobile();
		}else{
			$agent = 'Unidentified User Agent';
		}
		if ($agent0->isRobot()){
			$robot = $agent0->getRobot();
		}else{
			$robot = "0";
		}
		if ($agent0->isReferral()){
			$referer = $agent0->getReferrer();
		}else{
			$referer = "none";
		}
		$agent_version = $agent0->getVersion();
		$platform = $agent0->getPlatform();
		$agent_string = $agent0->getAgentString();
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();

		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
  	}else{
			$permissions = "0";
		}
		$data = [
        'title'  => 'Factures Dev-Time Store',
        'description' => '',
        'image' => '',
				'locale' => $this->request->getLocale(),
		    'twemoji' => false,
		'adsense' => true,
        'content' => 'invoices/store',
				'user' => $sessionmodel->user(session('userData.id')),
				'request' => \Config\Services::request(),
				'permissions' => $sessionmodel->permission($user['grade'])
    ];
		if (!session('isLoggedIn')) {
			return redirect()->to(base_url('login'))->withInput()->with('error', lang('Language.error__no_connected'));
		}else{
			$sessionmodel->Statistiques_vues(base_url('/'.$data['content']),$sessionmodel->get_ip(),$agent,$agent_version,$platform,$robot,$referer,$agent_string);
		  echo view('layouts/default__dashboard', $data);
	  }
	}

	public function invoice($id = FALSE){
		$agent0 = $this->request->getUserAgent();
		if ($agent0->isBrowser()){
			$agent = $agent0->getBrowser().' '.$agent0->getVersion();
		}elseif ($agent0->isRobot()){
			$robot = $agent0->getRobot();
		}elseif ($agent0->isMobile()){
			$agent = $agent0->getMobile();
		}else{
			$agent = 'Unidentified User Agent';
		}
		if ($agent0->isRobot()){
			$robot = $agent0->getRobot();
		}else{
			$robot = "0";
		}
		if ($agent0->isReferral()){
			$referer = $agent0->getReferrer();
		}else{
			$referer = "none";
		}
		$agent_version = $agent0->getVersion();
		$platform = $agent0->getPlatform();
		$agent_string = $agent0->getAgentString();
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();
		$data = [
        'title'  => 'Paramètres',
        'description' => '',
        'image' => '',
				'locale' => $this->request->getLocale(),
		    'twemoji' => false,
        'content' => 'invoices/index',
				'user' => $sessionmodel->user(session('userData.id')),
				'request' => \Config\Services::request()
    ];
		if (!session('isLoggedIn')) {
			return redirect()->to(base_url('login'))->withInput()->with('error', lang('Language.error__no_connected'));
		}else{
			$sessionmodel->Statistiques_vues(base_url('/'.$data['content']),$sessionmodel->get_ip(),$agent,$agent_version,$platform,$robot,$referer,$agent_string);
		  echo view('layouts/default__dashboard', $data);
	  }
	}

	//--------------------------------------------------------------------

}
