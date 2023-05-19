<?php
 namespace App\Controllers;
 use App\Models\UserModel;
use App\Models\StateModel;
use App\Models\AdminModel;
use App\Models\CityModel;
use App\Models\UserWalletModel;
use App\Models\UserWalletTransactionModel;
use App\Models\TransactionModel;
use App\Models\linkUsedModel;
use App\Models\ActiveUserModel;
use App\Models\CountryModel;
use App\Models\BounceModel;
use App\Models\PinModel;
use App\Models\GeneratelinksModel;
use App\Models\PackageModel;
use App\Libraries\Paginationnew;
use App\Libraries\SiteVariables;
use App\Libraries\EmailSms;

class Invite extends BaseController
{
 
     
	public function index()
	{
		$refpin=$this->request->getGet('ref');
		$data['pin']=$refpin;
		 $siteVariables = new SiteVariables();
    $CountryModel = new CountryModel();
    $data['country']=$CountryModel->find();
    $data['position'] = $siteVariables->getVariable('position');
    $data['genderarb'] = $siteVariables->getVariable('genderarb');
          
		return view('invite',$data);
	}

	public function newUserSave() {
    

       
        $UserModel = new UserModel();
        $PinModel = new PinModel();

               

        
            $pin = (isset($_POST['pin']) && !empty($_POST['pin'])) ? $this->request->getPost('pin') : '';
             $delimiter = ",";
            $result = explode($delimiter, $pin);
            $user_id=$result[0];
            $pin_id=$result[1];
            $pin=$result[2];

            $userdata=$UserModel->where('id',$user_id)->first();

            $sponsor_id=$userdata['username'];
            $sponsor_name=$userdata['name'];


            $userdata=$PinModel->where('pin',$pin)->where('id',$pin_id)->where('used_status','Inactive')->first();
            if (!$userdata) {
                $flashdata = "PIN already registered in HOTOTT..";
                setcookie("flashdata", $flashdata, time() + 300);
            	return redirect()->to($_SERVER["HTTP_REFERER"]);
            }
          
          
            $formArr = array();  

    
          $UserWalletModel= new UserWalletModel();
         $UserWalletTransactionModel= new UserWalletTransactionModel();


         $formArr['parent_id'] = '0'; 


        $formArr['sponsor_name'] = $sponsor_name;
        $formArr['ref_id'] = $sponsor_id;
        $formArr['name'] = $name = (isset($_POST['name']) && !empty($_POST['name'])) ? $this->request->getPost('name') : '';
        
      
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



        
        
        // $moblRecord = $UserModel->checkMobileExist($mobile);
        // if ($moblRecord > 0) {
           

        //      $flashdata = "Mobile No Already Exist";
        //         setcookie("flashdata", $flashdata, time() + 300);
        //         return redirect()->to($_SERVER["HTTP_REFERER"]);
        // }


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
                   

                    $pinRecordpintable = $PinModel->where('id',$pin_id)->first();
        if ($pinRecordpintable > 0) {

            $pinid=$pinRecordpintable['id'];
            $pack_id=$pinRecordpintable['p_id'];
            $pinreco=$pinRecordpintable['pin'];
            $lastinsertid=$id;
             $pinRecordpintable = $PinModel->where('id',$pin_id)->first();
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

                            $flashdata = "Thank you for your message. It has been sent..";
                            setcookie("flashdata", $flashdata, time() + 300);
                            return redirect()->to($_SERVER["HTTP_REFERER"]);


      
    }

        public function socialLink($link)
    {
       
        $refpin=$link;
        $data['link']=$refpin;
         $siteVariables = new SiteVariables();
    $CountryModel = new CountryModel();
    $data['country']=$CountryModel->find();
    $data['position'] = $siteVariables->getVariable('position');
    $data['genderarb'] = $siteVariables->getVariable('genderarb');
          
        return view('socialLink',$data);
    }


    public function newUsersocialSave() {
    

       
        $UserModel = new UserModel();
        $PinModel = new PinModel();

            $link = (isset($_POST['link']) && !empty($_POST['link'])) ? $this->request->getPost('link') : '';
         
            $cklink = site_url('Refferal') . '/' . $link;
           
             $GeneratelinksModel = new GeneratelinksModel();
             $checklink=$GeneratelinksModel->where('links',$cklink)->first();
             $link_id=$checklink['id'];
             $link_create_user=$checklink['user_id'];
             // print_r($checklink);exit;
             // if ($checklink) {
             //    // exit;
             //    $flashdata = "This link has already been used.";
             //     print_r($flashdata);exit;
             //                // setcookie("flashdata", $flashdata, time() + 300);
             //                // return redirect()->to($_SERVER["HTTP_REFERER"]);
             // }


                         $formArr = array(); 

                         $pattern = "/(?<=TOT)(.*?)(?=Z!)/"; // positive lookbehind for TOT and positive lookahead for Z!
                            preg_match($pattern, $link, $matches);
                            $user_id = $matches[0];

                 $userdata=$UserModel->where('id',$user_id)->first();

            $sponsor_id=$userdata['username'];
            $sponsor_name=$userdata['name']; 

    
          $UserWalletModel= new UserWalletModel();
         $UserWalletTransactionModel= new UserWalletTransactionModel();


         $formArr['parent_id'] = '0'; 


        $formArr['sponsor_name'] = $sponsor_name;
        $formArr['ref_id'] = $sponsor_id;
        $formArr['name'] = $name = (isset($_POST['name']) && !empty($_POST['name'])) ? $this->request->getPost('name') : '';
        
      
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



        
        
        // $moblRecord = $UserModel->checkMobileExist($mobile);
        // if ($moblRecord > 0) {
           

        //      $flashdata = "Mobile No Already Exist";
        //         setcookie("flashdata", $flashdata, time() + 300);
        //         return redirect()->to($_SERVER["HTTP_REFERER"]);
        // }


           // get the position of 'OTT' in the string
               


                // $lastpin=array();
            
                // $generatepin= mt_rand(100000000000000, 999999999999999);
                $generatepin = $this->randomString21(21, $type = '');

                $trans= mt_rand(1000000000, 9999999999);
                
                 $TransactionModel= new TransactionModel();
            $generatepincheck=$PinModel->where('pin',$generatepin)->find();
            $transaction=$TransactionModel->where('transaction_id',$trans)->find();
       
            // if($generatepincheck)
            // {

            //      $flashdata = "This link has already been used.";
            //      print_r($flashdata);exit;
          
            // }
            //   if($transaction)
            // {
            // $this->session->setFlashdata('errmessage', 'Please Try Again..');
            // return redirect()->to($_SERVER["HTTP_REFERER"]);
            // }


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

                        // $formArr['purchase_date'] = $purchase_date =date('Y-m-d h:m:s');
                        // $formArr['purchase_status'] = $purchase_status ='Active';
                        // $formArr['used_status'] = $used_status ='Active';
                        // $formArr['used_date'] = $used_date =date("Y-m-d h:m:s");
                        // $formArr['used_id'] =  =$username;
                                        $arrData = array(
                                                            'generate_id' => $id,
                                                            'username' => $uname,
                                                            'generate_name' => $name,
                                                            'pin' => $generatepin,
                                                            'p_id' => '1',
                                                            'purchase_status' => 'Active',
                                                            'used_status' => 'Inactive',
                                                            'pin_type' => '1',
                                                            'purchase_date' => date("Y-m-d H:i:s"),
                                                            
                                                        );
                                   $pinData = $PinModel->save($arrData);
                                   $pin_id = $PinModel->getInsertID();

                                     $arrData1 = array(
                                                            'transaction_id' => $trans,
                                                            'username' => $uname,
                                                            'pack_id' => '1',
                                                            'pin_id' => $pin_id,
                                                            'pay_by' => 'Online',
                                                            'amount' => '499',
                                                            'status' => 'Active',
                                                            'created' => date("Y-m-d h:m:s"),
                                                            
                                                        );
                        $TransactionModel->save($arrData1);
                                
    

            // $userdata=$PinModel->where('pin',$generatepin)->where('id',$pin_id)->where('used_status','Inactive')->first();
            // if (!$userdata) {
            //     $flashdata = "PIN already registered in HOTOTT..";
            //     setcookie("flashdata", $flashdata, time() + 300);
            //     return redirect()->to($_SERVER["HTTP_REFERER"]);
            // }
          

                    $walletDETAILS= array('username'=>$uname,'current_amount'=>'0');
                      $checkuinset= $UserWalletModel->save($walletDETAILS);
                   

                    $pinRecordpintable = $PinModel->where('id',$pin_id)->first();
        if ($pinRecordpintable > 0) {

            $pinid=$pinRecordpintable['id'];
            $pack_id=$pinRecordpintable['p_id'];
            $pinreco=$pinRecordpintable['pin'];
            $lastinsertid=$id;
             $pinRecordpintable = $PinModel->where('id',$pin_id)->first();
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

                             $cklink = site_url('Refferal') . '/' . $link;
           
             $GeneratelinksModel = new GeneratelinksModel();
             $linkUsedModel = new linkUsedModel();

             $changestatus=['status'=>'1'];
             $checklink=$GeneratelinksModel->set($changestatus)->where('links',$cklink)->update();
             $savainfo=['link_id'=>$link_id,'link_create_user'=>$link_create_user,'used_id'=>$id];
             $linkUsedModel->save($savainfo);

                            $flashdata = "Thank you for your message. It has been sent your Email Please Check..";
                            print_r($flashdata);
                            


      
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

	

}
