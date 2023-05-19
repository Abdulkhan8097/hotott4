<?php
namespace App\Models;
use CodeIgniter\Model;

class GeneratelinksModel extends Model {

    protected $table = 'generate_links';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'user_id', 'links', 'status', 'link_created', 'Used_Date','used_id'];
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
