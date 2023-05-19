<?php

namespace App\Models;
use CodeIgniter\Model;

class ActiveUserModel extends Model {

    protected $table = 'active_user';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'username', 'pid', 'pinId', 'pin', 'status', 'created_on'];


    public function getData($searchArray=array(), $offset='', $limit='',$coutOnly='')
    {
        if($coutOnly)
        {
            $sql = "SELECT COUNT(ad.id) as total_count FROM $this->table AS ad ";
        }
        else
        {
            $sql = "SELECT ad.* FROM $this->table AS ad ";
        }
        $sql .= " ";
        $sql .= " WHERE 1 ";
        if(isset($searchArray['txtsearch']))
        {
            $sql .= " AND ad.username LIKE '".$searchArray['txtsearch']."%' ";
            $sql .= " OR ad.mobile LIKE '".$searchArray['txtsearch']."%' ";
            $sql .= " OR ad.email LIKE '".$searchArray['txtsearch']."%' ";
            
        }

        if (isset($searchArray['parent_id']) && $searchArray['parent_id']) {
            $sql .= " AND ad.parent_id = '" . $searchArray['parent_id'] . "' ";
          
        }

         if (isset($searchArray['ref_id']) && $searchArray['ref_id']) {
            $sql .= " AND ad.ref_id = '" . $searchArray['ref_id'] . "' ";
          
        }

        
       $sql .= " ORDER BY id DESC";

        if($limit)
        {
            $sql .= " LIMIT $offset,$limit";
        }

        $query = $this->db->query($sql);
        $result = $query->getResult();
        
        if($coutOnly)
        {
            return $result[0]->total_count;
        }
       // echo $this->db->getLastQuery();exit;

        return $result;
    }
    

}

?>
