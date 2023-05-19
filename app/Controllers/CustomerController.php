<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\StateModel;
use App\Models\AdminModel;
use App\Models\CityModel;
use App\Models\UserWalletModel;
use App\Models\UserWalletTransactionModel;
use App\Models\ActiveUserModel;
use App\Models\CountryModel;
use App\Models\BounceModel;
use App\Models\PinModel;
use App\Models\PackageModel;
use App\Libraries\Paginationnew;
use App\Libraries\SiteVariables;
use App\Libraries\EmailSms;

class CustomerController extends BaseController {

    protected $session;
    protected $isAdminLoggedIn;


    public function __construct() {
        $this->session = session();
             $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');
    }

    public function Allcustomerlist() {
        $searchArray = array();
        $session = session();
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

         $session = session();
        if ($session->get('admin_id')) {
            // $isAdminLoggedIn = $session->get('admin_id');
            // $username = $session->get('name');
            $stateModel = new StateModel();
        $data['states'] = $stateModel->findAll();
              
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
        $totalRecord = $UserModel->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;      
        $data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        // print_r($totalRecord);exit;
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
       
           $data["searchArray"] = $searchArray;
        
        
       

        $data['customers'] = $UserModel->getData($searchArray, $startLimit, $Limit);
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
        $Limit = PER_PAGE_RECORD;


         $db = db_connect();

        // Define the query
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

            ORDER BY level ASC;
        ";
     

        // Execute the query
        $result = $db->query($query);
       $totalcount =count($result->getResult());

        
        $totalRecord = $totalcount;
        $startLimit = ($page - 1) * $Limit;     
        $data['reverse'] = $totalRecord-($page -1) * $Limit;
        // $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);

        
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

            ORDER BY level ASC
            LIMIT    $startLimit,$Limit;
        ";
        $result = $db->query($query);

// echo "<pre>";
//         print_r($query);
//         exit;
        // Build the tree structure
        $tree = array();
        foreach ($result->getResult() as $row) {
            $id = $row->id;
            $name = $row->name;
            $parent_id = $row->parent_id;
            $path = $row->path;
            $level = $row->level;
            $side = $row->side;
            $sponsor_name = $row->sponsor_name;
            $username = $row->username;

            // Create a new node for this category
            $node = array('name' => $name,'username' => $username,'side' => $side,'sponsor_name' => $sponsor_name,'level' => $level,'path' => $path);
           
       

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
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        // echo "<pre>";
        // print_r($startLimit);
        // exit;

        $this->template->render('admintemplate', 'contents', 'admin/customer/customerlist', $data);
    }

    function index() {
         $session = session();
        if ($session->get('admin_id')) {
            $user_id = $session->get('admin_id');
            $username = $session->get('name');

           
        } else if ($session->get('user_id')) {
            $user_id = $session->get('user_id');
            $username = $session->get('username');
        }
    
    $siteVariables = new SiteVariables();
    $CountryModel = new CountryModel();
    $PinModel = new PinModel();
   $data['pindata']=$PinModel->where('generate_id',$user_id)->where('used_status','Inactive')->where('pin_type','1')->limit(1)->find();



    $data['country']=$CountryModel->find();
    $data['position'] = $siteVariables->getVariable('position');
    $data['genderarb'] = $siteVariables->getVariable('genderarb');

    $id=$this->request->getGet('id');
    if ($id) {
        $UserModel = new UserModel();
      
        $data['edit'] = $UserModel->getCustomerID($id);

    }
    
    //echo"<pre>"; print_r($data['genderarr']);die;
    $this->template->render('admintemplate', 'contents', 'admin/customer/customer_form', $data);
    }
    public function ajax_sponsor(){
       
        $iname=$this->request->getPost('sponsor_id');

         $UserModel = new UserModel();
         $AdminModel = new AdminModel();
         $num_row=$UserModel->where('username',$iname)->find();
         $data=$AdminModel->where('username',$iname)->find();


       
        if($num_row > 0){
            
            echo $name=$num_row[0]['name'];
        }
        if($data > 0){
            
            echo $name=$data[0]['fname'];
        }

    }

     function ajax_state(){

        $StateModel = new StateModel();

        $id=$this->request->getPost('id');
        $sd=$StateModel->where('country_id',$id)->find();

        // $sql=$this->db->query("select id,name from states where country_id='$id'");
        //echo $sql;
        //die();
        echo '<option value="0">-- Select State--</option>';
        // $sd = $sql->result_array();
        foreach($sd as $row)
        {
        $id=$row['id'];
        $name=$row['name'];
        echo '<option value="'.$id.'">'.$name.'</option>';
        }
    }
     function ajax_city(){
        $CityModel = new CityModel();
        
       $id=$this->request->getPost('id');
        $sd=$CityModel->where('state_id',$id)->find();
      
        echo '<option value="0">-- Select City--</option>';
     
        foreach($sd as $row)
        {
            $id=$row['id'];
            $name=$row['name'];
            echo '<option value="'.$id.'">'.$name.'</option>';
        }
    }

   

    public function newUserSave() {
           $session = session();
        if ($session->get('admin_id')) {
            $isAdminLoggedIn = $session->get('admin_id');
            $username = $session->get('name');

            $isAdminLoggedIn = $session->get('admin_id');
        } else if ($data=$session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
            $username = $session->get('username');
          

        }

        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $UserModel = new UserModel();
        $PinModel = new PinModel();

        $formArr = array();  
        $id = (isset($_POST['id']) && !empty($_POST['id'])) ? $this->request->getPost('id') : ''; 
        $formArr['side'] = $side = (isset($_POST['side']) && !empty($_POST['side'])) ? $this->request->getPost('side') : '';


        
         $sponsor_id =(isset($_POST['sponsor_id']) && !empty($_POST['sponsor_id'])) ? $this->request->getPost('sponsor_id') : '';
         if ($sponsor_id=='admin') {
             $parent_id='2';
         }else{

            if ($side=='Others') {
              $parent_id='0';
              $formArr['ref_id'] =$sponsor_id;
            }else{
            $pdata=$UserModel->where('username',$sponsor_id)->first();
           $parent_id= $pdata['id'];
            }
          
         }
          $UserWalletModel= new UserWalletModel();
         $UserWalletTransactionModel= new UserWalletTransactionModel();


         $formArr['parent_id'] = $parent_id; 


        $formArr['sponsor_name'] = $sponsor_name =(isset($_POST['sponsor_name']) && !empty($_POST['sponsor_name'])) ? $this->request->getPost('sponsor_name') : '';
        $formArr['name'] = $name = (isset($_POST['name']) && !empty($_POST['name'])) ? $this->request->getPost('name') : '';
        
        $formArr['pin'] = $pin = (isset($_POST['pin']) && !empty($_POST['pin'])) ? $this->request->getPost('pin') : '';
        $formArr['email'] = $email = (isset($_POST['email']) && !empty($_POST['email'])) ? $this->request->getPost('email') : '';
        $formArr['mobile'] = $mobile = (isset($_POST['mobile']) && !empty($_POST['mobile'])) ? $this->request->getPost('mobile') : '';
        $formArr['gender'] = $gender = (isset($_POST['gender']) && !empty($_POST['gender'])) ? $this->request->getPost('gender') : '';
        $formArr['date_of_birth'] = $date_of_birth = (isset($_POST['date_of_birth']) && !empty($_POST['date_of_birth'])) ? $this->request->getPost('date_of_birth') : '';
        $formArr['nomine_name'] = $nomine_name = (isset($_POST['nomine_name']) && !empty($_POST['nomine_name'])) ? $this->request->getPost('nomine_name') : '';
        $formArr['nomine_relation'] = $nomine_relation = (isset($_POST['nomine_relation']) && !empty($_POST['nomine_relation'])) ? $this->request->getPost('nomine_relation') : '';
        $formArr['address_line1'] = $address_line1 = (isset($_POST['address_line1']) && !empty($_POST['address_line1'])) ? $this->request->getPost('address_line1') : '';
        $formArr['address_line2'] = $address_line2 = (isset($_POST['address_line2']) && !empty($_POST['address_line2'])) ? $this->request->getPost('address_line2') : '';
        $formArr['country'] = $country = (isset($_POST['country']) && !empty($_POST['country'])) ? $this->request->getPost('country') : '';
        $formArr['state'] = $state = (isset($_POST['state']) && !empty($_POST['state'])) ? $this->request->getPost('state') : '';
        $formArr['city'] = $city = (isset($_POST['city']) && !empty($_POST['city'])) ? $this->request->getPost('city') : '';
        $formArr['zip_code'] = $zip_code = (isset($_POST['zip_code']) && !empty($_POST['zip_code'])) ? $this->request->getPost('zip_code') : '';
        $formArr['bank_name'] = $bank_name = (isset($_POST['bank_name']) && !empty($_POST['bank_name'])) ? $this->request->getPost('bank_name') : '';

        $formArr['bank_country'] = $bank_country = (isset($_POST['bank_country']) && !empty($_POST['bank_country'])) ? $this->request->getPost('bank_country') : '';
        $formArr['acc_holder_name'] = $acc_holder_name = (isset($_POST['acc_holder_name']) && !empty($_POST['acc_holder_name'])) ? $this->request->getPost('acc_holder_name') : '';
        $formArr['account_no'] = $account_no = (isset($_POST['account_no']) && !empty($_POST['account_no'])) ? $this->request->getPost('account_no') : '';
        $formArr['ifsc_code'] = $ifsc_code = (isset($_POST['ifsc_code']) && !empty($_POST['ifsc_code'])) ? $this->request->getPost('ifsc_code') : '';
         $formArr['terms'] = $terms = (isset($_POST['terms']) && !empty($_POST['terms'])) ? $this->request->getPost('terms') : '';



         if ($id) {
             $UserModel->set($formArr)->where('id',$id)->update();
              $this->session->setFlashdata('message', 'Updated Successfully..');
              return redirect()->to($_SERVER["HTTP_REFERER"]);
         }

        
        $moblRecord = $UserModel->checkMobileExist($mobile);
        if ($moblRecord > 0) {
            $this->session->setFlashdata('errmessage', 'Mobile No Already Exist');
            return redirect()->to(site_url('AddCustomer'));
        }

        $pinRecord = $UserModel->checkPin($pin);
      
        if ($pinRecord > 0) {
            $this->session->setFlashdata('errmessage', 'This PIN Already Exist');
            return redirect()->to(site_url('AddCustomer'));
        }
      




            if ($side!='Others') {
         $totalside = $UserModel->checkSide($side,$parent_id);
        if ($totalside > 0) {
            $this->session->setFlashdata('errmessage', 'This Postion Already Exist');
            return redirect()->to(site_url('AddCustomer'));
        }
    }

           $formArr['password']=$password = rand('111111','999999');
           $formArr['transaction_password']=$transaction_pass = rand('1111','9999');

     
   

       
       $UserModel = new UserModel();
       $ActiveUserModel = new ActiveUserModel();
       $BounceModel = new BounceModel();
         

        $UserModel->save($formArr);
        $id = $UserModel->getInsertID();
        //  echo $UserModel->getLastQuery()->getQuery();
        // echo"<pre>";
        // print_r($id);exit;

            $rnd_no = rand('111','999');
                    $id4=$id.''.$rnd_no;
                    $uname = "HT$id4";
                    $datausern = array('username'=> $uname);
                   $UserModel->set($datausern)->where('id',$id)->update();

                   $datactive1 = array(                
                                       'username' => $uname 
                                                    );

                   $ActiveUserModel->save($datactive1);
                   $activeuserdata_id = $ActiveUserModel->getInsertID();

                    $walletDETAILS= array('username'=>$uname,'current_amount'=>'0');
                      $checkuinset= $UserWalletModel->save($walletDETAILS);
                   

                    $pinRecordpintable = $PinModel->where('id',$pin)->first();
        if ($pinRecordpintable > 0) {

            $pinid=$pinRecordpintable['id'];
            $pack_id=$pinRecordpintable['p_id'];
            $pinreco=$pinRecordpintable['pin'];
            $lastinsertid=$id;
             $pinRecordpintable = $PinModel->where('id',$pin)->first();
             $updatepinused= array('used_id'=>$uname,'used_status'=>'Active','used_date'=>date("Y-m-d H:i:s"));
                   $PinModel->set($updatepinused)->where('id',$pinid)->update();


                     $updatepinactive= array('pid'=>$pack_id,'pinId'=>$pinid,'pin'=>$pinreco,'status'=>'Active');
                      $ActiveUserModel->set($updatepinactive)->where('id',$activeuserdata_id)->update();

                        $userActive= array('pin'=>$pinreco,'package_id'=>$pack_id,'status'=>'Active','update_datetime'=>date("Y-m-d H:i:s"));

                      $UserModel->set($userActive)->where('id',$lastinsertid)->update();

                     
                      $checkexistdata=$UserWalletModel->where('username',$sponsor_id)->first();
                      if ($checkexistdata) {
                        $w_id=$checkexistdata['w_id'];
                        $current_amount=$checkexistdata['current_amount'];
                        $bdata=$BounceModel->where('b_type','joining_bounce')->first();
                        $bamount=$bdata['amount'];
                        $totalcurrent_amount=$current_amount+$bamount;
                        $walletupdate= array('current_amount'=>$totalcurrent_amount,'update_date'=>date("Y-m-d H:i:s"));
                        $UserWalletModel->set($walletupdate)->where('w_id',$w_id)->update();
                          
                      }else{
                        $bdata=$BounceModel->where('b_type','joining_bounce')->first();
                        $bamount=$bdata['amount'];
                        $wallet= array('username'=>$sponsor_id,'current_amount'=>$bamount);
                       $UserWalletModel->save($wallet);
                      }


                       $bdata=$BounceModel->where('b_type','joining_bounce')->first();
                        $bamount=$bdata['amount'];

                       $walletlog= array('username'=>$sponsor_id,'amount'=>$bamount,'type'=>'deposit','status'=>'successful');
                       $UserWalletTransactionModel->save($walletlog);


        }


                $emailObject = new EmailSms();

                $emailcontent = $emailObject->getMessage('register');
                             
                            
                            $toEmail = $email;
                            $name = $name;
                            $uname = $uname;
                            $password = $password;
                            $transaction_pass = $transaction_pass;
                            $subject = $emailcontent['SUBJECT'];
                            $mailbody = $emailcontent['BODY'];
                            $smsbody = $emailcontent['SMS'];
                         
                            $mailbody = str_replace("##USER_NAME##", $name, $mailbody);
                            $mailbody = str_replace("##UNAME##", $uname, $mailbody);
                            $mailbody = str_replace("##PASSWORD##", $password, $mailbody);
                            $mailbody = str_replace("##TRANSACTION_PASS##", $transaction_pass, $mailbody);
                            $smsbody = str_replace("##USER_NAME##", $name, $smsbody);
                            $smsreturn =  $emailObject->send_sms($mobile,$smsbody); // send sms
                            $emailObject->sendEmail($toEmail, $subject, $mailbody, '', '', $attachement); 



                            $PackageModel = new PackageModel();
$pack=$PackageModel->where('package_id','1')->first();
$packageAmount=$pack['amount'];
 $SMScontent = $emailObject->getMessage('Subcription');

 $smsbody2 = $SMScontent['SMS'];
  $smsbody2 = str_replace("##USER_AMOUNT##", $packageAmount, $smsbody2);
                            $smsreturn2 =  $emailObject->sendSubcription($mobile,$smsbody2); // send sms
                            
                            $this->session->setFlashdata('message', 'Thank you for your message. It has been sent..');
     return redirect()->to(base_url('AddCustomer'));


      
    }

  

//////////// delete customer /////////////


    public function delete_customer() {
        $session = session();

        $isAdminLoggedIn = $session->get('isAdminLoggedIn');

        $id = $this->request->getGet("id");

        $UserModel = new UserModel();

        if ($isAdminLoggedIn) {
           
            $UserModel->where('id', $id)->delete();

            $this->session->setFlashdata('message', 'User deleted successfully.');
        } else {
            $this->session->setFlashdata('errmessage', 'Invalid access.');
        }
      //  return redirect()->to(site_url('Customers'));
          return redirect()->to($_SERVER["HTTP_REFERER"]);
    }




///////// customer detail //////////////////////

    public function customerdetails() {
        $session = session();

        $isAdminLoggedIn = $session->get('isAdminLoggedIn');

        if (!$isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        $id = $this->request->getGet("id");
     

        $UserModel = new UserModel();
        $data['preview'] = $UserModel->getCustomerID($id); // return count value
// echo"<pre>";
//        print_r($data['preview']);exit;

        if (!$data['preview']) {
            $this->session->setFlashdata('errmessage', 'User Id Does not exist!');
            return redirect()->to(site_url('Customers'));
        }

        $this->template->render('admintemplate', 'contents', 'admin/customer/customerdetails', $data);
    }



public function refferalTeam(){
        $searchArray = array();
        $session = session();
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        if ($session->get('user_id')) {
            $isAdminLoggedIn = $session->get('user_id');
            $username = $session->get('username');
         

             if($username)
            { 
                $searchArray['ref_id'] =$username;
            }
        } 

      
      
            $stateModel = new StateModel();
        $data['states'] = $stateModel->findAll();
              
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
        $totalRecord = $UserModel->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;      
        $data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        // print_r($totalRecord);exit;
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
       
           $data["searchArray"] = $searchArray;
        
        
       

        $data['customers'] = $UserModel->getData($searchArray, $startLimit, $Limit);
        $this->template->render('admintemplate', 'contents', 'admin/customer/refferalcustomerlist', $data);
}


}

?>

