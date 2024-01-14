<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use Models\SessionModel;
use CodeIgniter\Database\ConnectionInterface;

class Auth extends BaseController
{
	protected $session;

	public function __construct(){
		// start session
		$this->session = Services::session();
		helper(['form', 'url', 'text']);
	}

	public function register(){
		$sessionmodel = new \App\Models\SessionModel();
		$db = \Config\Database::connect();
		$data = [
        'title'  => 'Inscription',
        'description' => "Découvrez dès aujourd'hui tout ce que oStream peut vous proposer.",
        'image' => '',
		'twemoji' => false,
		'adsense' => false,
				'locale' => $this->request->getLocale(),
        'content' => 'auth/register',
				'user' => $sessionmodel->user(session('userData.id'))
    ];
		if (!session('isLoggedIn')) {
		  echo view('layouts/default', $data);
	  }else{
			return redirect()->to('dashboard');
		}
	}

	public function login(){
		$sessionmodel = new \App\Models\SessionModel();

		$db = \Config\Database::connect();
		$data = [
        'title'  => 'Connexion',
        'description' => "Connectez-vous à votre compte oStream.",
        'image' => '',
		'twemoji' => false,
		'adsense' => false,
				'locale' => $this->request->getLocale(),
        'content' => 'auth/login',
				'user' => $sessionmodel->user(session('userData.id'))
    ];
		if (!session('isLoggedIn')) {
		  echo view('layouts/default', $data);
	  }else{
			return redirect()->to('dashboard');
		}
	}

	public function register_post(){
		$db = \Config\Database::connect();
		$sessionmodel = new \App\Models\SessionModel();
		// validate request
		$rules = [
		  'pseudo' 	=> 'required|min_length[3]|is_unique[user.pseudo]',
			'email'		=> 'required|valid_email|is_unique[user.email]',
			'password' 	=> 'required|min_length[6]',
			'password2' 	=> 'required|matches[password]',
			'checkbox' 	=> 'required',
		];

		if (!$this->validate($rules)) {
			return redirect()->to('register')->withInput()->with('errors', $this->validator->getErrors());
		}else{
			$builder = $db->table('user');
			$builder->where('email', strip_tags($this->request->getVar('email')));
			$verify__user_exist = $builder->countAllResults();
			if($verify__user_exist == 0){ // Verif si le compte pas existe
				$pseudo_check = $sessionmodel->security(strip_tags($this->request->getVar('pseudo')));
				if (preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', $pseudo_check)){
					return redirect()->to('register')->withInput()->with('error', 'Vous utilisez des caractères interdit. Veuillez changer votre pseudo.');
				}else{
					//$builder = $db->table('security__vericiation');
          //$builder->where('id', strip_tags($this->request->getVar('verification__devtime2'));
          //$query = $builder->get();
          //foreach ($query->getResult() as $row){
					//if($row->response == strip_tags($this->request->getVar('verification__devtime')){
						$email_domain = preg_replace('/^[^@]++@/', '', strip_tags($this->request->getVar('email')));
						if ((bool) checkdnsrr($email_domain, 'MX')==FALSE){
			      	return redirect()->to('register')->withInput()->with('error', 'Une erreur est survenue. #EMAIL01');
			      }else{
							if(strip_tags($this->request->getVar('parrain'))){
								$builder_user_check = $db->table('user');
								$builder_user_check->where('id', strip_tags($this->request->getVar('parrain')));
								$verify__user_exist = $builder_user_check->countAllResults();
								if($verify__user_exist == 1){
									$parrain_id = strip_tags($this->request->getVar('parrain'));
								}else{
									$parrain_id = "";
								}
							}else{
								$parrain_id = "";
							}
			           	$builder = $db->table('user');
									$tag_gen1 = rand(1,9999);
									$genere_code = rand(1,9999)."-".rand(1,9999)."-".rand(1,9999)."-".rand(1,9999);
									if(strlen($tag_gen1) < 1){
									   $tag_genere = "000".$tag_gen1;
									}elseif(strlen($tag_gen1) < 2){
									   $tag_genere = "00".$tag_gen1;
									}elseif(strlen($tag_gen1) < 0){
									   $tag_genere = "0".$tag_gen1;
									}else{
									   $tag_genere = $tag_gen1;
									}

			           	$data = [
			           		'pseudo' => $sessionmodel->security(strip_tags($this->request->getVar('pseudo'))),
				           	'tag' => '#'.$tag_genere,
			           		'password' => sha1(strip_tags($this->request->getVar('password'))),
			           		'email' => strip_tags($this->request->getVar('email')),
										'avatar' => "https://www.gravatar.com/avatar/".md5(strip_tags($this->request->getVar('email')))."?size=2048",
										'parrain' => $parrain_id,
										'ip' => $sessionmodel->get_ip(),
										'etat' => 1,
										'genere_code' => $genere_code,
			           	];
			           	$builder->insert($data);


									$email = \Config\Services::email();
						      $config['protocol'] = 'sendmail';
						      $config['mailPath'] = '/usr/sbin/sendmail';
						      $config['charset']  = 'utf-8';
						      $config['wordWrap'] = true;

						      $email->initialize($config);

						      $email->setFrom('admin@ostream.online', 'oStream');
						      $email->setTo(strip_tags($this->request->getVar('email')));

						      $email->setSubject('Bienvenue - oStream !');
						      $email->setMessage('Bonjour,
Merci de vous êtes inscrit sur oStream ! Pour cela, nous vous demandons de vérifier votre compte oStream.
Pour cela, il suffit de cliquer sur le lien suivant: '.base_url('auth/verify/'.$genere_code.'').'.
Cordialement,
L\'équipe oStream');

						      $email->send();


			           	return redirect()->to('login')->withInput()->with('success', "Inscription avec succès ! Validez votre compte oStream avec votre adresse email !");
						}
			  	//}else{
					//	return redirect()->to('register')->withInput()->with('error', 'La vérification est pas correcte !');
			  	//}
			  }
			}else{
				return redirect()->to('register')->withInput()->with('error', lang('Language.error__account_exist'));
			}
		}
	}



