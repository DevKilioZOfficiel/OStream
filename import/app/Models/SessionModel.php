<?php namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model{

  public function security($value){
    return strip_tags($value);
  }

  public function paragrapher($textarea){
    $textarea = str_replace("\r", '', $textarea);
    $textarea = preg_replace("'^(\n){1,}|(\n){1,}$'", '', $textarea);
    $textarea = preg_replace("'(\n){3,}|(\n){3,}'", "\n\n", $textarea);
    $textarea = str_replace("\n\n", '</p><p>', $textarea);
    $textarea = str_replace("\n", '<br />', $textarea);
    return $textarea;
  }

  public function get_ip() {
	// IP si internet partagé
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		}
	// IP derrière un proxy
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $example = preg_replace('/,(.*)/', '', $_SERVER['HTTP_X_FORWARDED_FOR']);
			return $example;
		}
	// Sinon : IP normale
		else {
			return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
		}
	}

  public function user($session_user) {
    $db = \Config\Database::connect();
    $builder = $db->query("SELECT * FROM user WHERE id ='".$session_user."'");
    return $builder->getRowArray();
	}
  public function maintenance_mode($session_user) {
    $db = \Config\Database::connect();
    $builder = $db->query("SELECT * FROM maintenance_mode WHERE id ='".$session_user."'");
    return $builder->getRowArray();
  }
  public function premium_user_info($session_user) {
    $db = \Config\Database::connect();
    $builder = $db->query("SELECT * FROM premium WHERE id ='".$session_user."'");
    return $builder->getRowArray();
	}

  public function invoices($slug = FALSE){
    $db = \Config\Database::connect();
    $builder = $db->query("SELECT * FROM invoices WHERE id ='".$slug."'");
    return $builder->getRowArray();
  }

  public function permission($session_grade) {
    $db = \Config\Database::connect();
    $builder = $db->query("SELECT * FROM permissions WHERE id_grade ='".$session_grade."'");
    return $builder->getRowArray();
	}

  public function categories($slug){
    $db = \Config\Database::connect();
    $builder = $db->query("SELECT * FROM 	categories WHERE slug ='".$slug."'");
    return $builder->getRowArray();
  }

  public function categories_id($slug){
    $db = \Config\Database::connect();
    $builder = $db->query("SELECT * FROM 	categories WHERE id ='".$slug."'");
    return $builder->getRowArray();
  }

  public function streams_categorie($id_categorie){
    $db = \Config\Database::connect();
    $builder = $db->query("SELECT * FROM 	list WHERE id_categorie ='".$id_categorie."'");
    return $builder->getRowArray();
  }
  public function streams($slug){
    $db = \Config\Database::connect();
    $builder = $db->query("SELECT * FROM 	list WHERE slug ='".$slug."'");
    return $builder->getRowArray();
  }

  public function Statistiques_vues($url,$ip,$agent,$agent_version,$platform,$robot,$referer,$agent_string,$ads,$country,$city) {
    $sessionmodel = new \App\Models\SessionModel();
    $db = \Config\Database::connect();
		helper('url');

      $builder__add_view = $db->table('views');
      $data_view = [
        'url' => $url,
        'ip'  => $ip,
        'agent' => $agent,
        'platform' => $platform,
        'version' => $agent_version,
        'robot' => $robot,
        'referrer' => $referer,
        'agent_string' => "".$agent_string."",
        'date_petit' => "".date('Y')."-".date('m')."",
        'country_code' => $country,
        'mois' => date('m'),
        'jour' => date('d'),
        'annee' => date('Y'),
        'ads' => $ads,
        'city' => $city
      ];
      $builder__add_view->insert($data_view);
	}

  public function durations_streams($user,$slug,$categorie,$duration,$quality) {
    $sessionmodel = new \App\Models\SessionModel();
    $db = \Config\Database::connect();
		helper('url');

      $builder__add_view = $db->table('durations_streams');
      $data_view = [
        'user' => $user,
        'slug' => $slug,
        'categorie' => $categorie,
        'duration' => $duration,
        'quality' => $quality,
        'mois' => date('m'),
        'jour' => date('d'),
        'annee' => date('Y')
      ];
      $builder__add_view->insert($data_view);
	}
}
