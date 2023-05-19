<?php

namespace App\Controllers;
use App\Models\UserWalletTransactionModel;
use App\Models\AdminChargesModel;
use App\Models\SherePointsModel;
use App\Models\UserWalletModel;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Libraries\Paginationnew;

class WalletSystem extends BaseController {

    protected $session;
    protected $isAdminLoggedIn;

    public function __construct() {
        $this->session = session();
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');
    }

    function index() {
        $session = session();
        $searchArray = array();
        if ($session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
             $username = ($session->get('username'));
             if($username){ 
             	$searchArray['username'] =$username;  

                  }

        } else if ($session->get('admin_id')) {
            $isAdminLoggedIn = $session->get('admin_id');
        }
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

      
      

        $UserWalletTransactionModel = new UserWalletTransactionModel();

            $paginationnew = new Paginationnew();
            
            $txtsearch = $this->request->getGet('txtsearch');
			
           

             if ($txtsearch) {
             	$searchArray['txtsearch'] =$txtsearch;
             }

            $page = $this->request->getGet('page');
            $page = $page ? $page : 1;
            $Limit = PER_PAGE_RECORD;
            $totalRecord = $UserWalletTransactionModel->getData($searchArray, '', '', '1');
            $startLimit = ($page - 1) * $Limit;
			$data['reverse'] = $totalRecord-($page -1) * $Limit;
            $data['startLimit'] = $startLimit;
            $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
            $data['txtsearch'] = $txtsearch;
            $data['startLimit'] = $startLimit;
            $data['pagination'] = $pagination;
            $data["searchArray"] = $searchArray;
        

            $data['history'] = $UserWalletTransactionModel->getData($searchArray, $startLimit, $Limit);
            // echo "<pre>";
            // print_r($$data['history']);exit;

      
        $this->template->render('admintemplate', 'contents', 'admin/Wallet/wallethistory', $data);
    }



    public function sharePoints(){

        $AdminChargesModel= new AdminChargesModel();
        $adcharge=$AdminChargesModel->where('charges_type','share_point')->first();
        $percent=$adcharge['amount'];
        $data['percent']=$percent;

        $this->template->render('admintemplate', 'contents', 'admin/Wallet/addsharePoints',$data);

    }
    
    public function adminSharePoints(){

        $AdminChargesModel= new AdminChargesModel();
        $adcharge=$AdminChargesModel->where('charges_type','share_point')->first();
        $percent=$adcharge['amount'];
        $data['percent']=$percent;

        $this->template->render('admintemplate', 'contents', 'admin/Wallet/addadminsharePoints',$data);

    }

