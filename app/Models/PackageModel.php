<?php

namespace App\Models;
use CodeIgniter\Model;

class PackageModel extends Model {

    protected $table = 'package';
    protected $primaryKey = 'package_id';

    protected $allowedFields = ['package_id', 'package_name', 'amount', 'entry_datetime', 'update_datetime', 'capping', 'stock'];
    

}

?>
