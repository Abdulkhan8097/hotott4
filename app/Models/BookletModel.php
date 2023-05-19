<?php namespace App\Models;

use CodeIgniter\Model;

class BookletModel extends Model {

    protected $table = 'booklet';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'booklet_name','file_name', 'status', 'created'];
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