    public function pointTranferSave(){

          $session = session();
       
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
         if ($session->get('user_id')) {
                $uid=$session->get('user_id');
                $username=$session->get('username');
            

          }else if ($session->get('admin_id')) {
            $isAdminLoggedIn = $session->get('admin_id');
        }


         $UserModel = new UserModel();
         $UserWalletModel = new UserWalletModel();
          
          $userdata=$UserModel->select('transaction_password')->where('id',$uid)->first();

          $transaction_password=$userdata['transaction_password'];

          $sponsor_id=$this->request->getPost('sponsor_id');
          $point=$this->request->getPost('amt');
          $pass=$this->request->getPost('pass');

        

      

            if (strcasecmp($username, $sponsor_id) == 0) {
                 $this->session->setFlashdata('errmessage', 'Something Went Wrong Please Try Again..');
                 return redirect()->to($_SERVER["HTTP_REFERER"]);
            }
          

             if ($transaction_password == $pass) {

                $userData=$UserWalletModel->where('username',$username)->first();
                $current_point=$userData['current_amount'];


                if ($current_point >= $point) {

                    $AdminChargesModel= new AdminChargesModel();
        $adcharge=$AdminChargesModel->where('charges_type','share_point')->first();
        $percent=$adcharge['amount'];
        // $current_point = 1180;
        // $percent = 2;
        $percent_value = ($percent/100) * $point;
        $total_deductAmount=$point-$percent_value;

        $usercurrent_point=$current_point-$point;
      

        $SherePointsModel = new SherePointsModel();
        $arr=[
            'shere_username'=>$username,
            'received_username'=>$sponsor_id,
            'share_amount'=>$total_deductAmount,
        ];

  


        $checksavedata=$SherePointsModel->save($arr);
       if ($checksavedata) {



                $walletupdate=[
                    'current_amount'=>$usercurrent_point,
                    'update_date'=>date('Y-m-d H:i:s'),
                ];

                $UserWalletModel = new UserWalletModel();


         $aftcheckupadte= $UserWalletModel->set($walletupdate)->where('username',$username)->update();
      

         if ($aftcheckupadte) {

            $UserWalletTransactionModel = new UserWalletTransactionModel();
            $arrupdate=[
                    'username'=>$username,
                    'amount'=>$point,
                    'type'=>'Transfer',
                    'remark'=>'points Transfer to ' .$sponsor_id,
                    'status'=>'successful',
            ];

            $checkupdate=$UserWalletTransactionModel->save($arrupdate);

            if ($checkupdate) {



                $UserWalletModel = new UserWalletModel();
                $checkbal=$UserWalletModel->where('username',$sponsor_id)->first();
                $usercbal=$checkbal['current_amount'];

                $totalcureentbal=$total_deductAmount+$usercbal;

                 $walletupdate=[
                    'current_amount'=>$totalcureentbal,
                    'update_date'=>date('Y-m-d H:i:s'),
                ];

         $aftcheckupadte1= $UserWalletModel->set($walletupdate)->where('username',$sponsor_id)->update();
         if ($aftcheckupadte1) {

             $UserWalletTransactionModel = new UserWalletTransactionModel();
            $arrupdate=[
                    'username'=>$sponsor_id,
                    'amount'=>$total_deductAmount,
                    'type'=>'deposit',
                    'remark'=>'points received by ' .$username,
                    'status'=>'successful',
            ];

            $checkupdate=$UserWalletTransactionModel->save($arrupdate);
             $this->session->setFlashdata('message', 'Point Transfer Successfully!');
            
         }
              
            }



            
         }





        
       }else{
           $this->session->setFlashdata('errmessage', 'Something Went Wrong Please Try Again..');
       }









                }else{
                    $this->session->setFlashdata('errmessage', 'you do not have enough balance to proceed..'); 
                }
              



             }else{
                $this->session->setFlashdata('errmessage', 'Wrong Transaction Number Please Try Again..');
          }
          return redirect()->to($_SERVER["HTTP_REFERER"]);


       
    }
    
