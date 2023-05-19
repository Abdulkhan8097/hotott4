<?php
namespace App\Models;

use CodeIgniter\Model;

class UserWalletTransactionModel extends Model{

	protected $table = 'user_wallet_transaction';

	protected $primaryKey = 'id';

	protected $allowedFields = ['id','username','amount','type','date_time','status','sendTo','receivedTo','remark'];


        
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
        
        if(isset($searchArray['txtsearch']) && $searchArray['txtsearch'])
        {
            $sql .= " AND ( ad.amount LIKE '%".$searchArray['txtsearch']."%'  ";
            $sql .= " OR  ad.username LIKE '%".$searchArray['txtsearch']."%' ) ";
           
        }

        if(isset($searchArray['username']) && $searchArray['username'])
        {
           $sql .= " AND ad.username = '" . $searchArray['username'] . "' ";
       }

      
      $sql .= " ORDER BY ad.$this->primaryKey DESC"; 

        if($limit)
        {
            $sql .= " LIMIT $offset,$limit";
        }
//   echo $sql;die;
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