<?php

namespace App\Models;
use CodeIgniter\Model;

class IdentityModel extends Model {

    protected $table = 'identitycard';
    protected $primaryKey = 'id';

    protected $allowedFields = ['identity_name', 'position_name', 'identity_email', 'mobile_number','date_of_birth','identity_address','profile_image'];
    

    public function getData($searchArray=array(), $offset='', $limit='',$coutOnly='')
    {
        if($coutOnly)
        {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        }
        else
        {
            $sql = "SELECT ad.* FROM $this->table AS ad ";
        }
      
       
        $sql .= " ";
        $sql .= " WHERE 1 ";
        // var_dump($sql);die;
        if(isset($searchArray['txtsearch']) && $searchArray['txtsearch'])
        {
            $sql .= " AND ( ad.identity_name LIKE '%".$searchArray['txtsearch']."%' ) ";
        }

      $sql .= " ORDER BY ad.$this->primaryKey"; 

        if($limit)
        {
            $sql .= " LIMIT $offset,$limit";
        }
  // echo $sql;die;
        $query = $this->db->query($sql);
        $result = $query->getResult();
        
        if($coutOnly)
        {
            return  $result[0]->total_count;
        }
        // echo $this->db->getLastQuery();exit;

        return $result;
    }

}

?>
