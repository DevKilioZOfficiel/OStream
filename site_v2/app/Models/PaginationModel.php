<?php
namespace App\Models;
use CodeIgniter\Model;
class PaginationModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','title','images','promotion__resume','price'];
}
