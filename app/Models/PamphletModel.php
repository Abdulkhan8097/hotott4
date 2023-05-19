<?php namespace App\Models;

use CodeIgniter\Model;

class PamphletModel extends Model {

    protected $table = 'tbl_pamphlet';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'pamphlet_name','Pamphlet_doc', 'status', 'created'];
    protected $db ;
      
    function __construct() {      
        parent::__construct();
       $this->db = \Config\Database::connect();
    }

    function getData() {
        $arrResult =  $this->asArray()
                        ->get();
        
        $arrObj = $arrResult->getResultArray();

        return isset($arrObj[0]) ? $arrObj[0] : array();
    }
}

?>