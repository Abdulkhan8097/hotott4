<?php
namespace App\Models;
use CodeIgniter\Model;

class linkUsedModel extends Model {

    protected $table = 'link_used';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'link_id', 'link_create_user', 'used_id', 'created'];
    public function getData($searchArray = array(), $offset = '', $limit = '', $coutOnly = '') {
        if ($coutOnly) {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        } else {
            $sql = "SELECT ad.* FROM $this->table AS ad ";
        }
        $sql .= " ";
        $sql .= " WHERE 1 ";
        if (isset($searchArray['txtsearch']) && $searchArray['txtsearch']) {
            $sql .= " AND (ad.links LIKE '" . $searchArray['txtsearch'] . "%' )";
          
        }
        
        if (isset($searchArray['id']) && $searchArray['id']) {
            $sql .= " AND ad.id = '" . $searchArray['id'] . "' ";
        }

          if ($searchArray['used_status']!='' && $searchArray['used_status']!='') {
            $sql .= " AND ad.status = '" . $searchArray['used_status'] . "' ";
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
        // echo $this->db->getLastQuery();EXIT;

        return $result;
    }

}

?>
