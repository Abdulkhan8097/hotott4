<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\PackageModel;
use App\Models\UserWalletModel;
use App\Models\UserWalletTransactionModel;
use App\Models\PinModel;
use App\Models\TransactionModel;
use App\Models\BounceModel;
use App\Models\ActiveUserModel;
use App\Models\GeneratelinksModel;
use App\Models\AdminModel;
use App\Models\AdminChargesModel;
use App\Libraries\Paginationnew;
use App\Libraries\SiteVariables;
use App\Libraries\EmailSms;

class PinController extends BaseController {

    protected $session;
    protected $isAdminLoggedIn;


    public function __construct() {
        $this->session = session();
        $siteVariables = new SiteVariables();
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');
    }

    public function index() {
        $session = session();
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

		
	
		      
        $PinModel = new PinModel();
        $paginationnew = new Paginationnew();
        $txtsearch = $this->request->getGet('txtsearch');
        $searchArray = array();
        if($txtsearch)
        {
            $searchArray['txtsearch'] = $txtsearch;
        }
       
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $PinModel->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;		
		$data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
    
           $data["searchArray"] = $searchArray;
        
        
       

        $data['pin'] = $PinModel->getData($searchArray, $startLimit, $Limit);
        // echo"<pre>";
        //   print_r($data['pin']);exit;

        $this->template->render('admintemplate', 'contents', 'admin/Pin/pinlist', $data);
    }

    function genratePin() {
    	$PackageModel= new PackageModel();
    	 $data['package']=$PackageModel->where('package_id','1')->find();
    
  
    $this->template->render('admintemplate', 'contents', 'admin/Pin/genratepin',$data);
    }

   
 
   

    public function savePinGenerate() {
           $session = session();
        if ($session->get('admin_id')) {
            $isAdminLoggedIn = $session->get('admin_id');
            $username = $session->get('name');

            $isAdminLoggedIn = $session->get('admin_id');
        } else if ($session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
            $username = $session->get('username');
        }

        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $PinModel = new PinModel();
        $generate_id = $isAdminLoggedIn; 
        $generate_name = $username;
       $p_id = (isset($_POST['p_id']) && !empty($_POST['p_id'])) ? $this->request->getPost('p_id') : '';
        $qty = (isset($_POST['qty']) && !empty($_POST['qty'])) ? $this->request->getPost('qty') : '';
           for($i=1;$i<=$qty;$i++){
        	        // $generatepin         = $this->randomString21(21, $type = '');
            $shortId = uniqid('', true);
             $generatepin = substr(str_replace('.', '', $shortId), 0, 21);
        	        $arrData = array(
        	                            'generate_id'   => $generate_id,
        	                            'generate_name'   =>$generate_name,
        	                            'pin'           => $generatepin,
        	                            'p_id'          => $p_id,
                                        'pin_type'          => '1',
        	                          
        	                        );
        	        $checkduplicatepin=$PinModel->where('pin',$generatepin)->find();
        	        if ($checkduplicatepin) {
        	        	$this->session->setFlashdata('errmessage', 'Duplicate Pin  exist!');
        	        	 return redirect()->to($_SERVER["HTTP_REFERER"]);
        	        }
        	        
        	      $PinModel->save($arrData);

        	    }
       

        
     
        $this->session->setFlashdata('message', 'Pin Generate Successfully!');
        return redirect()->to($_SERVER["HTTP_REFERER"]);


      
    }
     public function activePin() {
        $session = session();

        $isAdminLoggedIn = $session->get('isAdminLoggedIn');

        $id = $this->request->getGet("id");
        
        

        $PinModel = new PinModel();

        if ($isAdminLoggedIn) {
           
           
            $searchArray['pinid']=$id;
            $pindata=$PinModel->getDataActive($searchArray);
             $data['data']=$pindata;
          


             $this->template->render('admintemplate', 'contents', 'admin/Pin/activepin',$data);
        } else {
            $this->session->setFlashdata('errmessage', 'Invalid access.');
             return redirect()->to($_SERVER["HTTP_REFERER"]);
        }
      //  return redirect()->to(site_url('Customers'));
         
      }
    

  

//////////// delete  /////////////


    public function delete() {
        $session = session();

        $isAdminLoggedIn = $session->get('isAdminLoggedIn');

        $id = $this->request->getGet("id");

        $PinModel = new PinModel();

        if ($isAdminLoggedIn) {
           
            $PinModel->where('id', $id)->delete();

            $this->session->setFlashdata('message', 'PIN deleted successfully.');
        } else {
            $this->session->setFlashdata('errmessage', 'Invalid access.');
        }
      //  return redirect()->to(site_url('Customers'));
          return redirect()->to($_SERVER["HTTP_REFERER"]);
    }




//     public function preview() {
//         $session = session();

//         $isAdminLoggedIn = $session->get('isAdminLoggedIn');

//         if (!$isAdminLoggedIn) {
//             return redirect()->to(site_url('admin'));
//         }

//         $id = $this->request->getGet("id");
     

//         $PinModel = new PinModel();
//         $data['preview'] = $PinModel->find($id); // return count value
// echo"<pre>";
//        print_r($data['preview']);exit;

//         if (!$data['preview']) {
//             $this->session->setFlashdata('errmessage', 'User Id Does not exist!');
//             return redirect()->to(site_url('Customers'));
//         }

//         $this->template->render('admintemplate', 'contents', 'admin/customer/customerdetails', $data);
//     }


