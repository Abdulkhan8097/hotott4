<?php

namespace App\Models;
use CodeIgniter\Model;

class OfferClaimModel extends Model {

    protected $table = 'offer_claim';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'user_id', 'username', 'award_id', 'type', 'duration', 'offer_status', 'created_on'];

       public function getData($searchArray = array(), $offset = '', $limit = '', $coutOnly = '') {
        if ($coutOnly) {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        } else {
            $sql = "SELECT ad.*,A.*, R.*, U.* FROM $this->table AS ad ";
        }

        $sql .= " LEFT JOIN award as A ON (ad.award_id = A.a_id) ";
        $sql .= " LEFT JOIN reward as R ON (ad.reward_id = R.r_id) ";
        $sql .= " LEFT JOIN users as U ON (ad.username = U.username) ";

        $sql .= " ";
        $sql .= " WHERE 1 ";

        if (isset($searchArray['txtsearch']) && $searchArray['txtsearch']) {
            $sql .= " AND (A.a_name LIKE '" . $searchArray['txtsearch'] . "%' ";
            $sql .= " OR R.r_name LIKE '" . $searchArray['txtsearch'] . "%' ) ";
        }
        
        if (isset($searchArray['id']) && $searchArray['id']) {
            $sql .= " AND ad.id = '" . $searchArray['id'] . "' ";
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
    
    public function getLastData($searchArray = array(), $offset = '', $limit = '', $coutOnly = '') {
        if ($coutOnly) {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        } else {
            $sql = "SELECT ad.* FROM $this->table AS ad ";
        }
        $sql .= " WHERE 1 ";
        
        if (isset($searchArray['username']) && $searchArray['username']) {
            $sql .= " AND ad.username = '" . $searchArray['username'] . "' ";
        }
       
         $sql .= " ORDER BY ad.$this->primaryKey DESC";
       
        

        if ($limit) {
            $sql .= " LIMIT $offset,$limit";
        }

        $query = $this->db->query($sql);
        $result = $query->getRowArray();

        if ($coutOnly) {
            return $result[0]->total_count;
        }

        return $result;
    }

    

}

?>
