<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\API\ResponseTrait;
use App\Models\AdminModel;
use App\Models\MedicineModel;
use App\Models\UserModel;
use App\Models\PackageModel;
use App\Models\BounceModel;
use App\Models\ActiveUserModel;
use App\Models\AdminChargesModel;
use App\Models\GSTModel;
use App\Models\TDSmodel;
use App\Models\StaffModel;
use App\Libraries\EmailSms;
use CodeIgniter\Session\Session;
use App\Libraries\Paginationnew;

class Admin extends BaseController {

    protected $session;
    protected $isAdminLoggedIn;

    public function __construct() {

        $this->session = session();
        //echo "<pre>"; print_r($session);die;
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');
    }

    public function index() {
        
        $session = session();

        $isAdminLoggedIn = $session->get('isAdminLoggedIn');

        if ($isAdminLoggedIn) {
            //echo "<pre>"; print_r($session->get('isAdminLoggedIn'));die;
            return redirect()->to(site_url('dashboard'));
        }

        $errorMsg = "";
        $method = $this->request->getMethod();

        $adminModel = new AdminModel();
        if ($method == 'post') {
            $username = $this->request->getPost("username");
            $password = $this->request->getPost("password");
            if ($username != '' && $password != '') {
                $return = $adminModel->checkAdminLogin($username, $password);

               // var_dump($return);
                

                if ($return) {

                $number = $return->phone;
                    $name = $return->fname;
                    $id = $return->id;

                    
                    $prefix = '+91';
                    $asterisks = str_repeat('*', 8); // 8 asterisks to replace the first 8 digits

                    $masked_number = $prefix . $asterisks . substr($number, -2); // concatenate the prefix, asterisks, and last two digits

                    $data['phone']=$masked_number;
                    $data['username']=$username;
                    $data['password']=$password;
                    $data['admin']='admin';


                   //  $otp=rand(1111,9999);
                   
                   //  $arr=['otp'=>$otp];
                   //  $adminModel = new AdminModel();
                   // $adminModel->updatedata($id,$arr);

                   //  // $AdminModel->set($arr)->where('id',$id)->update();

                   //      $emailObject = new EmailSms();

                   //      $emailcontent = $emailObject->getMessage('otp');
                             
                   //          $smsbody = $emailcontent['SMS'];
                         
                          
                   //          $smsbody = str_replace("##USER_NAME##", $name, $smsbody);
                   //          $smsbody = str_replace("##OTP##", $otp, $smsbody);
                   //          $smsreturn =  $emailObject->smsotp($number,$smsbody); // send sms

                     return view('otp',$data);

                    //return redirect()->to(site_url('dashboard'));
                } else {
                    $session->setFlashdata('errmessage', 'Invalid Email / Password');
                }
            } else {
                $session->setFlashdata('errmessage', 'Invalid Email / Password');
            }
        }

        $UserModel = new UserModel();
        if ($method == 'post') {
            $username = $this->request->getPost("username");
            $password = $this->request->getPost("password");
            
           
            if ($username != '' && $password != '') {
                $return = $UserModel->checkUserLogin($username,$password);

                // var_dump($return);
              

                if ($return) {

                   

                    $number = $return->mobile;
                    $name = $return->name;
                    $id = $return->id;
                    
                    $prefix = '+91';
                    $asterisks = str_repeat('*', 8); // 8 asterisks to replace the first 8 digits

                    $masked_number = $prefix . $asterisks . substr($number, -2); // concatenate the prefix, asterisks, and last two digits

                    $data['phone']=$masked_number;
                    $data['username']=$username;
                    $data['password']=$password;


                    // $otp=rand(1111,9999);
                    // $arr=['otp'=>$otp];

                    // $UserModel->set($arr)->where('id',$id)->update();

                    //     $emailObject = new EmailSms();

                    //     $emailcontent = $emailObject->getMessage('otp');
                             
                    //         $smsbody = $emailcontent['SMS'];
                         
                          
                    //         $smsbody = str_replace("##USER_NAME##", $name, $smsbody);
                    //         $smsbody = str_replace("##OTP##", $otp, $smsbody);
                    //         $smsreturn =  $emailObject->smsotp($number,$smsbody); // send sms
                        



                   

                    return view('otp',$data);


                 // return redirect()->to(site_url('dashboard'));
                } else {
                    // exit;
                    // $session->setFlashdata('errmessage', 'Invalid Email / Password');
                    // return redirect()->to(site_url('admin'));
                     $StaffModel = new StaffModel();
        if ($method == 'post') {
            $username = $this->request->getPost("username");
            $password = $this->request->getPost("password");
            
           
            if ($username != '' && $password != '') {
                $return = $StaffModel->checkStaffLogin($username,$password);
                
              

                if ($return) {

                   

                    $number = $return->phone;
                    $name = $return->name;
                    $id = $return->id;
                    
                    $prefix = '+91';
                    $asterisks = str_repeat('*', 8); // 8 asterisks to replace the first 8 digits

                    $masked_number = $prefix . $asterisks . substr($number, -2); // concatenate the prefix, asterisks, and last two digits

                    $data['phone']=$masked_number;
                    $data['username']=$username;
                    $data['password']=$password;


                    // $otp=rand(1111,9999);
                    // $arr=['otp'=>$otp];

                    // $StaffModel->set($arr)->where('id',$id)->update();

                    //     $emailObject = new EmailSms();

                    //     $emailcontent = $emailObject->getMessage('otp');
                             
                    //         $smsbody = $emailcontent['SMS'];
                         
                          
                    //         $smsbody = str_replace("##USER_NAME##", $name, $smsbody);
                    //         $smsbody = str_replace("##OTP##", $otp, $smsbody);
                    //         $smsreturn =  $emailObject->smsotp($number,$smsbody); // send sms
                        



                   

                    return view('staffotp',$data);


                 // return redirect()->to(site_url('dashboard'));
                } else {
                    $session->setFlashdata('errmessage', 'Invalid Email / Password');
                    return redirect()->to(site_url('admin'));
                }
            } else {
                $session->setFlashdata('errmessage', 'Invalid Email / Password');
                return redirect()->to(site_url('admin'));
            }
        }


                }
            } else {
                $session->setFlashdata('errmessage', 'Invalid Email / Password');
                return redirect()->to(site_url('admin'));
            }
        }

         //////////////////////////// staff login ////////////////////////



        

       

       

        $this->template->render('admintemplate', 'contents', 'admin/loginTpl', array("errorMsg" => $errorMsg));
    }
    public function Stafflogincheck(){
        $session = session();
       
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");
        $login_type = $this->request->getPost("login_type");
       
            $StaffModel = new StaffModel();
        if ($username != '' && $password != '') {
         $return = $StaffModel->checkStaffLogin2($username,$password);

        
                if ($return) {
                  return redirect()->to(site_url('dashboard'));

                } else {
                    $session->setFlashdata('errmessage', 'Invalid Email / Password');
                    return redirect()->to(site_url('admin'));
                }
            } else {
                $session->setFlashdata('errmessage', 'Invalid Email / Password');
                return redirect()->to(site_url('admin'));
            }

    }