    public function adminpointTranferSave(){

          $session = session();
       
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
         if ($session->get('admin_id')) {
            $isAdminLoggedIn = $session->get('admin_id');
            $username=$session->get('username');
        }

         $AdminModel = new AdminModel();
         $UserWalletModel = new UserWalletModel();
          
          $userdata=$AdminModel->select('transaction_password')->where('id',$isAdminLoggedIn)->first();

          $transaction_password=$userdata['transaction_password'];

          $sponsor_id=$this->request->getPost('sponsor_id');
          $point=$this->request->getPost('amt');
          $pass=$this->request->getPost('pass');

        

      

            if (strcasecmp($username, $sponsor_id) == 0) {
                 $this->session->setFlashdata('errmessage', 'Something Went Wrong Please Try Again..');
                 return redirect()->to($_SERVER["HTTP_REFERER"]);
            }
          

             if ($transaction_password == $pass) {

                $userData=$UserWalletModel->where('username',$username)->first();
                $current_point=$userData['current_amount'];


                if ($current_point >= $point) {

                    $AdminChargesModel= new AdminChargesModel();
        $adcharge=$AdminChargesModel->where('charges_type','share_point')->first();
        $percent=$adcharge['amount'];
        // $current_point = 1180;
        // $percent = 2;
        $percent_value = ($percent/100) * $point;
        $total_deductAmount=$point-$percent_value;

        $usercurrent_point=$current_point-$point;
      

        $SherePointsModel = new SherePointsModel();
        $arr=[
            'shere_username'=>$username,
            'received_username'=>$sponsor_id,
            'share_amount'=>$total_deductAmount,
        ];

  


        $checksavedata=$SherePointsModel->save($arr);
       if ($checksavedata) {



                $walletupdate=[
                    'current_amount'=>$usercurrent_point,
                    'update_date'=>date('Y-m-d H:i:s'),
                ];

                $UserWalletModel = new UserWalletModel();


         $aftcheckupadte= $UserWalletModel->set($walletupdate)->where('username',$username)->update();
      

         if ($aftcheckupadte) {

            $UserWalletTransactionModel = new UserWalletTransactionModel();
            $arrupdate=[
                    'username'=>$username,
                    'amount'=>$point,
                    'type'=>'Transfer',
                    'remark'=>'points Transfer to ' .$sponsor_id,
                    'status'=>'successful',
            ];

            $checkupdate=$UserWalletTransactionModel->save($arrupdate);

            if ($checkupdate) {



                $UserWalletModel = new UserWalletModel();
                $checkbal=$UserWalletModel->where('username',$sponsor_id)->first();
                $usercbal=$checkbal['current_amount'];

                $totalcureentbal=$total_deductAmount+$usercbal;

                 $walletupdate=[
                    'current_amount'=>$totalcureentbal,
                    'update_date'=>date('Y-m-d H:i:s'),
                ];

         $aftcheckupadte1= $UserWalletModel->set($walletupdate)->where('username',$sponsor_id)->update();
         if ($aftcheckupadte1) {

             $UserWalletTransactionModel = new UserWalletTransactionModel();
            $arrupdate=[
                    'username'=>$sponsor_id,
                    'amount'=>$total_deductAmount,
                    'type'=>'deposit',
                    'remark'=>'points received by ' .$username,
                    'status'=>'successful',
            ];

            $checkupdate=$UserWalletTransactionModel->save($arrupdate);
             $this->session->setFlashdata('message', 'Point Transfer Successfully!');
            
         }
              
            }



            
         }





        
       }else{
           $this->session->setFlashdata('errmessage', 'Something Went Wrong Please Try Again..');
       }









                }else{
                    $this->session->setFlashdata('errmessage', 'you do not have enough balance to proceed..'); 
                }
              



             }else{
                $this->session->setFlashdata('errmessage', 'Wrong Transaction Number Please Try Again..');
          }
          return redirect()->to($_SERVER["HTTP_REFERER"]);


       
    }

     function sharePointslist() {
        $session = session();
        $searchArray = array();
        if ($session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
             $username = ($session->get('username'));
             if($username){ 
                $searchArray['username'] =$username;  

                  }

        } else if ($session->get('admin_id')) {
            $isAdminLoggedIn = $session->get('admin_id');
        }
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

      
      

        $SherePointsModel = new SherePointsModel();

            $paginationnew = new Paginationnew();
            
            $txtsearch = $this->request->getGet('txtsearch');
            
           

             if ($txtsearch) {
                $searchArray['txtsearch'] =$txtsearch;
             }

            $page = $this->request->getGet('page');
            $page = $page ? $page : 1;
            $Limit = PER_PAGE_RECORD;
            $totalRecord = $SherePointsModel->getData($searchArray, '', '', '1');
            $startLimit = ($page - 1) * $Limit;
            $data['reverse'] = $totalRecord-($page -1) * $Limit;
            $data['startLimit'] = $startLimit;
            $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
            $data['txtsearch'] = $txtsearch;
            $data['startLimit'] = $startLimit;
            $data['pagination'] = $pagination;
            $data["searchArray"] = $searchArray;
        

            $data['history'] = $SherePointsModel->getData($searchArray, $startLimit, $Limit);
            // echo "<pre>";
            // print_r($$data['history']);exit;

      
        $this->template->render('admintemplate', 'contents', 'admin/Wallet/sharepointhistory', $data);
    }
    
