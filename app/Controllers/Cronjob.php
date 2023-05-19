<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Models\ActiveUserModel;
use App\Models\PinModel;
use App\Models\UserModel;

class Cronjob extends BaseController {
    
    protected $session;
    protected $isAdminLoggedIn;
    
	function __construct()
	{
     
          
        $this->session = session();
        
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');   
	}




   public function subscriptionExpired(){

   	$ActiveUserModel = new ActiveUserModel();

   	$expiredSubscription = $ActiveUserModel->where('status', 'Active')
                                     ->where('created_on < DATE_SUB(NOW(), INTERVAL 30 DAY)')
                                     ->findAll();
                                     // echo "<pre>";
                                     // print_r($expiredSubscription);

     if ($expiredSubscription){
                                     

   	foreach ($expiredSubscription as $subscription) {

   		$Updatestatus=['status' => 'Inactive'];

   		$check=$ActiveUserModel->set($Updatestatus)->where('username',$subscription['username'])->update();
   		if ($check) {
   			$PinModel = new PinModel();
   			$UserModel = new UserModel();

   			$pinupdate=['used_status'=> 'Expired'];
   			$PinModel->set($pinupdate)->where('id',$subscription['pinId'])->update();

   			$userupdate=['package_id'=> '0'];

   			$UserModel->set($userupdate)->where('username',$subscription['username'])->update();


   		}

            
        }

        	echo "done";

    }



      
    }

}

?>