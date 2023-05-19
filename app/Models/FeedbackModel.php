<?php namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model {

    protected $table = 'feedback';
    protected $primaryKey = 'feedback_id';
    protected $allowedFields = ['feedback_id', 'user_id', 'username', 'feedback_title', 'feedback', 'feedback_status', 'created_on'];
    protected $db ;
      
    function __construct() {      
        parent::__construct();
       $this->db = \Config\Database::connect();
    }

    public function getData($searchArray = array(), $offset = '', $limit = '', $coutOnly = '') {
        if ($coutOnly) {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        } else {
            $sql = "SELECT ad.*,U.* FROM $this->table AS ad ";
        }

        $sql .= " LEFT JOIN users as U ON (ad.user_id = U.id) ";

        $sql .= " ";
        $sql .= " WHERE 1 ";

        if (isset($searchArray['txtsearch']) && $searchArray['txtsearch']) {
            $sql .= " AND (ad.feedback_title LIKE '" . $searchArray['txtsearch'] . "%' ";
            $sql .= " OR ad.feedback LIKE '" . $searchArray['txtsearch'] . "%' ";
            $sql .= " OR U.username LIKE '" . $searchArray['txtsearch'] . "%' ) ";
        }
        
        if (isset($searchArray['id']) && $searchArray['id']) {
            $sql .= " AND ad.feedback_id = '" . $searchArray['id'] . "' ";
        }

        if (isset($searchArray['userid']) && $searchArray['userid']) {
            $sql .= " AND ad.user_id = '" . $searchArray['userid'] . "' ";
        }
        
        if (isset($searchArray['sort_by']) && $searchArray['sort_by']=="arebic") {
            $sql .= " ORDER BY city_arb_name ASC";
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
}

?>