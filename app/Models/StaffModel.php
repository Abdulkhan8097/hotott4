<?php namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model{
    
     protected $table = 'staff';
     protected $primaryKey = 'id';  
     protected $allowedFields = ['id','name','password','phone','admin_type','email','status','craeted','otp'];




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
            $sql .= " AND (ad.name LIKE '".$searchArray['txtsearch']."%' ";
            $sql .= " OR ad.phone LIKE '".$searchArray['txtsearch']."%' ";
            $sql .= " OR ad.email LIKE '".$searchArray['txtsearch']."%' ";
            $sql .= " OR ad.admin_type LIKE '".$searchArray['txtsearch']."%') ";
           
            
        }

       

         if (isset($searchArray['admin_type']) && $searchArray['admin_type']) {
            $sql .= " AND ad.admin_type = '" . $searchArray['admin_type'] . "' ";
          
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

   
    function checkStaffLogin2($username,$password) {
        //echo "in database";exit;
        $txtreturn = false;

        $objResult = $this->asObject()
                ->where(['email' => $username])
                ->where(['password' => $password])
                ->first();

        if ($objResult) {

          
                $adminSession = array(
                    'staff_id' => $objResult->id,
                    'email' => $objResult->email,
                    'name' => $objResult->name,
                    'user_type' => $objResult->admin_type,
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
       function checkStaffLogin($username,$password) {
        //echo "in database";exit;
        $txtreturn = false;

        $objResult = $this->asObject()
                ->where(['email' => $username])
                ->where(['password' => $password])
                ->first();

                		if ($objResult) {
                		 return $objResult;
                		}

     
               
          
     

    }

      public function updateStatus($id,$formArr)
    {
        
        return $this->db
                        ->table('staff')
                        ->where(["id" => $id])
                        ->set($formArr)
                        ->update();
    
    }

    


}

?>