    public function logincheck(){
        $session = session();
       
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");
        $login_type = $this->request->getPost("login_type");
        if ($login_type=='admin') {
            $AdminModel = new AdminModel();
        if ($username != '' && $password != '') {
         $return = $AdminModel->checkUserLogin2($username,$password);

        
                if ($return) {
                  return redirect()->to(site_url('dashboard'));

                } else {
                    $session->setFlashdata('errmessage', 'Invalid Email / Password');
                    return redirect()->to(site_url('admin'));
                }
            } else {
                $session->setFlashdata('errmessage', 'Invalid Email / Password');
                return redirect()->to(site_url('admin'));
            }


        }else{


     
        $UserModel = new UserModel();
        if ($username != '' && $password != '') {
         $return = $UserModel->checkUserLogin2($username,$password);

        
                if ($return) {
                  return redirect()->to(site_url('dashboard'));

                } else {
                    $session->setFlashdata('errmessage', 'Invalid Email / Password');
                    return redirect()->to(site_url('admin'));
                }
            } else {
                $session->setFlashdata('errmessage', 'Invalid Email / Password');
                return redirect()->to(site_url('admin'));
            }
        }
           
           



    }

    public function staffverifyOTP()
{

   $nu1 = $this->request->getPost("nu1");
            $nu2 = $this->request->getPost("nu2");
            $nu3 = $this->request->getPost("nu3");
            $nu4 = $this->request->getPost("nu4");
            $otp = $nu1 . $nu2 . $nu3 . $nu4;

            $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");
        


      
        

          $StaffModel = new StaffModel();
            $otpCheck=$StaffModel->where('email',$username)->where('otp',$otp)->first();
        
              // Perform OTP verification here
              if ($otp == $otpCheck['otp']) {
                $message = '<p class="success">OTP verified successfully!</p>';
              } else {
                $message = '<p class="error">Invalid OTP!</p>';
              }

              echo $message; // Send response message
        
    }

public function verifyOTP()
{

   $nu1 = $this->request->getPost("nu1");
            $nu2 = $this->request->getPost("nu2");
            $nu3 = $this->request->getPost("nu3");
            $nu4 = $this->request->getPost("nu4");
            $otp = $nu1 . $nu2 . $nu3 . $nu4;

            $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");
        $login_type = $this->request->getPost("login_type");


      
        if ($login_type=='admin') {

          $AdminModel = new AdminModel();
            $otpCheck=$AdminModel->where('email',$username)->where('otp',$otp)->first();
        
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


    public function dashboard() {

        $session = session();
        $UserModel = new UserModel();
         if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $data = array();

        $adminModel = new AdminModel();
        $data['login'] = $adminModel->LoginID();
        if ($session->get('admin_id')) {
            $isAdminLoggedIn = $session->get('admin_id');
             $right=$UserModel->select('id')->where('side','right')->find();
        $data['rightcount']=count($right);
        $left=$UserModel->select('id')->where('side','left')->find();
        $data['leftcount']=count($left);
         $Middle=$UserModel->select('id')->where('side','Middle')->find();
        $data['Middlecount']=count($Middle);

        $total=count($right)+count($left)+count($Middle);
        $data['totalcount']=$total;
          

        } else if ($session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
            $db = db_connect();
            // left count
            $query = "
           WITH RECURSIVE category_tree (id, name, parent_id, path, level, username, side, sponsor_name) AS (
                SELECT id, name, parent_id, CAST(id AS CHAR(200)), 1, username, side, sponsor_name
                FROM users
                WHERE parent_id='".$isAdminLoggedIn."'
            
                UNION ALL
                SELECT c.id, c.name, c.parent_id, CONCAT(ct.path, ',', c.id), ct.level + 1, c.username, c.side, c.sponsor_name
                FROM users c
                JOIN category_tree ct ON c.parent_id = ct.id
            )
            SELECT id, name, parent_id, path, level, username, side, sponsor_name
            FROM category_tree
            WHERE level BETWEEN 1 AND 12
            And side='left'
            ORDER BY level;
        ";

         $result = $db->query($query);
       $totalcount =count($result->getResult());
       $data['leftcount']=$totalcount;

       // right count

        $query = "
           WITH RECURSIVE category_tree (id, name, parent_id, path, level, username, side, sponsor_name) AS (
                SELECT id, name, parent_id, CAST(id AS CHAR(200)), 1, username, side, sponsor_name
                FROM users
                WHERE parent_id='".$isAdminLoggedIn."'
            
                UNION ALL
                SELECT c.id, c.name, c.parent_id, CONCAT(ct.path, ',', c.id), ct.level + 1, c.username, c.side, c.sponsor_name
                FROM users c
                JOIN category_tree ct ON c.parent_id = ct.id
            )
            SELECT id, name, parent_id, path, level, username, side, sponsor_name
            FROM category_tree
            WHERE level BETWEEN 1 AND 12
            And side='Right'
            ORDER BY level;
        ";

         $result = $db->query($query);
       $rightcount =count($result->getResult());
       $data['rightcount']=$rightcount;

       // middle count


        $query = "
           WITH RECURSIVE category_tree (id, name, parent_id, path, level, username, side, sponsor_name) AS (
                SELECT id, name, parent_id, CAST(id AS CHAR(200)), 1, username, side, sponsor_name
                FROM users
                WHERE parent_id='".$isAdminLoggedIn."'
            
                UNION ALL
                SELECT c.id, c.name, c.parent_id, CONCAT(ct.path, ',', c.id), ct.level + 1, c.username, c.side, c.sponsor_name
                FROM users c
                JOIN category_tree ct ON c.parent_id = ct.id
            )
            SELECT id, name, parent_id, path, level, username, side, sponsor_name
            FROM category_tree
            WHERE level BETWEEN 1 AND 12
            And side='Middle'
            ORDER BY level;
        ";

         $result = $db->query($query);
       $Middle =count($result->getResult());
       $data['Middlecount']=$Middle;


       $total=$totalcount+$rightcount+$Middle;
       $data['totalcount']=$total;       
        } 
       
      //  return redirect()->to(site_url('logout'));

        
        $this->template->render('admintemplate', 'contents', 'admin/dashboard', $data);
    }

/////////////////////////  company dashboard ///////////////////////////////

    public function dashboard1() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        $data = array();

        $medModel = new MedicineModel();
        $searchArray = '';
        $data['totalmedicinecount'] = $medModel->getData($searchArray, '', '', 1);

        $delboyModel = new DelBoyModel();
        $searchArray = '';
        $data['totaldeliveryboyscount'] = $delboyModel->getData($searchArray, '', '', 1);

        $ordersModel = new OrdersModel();
        $searchArray = '';
        $data['totalorderscount'] = $ordersModel->getData($searchArray, '', '', 1);

        $userModel = new UserModel();
        $searchArray = '';
        $data['totalcustomerscount'] = $userModel->getData($searchArray, '', '', 1);

        $this->template->render('admintemplate', 'contents', 'admin/dashboard1', $data);
    }





    // PACKAGE 
       public function package() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
         $PackageModel= new PackageModel();
         $data['package']=$PackageModel->find();
        $this->template->render('admintemplate', 'contents', 'admin/package/packagelist',$data);
       }

