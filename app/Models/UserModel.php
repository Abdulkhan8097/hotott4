<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    
     protected $table = 'users';
     protected $primaryKey = 'id';  
     protected $allowedFields = ['id','name','password','parent_id','sponsor_name','email','side','pin','mobile','gender','date_of_birth','nomine_name','nomine_relation','address_line1','address_line2','country','state','city','zip_code','bank_name','bank_country','acc_holder_name','account_no','username','user_type','ifsc_code','transaction_password','created','terms','package_id','status','update_datetime','family_pack_status','otp','ref_id'];




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

    public function getUserdetail($id)
    {
        $arrResult =  $this->asArray()
                    ->where(['id' => $id])
                    ->first();

        return $arrResult;
    }
       public function checkMobileExist($mobile) {
        $arrResult = $this->asArray()
                ->where(['mobile' => $mobile])
                ->countAllResults();
        return $arrResult;
    }
     public function checkPin($pin) {
        $arrResult = $this->asArray()
                ->where(['pin' => $pin])
                ->countAllResults();
        return $arrResult;
    }
    public function checkSide($side,$parent_id) {
        $arrResult = $this->asArray()
                ->where(['side' => $side,'parent_id' => $parent_id])
                ->countAllResults();
        return $arrResult;
    }

    function checkUserLogin2($username,$password) {
        //echo "in database";exit;
        $txtreturn = false;

        $objResult = $this->asObject()
                ->where(['username' => $username])
                ->where(['password' => $password])
                ->first();

        if ($objResult) {

          
                $adminSession = array(
                    'user_id' => $objResult->id,
                    'email' => $objResult->email,
                    'username' => $objResult->username,
                    'name' => $objResult->name,
                    'family_pack_status' => $objResult->family_pack_status,
                    'transaction_password' => $objResult->transaction_password,
                    'user_type' => $objResult->user_type,
                    'created' => $objResult->created,
                    'isAdminLoggedIn' => TRUE,
                    'LoggedIn' => TRUE,
                );

                $session = session();
                $session->set($adminSession);
                $txtreturn = true;
                return $objResult;
          
        }
        return '';

    }
       function checkUserLogin($username,$password) {
        //echo "in database";exit;
        $txtreturn = false;

        $objResult = $this->asObject()
                ->where(['username' => $username])
                ->where(['password' => $password])
                ->first();

                if ($objResult) {
                    
                   return $objResult;
                }

     
                
          
     

    }

     public function getCustomerID($id) {
        $sql = "SELECT users.*, countriess.name as countriess_name,states.name as statename ,cities.name as cityname FROM users";
        $sql .= " LEFT JOIN countriess ON (users.country = countriess.id) ";
        $sql .= " LEFT JOIN states ON (users.state = states.id) ";
        $sql .= " LEFT JOIN cities ON (users.city = cities.id) ";
        $sql .= " WHERE users.id ='" . $id . "' ";
        $query = $this->db->query($sql);
        $result = $query->getRow();
        // echo $this->db->getLastQuery();exit;
        return $result;
    }

    
         public function getDatauser($searchArray=array(), $offset='', $limit='',$coutOnly='')
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

      // if (isset($searchArray['txtsearch'])) {
      //       $sql .= " AND ( ad.email LIKE '" . $searchArray['txtsearch'] . "%' ";
      //       $sql .= " OR ad.id LIKE '" . $searchArray['txtsearch'] . "%' ";
      //       $sql .= " OR ad.vip_code LIKE '" . $searchArray['txtsearch'] . "%' ";
      //       $sql .= " OR ad.city_code LIKE '" . $searchArray['txtsearch'] . "%' ";
      //       $sql .= " OR ad.name LIKE '" . $searchArray['txtsearch'] . "%' ";

      //       $sql .= " OR ad.start_date LIKE '" . $searchArray['txtsearch'] . "%' ";
      //       $sql .= " OR ad.end_date LIKE '" . $searchArray['txtsearch'] . "%' ";
      //       $sql .= " OR ad.gender LIKE '" . $searchArray['txtsearch'] . "%' ";
      //       $sql .= " OR ad.stateid LIKE '" . $searchArray['txtsearch'] . "%' ";
      //       $sql .= " OR ad.cityid LIKE '" . $searchArray['txtsearch'] . "%' ";

      //       $sql .= " OR ad.mobile LIKE '" . $searchArray['txtsearch'] . "%' ) ";

      //   }

        if ((isset($searchArray['start_date'])) && (isset($searchArray['end_date']))) {
            $sql .= " AND ( DATE_FORMAT(ad.created, '%Y-%m-%d') >= '".$searchArray['start_date']."' ";
             $sql .= " AND DATE_FORMAT(ad.created, '%Y-%m-%d') <= '".$searchArray['end_date']."' ) "; 
           }

        

        if (isset($searchArray['country']) && $searchArray['country']) {
            $sql .= " AND ad.country = '" . $searchArray['country'] . "' ";
        }
        if (isset($searchArray['state'])) {
            $sql .= " AND ad.state = '" . $searchArray['state'] . "' ";
        }
       
        if (isset($searchArray['city'])) {
            $sql .= " AND ad.city = '" . $searchArray['city'] . "' ";
        }
        if (isset($searchArray['mobile'])) {
            $sql .= " AND ad.mobile = '" . $searchArray['mobile'] . "' ";
        }
        if (isset($searchArray['pin_type'])) {
            $sql .= " AND ad.pin_type = '" . $searchArray['pin_type'] . "' ";
        }
        if (isset($searchArray['side'])) {
            $sql .= " AND ad.side = '" . $searchArray['side'] . "' ";
            
        }
        if (isset($searchArray['amount'])) {
            $sql .= " AND ad.amount = '" . $searchArray['amount'] . "' ";
        }
        if (isset($searchArray['pin'])) {
            $sql .= " AND ad.pin = '" . $searchArray['pin'] . "' ";
        }
         if (isset($searchArray['user_id'])) {
            $sql .= " AND ad.parent_id = '" . $searchArray['user_id'] . "' ";
        }
        if (isset($searchArray['username'])) {
            $sql .= " AND ad.username = '" . $searchArray['username'] . "' ";
        }
        
        // if (isset($searchArray['status']) && $searchArray['status']) {
        //     $sql .= " AND ad.status='".$searchArray['status']."' ";
        // }

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
// echo $this->db->getLastQuery();
        return $result;
    }



    public function getDataActive($searchArray=array(), $offset='', $limit='',$coutOnly='')
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
    
    public function getUserdetailByUsername($username)
    {
        $arrResult =  $this->asArray()
                    ->where(['username' => $username])
                    ->first();

        return $arrResult;
    }




   


}

?>