	public function preregister_post(){
		$db = \Config\Database::connect();
		$sessionmodel = new \App\Models\SessionModel();
		// validate request
		$rules = [
		  'pseudo' 	=> 'required|min_length[3]|is_unique[user.pseudo]',
			'email'		=> 'required|valid_email|is_unique[user.email]',
			'password' 	=> 'required|min_length[6]',
			'password2' 	=> 'required|matches[password]',
			'checkbox' 	=> 'required',
		];

		if (!$this->validate($rules)) {
			return redirect()->to('register')->withInput()->with('errors', $this->validator->getErrors());
		}else{
			$builder = $db->table('user');
			$builder->where('email', strip_tags($this->request->getVar('email')));
			$verify__user_exist = $builder->countAllResults();
			if($verify__user_exist == 0){ // Verif si le compte pas existe
				$pseudo_check = $sessionmodel->security(strip_tags($this->request->getVar('pseudo')));
				if (preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', $pseudo_check)){
					return redirect()->to('register')->withInput()->with('error', 'Vous utilisez des caractères interdit. Veuillez changer votre pseudo.');
				}else{
					//$builder = $db->table('security__vericiation');
          //$builder->where('id', strip_tags($this->request->getVar('verification__devtime2')));
          //$query = $builder->get();
          //foreach ($query->getResult() as $row){
					//if($row->response == strip_tags($this->request->getVar('verification__devtime'))){
						$email_domain = preg_replace('/^[^@]++@/', '', strip_tags($this->request->getVar('email')));
						if ((bool) checkdnsrr($email_domain, 'MX')==FALSE){
			      	return redirect()->to('/')->withInput()->with('error', 'Une erreur est survenue. #EMAIL01');
			      }else{
							if(strip_tags($this->request->getVar('parrain'))){
								$builder_user_check = $db->table('user');
								$builder_user_check->where('id', strip_tags($this->request->getVar('parrain')));
								$verify__user_exist = $builder_user_check->countAllResults();
								if($verify__user_exist == 1){
									$parrain_id = strip_tags($this->request->getVar('parrain'));
								}else{
									$parrain_id = "";
								}
							}else{
								$parrain_id = "";
							}
							$builder = $db->table('user');
							$tag_gen1 = rand(1,9999);
							$genere_code = rand(1,9999)."-".rand(1,9999)."-".rand(1,9999)."-".rand(1,9999);
							if(strlen($tag_gen1) < 1){
								 $tag_genere = "000".$tag_gen1;
							}elseif(strlen($tag_gen1) < 2){
								 $tag_genere = "00".$tag_gen1;
							}elseif(strlen($tag_gen1) < 0){
								 $tag_genere = "0".$tag_gen1;
							}else{
								 $tag_genere = $tag_gen1;
							}

							$data = [
								'pseudo' => $sessionmodel->security(strip_tags($this->request->getVar('pseudo'))),
								'tag' => '#'.$tag_genere,
								'password' => sha1(strip_tags($this->request->getVar('password'))),
								'email' => strip_tags($this->request->getVar('email')),
								'avatar' => "https://www.gravatar.com/avatar/".md5(strip_tags($this->request->getVar('email')))."?size=2048",
								'parrain' => $parrain_id,
								'ip' => $sessionmodel->get_ip(),
								'etat' => 1,
								'genere_code' => $genere_code,
							];
							$builder->insert($data);


							$email = \Config\Services::email();
							$config['protocol'] = 'sendmail';
							$config['mailPath'] = '/usr/sbin/sendmail';
							$config['charset']  = 'utf-8';
							$config['wordWrap'] = true;

							$email->initialize($config);

							$email->setFrom('admin@ostream.online', 'oStream');
							$email->setTo(strip_tags($this->request->getVar('email')));

							$email->setSubject('Bienvenue - oStream !');
							$email->setMessage('Bonjour,
Merci de vous êtes inscrit sur oStream ! Pour cela, nous vous demandons de vérifier votre compte oStream.
Pour cela, il suffit de cliquer sur le lien suivant: '.base_url('auth/verify/'.$genere_code.'').'.
Cordialement,
L\'équipe oStream');

							$email->send();


							return redirect()->to('login')->withInput()->with('success', "Inscription avec succès ! Validez votre compte oStream avec votre adresse email !");
						}
			  	//}else{
					//	return redirect()->to('register')->withInput()->with('error', 'La vérification est pas correcte !');
			  	//}
			  }
			}else{
				return redirect()->to('register')->withInput()->with('error', lang('Language.error__account_exist'));
			}
		}
	}

