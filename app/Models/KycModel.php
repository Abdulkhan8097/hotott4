<?php namespace App\Models;

use CodeIgniter\Model;

class KycModel extends Model {

    protected $table = 'kyc';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'user_id','aadhar_card_front', 'aadhar_card_back', 'pan', 'driving_license', 'voter_card', 'electric_bill', 'passport', 'created_on'];
    protected $db ;
      
    function __construct() {      
        parent::__construct();
       $this->db = \Config\Database::connect();
    }

    public function getData($searchArray = array(), $offset = '', $limit = '', $coutOnly = '') {
        if ($coutOnly) {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        } else {
            $sql = "SELECT ad.*,U.username FROM $this->table AS ad ";
        }
        $sql .= " LEFT JOIN users as U ON (ad.user_id = U.id) ";

        $sql .= " ";
        $sql .= " WHERE 1 ";
        if (isset($searchArray['txtsearch']) && $searchArray['txtsearch']) {
            $sql .= " AND (U.username LIKE '" . $searchArray['txtsearch'] . "%' ) ";
            //$sql .= " OR ad.city_arb_name LIKE '" . $searchArray['txtsearch'] . "%' ) ";
        }
        
        if (isset($searchArray['id']) && $searchArray['id']) {
            $sql .= " AND ad.id = '" . $searchArray['id'] . "' ";
        }
       
        $sql .= " ORDER BY ad.$this->primaryKey DESC";
        

        if ($limit) {
            $sql .= " LIMIT $offset,$limit";
        }

        $query = $this->db->query($sql);
        $result = $query->getResult();

        if ($coutOnly) {
            return $result[0]->total_count;
        }

        return $result;
    }

    public function getUserDetails($user_id) {
        $arrResult =  $this->asArray()
                        ->where(['user_id' => $user_id])
                        ->findAll();
        
        return isset($arrResult[0]) ? $arrResult[0] : array();
    }
}

?>