    public function redeenPinActive(){
    	      $session = session();
        if ($session->get('admin_id')) {
            $isAdminLoggedIn = $session->get('admin_id');
            $username = $session->get('username');

            $isAdminLoggedIn = $session->get('admin_id');
        } else if ($data=$session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
            $username = $session->get('username');
        }


    	$PinModel = new PinModel();
    	$UserModel = new UserModel();
        $ActiveUserModel = new ActiveUserModel();
    	$formArr = array(); 
    	 $activePin =(isset($_POST['activePin']) && !empty($_POST['activePin'])) ? $this->request->getPost('activePin') : '';
    	 $package =(isset($_POST['package']) && !empty($_POST['package'])) ? $this->request->getPost('package') : '';
    	 $sponsor_id =(isset($_POST['sponsor_id']) && !empty($_POST['sponsor_id'])) ? $this->request->getPost('sponsor_id') : '';
    	 $sponsor_name =(isset($_POST['sponsor_name']) && !empty($_POST['sponsor_name'])) ? $this->request->getPost('sponsor_name') : '';


    	
    	if ($sponsor_id=='admin' || $sponsor_id=='ADMIN') {
    		$this->session->setFlashdata('errmessage', 'Something Went Wrong!..');
    		return redirect()->to($_SERVER["HTTP_REFERER"]);
    	
    	}
    	
    		$data=$UserModel->where('username',$sponsor_id)->first();
    		if ($data) {


                    $pindatacheck=$PinModel->where('pin',$activePin)->first();
                    $pinID=$pindatacheck['id'];
                    $pacID=$pindatacheck['p_id'];
                   

    			$id=$data['id'];
                $username=$data['username'];
                $name=$data['name'];
                $email=$data['email'];
                $package_id=$data['package_id'];
               
   




               
                if($pacID > $package_id){
                     
                        // $formArr['purchase_date'] = $purchase_date =date('Y-m-d h:m:s');
                        // $formArr['purchase_status'] = $purchase_status ='Active';
                        $formArr['used_status'] = $used_status ='Active';
                        $formArr['used_date'] = $used_date =date("Y-m-d h:m:s");
                        $formArr['used_id'] = $sponsor_id;
    		   
    		   
    		   		$checksave=$PinModel->set($formArr)->where('pin',$activePin)->update();

                       $datactive = array(
                                                        'pin'     => $activePin,
                                                        'pid'     => $pacID,
                                                        'pinId'     => $pinID,
                                                        'status' => 'Active',
                                                        'created_on' => date('Y-m-d h:m:s')
                                                    );
                                    
                        $ActiveUserModel->set($datactive)->where('username',$username)->update();

                            $datactive1 = array(
                                                        
                                                        'pin' => $activePin,
                                                        'status' => 'Active',
                                                        'package_id' =>$pacID,
                                                        'update_datetime' => date('Y-m-d h:m:s')
                                                    );
                                         
                         
                            $UserModel->set($datactive1)->where('username',$username)->update();

                             $emailObject = new EmailSms();

                      $emailcontent = $emailObject->getMessage('upgrade_package');
                             
                            
                            $toEmail = $email;
                            $name = $name;
                            $uname = $uname;
                            $password = $password;
                            $transaction_pass = $transaction_pass;
                            $subject = $emailcontent['SUBJECT'];
                            $mailbody = $emailcontent['BODY'];
                         
                            $mailbody = str_replace("##USER_NAME##", $name, $mailbody);
                            $emailObject->sendEmail($toEmail, $subject, $mailbody, '', '', $attachement);



        $db = db_connect();
        $query="WITH RECURSIVE category_tree (id, name, parent_id, path, level, username, side, sponsor_name, ancestors) AS (
  SELECT id, name, parent_id, CAST(id AS CHAR(200)), 0, username, side, sponsor_name, CAST(id AS CHAR(200))
  FROM users WHERE id = '".$id."'
  UNION ALL
  SELECT c.id, c.name, c.parent_id, CONCAT(ct.path, ',', c.id), ct.level + 1, c.username, c.side, c.sponsor_name,
    CONCAT(ct.ancestors, ',', c.id)
  FROM users c
  JOIN category_tree ct ON c.id = ct.parent_id
)
SELECT id, name, parent_id, path, level, username, side, sponsor_name, ancestors
FROM category_tree
WHERE level BETWEEN 1 AND 11
ORDER BY level;
";
$result = $db->query($query);
$result=$result->getResult();

foreach ($result as $key => $value) {
    $uname=$value->username;
    $UserWalletModel = new UserWalletModel();
    $UserWalletTransactionModel = new UserWalletTransactionModel();
    $BounceModel = new BounceModel();
    $bdata=$BounceModel->where('b_type','renewal_bounce')->first();
    $bamount=$bdata['amount'];
   
    $upwallet=array('username'=>$uname,'amount'=>$bamount,'type'=>'deposit','status'=>'successful','remark'=>'Team Renew Pin Bouns');
    $UserWalletTransactionModel->save($upwallet);
    $userbal=$UserWalletModel->where('username',$uname)->first();
    $current_amount=$userbal['current_amount'];
    $addbouns=$current_amount+$bamount;
    $upbal=array('current_amount'=>$addbouns);
    $UserWalletModel->set($upbal)->where('username',$uname)->update();

}


  
    $db = db_connect();

$query2 = "WITH RECURSIVE category_tree (id, name, parent_id, path, level, username, side, sponsor_name, ancestors) AS (
              SELECT id, name, parent_id, CAST(id AS CHAR(200)), 0, username, side, sponsor_name, CAST(id AS CHAR(200))
              FROM users WHERE id = '".$id."'
              UNION ALL
              SELECT c.id, c.name, c.parent_id, CONCAT(ct.path, ',', c.id), ct.level + 1, c.username, c.side, c.sponsor_name,
                CONCAT(ct.ancestors, ',', c.id)
              FROM users c
              JOIN category_tree ct ON c.id = ct.parent_id
            )
            SELECT id, name, parent_id, path, level, username, side, sponsor_name, ancestors
            FROM category_tree
            WHERE level >= 12
            ORDER BY level";

          $result1 = $db->query($query2);
$resultdata=$result1->getResult();

                if ($resultdata) {
                  


                foreach ($resultdata as $key => $value) {
                    $uname=$value->username;
                    $UserWalletModel = new UserWalletModel();
                    $UserWalletTransactionModel = new UserWalletTransactionModel();
                    $BounceModel = new BounceModel();
                    $bdata=$BounceModel->where('b_type','renewal_12level')->first();
                    $bamount=$bdata['amount'];
                   
                    $upwallet=array('username'=>$uname,'amount'=>$bamount,'type'=>'deposit','status'=>'successful','remark'=>'Team Renew Pin Bouns');
                    $UserWalletTransactionModel->save($upwallet);
                    $userbal=$UserWalletModel->where('username',$uname)->first();
                    $current_amount=$userbal['current_amount'];
                    $addbouns=$current_amount+$bamount;
                    $upbal=array('current_amount'=>$addbouns);
                    $UserWalletModel->set($upbal)->where('username',$uname)->update();

                     }
                }

                  
    		   		$this->session->setFlashdata('message', 'User Active Successfully..');
    		   		return redirect()->to($_SERVER["HTTP_REFERER"]);
    		   	}else{
    		   		$this->session->setFlashdata('errmessage', 'Pin Allready Active..');
    		   return redirect()->to($_SERVER["HTTP_REFERER"]);
    		   	}



    		}else{
    			$this->session->setFlashdata('errmessage', 'User Not Exist!..');
    		return redirect()->to($_SERVER["HTTP_REFERER"]);
    		}

    }



     function purchasePin() {
        $PackageModel= new PackageModel();
               $session = session();
        if ($session->get('admin_id')) {
            $isAdminLoggedIn = $session->get('admin_id');
            $username = $session->get('name');

           
        } else if ($session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
            $family_pack_status = $session->get('family_pack_status');
          

        }

$UserModel= new UserModel();
$check=$UserModel->where('id',$isAdminLoggedIn)->where('family_pack_status','1')->first();
        if ($check) {
            $data['package']=$PackageModel->find();
        
           
        }else{
        
         $data['package']=$PackageModel->limit(1)->offset(0)->find();
     }
    
  
    $this->template->render('admintemplate', 'contents', 'admin/Pin/purchasepin',$data);
    }

    public function charges(){
            $pid = $this->request->getPost('pid');
            $pinno = $this->request->getPost('pinno');
           
            if(!empty($pinno)){
                if(!empty($pid)){
                         $PackageModel= new PackageModel();
                         $result=$PackageModel->where('package_id',$pid)->first(); 
                          $amt = $result['amount'];
                        
                 
                    echo $amt*$pinno;
                }else{
                    echo "Please select package";
                }
            }else{
                    echo "";
                }
    }

   public function purchasepinTransaction(){
      $session = session();
        if ($session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
            $username = $session->get('username');
            $name = $session->get('name');
            $transaction_password = $session->get('transaction_password');

           
        }
           $PinModel= new PinModel();
           $UserWalletTransactionModel= new UserWalletTransactionModel();
           $pass = $this->request->getPost('pass');
           if ($transaction_password!=$pass) {
              $this->session->setFlashdata('errmessage', 'Please Try Again Enter Your Correct Transaction Password..');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
           }
        
          $packid = $this->request->getPost('pid');
          
          $pin_type = $this->request->getPost('pin_type');
          $qty = $this->request->getPost('pin');
          $Online = $this->request->getPost('Online');
          $Wallet = $this->request->getPost('Wallet');
         
          $amt = $this->request->getPost('amt');
          if ($Wallet) {
               $UserWalletModel = new UserWalletModel();

                $userwallet=$UserWalletModel->where('username',$username)->first();
                if ($userwallet) {
                   $current_amount=$userwallet['current_amount'];
                  if ($amt > $current_amount) {
                  $this->session->setFlashdata('errmessage', 'Sorry Low Balance...');
                    return redirect()->to($_SERVER["HTTP_REFERER"]);
                  }
                 
                
                }             
          }


          if ($Online=='Online' AND $pin_type=='1') {
               $lastpin=array();
              for ($x = 1; $x <= $qty; $x++) {
                // $generatepin= mt_rand(100000000000000, 999999999999999);
                // $generatepin = $this->randomString21(21, $type = '');
                $shortId = uniqid('', true);
             $generatepin = substr(str_replace('.', '', $shortId), 0, 21);
                $trans= mt_rand(1000000000, 9999999999);
                
                 $TransactionModel= new TransactionModel();
            $generatepincheck=$PinModel->where('pin',$generatepin)->find();
            $transaction=$TransactionModel->where('transaction_id',$trans)->find();
       
            if($generatepincheck)
            {
            $this->session->setFlashdata('errmessage', 'Please Try Again..');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
            }
              if($transaction)
            {
            $this->session->setFlashdata('errmessage', 'Please Try Again..');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
            }
            $formArr['purchase_date'] = $purchase_date =date('Y-m-d h:m:s');
                        $formArr['purchase_status'] = $purchase_status ='Active';
                        $formArr['used_status'] = $used_status ='Active';
                        $formArr['used_date'] = $used_date =date("Y-m-d h:m:s");
                        $formArr['used_id'] = $used_id =$username;
             $arrData = array(
                                                            'generate_id' => $isAdminLoggedIn,
                                                            'username' => $username,
                                                            'generate_name' => $name,
                                                            'pin' => $generatepin,
                                                            'p_id' => $packid,
                                                            'purchase_status' => 'Active',
                                                            'used_status' => 'Inactive',
                                                            'pin_type' => '1',
                                                            'purchase_date' => date("Y-m-d h:m:s"),
                                                            
                                                        );
                                   $pinData = $PinModel->save($arrData);
                                   $user_id = $PinModel->getInsertID();
                                   array_push($lastpin,$user_id);
                                 


            }
              
              $lastpinsave=implode(",",$lastpin);
              $arrData1 = array(
                                                            'transaction_id' => $trans,
                                                            'username' => $username,
                                                            'pack_id' => $packid,
                                                            'pin_id' => $lastpinsave,
                                                            'pay_by' => $Online,
                                                            'amount' => $amt,
                                                            'Payment_status' => 'Success',
                                                            'created' => date("Y-m-d h:m:s"),
                                                            
                                                        );
                        $TransactionModel->save($arrData1);
                        $UserModel = new UserModel();
                        $updatefamilypack=array('family_pack_status'=>'0');

                        $UserModel->set($updatefamilypack)->where('username',$username)->update();
                        $this->session->setFlashdata('message', 'Purchase Refferal PIN  Successfully..');
                        return redirect()->to($_SERVER["HTTP_REFERER"]);


          }elseif ($Online=='Online' AND $pin_type=='2') {
              // code...
         

               $lastpin=array();
              for ($x = 1; $x <= $qty; $x++) {
                  // $generatepin = $this->randomString(30, $type = '');
                  $shortId = uniqid('', true);
             $generatepin = substr(str_replace('.', '', $shortId), 0, 30);
                $trans= mt_rand(1000000000, 9999999999);
                
                 $TransactionModel= new TransactionModel();
            $generatepincheck=$PinModel->where('pin',$generatepin)->find();
            $transaction=$TransactionModel->where('transaction_id',$trans)->find();
       
            if($generatepincheck)
            {
            $this->session->setFlashdata('errmessage', 'Please Try Again..');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
            }
              if($transaction)
            {
            $this->session->setFlashdata('errmessage', 'Please Try Again..');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
            }
            $formArr['purchase_date'] = $purchase_date =date('Y-m-d h:m:s');
                        $formArr['purchase_status'] = $purchase_status ='Active';
                        $formArr['used_status'] = $used_status ='Active';
                        $formArr['used_date'] = $used_date =date("Y-m-d h:m:s");
                        $formArr['used_id'] = $used_id =$username;
             $arrData = array(
                                                            'generate_id' => $isAdminLoggedIn,
                                                            'username' => $username,
                                                            'generate_name' => $name,
                                                            'pin' => $generatepin,
                                                            'p_id' => $packid,
                                                            'purchase_status' => 'Active',
                                                            'used_status' => 'Inactive',
                                                            'pin_type' => '2',
                                                            'purchase_date' => date("Y-m-d h:m:s"),
                                                            
                                                        );
                                   $pinData = $PinModel->save($arrData);
                                   $user_id = $PinModel->getInsertID();
                                   array_push($lastpin,$user_id);
                                 


            }
              
              $lastpinsave=implode(",",$lastpin);
              $arrData1 = array(
                                                            'transaction_id' => $trans,
                                                            'username' => $username,
                                                            'pack_id' => $packid,
                                                            'pin_id' => $lastpinsave,
                                                            'pay_by' => $Online,
                                                            'amount' => $amt,
                                                            'status' => 'Active',
                                                            'created' => date("Y-m-d h:m:s"),
                                                            
                                                        );
                        $TransactionModel->save($arrData1);
                        $this->session->setFlashdata('message', 'Purchase Renewal PIN  Successfully..');
                        return redirect()->to($_SERVER["HTTP_REFERER"]);

          }


          // wallet
          if ($Wallet=='Wallet' AND $pin_type=='1') {

            $qty = $this->request->getPost('pin');
            $amt = $this->request->getPost('amt');
            $AdminChargesModel = new AdminChargesModel();
            $admindata=$AdminChargesModel->where('charges_type','HOTOTTBANK')->first();
         
            $adminHotottAmount=$admindata['amount'];

           $sing = str_split($adminHotottAmount, 1);
           $signplmi=$sing[0];

           $charge = substr($adminHotottAmount, 1);
  
           
            for ($i = 0; $i < $qty; $i++) {
                $tocharge+=$charge;
                }



             

                if ($signplmi == '+') {
                  $amt += $tocharge;
                } else if ($signplmi == '-') {
                  $amt -= $tocharge;
                }


               $lastpin=array();
              for ($x = 1; $x <= $qty; $x++) {
                // $generatepin= mt_rand(100000000000000, 999999999999999);
                // $generatepin = $this->randomString21(21, $type = '');
                  $shortId = uniqid('', true);
             $generatepin = substr(str_replace('.', '', $shortId), 0, 21);
                $trans= mt_rand(1000000000, 9999999999);
                
                 $TransactionModel= new TransactionModel();
            $generatepincheck=$PinModel->where('pin',$generatepin)->find();
            $transaction=$TransactionModel->where('transaction_id',$trans)->find();
       
            if($generatepincheck)
            {
            $this->session->setFlashdata('errmessage', 'Please Try Again..');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
            }
              if($transaction)
            {
            $this->session->setFlashdata('errmessage', 'Please Try Again..');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
            }
            $formArr['purchase_date'] = $purchase_date =date('Y-m-d h:m:s');
                        $formArr['purchase_status'] = $purchase_status ='Active';
                        $formArr['used_status'] = $used_status ='Active';
                        $formArr['used_date'] = $used_date =date("Y-m-d h:m:s");
                        $formArr['used_id'] = $used_id =$username;
             $arrData = array(
                                                            'generate_id' => $isAdminLoggedIn,
                                                            'username' => $username,
                                                            'generate_name' => $name,
                                                            'pin' => $generatepin,
                                                            'p_id' => $packid,
                                                            'purchase_status' => 'Active',
                                                            'used_status' => 'Inactive',
                                                            'pin_type' => '1',
                                                            'purchase_date' => date("Y-m-d h:m:s"),
                                                            
                                                        );
                                   $pinData = $PinModel->save($arrData);
                                   $user_id = $PinModel->getInsertID();
                                   array_push($lastpin,$user_id);
                                 


            }
              
              $lastpinsave=implode(",",$lastpin);
              $arrData1 = array(
                                                            'transaction_id' => $trans,
                                                            'username' => $username,
                                                            'pack_id' => $packid,
                                                            'pin_id' => $lastpinsave,
                                                            'pay_by' => $Wallet,
                                                            'amount' => $amt,
                                                            'Payment_status' => 'Success',
                                                            'created' => date("Y-m-d h:m:s"),
                                                            
                                                        );
                        $TransactionModel->save($arrData1);
                        $UserModel = new UserModel();
                         $userwallet=$UserWalletModel->where('username',$username)->first();
                if ($userwallet) {
                   $current_amount=$userwallet['current_amount'];
                   $cbal=$current_amount-$amt;
                   $arr= array('current_amount'=>$cbal);
                 
                 $UserWalletModel->set($arr)->where('username',$username)->update();

             

                 $history=array('username' => $username,'amount' => $amt,'type' =>'withdraw','status'=>'successful','remark'=>'Purchase Pin');
                 $UserWalletTransactionModel->save($history);
                
                }   
                



                        if ($packid=='2') {
                        $updatefamilypack=array('family_pack_status'=>'0');

                        $UserModel->set($updatefamilypack)->where('username',$username)->update();
                         }
                        $this->session->setFlashdata('message', 'Purchase Refferal PIN  Successfully..');
                        return redirect()->to($_SERVER["HTTP_REFERER"]);


          }elseif ($Wallet=='Wallet' AND $pin_type=='2') {
              $qty = $this->request->getPost('pin');
            $amt = $this->request->getPost('amt');
            $AdminChargesModel = new AdminChargesModel();
            $admindata=$AdminChargesModel->where('charges_type','HOTOTTBANK')->first();
         
            $adminHotottAmount=$admindata['amount'];

           $sing = str_split($adminHotottAmount, 1);
           $signplmi=$sing[0];

           $charge = substr($adminHotottAmount, 1);
  
           
            for ($i = 0; $i < $qty; $i++) {
                $tocharge+=$charge;
                }



             

                if ($signplmi == '+') {
                  $amt += $tocharge;
                } else if ($signplmi == '-') {
                  $amt -= $tocharge;
                }
        

               $lastpin=array();
              for ($x = 1; $x <= $qty; $x++) {
                  // $generatepin = $this->randomString(30, $type = '');
                  $shortId = uniqid('', true);
             $generatepin = substr(str_replace('.', '', $shortId), 0, 30);
                $trans= mt_rand(1000000000, 9999999999);
                
                 $TransactionModel= new TransactionModel();
            $generatepincheck=$PinModel->where('pin',$generatepin)->find();
            $transaction=$TransactionModel->where('transaction_id',$trans)->find();
       
            if($generatepincheck)
            {
            $this->session->setFlashdata('errmessage', 'Please Try Again..');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
            }
              if($transaction)
            {
            $this->session->setFlashdata('errmessage', 'Please Try Again..');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
            }
            $formArr['purchase_date'] = $purchase_date =date('Y-m-d h:m:s');
                        $formArr['purchase_status'] = $purchase_status ='Active';
                        $formArr['used_status'] = $used_status ='Active';
                        $formArr['used_date'] = $used_date =date("Y-m-d h:m:s");
                        $formArr['used_id'] = $used_id =$username;
             $arrData = array(
                                                            'generate_id' => $isAdminLoggedIn,
                                                            'username' => $username,
                                                            'generate_name' => $name,
                                                            'pin' => $generatepin,
                                                            'p_id' => $packid,
                                                            'purchase_status' => 'Active',
                                                            'used_status' => 'Inactive',
                                                            'pin_type' => '2',
                                                            'purchase_date' => date("Y-m-d h:m:s"),
                                                            
                                                        );
                                   $pinData = $PinModel->save($arrData);
                                   $user_id = $PinModel->getInsertID();
                                   array_push($lastpin,$user_id);
                                 


            }
              
              $lastpinsave=implode(",",$lastpin);
              $arrData1 = array(
                                                            'transaction_id' => $trans,
                                                            'username' => $username,
                                                            'pack_id' => $packid,
                                                            'pin_id' => $lastpinsave,
                                                            'pay_by' => $Online,
                                                            'amount' => $amt,
                                                            'status' => 'Active',
                                                            'created' => date("Y-m-d h:m:s"),
                                                            
                                                        );
                        $TransactionModel->save($arrData1);
                        $this->session->setFlashdata('message', 'Purchase Renewal PIN  Successfully..');
                        return redirect()->to($_SERVER["HTTP_REFERER"]);

          }

    }

   public function randomString($length, $type = '') {
      // Select which type of characters you want in your random string
      switch($type) {
        /*case 'num':
          // Use only numbers
          $salt = '1234567890';
          break;*/
        /*case 'lower':
          // Use only lowercase letters
          $salt = 'abcdefghijklmnopqrstuvwxyz';
          break;*/
        case 'upper':
          // Use only uppercase letters
          $salt = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
          break;
        default:
          // Use uppercase, lowercase, numbers, and symbols
          $salt = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
          break;
      }
      $rand = '';
      $i = 0;
      while ($i < $length) { // Loop until you have met the length
        $num = rand() % strlen($salt);
        $tmp = substr($salt, $num, 1);
        $rand = $rand . $tmp;
        $i++;
      }
      return $rand; // Return the random string
    }
    


      public function purchasePinList() {
        $session = session();
       $searchArray = array();
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
          if ($session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
            $username = $session->get('username');
              if($isAdminLoggedIn)
        {
            $searchArray['user_id'] = $isAdminLoggedIn;
        }
        } 

        $PinModel = new PinModel();
        $paginationnew = new Paginationnew();
        $txtsearch = $this->request->getGet('txtsearch');
        $pin_type = $this->request->getGet('pin_type');
        $used_status = $this->request->getGet('used_status');
       
         if($used_status)
        {
            $searchArray['used_status'] = $used_status;
        }
        if($pin_type)
        {
            $searchArray['pin_type'] = $pin_type;
        }
         if($txtsearch)
        {
            $searchArray['txtsearch'] = $txtsearch;
        }
         $username = ($session->get('username'));
              
             if($username)
            { 
                $searchArray['username'] =$username;
            }
       
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $PinModel->getDataPurchasePIN($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;     
        $data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
      
           $data["searchArray"] = $searchArray;
        
        
       

        $data['pin'] = $PinModel->getDataPurchasePIN($searchArray, $startLimit, $Limit);
        // echo"<pre>";
        //   print_r($data['pin']);exit;

        $this->template->render('admintemplate', 'contents', 'admin/Pin/purchasepinlist', $data);
    }

     public function purchaseRenewalPinList() {
        $session = session();
       $searchArray = array();
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
          if ($session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
            $username = $session->get('username');
         
              if($isAdminLoggedIn)
        {
            $searchArray['user_id'] = $isAdminLoggedIn;
        }

             if($username)
            { 
                $searchArray['username'] =$username;
            }
        } 

        $PinModel = new PinModel();
        $paginationnew = new Paginationnew();
        $txtsearch = $this->request->getGet('txtsearch');
        $pin_type = $this->request->getGet('pin_type');
        $used_status = $this->request->getGet('used_status');
       
         if($used_status)
        {
            $searchArray['used_status'] = $used_status;
        }
        if($pin_type)
        {
            $searchArray['pin_type'] = $pin_type;
        }
         if($txtsearch)
        {
            $searchArray['txtsearch'] = $txtsearch;
        }
        

             
       
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $PinModel->getDataRenewalPurchasePIN($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;     
        $data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
      
           $data["searchArray"] = $searchArray;
        
        
       

        $data['pin'] = $PinModel->getDataRenewalPurchasePIN($searchArray, $startLimit, $Limit);
        // echo"<pre>";
        //   print_r($data['pin']);exit;

        $this->template->render('admintemplate', 'contents', 'admin/Pin/renewalpurchasepinlist', $data);
    }


      public function linkslist() {
        $session = session();
       $searchArray = array();
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
          if ($session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
            $username = $session->get('username');
         
              if($isAdminLoggedIn)
        {
            $searchArray['user_id'] = $isAdminLoggedIn;
        }

             if($username)
            { 
                $searchArray['username'] =$username;
            }
        } 

        $GeneratelinksModel = new GeneratelinksModel();
        $paginationnew = new Paginationnew();
        $txtsearch = $this->request->getGet('txtsearch');
       
        $used_status = $this->request->getGet('used_status');

       
         if($used_status!='')
        {
            
            $searchArray['used_status'] = $used_status;
        }
        if($pin_type)
        {
            $searchArray['pin_type'] = $pin_type;
        }
         if($txtsearch)
        {
            $searchArray['txtsearch'] = $txtsearch;
        }
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $GeneratelinksModel->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;     
        $data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
      
           $data["searchArray"] = $searchArray;
        
        
       

        $data['links'] = $GeneratelinksModel->getData($searchArray, $startLimit, $Limit);
        // echo"<pre>";
        //   print_r($data['pin']);exit;

        $this->template->render('admintemplate', 'contents', 'admin/Links/linklist', $data);
    }

    public function linkGenerate(){

        $session = session();
  
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $data['pagetitle']='Generate New Link';

  

         $this->template->render('admintemplate', 'contents', 'admin/Links/linkadd',$data);

    }

    public function urlGenerate(){

         $session = session();
       
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
          if ($session->get('user_id')) {
                $uid=$session->get('user_id');
            

          }elseif($session->get('admin_id')){
              $uid=$session->get('admin_id');
          }
          
    
           $ShortUrlModel = new GeneratelinksModel();
           $checkurl=$ShortUrlModel->where('user_id',$uid)->find();
           if (!$checkurl) {
              // generate a unique ID for the short URL
            // $shortId = uniqid();
            $shortId = uniqid('', true);
             $shortId = substr(str_replace('.', '', $shortId), 0, 30);

            // construct the short URL by appending the ID to a base URL
            $shortUrl = site_url('Refferal') . '/' .'TOT'.$uid.'Z!'. $shortId;

            // save the short URL and long URL mapping in the database
            $arr=['user_id'=>$uid,'links'=>$shortUrl];
            $ShortUrlModel->save($arr);
            $this->session->setFlashdata('message', 'Link Generate Successfully..');
           }
           
            return redirect()->to($_SERVER["HTTP_REFERER"]);

    }

    public function userTransferPin()
    {
           $session = session();
       
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        
          $this->template->render('admintemplate', 'contents', 'admin/Pin/usertransferpin');
    }

    public function pinTranferSave(){
            $session = session();
       
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
          if ($session->get('user_id')) {
                $uid=$session->get('user_id');
                $username=$session->get('username');
            

          }
          $UserModel = new UserModel();
          $PinModel = new PinModel();
          $userdata=$UserModel->select('transaction_password')->where('id',$uid)->first();

          $transaction_password=$userdata['transaction_password'];

          


          $user_id=$this->request->getPost('user_id');
          $pin_type=$this->request->getPost('pin_type');
          $qty=$this->request->getPost('qty');
          $pass=$this->request->getPost('pass');

          $postuserdata=$UserModel->where('username',$user_id)->first();
          $post_id=$postuserdata['id'];
          $post_name=$postuserdata['name'];


            if ($username == $user_id) {
                 $this->session->setFlashdata('errmessage', 'Something Went Wrong Please Try Again..');
                 return redirect()->to($_SERVER["HTTP_REFERER"]);
            }





          if ($transaction_password == $pass) {
            $checkpin=$PinModel->where('pin_type',$pin_type)->where('username',$username)->where('used_status','Inactive')->find();
            $dbtotalrows=count($checkpin);
            if ($dbtotalrows>=$qty) {
           



            
            $checkpin=$PinModel->where('pin_type',$pin_type)->where('username',$username)->where('used_status','Inactive')->limit($qty)->find();
            //   echo $PinModel->getLastQuery()->getQuery();
            // echo"<pre>";
            // print_r($checkpin);exit;
         
            if ($checkpin) {

                foreach($checkpin as $val){


                     $data=[
                        'generate_id'=>$post_id,
                        'generate_name'=>$post_name,
                        'username'=>$user_id,
                        'transfer_form'=>$username,
                        'transfer_to'=>$user_id,
                        'pin_transfer_date'=>$date = date('Y-m-d H:i:s')
                    ];

                     $checkTransfer=$PinModel->set($data)->where('id',$val['id'])->update();
                     // echo $PinModel->getLastQuery()->getQuery();
                     // EXIT;

                }
                 $this->session->setFlashdata('message', 'Tranfer pin Successfully..');


               
           }else{
                $this->session->setFlashdata('errmessage', 'Not enough PIN Please Try Again..');
          }
           }else{
                $this->session->setFlashdata('errmessage', 'Not enough PIN Please Try Again..');
          }

  
          }else{
                $this->session->setFlashdata('errmessage', 'Wrong Transaction Number Please Try Again..');
          }

          return redirect()->to($_SERVER["HTTP_REFERER"]);



    }


     public function userTransferPinList() {
        $session = session();
        $searchArray = array();
      
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
          if ($session->get('user_id')) {
                $uid=$session->get('user_id');
                $username=$session->get('username');
                if($username)
                {
                    $searchArray['username'] = $username;
                }
            

          }
        
    
              
        $PinModel = new PinModel();
        $paginationnew = new Paginationnew();
        $txtsearch = $this->request->getGet('txtsearch');
        
        if($txtsearch)
        {
            $searchArray['txtsearch'] = $txtsearch;
        }
       
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $PinModel->getDataTransfer($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;     
        $data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
    
           $data["searchArray"] = $searchArray;
        
        
       

        $data['pin'] = $PinModel->getDataTransfer($searchArray, $startLimit, $Limit);
        // echo"<pre>";
        //   print_r($data['pin']);exit;

        $this->template->render('admintemplate', 'contents', 'admin/Pin/Transferpinlist', $data);
    }

    public function adminuserTransferPinbyadmin() {
        $session = session();
        $searchArray = array();
      
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
          if ($session->get('admin_id')) {
                $uid=$session->get('admin_id');
                $username=$session->get('username');
                if($username)
                {
                    // $searchArray['transfer_form'] = 'HOTOTT';
                }
            

          }
        
    
              
        $PinModel = new PinModel();
        $paginationnew = new Paginationnew();
        $txtsearch = $this->request->getGet('txtsearch');
        
        if($txtsearch)
        {
            $searchArray['txtsearch'] = $txtsearch;
        }
       
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $PinModel->admingetDataTransfer($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;     
        $data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
    
           $data["searchArray"] = $searchArray;
        
        
       

        $data['pin'] = $PinModel->admingetDataTransfer($searchArray, $startLimit, $Limit);
        // echo"<pre>";
        //   print_r($data['pin']);exit;

        $this->template->render('admintemplate', 'contents', 'admin/Pin/adminTransferpinlist', $data);
    }



      public function userTransferPinbyadmin()
    {
           $session = session();
       
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        
          $this->template->render('admintemplate', 'contents', 'admin/Pin/adminusertransferpin');
    }


    public  function otpVerify()
    {

         $session = session();
  
      
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $data= array();

    $data['user_id']= $user_id=$this->request->getPost('user_id');
        $data['pin_type']=  $pin_type=$this->request->getPost('pin_type');
          $data['qty']=$qty=$this->request->getPost('qty');
         $data['pass']= $pass=$this->request->getPost('pass');


          if ($session->get('admin_id')) {
            $id=$session->get('admin_id');
            $adminModel = new AdminModel();
            $addata=$adminModel->where('id',$id)->first();
            $name=$addata['fname'];
            $number=$addata['phone'];
            $data['phone']=$number;
            $data['admin']='admin';
            $data['id']=$id;

             $otp=rand(1111,9999);
                   
                    $arr=['otp'=>$otp];
                    
                   $adminModel->updatedata($id,$arr);

                     // $AdminModel->set($arr)->where('id',$id)->update();

                        $emailObject = new EmailSms();

                        $emailcontent = $emailObject->getMessage('otp');
                             
                            $smsbody = $emailcontent['SMS'];
                         
                          
                            $smsbody = str_replace("##USER_NAME##", $name, $smsbody);
                            $smsbody = str_replace("##OTP##", $otp, $smsbody);
                            $smsreturn =  $emailObject->smsotp($number,$smsbody); // send sms
             
            

          }elseif($session->get('user_id')){

          }

          
        
         return view('transferpinotp',$data);
    }

    public function verifyOTP()
{
     $session = session();
      if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
      if ($session->get('admin_id')) {
        $id=$session->get('admin_id');
      

      }



   $nu1 = $this->request->getPost("nu1");
            $nu2 = $this->request->getPost("nu2");
            $nu3 = $this->request->getPost("nu3");
            $nu4 = $this->request->getPost("nu4");
            $otp = $nu1 . $nu2 . $nu3 . $nu4;

   
        $login_type = $this->request->getPost("login_type");


      
        if ($login_type=='admin') {

          $AdminModel = new AdminModel();
            $otpCheck=$AdminModel->where('id',$id)->where('otp',$otp)->first();
            // print_r($otpCheck);exit;
        
              // Perform OTP verification here
              if ($otp == $otpCheck['otp']) {
                $message = '<p class="success">OTP verified successfully!</p>';
              } else {
                $message = '<p class="error">Invalid OTP!</p>';
              }

              echo $message; // Send response message
        }else{
         $UserModel = new UserModel();
            $otpCheck=$UserModel->where('username',$username)->where('password',$password)->where('otp',$otp)->first();

              // Perform OTP verification here
              if ($otp == $otpCheck['otp']) {
                $message = '<p class="success">OTP verified successfully!</p>';
              } else {
                $message = '<p class="error">Invalid OTP!</p>';
              }

              echo $message; // Send response message
           }
    }


    public function adminpinTranferSave(){
         $session = session();
   
      
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
          if ($session->get('admin_id')) {
                $uid=$session->get('admin_id');
                $username=$session->get('username');
              
          }

          $AdminModel = new AdminModel();
          $PinModel = new PinModel();
           $UserModel = new UserModel();
          $userdata=$AdminModel->select('transaction_password')->where('id',$uid)->first();


          $transaction_password=$userdata['transaction_password'];

          $user_id=$this->request->getPost('user_id');
          $pin_type=$this->request->getPost('pin_type');
          $qty=$this->request->getPost('qty');
          $pass=$this->request->getPost('pass');

          

          $postuserdata=$UserModel->where('username',$user_id)->first();
          $post_id=$postuserdata['id'];
          $post_name=$postuserdata['name'];


            if ($username == $user_id) {
                 $this->session->setFlashdata('errmessage', 'Something Went Wrong Please Try Again..');
                 return redirect()->to($_SERVER["HTTP_REFERER"]);
            }

            if ($transaction_password == $pass) {

                if ( $pin_type=='1') 
                {

                    $PackageModel= new PackageModel();
                   $packdata =$PackageModel->where('package_id','1')->first();
                   $amt=$packdata['amount'];
                   $packid=$packdata['package_id'];

                   $amt=$qty*$amt;
                   
                    $lastpin=array();
              for ($x = 1; $x <= $qty; $x++) {
                // $generatepin= mt_rand(100000000000000, 999999999999999);
                // $generatepin = $this->randomString21(21, $type = '');
                  $shortId = uniqid('', true);
             $generatepin = substr(str_replace('.', '', $shortId), 0, 21);
                $trans= mt_rand(1000000000, 9999999999);
                
                 $TransactionModel= new TransactionModel();
            $generatepincheck=$PinModel->where('pin',$generatepin)->find();
            $transaction=$TransactionModel->where('transaction_id',$trans)->find();
       
            // if($generatepincheck)
            // {
            // $this->session->setFlashdata('errmessage', 'Please Try Again..');
            // return redirect()->to($_SERVER["HTTP_REFERER"]);
            // }
            //   if($transaction)
            // {
            // $this->session->setFlashdata('errmessage', 'Please Try Again..');
            // return redirect()->to($_SERVER["HTTP_REFERER"]);
            // }
            
             $arrData = array(
                                                            'generate_id' => $post_id,
                                                            'username' => $user_id,
                                                            'generate_name' => $post_name,
                                                            'pin' => $generatepin,
                                                            'p_id' => $packid,
                                                            'purchase_status' => 'Active',
                                                            'used_status' => 'Inactive',
                                                            'pin_type' => '1',
                                                            'transfer_form'=>'HOTOTT',
                                                            'transfer_to'=>$user_id,
                                                        'pin_transfer_date'=>$date = date('Y-m-d H:i:s'),
                                                            'purchase_date' => date("Y-m-d h:m:s"),
                                                            
                                                        );
                                   $pinData = $PinModel->save($arrData);
                                   $userid = $PinModel->getInsertID();
                                   array_push($lastpin,$userid);
                                 


            }
              
              $lastpinsave=implode(",",$lastpin);
              $arrData1 = array(
                                                            'transaction_id' => $trans,
                                                            'username' => $user_id,
                                                            'pack_id' => $packid,
                                                            'pin_id' => $lastpinsave,
                                                            'pay_by' => 'Online',
                                                            'amount' => $amt,
                                                            'Payment_status' => 'Success',
                                                            'created' => date("Y-m-d h:m:s"),
                                                            
                                                        );
                        $TransactionModel->save($arrData1);
                        $UserModel = new UserModel();

                        
                        $this->session->setFlashdata('message', 'Tranfer Refferal pin Successfully..');
                        return redirect()->to($_SERVER["HTTP_REFERER"]);


                }else{
                    // $pin_type=='2'


                      $PackageModel= new PackageModel();
                   $packdata =$PackageModel->where('package_id','1')->first();
                   $amt=$packdata['amount'];
                   $packid=$packdata['package_id'];

                   $amt=$qty*$amt;
                   
                    $lastpin=array();
              for ($x = 1; $x <= $qty; $x++) {
                // $generatepin= mt_rand(100000000000000, 999999999999999);
                // $generatepin = $this->randomString21(30, $type = '');
                  $shortId = uniqid('', true);
             $generatepin = substr(str_replace('.', '', $shortId), 0, 30);
                $trans= mt_rand(1000000000, 9999999999);
                
                 $TransactionModel= new TransactionModel();
            $generatepincheck=$PinModel->where('pin',$generatepin)->find();
            $transaction=$TransactionModel->where('transaction_id',$trans)->find();
       
            // if($generatepincheck)
            // {
            // $this->session->setFlashdata('errmessage', 'Please Try Again..');
            // return redirect()->to($_SERVER["HTTP_REFERER"]);
            // }
            //   if($transaction)
            // {
            // $this->session->setFlashdata('errmessage', 'Please Try Again..');
            // return redirect()->to($_SERVER["HTTP_REFERER"]);
            // }
            
             $arrData = array(
                                                            'generate_id' => $post_id,
                                                            'username' => $user_id,
                                                            'generate_name' => $post_name,
                                                            'pin' => $generatepin,
                                                            'p_id' => $packid,
                                                            'purchase_status' => 'Active',
                                                            'used_status' => 'Inactive',
                                                            'pin_type' => '2',
                                                            'transfer_form'=>'HOTOTT',
                                                            'transfer_to'=>$user_id,
                                                        'pin_transfer_date'=>$date = date('Y-m-d H:i:s'),
                                                            'purchase_date' => date("Y-m-d h:m:s"),
                                                            
                                                        );
                                   $pinData = $PinModel->save($arrData);
                                   $userid = $PinModel->getInsertID();
                                   array_push($lastpin,$userid);
                                 


            }
              
              $lastpinsave=implode(",",$lastpin);
              $arrData1 = array(
                                                            'transaction_id' => $trans,
                                                            'username' => $user_id,
                                                            'pack_id' => $packid,
                                                            'pin_id' => $lastpinsave,
                                                            'pay_by' => 'Online',
                                                            'amount' => $amt,
                                                            'Payment_status' => 'Success',
                                                            'created' => date("Y-m-d h:m:s"),
                                                            
                                                        );
                        $TransactionModel->save($arrData1);
                        $UserModel = new UserModel();

                        
                        $this->session->setFlashdata('message', 'Tranfer Renewal pin Successfully..');
                        return redirect()->to($_SERVER["HTTP_REFERER"]);
                }


            

  
          }else{
                $this->session->setFlashdata('errmessage', 'Wrong Transaction Number Please Try Again..');
          }

          return redirect()->to($_SERVER["HTTP_REFERER"]);




       
    }

    public function randomString21($length, $type = '') {
      // Select which type of characters you want in your random string
      switch($type) {
        /*case 'num':
          // Use only numbers
          $salt = '1234567890';
          break;*/
        /*case 'lower':
          // Use only lowercase letters
          $salt = 'abcdefghijklmnopqrstuvwxyz';
          break;*/
        case 'upper':
          // Use only uppercase letters
          $salt = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
          break;
        default:
          // Use uppercase, lowercase, numbers, and symbols
          $salt = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
          break;
      }
      $rand = '';
      $i = 0;
      while ($i < $length) { // Loop until you have met the length
        $num = rand() % strlen($salt);
        $tmp = substr($salt, $num, 1);
        $rand = $rand . $tmp;
        $i++;
      }
      return $rand; // Return the random string
    }



     public function transferpindelete() {
        $session = session();

        $isAdminLoggedIn = $session->get('isAdminLoggedIn');

        $id = $this->request->getGet("id");

        $PinModel = new PinModel();

        if ($isAdminLoggedIn) {
           
            $PinModel->where('id', $id)->delete();

            $this->session->setFlashdata('message', ' Transfer PIN deleted successfully.');
        } else {
            $this->session->setFlashdata('errmessage', 'Invalid access.');
        }
      //  return redirect()->to(site_url('Customers'));
          return redirect()->to($_SERVER["HTTP_REFERER"]);
    }







}

?>