	public function forgot_post(){
		$db = \Config\Database::connect();
		$sessionmodel = new \App\Models\SessionModel();
		// validate request
		$rules = [
			'devtime__email_forgot'		=> 'required|valid_email',
		];

		if (!$this->validate($rules)) {
			return redirect()->to('login')->withInput()->with('errors', $this->validator->getErrors());
		}else{
	   	// check credentials
			$builder = $db->table('user');
			$builder->where('email', strip_tags($this->request->getVar('devtime__email_forgot')));
			$verify__user_exist = $builder->countAllResults();
			if($verify__user_exist == 1){ // Verif si le compte pas existe
				$builder = $db->table('user');
				$code = "DVTME8-".rand(1,9999)."-".rand(1,9999)."-".rand(1,9999)."-PWD";
				$builder->set('password', sha1($code));
				$builder->where('email', strip_tags($this->request->getVar('devtime__email_forgot')));
				$builder->update();

				$email = \Config\Services::email();
	      $config['protocol'] = 'sendmail';
	      $config['mailPath'] = '/usr/sbin/sendmail';
	      $config['charset']  = 'utf-8';
	      $config['wordWrap'] = true;

	      $email->initialize($config);

	      $email->setFrom('admin@ostream.online', 'oStream');
	      $email->setTo(strip_tags($this->request->getVar('devtime__email_forgot')));

	      $email->setSubject('Mot de passe oublié - oStream !');
	      $email->setMessage('Bonjour,
	Voici votre nouveau mot de passe pour accéder a votre compte oStream.
	'.$code);

	      $email->send();



				return redirect()->to('login')->withInput()->with('success', "Un email à été envoyé avec votre nouveau mot de passe");
			}else{
				return redirect()->to('login')->withInput()->with('error', "Oups... On dirait que l'email n'existe pas.");
			}
	   }
	}

	public function verify($key){
		$db = \Config\Database::connect();
		$sessionmodel = new \App\Models\SessionModel();

	   	// check credentials
			$builder = $db->table('user');
			$builder->where('genere_code', strip_tags($key));
			$verify__user_exist = $builder->countAllResults();
			if($verify__user_exist == 1){ // Verif si le compte pas existe
				$builder = $db->table('user');
				$builder->set('genere_code', "");
				$builder->set('etat', 0);
				$builder->where('genere_code', strip_tags($key));
				$builder->update();

				return redirect()->to('login')->withInput()->with('success', "Email validé avec succès !");
			}else{
				return redirect()->to('login')->withInput()->with('error', "Oups... On dirait que le code n'existe pas.");
			}

	}

	public function logout(){
		$this->session->remove(['isLoggedIn', 'userData','token','token_secret','request_vars']);

		return redirect()->to('login');
	}

	//--------------------------------------------------------------------

}
