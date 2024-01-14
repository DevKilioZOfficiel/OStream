<?php namespace App\Models;

use CodeIgniter\Model;

class PermissionsModel extends Model{


  public function get_permissions__list($id = FALSE) {
    $db = \Config\Database::connect();

    $builder = $db->table('permissions');
    $builder->select($id);
    return $builder->get()->getResultArray();
	}

  public function get_permissions__list2($name = FALSE, $id = FALSE){
    $db = \Config\Database::connect();

    $builder = $db->table('permissions');
    $builder->select($name);
    $builder->where('id', $id);
    return $builder->get()->getResultArray();
    }

}