    function adminSharePointslist() {
        $session = session();
        $searchArray = array();
        if ($session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
             $username = ($session->get('username'));
             if($username){ 
                $searchArray['username'] =$username;  

                  }

        } else if ($session->get('admin_id')) {
            $isAdminLoggedIn = $session->get('admin_id');
        }
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

      
      

        $SherePointsModel = new SherePointsModel();

            $paginationnew = new Paginationnew();
            
            $txtsearch = $this->request->getGet('txtsearch');
            
           

             if ($txtsearch) {
                $searchArray['txtsearch'] =$txtsearch;
             }

            $page = $this->request->getGet('page');
            $page = $page ? $page : 1;
            $Limit = PER_PAGE_RECORD;
            $totalRecord = $SherePointsModel->getData($searchArray, '', '', '1');
            $startLimit = ($page - 1) * $Limit;
            $data['reverse'] = $totalRecord-($page -1) * $Limit;
            $data['startLimit'] = $startLimit;
            $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
            $data['txtsearch'] = $txtsearch;
            $data['startLimit'] = $startLimit;
            $data['pagination'] = $pagination;
            $data["searchArray"] = $searchArray;
        

            $data['history'] = $SherePointsModel->getData($searchArray, $startLimit, $Limit);
            // echo "<pre>";
            // print_r($$data['history']);exit;

      
        $this->template->render('admintemplate', 'contents', 'admin/Wallet/sharepointhistory', $data);
    }


    public function withdrawPoint(){

         $this->template->render('admintemplate', 'contents', 'admin/Wallet/withdrawPoint');

    }


    public function withdrawSave(){

         $session = session();
       
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
         if ($session->get('user_id')) {
                $uid=$session->get('user_id');
                $username=$session->get('username');
            

          }


         $UserModel = new UserModel();
         $UserWalletModel = new UserWalletModel();
          
          $userdata=$UserModel->select('transaction_password')->where('id',$uid)->first();

          $transaction_password=$userdata['transaction_password'];

          $sponsor_id=$this->request->getPost('username');
          $point=$this->request->getPost('amt');
          $pass=$this->request->getPost('pass');

        

      

       

             if ($transaction_password == $pass) {

                $userData=$UserWalletModel->where('username',$username)->first();
                $current_point=$userData['current_amount'];


                if ($current_point >= $point) {


                    $AdminChargesModel= new AdminChargesModel();
        $adcharge=$AdminChargesModel->where('charges_type','withdraw_point')->first();
        $percent=$adcharge['amount'];

        // $current_point = 1180;
        // $percent = 2;
        $percent_value = ($percent/100) * $point;

        $total_deductAmount=$point-$percent_value;



        $usercurrent_point=$current_point-$point;

                $walletupdate=[
                    'current_amount'=>$usercurrent_point,
                    'update_date'=>date('Y-m-d H:i:s'),
                ];

                $UserWalletModel = new UserWalletModel();


         $aftcheckupadte= $UserWalletModel->set($walletupdate)->where('username',$username)->update();
      

         if ($aftcheckupadte) {

            $UserWalletTransactionModel = new UserWalletTransactionModel();
            $arrupdate=[
                    'username'=>$username,
                    'amount'=>$point,
                    'type'=>'withdraw',
                    'remark'=>$percent.' Admin Charge By withdraw points is '.$total_deductAmount,
                    'status'=>'successful',
            ];

            $checkupdate=$UserWalletTransactionModel->save($arrupdate);  
             $this->session->setFlashdata('message', 'Points withdraw Successfully!');


         }





        
      








                }else{
                    $this->session->setFlashdata('errmessage', 'you do not have enough balance to proceed..'); 
                }
              



             }else{
                $this->session->setFlashdata('errmessage', 'Wrong Transaction Number Please Try Again..');
          }
          return redirect()->to($_SERVER["HTTP_REFERER"]);

    }






}

?>
