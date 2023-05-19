<?php

namespace App\Models;
use CodeIgniter\Model;

class AwardModel extends Model {

    protected $table = 'award';
    protected $primaryKey = 'a_id';

    protected $allowedFields = ['a_id', 'a_name', 'title', 'description', 'duration', 'a_pin', 'price', 'status'];

       public function getData($searchArray = array(), $offset = '', $limit = '', $coutOnly = '') {
        if ($coutOnly) {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        } else {
            $sql = "SELECT ad.* FROM $this->table AS ad ";
        }
        $sql .= " ";
        $sql .= " WHERE 1 ";
        if (isset($searchArray['txtsearch']) && $searchArray['txtsearch']) {
            $sql .= " AND (ad.a_name LIKE '" . $searchArray['txtsearch'] . "%' ";
            $sql .= " OR ad.a_name LIKE '" . $searchArray['txtsearch'] . "%' ) ";
        }
        
        if (isset($searchArray['id']) && $searchArray['id']) {
            $sql .= " AND ad.a_id = '" . $searchArray['id'] . "' ";
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

    public function getClaimedData($searchArray = array(), $offset = '', $limit = '', $coutOnly = '') {
        if ($coutOnly) {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        } else {
            $sql = "SELECT ad.*,ofc.* FROM $this->table AS ad ";
        }
        $sql .= " LEFT JOIN offer_claim as ofc ON (ad.a_id = ofc.award_id) ";
        $sql .= " WHERE 1 ";
        if (isset($searchArray['txtsearch']) && $searchArray['txtsearch']) {
            $sql .= " AND (ad.city_name LIKE '" . $searchArray['txtsearch'] . "%' ";
            $sql .= " OR ad.city_arb_name LIKE '" . $searchArray['txtsearch'] . "%' ) ";
        }
        
        if (isset($searchArray['id']) && $searchArray['id']) {
            $sql .= " AND ad.a_id = '" . $searchArray['id'] . "' ";
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
