<?php namespace App\Models;

use CodeIgniter\Model;

class BrochureModel extends Model {

    protected $table = 'brochure';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'brochure_name','file_name', 'status', 'created'];
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