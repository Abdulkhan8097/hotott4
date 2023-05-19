<?php

namespace App\Models;
use CodeIgniter\Model;

class PinModel extends Model {

    protected $table = 'pin';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'p_id', 'generate_id', 'generate_name', 'used_id', 'username', 'pin', 'transfer_to', 'transfer_form', 'purchase_status', 'used_status', 'created_on', 'edited_on', 'purchase_date', 'used_date', 'pin_type', 'pin_transfer_date'];

    public function getData($searchArray=array(), $offset='', $limit='',$coutOnly='')
    {
        if($coutOnly)
        {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        }
        else
        {
            $sql = "SELECT ad.*,P.package_name,P.amount FROM $this->table AS ad ";
        }
         $sql .= " LEFT JOIN package as P ON (ad.p_id = P.package_id) ";
        $sql .= " ";
        $sql .= " WHERE 1 ";
        
        if(isset($searchArray['txtsearch']) && $searchArray['txtsearch'])
        {
            $sql .= " AND ( ad.pin LIKE '%".$searchArray['txtsearch']."%' ) ";
        }

        if (isset($searchArray['pinid']) && $searchArray['pinid']) {
        	$sql .= " AND ( ad.id  =".$searchArray['pinid']." ) ";

        }
        
        if((isset($searchArray['startdate']) && $searchArray['startdate']) && (isset($searchArray['enddate']) && $searchArray['enddate']))
        {
            $sql .= " AND ( DATE_FORMAT(ad.created_on, '%Y-%m-%d') >= '".$searchArray['startdate']."' ";
            $sql .= " AND DATE_FORMAT(ad.created_on, '%Y-%m-%d') <= '".$searchArray['enddate']."' ) ";
           
        }

        if (isset($searchArray['userid']) && $searchArray['userid']) {
        	$sql .= " AND ( ad.username  ='".$searchArray['userid']."' ) ";

        }
        
          $sql .= " AND ad.pin_type ='1'";
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

        return $result;
    }

     public function getDataActive($searchArray=array(), $offset='', $limit='',$coutOnly='')
    {
        if($coutOnly)
        {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        }
        else
        {
            $sql = "SELECT ad.*,P.package_name,P.amount FROM $this->table AS ad ";
        }
         $sql .= " LEFT JOIN package as P ON (ad.p_id = P.package_id) ";
        $sql .= " ";
        $sql .= " WHERE 1 ";
        
        if(isset($searchArray['txtsearch']) && $searchArray['txtsearch'])
        {
            $sql .= " AND ( ad.pin LIKE '%".$searchArray['txtsearch']."%' ) ";
        }

        if (isset($searchArray['pinid']) && $searchArray['pinid']) {
            $sql .= " AND ( ad.id  =".$searchArray['pinid']." ) ";

        }
         

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

        return $result;
    }

    public function getDataPurchasePIN($searchArray=array(), $offset='', $limit='',$coutOnly='')
    {
        if($coutOnly)
        {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        }
        else
        {
            $sql = "SELECT ad.*,P.package_name,P.amount FROM $this->table AS ad ";
        }
         $sql .= " LEFT JOIN package as P ON (ad.p_id = P.package_id) ";
         
        $sql .= " ";
        $sql .= " WHERE 1 ";
        
        if(isset($searchArray['txtsearch']) && $searchArray['txtsearch'])
        {
            $sql .= " AND ( ad.pin LIKE '%".$searchArray['txtsearch']."%' ) ";
        }

        if(isset($searchArray['username']) && $searchArray['username'])
        {
           $sql .= " AND ad.username = '" . $searchArray['username'] . "' ";

        }
         if(isset($searchArray['pin_type']) && $searchArray['pin_type'])
        {
           $sql .= " AND ad.pin_type = '" . $searchArray['pin_type'] . "' ";

        }
          if(isset($searchArray['used_status']) && $searchArray['used_status'])
        {
           $sql .= " AND ad.used_status = '" . $searchArray['used_status'] . "' ";

        }

        if (isset($searchArray['pinid']) && $searchArray['pinid']) {
            $sql .= " AND ( ad.id  =".$searchArray['pinid']." ) ";
        }
        $sql .= " AND ad.pin_type ='1'";
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

    public function getDataRenewalPurchasePIN($searchArray=array(), $offset='', $limit='',$coutOnly='')
    {
        if($coutOnly)
        {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        }
        else
        {
            $sql = "SELECT ad.*,P.package_name,P.amount FROM $this->table AS ad ";
        }
         $sql .= " LEFT JOIN package as P ON (ad.p_id = P.package_id) ";
         
        $sql .= " ";
        $sql .= " WHERE 1 ";
        
        if(isset($searchArray['txtsearch']) && $searchArray['txtsearch'])
        {
            $sql .= " AND ( ad.pin LIKE '%".$searchArray['txtsearch']."%' ) ";
        }

        if(isset($searchArray['username']) && $searchArray['username'])
        {
           $sql .= " AND ad.username = '" . $searchArray['username'] . "' ";

        }
         if(isset($searchArray['pin_type']) && $searchArray['pin_type'])
        {
           $sql .= " AND ad.pin_type = '" . $searchArray['pin_type'] . "' ";

        }
          if(isset($searchArray['used_status']) && $searchArray['used_status'])
        {
           $sql .= " AND ad.used_status = '" . $searchArray['used_status'] . "' ";

        }

        if (isset($searchArray['pinid']) && $searchArray['pinid']) {
            $sql .= " AND ( ad.id  =".$searchArray['pinid']." ) ";
        }
         $sql .= " AND pin_type='2'";
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


     public function getDataTransfer($searchArray=array(), $offset='', $limit='',$coutOnly='')
    {
        if($coutOnly)
        {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        }
        else
        {
            $sql = "SELECT ad.*,P.package_name,P.amount,U.name FROM $this->table AS ad ";
        }
         $sql .= " LEFT JOIN package as P ON (ad.p_id = P.package_id) ";
         $sql .= " LEFT JOIN users as U ON (ad.transfer_to = U.username) ";
        $sql .= " ";
        $sql .= " WHERE 1 ";
        
        if(isset($searchArray['txtsearch']) && $searchArray['txtsearch'])
        {
            $sql .= " AND ( ad.transfer_to LIKE '%".$searchArray['txtsearch']."%' ) ";
        }

        if (isset($searchArray['username']) && $searchArray['username']) {
            $sql .= " AND ( ad.transfer_form  ='".$searchArray['username']."' ) ";
        }
        $sql .= "AND transfer_to !=''";

      $sql .= " ORDER BY ad.$this->primaryKey"; 

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
      // echo  $this->db->getLastQuery();exit;
        

        return $result;
    }

       public function admingetDataTransfer($searchArray=array(), $offset='', $limit='',$coutOnly='')
    {
        if($coutOnly)
        {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        }
        else
        {
            $sql = "SELECT ad.*,P.package_name,P.amount,U.name FROM $this->table AS ad ";
        }
         $sql .= " LEFT JOIN package as P ON (ad.p_id = P.package_id) ";
         $sql .= " LEFT JOIN users as U ON (ad.transfer_to = U.username) ";
        $sql .= " ";
        $sql .= " WHERE 1 ";
        
        if(isset($searchArray['txtsearch']) && $searchArray['txtsearch'])
        {
            $sql .= " AND ( ad.transfer_to LIKE '%".$searchArray['txtsearch']."%' ) ";
        }

        if (isset($searchArray['username']) && $searchArray['username']) {
            $sql .= " AND ( ad.transfer_form  ='".$searchArray['username']."' ) ";
        }
        if (isset($searchArray['transfer_form']) && $searchArray['transfer_form']) {
            $sql .= " AND ( ad.transfer_form  ='".$searchArray['transfer_form']."' ) ";
        }
        $sql .= "AND transfer_to !=''";

      $sql .= " ORDER BY ad.$this->primaryKey"; 

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
      // echo  $this->db->getLastQuery();exit;
        

        return $result;
    }
    

}

?>
