<?php

namespace App\Models;
use CodeIgniter\Model;

class BounceModel extends Model {

    protected $table = 'tbl_bounce';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'b_type', 'amount', 'created_date', 'update_date'];
    

}

?>
