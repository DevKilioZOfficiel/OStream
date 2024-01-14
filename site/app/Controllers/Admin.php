<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use Models\SessionModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Files\File;

class Admin extends BaseController{

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

	public function index($page = FALSE){
		helper(['form', 'url', 'text']);
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
  	}else{
		}
		if (!is_file(APPPATH.'/Views/admin/'.$page.'.php')){
			return redirect()->to(base_url())->withInput()->with('error', lang('Language.error__page_not_found'));
		}else{
			if($page == "add-newsletters"){
				if(isset($_POST['submit'])){

			    $from_email = "";
      		    $to_email = $this->request->GetPost('to_email');
			    //echo $to_email;
      		    $to_mail = explode(',', $to_email);
      		    $mail_count = count($to_mail);
      		    for($i=0;$i<$mail_count;$i++)
      		    {

$data['email_html'] = '';

      		       $mail_id = $to_mail[$i];

				   $email = \Config\Services::email();
				   $config_email['mailType'] = "html";
					 $email->initialize($config_email);

				   $email->setFrom('noreply@dev-time.eu', 'Dev-Time');
				   $email->setTo($mail_id);
				   //$this->email->cc('another@another-example.com');
				   //$this->email->bcc('them@their-example.com');

				   $email->setSubject($this->request->GetPost('title'));
				   $email->setMessage($data['email_html']);

				   $email->send();
     		        //$this->email->clear();
    		    }

		  		$data['count__emails'] = $mail_count;

		  	}
			}



			if($permissions['is_admin'] == 1){
				if($page == "render__newsletters"){
					echo view('admin/render__newsletters');
				}elseif($page == "render__servers"){
					echo view('admin/render__servers');
				}elseif($page == "render__stats"){
					echo view('admin/render__stats');
				}else{
		      $data = [
			    	'title'  => 'Administration',
			    	'description' => '',
			    	'image' => '',
			    	'locale' => $this->request->getLocale(),
			    	'content' => 'admin/'.$page.'',
			    	'user' => $sessionmodel->user(session('userData.id')),
			    	'permissions' => $sessionmodel->permission($user['grade'])
          ];
			    echo view('layouts/default_admin', $data);
			  }
			}else{
				return redirect()->to(base_url('/dashboard'))->withInput()->with('error', lang('Language.error__page_not_found'));
			}
	  }
	}

	public function user($user0 = FALSE){
	$sessionmodel = new \App\Models\SessionModel();
		$info_user = $sessionmodel->user($user0);
		helper(['form', 'url', 'text']);
	  $db = \Config\Database::connect();
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
			$permission = $sessionmodel->permission($info_user['grade']);
  	}else{
		}
		if(empty($info_user)){
			//return redirect()->to(base_url())->withInput()->with('error', lang('Language.error__page_not_found'));
		}else{
			if($permissions['is_admin'] == 1){
		    $data = [
			  	'title'  => 'Administration',
			  	'description' => '',
			  	'image' => '',
			  	'locale' => $this->request->getLocale(),
					'info_user' => $sessionmodel->user($user0),
			  	'user' => $sessionmodel->user(session('userData.id')),
			  	'permissions' => $sessionmodel->permission($user['grade']),
					'permission' => $permission,
			  	'content' => 'admin/user'
        ];

			  echo view('layouts/default_admin', $data);
			}else{
				return redirect()->to(base_url('/dashboard'))->withInput()->with('error', lang('Language.error__page_not_found'));
			}
	  }
	}

	public function live($id = FALSE){
	$sessionmodel = new \App\Models\SessionModel();
		$streams = $sessionmodel->streams($id);
		helper(['form', 'url', 'text']);
	  $db = \Config\Database::connect();
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
  	}else{
		}
		if(empty($streams)){
			//return redirect()->to(base_url())->withInput()->with('error', lang('Language.error__page_not_found'));
		}else{
			if($permissions['is_admin'] == 1){
		    $data = [
			  	'title'  => 'Administration',
			  	'description' => '',
			  	'image' => '',
			  	'locale' => $this->request->getLocale(),
					'streams' => $sessionmodel->streams($id),
			  	'user' => $sessionmodel->user(session('userData.id')),
			  	'permissions' => $sessionmodel->permission($user['grade']),
			  	'content' => 'admin/streaming'
        ];

			  echo view('layouts/default_admin', $data);
			}else{
				return redirect()->to(base_url('/dashboard'))->withInput()->with('error', lang('Language.error__page_not_found'));
			}
	  }
	}

	public function categorie($slug_categorie = FALSE){
	$sessionmodel = new \App\Models\SessionModel();
		$categorie = $sessionmodel->categories($slug_categorie);
		helper(['form', 'url', 'text']);
	  $db = \Config\Database::connect();
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
  	}else{
		}
		if(empty($categorie)){
			//return redirect()->to(base_url())->withInput()->with('error', lang('Language.error__page_not_found'));
		}else{
			if($permissions['is_admin'] == 1){
		    $data = [
			  	'title'  => 'Administration',
			  	'description' => '',
			  	'image' => '',
			  	'locale' => $this->request->getLocale(),
					'categorie' => $sessionmodel->categories($slug_categorie),
			  	'user' => $sessionmodel->user(session('userData.id')),
			  	'permissions' => $sessionmodel->permission($user['grade']),
			  	'content' => 'admin/categorie'
        ];

			  echo view('layouts/default_admin', $data);
			}else{
				return redirect()->to(base_url('/dashboard'))->withInput()->with('error', lang('Language.error__page_not_found'));
			}
	  }
	}

	public function import($page = FALSE){
		$sessionmodel = new \App\Models\SessionModel();
		$db = \Config\Database::connect();
		if($page === "new_categorie"){
			$request = \Config\Services::request();
			$data = [
					'locale' => $this->request->getLocale(),
					'user' => $sessionmodel->user(session('userData.id')),
					'request' => \Config\Services::request()
			];

			$input = [
				//'avatar'		=> 'required|uploaded[avatar]|mime_in[avatar,image/webp,image/png,image/jpg]',
				'zipfile' => 'ext_in[zipfile,png,jpg]'
			];
			if (!$this->validate($input)) {
				return redirect()->to('admincp/categories')->withInput()->with('errors', $this->validator->getErrors());
			}else{
				if(!$this->validator->getErrors('zipfile')){
					$img = $this->request->getFile('zipfile');
					$newName = $img->getRandomName();
					$img->move('./uploads/images/', $newName);

					$extension = $img->getClientExtension();

					$builder = $db->table('categories');

					if($request->GetPost('is_premium') == "on"){ $premium = 1; }else{ $premium = 0; }
					if($request->GetPost('trends') == "on"){ $trends = 1; }else{ $trends = 0; }
					if($request->GetPost('is_film') == "on"){ $is_film = 1; }else{ $is_film = 0; }
					if($request->GetPost('is_serie') == "on"){ $is_serie = 1; }else{ $is_serie = 0; }
					if($request->GetPost('is_live') == "on"){ $is_live = 1; }else{ $is_live = 0; }
					if($request->GetPost('is_manga') == "on"){ $is_manga = 1; }else{ $is_manga = 0; }

					$data = [
						'slug' => url_title($this->request->getPost('name'), '-', true),
						'name' => strip_tags($request->GetPost('name')),
						'image' => base_url('uploads/images/'.$newName.''),
						'is_premium' => $premium,
						'trends' => $trends,
						'is_film' => $is_film,
						'is_serie' => $is_serie,
						'is_live' => $is_live,
						'is_manga' => $is_manga
					];

					$builder->insert($data);
					return redirect()->to(base_url('admincp/categories'))->withInput()->with('success', 'La catégorie est créée avec succès.');
				}else{
					return redirect()->to(base_url('admincp/categories'))->withInput()->with('error', "Oups. Une erreur est survenue lors de l'importation du fichier.");
				}
			}

		}elseif($page === "new_live"){
			$request = \Config\Services::request();
			$data = [
					'locale' => $this->request->getLocale(),
					'user' => $sessionmodel->user(session('userData.id')),
					'request' => \Config\Services::request()
			];

			$input = [
				//'avatar'		=> 'required|uploaded[avatar]|mime_in[avatar,image/webp,image/png,image/jpg]',
				'zipfile' => 'ext_in[zipfile,png,jpg]'
			];
			if (!$this->validate($input)) {
				return redirect()->to('admincp/lives')->withInput()->with('errors', $this->validator->getErrors());
			}else{
				if(!$this->validator->getErrors('zipfile')){
					$img = $this->request->getFile('zipfile');
					$newName = $img->getRandomName();
					$img->move('./uploads/images/', $newName);

					$extension = $img->getClientExtension();

					$builder = $db->table('list');

					if($request->GetPost('is_premium') == "on"){ $premium = 1; }else{ $premium = 0; }

					$builder2 = $db->table('list');
					$count_total = $builder2->countAllResults()+1;
					$data = [
						'id_categorie' => $request->GetPost('id_categorie'),
						'is_premium' => $premium,
						'titre' => strip_tags($request->GetPost('titre')),
						'tags' => strip_tags($request->GetPost('tags')),
						'image' => base_url('uploads/images/'.$newName.''),
						'description' => htmlentities($request->GetPost('description')),
						'slug' => url_title($this->request->getPost('titre'), '-', true).'-'.$count_total,
						'server_id' => $request->GetPost('server_id'),
						'stream_url' => $request->GetPost('stream_url'),
						'stream_type' => $request->GetPost('stream_type'),
						'launch' => strtotime($request->GetPost('launch')),
						'end' => strtotime($request->GetPost('end'))
					];

					$builder->insert($data);
					return redirect()->to(base_url('admincp/lives'))->withInput()->with('success', 'Le live est créé avec succès.');
				}else{
					return redirect()->to(base_url('admincp/lives'))->withInput()->with('error', "Oups. Une erreur est survenue lors de l'importation du fichier.");
				}
			}

		}elseif($page === "user_avatar"){

		  $user = $sessionmodel->user(session('userData.id'));
			if(!empty($user)){
			$request = \Config\Services::request();
			$data = [
					'locale' => $this->request->getLocale(),
					'user' => $sessionmodel->user(session('userData.id')),
					'request' => \Config\Services::request()
			];

			$input = [
            'avatar' => [
                'label' => 'Avatar',
                'rules' => 'uploaded[avatar]'
                    . '|is_image[avatar]'
                    . '|mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[avatar,5000]'
                    . '|max_dims[avatar,1024,1024]',
            ],
        ];
			//$input = [
			//	'avatar'		=> 'ext_in[avatar,png,jpg]|max_size[avatar,5000]|max_dims[userfile,1024,1024]',
			//	//'zipfile' => 'ext_in[zipfile,png,jpg]'
			//];
			if(empty($this->request->getFile('avatar'))){
				return redirect()->to(base_url('dashboard'))->withInput()->with('error', "Il est obligatoire de mettre une image.");
			}else{
			if (!$this->validate($input)) {
				return redirect()->to('dashboard')->withInput()->with('errors', $this->validator->getErrors());
			}else{
				if(!$this->validator->getErrors('avatar')){
					$img = $this->request->getFile('avatar');
					$newName = $img->getRandomName();
					$img->move('./uploads/images/', $newName);

					$extension = $img->getClientExtension();

					$builder3 = $db->table('user');
          $builder3->set('avatar', base_url('uploads/images/'.$newName.''));
          $builder3->where('id', $user['id']);
          $builder3->update();

					return redirect()->to(base_url('dashboard'))->withInput()->with('success', 'L\'avatar est mis à jour avec succès !');
				}else{
					return redirect()->to(base_url('dashboard'))->withInput()->with('error', "Oups. Une erreur est survenue lors de l'importation de l'image.");
				}
			}
			}
		}else{
			return redirect()->to(base_url('login'));
		}

		}elseif($page === "categorie"){
			$request = \Config\Services::request();
			$categorie = $sessionmodel->categories($request->GetGet('id'));
			$data = [
					'locale' => $this->request->getLocale(),
					'user' => $sessionmodel->user(session('userData.id')),
					'request' => \Config\Services::request()
			];

			$input = [
				//'avatar'		=> 'required|uploaded[avatar]|mime_in[avatar,image/webp,image/png,image/jpg]',
				'zipfile' => 'ext_in[zipfile,png,jpg]'
			];
			if (!$this->validate($input)) {
				return redirect()->to('admincp/categorie/'.$categorie['slug'])->withInput()->with('errors', $this->validator->getErrors());
			}else{
				if(!$this->validator->getErrors('zipfile')){
					$img = $this->request->getFile('zipfile');
					$newName = $img->getRandomName();
					$img->move('./uploads/images/', $newName);

					$extension = $img->getClientExtension();

					$builder = $db->table('categories');
					$builder->set('image', base_url('uploads/images/'.$newName.''));
					$builder->where('id', $categorie['id']);
					$builder->update();
					return redirect()->to(base_url('admincp/categorie/'.$categorie['slug']))->withInput()->with('success', 'L\'image vient d\'être mise à jour !.');
				}else{
					return redirect()->to(base_url('admincp/categorie/'.$categorie['slug']))->withInput()->with('error', "Oups. Une erreur est survenue lors de l'importation du fichier.");
				}
			}
		}elseif($page === "streams"){
			$request = \Config\Services::request();
			$streams = $sessionmodel->streams($request->GetGet('id'));
			$data = [
					'locale' => $this->request->getLocale(),
					'user' => $sessionmodel->user(session('userData.id')),
					'request' => \Config\Services::request()
			];

			$input = [
				//'avatar'		=> 'required|uploaded[avatar]|mime_in[avatar,image/webp,image/png,image/jpg]',
				'zipfile' => 'ext_in[zipfile,png,jpg]'
			];
			if (!$this->validate($input)) {
				return redirect()->to('admincp/live/'.$streams['slug'])->withInput()->with('errors', $this->validator->getErrors());
			}else{
				if(!$this->validator->getErrors('zipfile')){
					$img = $this->request->getFile('zipfile');
					$newName = $img->getRandomName();
					$img->move('./uploads/images/', $newName);

					$extension = $img->getClientExtension();

					$builder = $db->table('list');
					$builder->set('image', base_url('uploads/images/'.$newName.''));
					$builder->where('id', $streams['id']);
					$builder->update();
					return redirect()->to(base_url('admincp/live/'.$streams['slug']))->withInput()->with('success', 'L\'image vient d\'être mise à jour !.');
				}else{
					return redirect()->to(base_url('admincp/live/'.$streams['slug']))->withInput()->with('error', "Oups. Une erreur est survenue lors de l'importation du fichier.");
				}
			}
		}
	}

	//--------------------------------------------------------------------

}