        public function edditpackage() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $id=$this->request->getGet('id');
         $PackageModel= new PackageModel();
         $data['edit']=$PackageModel->find($id);
        $this->template->render('admintemplate', 'contents', 'admin/package/packageedit',$data);
       }

        public function savePackage() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $id=$this->request->getPost('id');
        $formArr = array();
        $formArr['package_name'] = $package_name = (isset($_POST['package_name']) && !empty($_POST['package_name'])) ? $this->request->getPost('package_name') : '';
        $formArr['amount'] = $amount = (isset($_POST['amount']) && !empty($_POST['amount'])) ? $this->request->getPost('amount') : '';
        $formArr['stock'] = $stock = (isset($_POST['stock']) && !empty($_POST['stock'])) ? $this->request->getPost('stock') : '';
        $formArr['capping'] = $capping = (isset($_POST['capping']) && !empty($_POST['capping'])) ? $this->request->getPost('capping') : '';
        $formArr['update_datetime'] = date("Y-m-d H:i:s");;
        
         $PackageModel= new PackageModel();
         if ($id) {
            $PackageModel->set($formArr)->where('package_id',$id)->update();

           $this->session->setFlashdata('message', 'Package Details Update Successfully!');
           return redirect()->to($_SERVER["HTTP_REFERER"]);
         }else{
            $this->session->setFlashdata('errmessage', 'Package Id does not exist!');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
         }
         $this->session->setFlashdata('errmessage', 'Something Went Wrong!');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
        
       }


       // BOUNCE
        public function Bounce() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
         $BounceModel= new BounceModel();
         $data['bounce']=$BounceModel->find();
        $this->template->render('admintemplate', 'contents', 'admin/Bounce/bouncelist',$data);
       }
        public function edditBounce() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $id=$this->request->getGet('id');
         $BounceModel= new BounceModel();
         $data['edit']=$BounceModel->find($id);
        $this->template->render('admintemplate', 'contents', 'admin/Bounce/bounceedit',$data);
       }

          public function saveBounce() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
      
        $id=$this->request->getPost('id');
        $formArr = array();
        
        $formArr['amount'] = $amount = (isset($_POST['amount']) && !empty($_POST['amount'])) ? $this->request->getPost('amount') : '';
       
        $formArr['update_date'] = date("Y-m-d H:i:s");;
        
         $BounceModel= new BounceModel();
         if ($id) {
            $BounceModel->set($formArr)->where('id',$id)->update();

           $this->session->setFlashdata('message', 'Bounce Details Update Successfully!');
           return redirect()->to($_SERVER["HTTP_REFERER"]);
         }
         $this->session->setFlashdata('errmessage', 'Something Went Wrong!');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
        
       }


    public function edit_password()
    {

        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        $this->template->render('admintemplate', 'contents' , 'admin/profile/change_password');

    }

    public function update_password() {
         $session = session();
        $UserModel = new UserModel();
        $adminModel = new AdminModel();
         $old_password = $this->request->getPost('old_password');
        $new_password = $this->request->getPost('new_password');
        $confirm_password = $this->request->getPost('confirm_password');
         if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $userid = $this->session->get('user_id');
        $admin_id = $this->session->get('admin_id');
      
      

        if ($admin_id) {
           $admindata=$adminModel->where('id',$admin_id)->first();
           $dbPassword=$admindata['password'];
           if(password_verify($old_password,$dbPassword)){


            if ($new_password == $confirm_password ) {

                $update_password=['password'=>password_hash($new_password,1)];
                $check=$adminModel->set($update_password)->where('id',$admin_id)->update();
                if ($check) {
                   $this->session->setFlashdata('message', 'Password Updated Successfully!');
                 return redirect()->to($_SERVER["HTTP_REFERER"]);
                }else{
                   $this->session->setFlashdata('errmessage', 'Password NotUpdated...');
            return redirect()->to($_SERVER["HTTP_REFERER"]); 
                }


              
            }else{
                 $this->session->setFlashdata('errmessage', 'New and confirm passwords do not match.');
            return redirect()->to($_SERVER["HTTP_REFERER"]);

            }

           }else{
         $this->session->setFlashdata('errmessage', 'Incorrect old password!');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
           }
          
        }else{


        $userdata=$UserModel->where('id',$userid)->first();
           $dbPassword=$userdata['password'];
           if($old_password==$dbPassword){


            if ($new_password == $confirm_password ) {

                $update_password=['password'=>$new_password];
                $check=$UserModel->set($update_password)->where('id',$userid)->update();
                if ($check) {
                   $this->session->setFlashdata('message', 'Password Updated Successfully!');
                 return redirect()->to($_SERVER["HTTP_REFERER"]);
                }else{
                   $this->session->setFlashdata('errmessage', 'Password NotUpdated...');
            return redirect()->to($_SERVER["HTTP_REFERER"]); 
                }


              
            }else{
                 $this->session->setFlashdata('errmessage', 'New and confirm passwords do not match.');
            return redirect()->to($_SERVER["HTTP_REFERER"]);

            }

           }else{
         $this->session->setFlashdata('errmessage', 'Incorrect old password!');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
           }



        }

}


    public function tranupdate_password() {
         $session = session();
        $UserModel = new UserModel();
        $adminModel = new AdminModel();
         $old_password = $this->request->getPost('told_password');
        $new_password = $this->request->getPost('tnew_password');
        $confirm_password = $this->request->getPost('tcnf_new_password');
         if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $userid = $this->session->get('user_id');
      if ($userid) {
        $userdata=$UserModel->where('id',$userid)->first();
           $dbPassword=$userdata['transaction_password'];
           if($old_password==$dbPassword){


            if ($new_password == $confirm_password ) {

                $update_password=['transaction_password'=>$new_password];
                $check=$UserModel->set($update_password)->where('id',$userid)->update();
                if ($check) {
                   $this->session->setFlashdata('message', 'Transaction Password Updated Successfully!');
                 return redirect()->to($_SERVER["HTTP_REFERER"]);
                }else{
                   $this->session->setFlashdata('errmessage', 'Transaction Password NotUpdated...');
            return redirect()->to($_SERVER["HTTP_REFERER"]); 
                }


              
            }else{
                 $this->session->setFlashdata('errmessage', 'New and confirm Transaction passwords do not match.');
            return redirect()->to($_SERVER["HTTP_REFERER"]);

            }

           }else{
         $this->session->setFlashdata('errmessage', 'Incorrect old Transaction password!');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
           }
       }



       

}



 // Admin charges
        public function pointShareCharges() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
         $AdminChargesModel= new AdminChargesModel();
         $data['list']=$AdminChargesModel->find();
        $this->template->render('admintemplate', 'contents', 'admin/AdminCharges/pointsharecharges',$data);
       }
        public function edditpointShareCharges() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $id=$this->request->getGet('id');

         $AdminChargesModel= new AdminChargesModel();
         $data['edit']=$AdminChargesModel->find($id);
        $this->template->render('admintemplate', 'contents', 'admin/AdminCharges/editsharepoint',$data);
       }

          public function savepointShareCharges() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
      
        $id=$this->request->getPost('id');

        // $formArr = array();
        
      $amount = (isset($_POST['amount']) && !empty($_POST['amount'])) ? $this->request->getPost('amount') : '';
      
      $remark = (isset($_POST['remark']) && !empty($_POST['remark'])) ? $this->request->getPost('remark') : '';
       
        // $formArr['update_on'] = date("Y-m-d H:i:s");

        $formArr=['amount'=>$amount,'remark'=>$remark, 'update_on'=>date("Y-m-d H:i:s")];


        
         $AdminChargesModel= new AdminChargesModel();
         if ($id) {
            $AdminChargesModel->updatedata($id, $formArr);
            


           $this->session->setFlashdata('message', 'Admin Charges Update Successfully!');
           return redirect()->to($_SERVER["HTTP_REFERER"]);
         }
         $this->session->setFlashdata('errmessage', 'Something Went Wrong!');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
        
       }


       public function activeTeam(){
      $searchArray = array();
        $session = session();
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

         
        if ($session->get('admin_id')) {
            // $isAdminLoggedIn = $session->get('admin_id');
            // $username = $session->get('name');
          
     
              
        $UserModel = new UserModel();
        $paginationnew = new Paginationnew();
        $txtsearch = $this->request->getGet('txtsearch');
        
        if($txtsearch)
        {
            $searchArray['txtsearch'] = $txtsearch;
        }
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $UserModel->getDataActive($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;      
        $data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        // print_r($totalRecord);exit;
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
       
           $data["searchArray"] = $searchArray;
        
        
       

        $data['customers'] = $UserModel->getDataActive($searchArray, $startLimit, $Limit);
        $this->template->render('admintemplate', 'contents', 'admin/customer/admincustomerlist', $data);
        exit;

          
        } else if ($session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
            $username = $session->get('username');

            if($isAdminLoggedIn)
        {
            $searchArray['parent_id'] = $isAdminLoggedIn;
        }
        }

        
        $paginationnew = new Paginationnew();

        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = 20;


         $db = db_connect();

        // Define the query
        $query = "
              SELECT ct.*, ot.status
FROM (
    WITH RECURSIVE category_tree (id, name, parent_id, path, level, username, side, sponsor_name, mobile) AS (
        SELECT id, name, parent_id, CAST(id AS CHAR(200)), 1, username, side, sponsor_name, mobile FROM users
        WHERE parent_id='".$isAdminLoggedIn."'

        UNION ALL

        SELECT c.id, c.name, c.parent_id, CONCAT(ct.path, ',', c.id), ct.level + 1, c.username, c.side, c.sponsor_name, c.mobile
        FROM users c
        JOIN category_tree ct ON c.parent_id = ct.id
    )
    SELECT id, name, parent_id, path, level, username, side, sponsor_name, mobile
    FROM category_tree
    ORDER BY level ASC
) AS ct
JOIN active_user ot ON ct.username = ot.username; -- Join condition goes here
        ";

        //  $query = "
        //    WITH RECURSIVE category_tree (id, name, parent_id, path, level, username, side, sponsor_name, mobile) AS (
        //         SELECT id, name, parent_id, CAST(id AS CHAR(200)), 1, username, side, sponsor_name, mobile FROM users
        //         WHERE parent_id='".$isAdminLoggedIn."'
            
        //         UNION ALL
        //         SELECT c.id, c.name, c.parent_id, CONCAT(ct.path, ',', c.id), ct.level + 1, c.username, c.side, c.sponsor_name, c.mobile
        //         FROM users c
        //         JOIN category_tree ct ON c.parent_id = ct.id
        //     )
        //     SELECT id, name, parent_id, path, level, username, side, sponsor_name, mobile
        //     FROM category_tree

        //     ORDER BY level ASC;
        // ";

     

        // Execute the query
        $result = $db->query($query);
       $totalcount =count($result->getResult());

        
        $totalRecord = $totalcount;
        $startLimit = ($page - 1) * $Limit;     
        $data['reverse'] = $totalRecord-($page -1) * $Limit;
        // $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);

            $query = "
               SELECT ct.*, ot.status
FROM (
    WITH RECURSIVE category_tree (id, name, parent_id, path, level, username, side, sponsor_name, mobile) AS (
        SELECT id, name, parent_id, CAST(id AS CHAR(200)), 1, username, side, sponsor_name, mobile FROM users
        WHERE parent_id='".$isAdminLoggedIn."'

        UNION ALL

        SELECT c.id, c.name, c.parent_id, CONCAT(ct.path, ',', c.id), ct.level + 1, c.username, c.side, c.sponsor_name, c.mobile
        FROM users c
        JOIN category_tree ct ON c.parent_id = ct.id
    )
    SELECT id, name, parent_id, path, level, username, side, sponsor_name, mobile
    FROM category_tree

    
   
) AS ct
JOIN active_user ot ON ct.username = ot.username ORDER BY level ASC LIMIT $startLimit,$Limit; -- Join condition goes here
 
        ";
      
      
        //   $query = "
        //    WITH RECURSIVE category_tree (id, name, parent_id, path, level, username, side, sponsor_name, mobile ) AS (
        //         SELECT id, name, parent_id, CAST(id AS CHAR(200)), 1, username, side, sponsor_name, mobile FROM users
        //         WHERE parent_id='".$isAdminLoggedIn."'
        //         UNION ALL
        //         SELECT c.id, c.name, c.parent_id, CONCAT(ct.path, ',', c.id), ct.level + 1, c.username, c.side, c.sponsor_name, c.mobile
        //         FROM users c
        //         JOIN category_tree ct ON c.parent_id = ct.id
        //     )
        //     SELECT id, name, parent_id, path, level, username, side, sponsor_name, mobile
        //     FROM category_tree

        //     ORDER BY level ASC
        //     LIMIT    $startLimit,$Limit;
        // ";
        $result = $db->query($query);

// echo "<pre>";
//         print_r($query);
//         exit;
        // Build the tree structure
        $tree = array();
        foreach ($result->getResult() as $row) {
            
//         exit;
            $id = $row->id;
            $name = $row->name;
            $parent_id = $row->parent_id;
            $path = $row->path;
            $level = $row->level;
            $side = $row->side;
            $sponsor_name = $row->sponsor_name;
            $username = $row->username;
            $mobile = $row->mobile;
            $status = $row->status;

            // Create a new node for this category
            $node = array('name' => $name,'username' => $username,'side' => $side,'sponsor_name' => $sponsor_name,'level' => $level,'path' => $path,'mobile' => $mobile,'status' => $status);
      

           
       

            // Check if this node has a parent
            if ($parent_id === $isAdminLoggedIn) {
                // This is a root node
                $tree[$id] = $node;
              

             
            } else {
                // This is a child node
                $parent = &$tree[$parent_id];

                if (!isset($parent['children'])) {
                    $parent['children'] = array();
                }
                $parent['children'][$id] = $node;
            }
        }

        // Pass the tree structure to the view
        $data = array('tree' => $tree);
        // print_r($tree);exit;

        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        
       

      

        $this->template->render('admintemplate', 'contents', 'admin/activeteam', $data);
       }


        public function gstlist() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
         $GSTModel= new GSTModel();
         $data['list']=$GSTModel->find();
        $this->template->render('admintemplate', 'contents', 'admin/gst',$data);
       }
        public function edditgstlist() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $id=$this->request->getGet('id');

         $GSTModel= new GSTModel();
         $data['edit']=$GSTModel->find($id);
        $this->template->render('admintemplate', 'contents', 'admin/editGST',$data);
       }

       public function saveGST() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
      
        $id=$this->request->getPost('id');

        // $formArr = array();
        
      $cgst = (isset($_POST['cgst']) && !empty($_POST['cgst'])) ? $this->request->getPost('cgst') : '';
      $sgst = (isset($_POST['sgst']) && !empty($_POST['sgst'])) ? $this->request->getPost('sgst') : '';
       
        // $formArr['update_on'] = date("Y-m-d H:i:s");

        $formArr=['cgst'=>$cgst,'sgst'=>$sgst,'edited_on'=>date("Y-m-d H:i:s")];


        
         $GSTModel= new GSTModel();
         if ($id) {
            $GSTModel->updatedata($id, $formArr);
            


           $this->session->setFlashdata('message', 'Admin GST Update Successfully!');
           return redirect()->to($_SERVER["HTTP_REFERER"]);
         }
         $this->session->setFlashdata('errmessage', 'Something Went Wrong!');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
        
       }

        public function tdslist() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
         $TDSmodel= new TDSmodel();
         $data['list']=$TDSmodel->find();
        $this->template->render('admintemplate', 'contents', 'admin/tds',$data);
       }
        public function edditTDSlist() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $id=$this->request->getGet('id');

         $TDSmodel= new TDSmodel();
         $data['edit']=$TDSmodel->find($id);
        $this->template->render('admintemplate', 'contents', 'admin/editTDS',$data);
       }

       public function saveTDS() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
      
        $id=$this->request->getPost('id');

        // $formArr = array();
        
      $tds = (isset($_POST['tds']) && !empty($_POST['tds'])) ? $this->request->getPost('tds') : '';
       
        // $formArr['update_on'] = date("Y-m-d H:i:s");

        $formArr=['tds'=>$tds,'edited_on'=>date("Y-m-d H:i:s")];


        
         $TDSmodel= new TDSmodel();
         if ($id) {
            $TDSmodel->updatedata($id, $formArr);
            


           $this->session->setFlashdata('message', 'Admin TDS Update Successfully!');
           return redirect()->to($_SERVER["HTTP_REFERER"]);
         }
         $this->session->setFlashdata('errmessage', 'Something Went Wrong!');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
        
       }

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to(site_url('admin'));
    }

}
