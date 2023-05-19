<?php
namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model{

	protected $table = 'transaction';

	protected $primaryKey = 'tr_id';

	protected $allowedFields = ['tr_id','transaction_id','username','pack_id','pin_id','pay_by','amount','Payment_status','created'];


        
      public function getData($searchArray=array(), $offset='', $limit='',$coutOnly='')
    {
        if($coutOnly)
        {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        }
        else
        {
            $sql = "SELECT ad.*,P.package_name,P.amount as packageamount FROM $this->table AS ad ";
        }
         $sql .= " LEFT JOIN package as P ON (ad.pack_id = P.package_id) ";
         
        $sql .= " ";
        $sql .= " WHERE 1 ";
        
        if(isset($searchArray['txtsearch']) && $searchArray['txtsearch'])
        {
            $sql .= " AND ( ad.transaction_id LIKE '%".$searchArray['txtsearch']."%'  ";
            $sql .= " OR  ad.username LIKE '%".$searchArray['txtsearch']."%' ) ";
           
        }

        if(isset($searchArray['username']) && $searchArray['username'])
        {
           $sql .= " AND ad.username = '" . $searchArray['username'] . "' ";

        }
         if(isset($searchArray['pin_type']) && $searchArray['pin_type'])
        {
           $sql .= " AND ad.pin_type = '" . $searchArray['pin_type'] . "' ";

        }
         if(isset($searchArray['Payment_status']) && $searchArray['Payment_status'])
        {
           $sql .= " AND ad.Payment_status = '" . $searchArray['Payment_status'] . "' ";

        }
        if(isset($searchArray['pay_by']) && $searchArray['pay_by'])
        {
           $sql .= " AND ad.pay_by = '" . $searchArray['pay_by'] . "' ";

        }
        
        if((isset($searchArray['start_date']) && $searchArray['start_date']) && (isset($searchArray['end_date']) && $searchArray['end_date']))
        {
            $sql .= " AND ( DATE_FORMAT(ad.created, '%Y-%m-%d') >= '".$searchArray['start_date']."' ";
            $sql .= " AND DATE_FORMAT(ad.created, '%Y-%m-%d') <= '".$searchArray['end_date']."' ) ";
           
        }
        
          if(isset($searchArray['used_status']) && $searchArray['used_status'])
        {
           $sql .= " AND ad.used_status = '" . $searchArray['used_status'] . "' ";

        }
         if (isset($searchArray['tr_id']) && $searchArray['tr_id']) {
            $sql .= " AND ( ad.tr_id  =".$searchArray['tr_id']." ) ";
        }
        if (isset($searchArray['pinid']) && $searchArray['pinid']) {
            $sql .= " AND ( ad.id  =".$searchArray['pinid']." ) ";
        }
      $sql .= " ORDER BY ad.$this->primaryKey DESC"; 

        if($limit)
        {
            $sql .= " LIMIT $offset,$limit";
        }
//echo $sql;die;
        $query = $this->db->query($sql);
        $result = $query->getResult();
        
        if($coutOnly)
        {
            return  $result[0]->total_count;
        }
// echo $this->db->getLastQuery();exit;
        return $result;
    }
    
    public function getTotalAmount($searchArray=array())
    {
         $sql = "SELECT SUM(amount) as total_amount FROM $this->table AS ad ";
          $sql .= " ";
        $sql .= " WHERE 1 ";
        
        if(isset($searchArray['txtsearch']) && $searchArray['txtsearch'])
        {
            $sql .= " AND ( ad.transaction_id LIKE '%".$searchArray['txtsearch']."%'  ";
            $sql .= " OR  ad.username LIKE '%".$searchArray['txtsearch']."%' ) ";
           
        }

        if(isset($searchArray['username']) && $searchArray['username'])
        {
           $sql .= " AND ad.username = '" . $searchArray['username'] . "' ";

        }
         if(isset($searchArray['pin_type']) && $searchArray['pin_type'])
        {
           $sql .= " AND ad.pin_type = '" . $searchArray['pin_type'] . "' ";

        }
         if(isset($searchArray['Payment_status']) && $searchArray['Payment_status'])
        {
           $sql .= " AND ad.Payment_status = '" . $searchArray['Payment_status'] . "' ";

        }
        if(isset($searchArray['pay_by']) && $searchArray['pay_by'])
        {
           $sql .= " AND ad.pay_by = '" . $searchArray['pay_by'] . "' ";

        }
        
        if((isset($searchArray['start_date']) && $searchArray['start_date']) && (isset($searchArray['end_date']) && $searchArray['end_date']))
        {
            $sql .= " AND ( DATE_FORMAT(ad.created, '%Y-%m-%d') >= '".$searchArray['start_date']."' ";
            $sql .= " AND DATE_FORMAT(ad.created, '%Y-%m-%d') <= '".$searchArray['end_date']."' ) ";
           
        }
        
          if(isset($searchArray['used_status']) && $searchArray['used_status'])
        {
           $sql .= " AND ad.used_status = '" . $searchArray['used_status'] . "' ";

        }
         if (isset($searchArray['tr_id']) && $searchArray['tr_id']) {
            $sql .= " AND ( ad.tr_id  =".$searchArray['tr_id']." ) ";
        }
        if (isset($searchArray['pinid']) && $searchArray['pinid']) {
            $sql .= " AND ( ad.id  =".$searchArray['pinid']." ) ";
        }
      
        $query = $this->db->query($sql);
        $result = $query->getResult();
        
         return isset($result[0]) ? $result[0]->total_amount : 0;
    }


}	

?>