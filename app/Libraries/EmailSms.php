<?php namespace App\Libraries;


class EmailSms {

   
    
	  protected $SMS_BASE_URL;
    protected $SMS_SENDERID='HOTOTT';
    protected $SMS_API_KEY='aG90b3R0OlptdjJJT3R5';
    
    function __construct()
    {

        $this->SMS_BASE_URL = "https://webpostservice.com/sendsms_v2.0/sendsms.php?apikey=".$this->SMS_API_KEY."&type=TEXT&sender=".$this->SMS_SENDERID."";
    
    }
    private $arrMessage = array();

    public function getMessage($key){


		//message for registration
		$this->arrMessage['register'] =array( "SUBJECT"=>"Registration Details for HOTOTT",
         "BODY"=>" Dear ##USER_NAME##,<br><br>
													 Thank you for registering with us.<br>
                                                     Your Username is <b>##UNAME##</b><br>Password is <b>##PASSWORD##</b> <br>and Transaction Password is <b>##TRANSACTION_PASS##</b>.
												",
                                           "SMS"=>"Dear ##USER_NAME## welcome to HOTOTT family you are registered successfully with us.
Thank you HOTOTT ENTERTAINMENT PRIVATE LIMITED"
                                        );

        $this->arrMessage['Subcription'] =array( "SUBJECT"=>"Registration Details for HOTOTT",
                                         "SMS"=>"Your subscription of INR ##USER_AMOUNT## has been successfully created.
thank you HOTOTT ENTERTAINMENT PRIVATE LIMITED");

        $this->arrMessage['Renewal'] =array( "SUBJECT"=>"",
                                         "SMS"=>"Your Renewal of INR ##USER_AMOUNT## is pending , please do it asap.
thank you HOTOTT ENTERTAINMENT PRIVATE LIMITED");

         $this->arrMessage['Rewards'] =array( "SUBJECT"=>"",
                                         "SMS"=>"Dear ##USER_NAME## CONGRATULATIONS you get {#var#} views on your video.
thank you HOTOTT ENTERTAINMENT PRIVATE LIMITED");

         $this->arrMessage['Reward_win'] =array( "SUBJECT"=>"",
                                         "SMS"=>"Dear {#var#} CONGRATULATIONS you win {#var#}.
Thank you HOTOTT ENTERTAINMENT PRIVATE LIMITED");

          $this->arrMessage['otp'] =array( "SUBJECT"=>"",
                                         "SMS"=>"Dear ##USER_NAME## Your OTP Code is: ##OTP## please do not share with anyone.
Thank You HOTOTT ENTERTAINMENT PRIVATE LIMITED");






        $this->arrMessage['upgrade_package'] =array( "SUBJECT"=>"Package Upgrade Successfully for HOTOTT",
         "BODY"=>" Dear ##USER_NAME##,<br><br>
                                                     Congratulation Your User Package upgrade successful and enjoy to All Win.
                                                ");


		//message for gorgot password
		$this->arrMessage['forgotpassword'] = " Dear ##USER_NAME## <br>
													 Your Password generation link ##PASSWPRD_LINK## . <br> Please click above link and reset your password.
                        ";
                        
    //message for gorgot password
		$this->arrMessage['renewpassword'] = " Dear ##USER_NAME## <br>
    Your Password updated successfully.";

    //message for gorgot password
		$this->arrMessage['fillingcomplain'] = " Hello, <br>
    Please find below complain details <br> <br> 
   <table width='50%'>
   <tr><td><b> Name: </b></td><td> ##C_NAME##</td><tr>
   <tr><td><b>Address: </b></td><td> ##C_ADDRESS## </td><tr>
   <tr><td><b>Phone (day):</b></td><td> ##C_PHONE## </td><tr>
   <tr><td><b> Phone (cell): </b></td><td> ##C_MOBILE## </td><tr>
   <tr><td><b> E-mail Address: </b></td><td> ##C_EMAIL## </td><tr>
   <tr><td><b> Kola Account Number: </b></td><td> ##C_KOLA_ACCOUNT## </td><tr>
   <tr><td><b>Complain Detail: </b></td><td>  ##C_DETAILS## </td><tr>
   <tr><td> <b>Signing Name: </b></td><td> ##C_SIGNING_NAME## </td><tr>
   <tr><td><b> Time: </b></td><td> ##C_SIGNING_TIME## </td><tr>
    ";
		
		if(array_key_exists($key,$this->arrMessage))
		{
			return $this->arrMessage[$key];
		}
  }
  
  

  public function getEmailFooter()
  {
     return "Thanks & Regards <br> ".SITE_NAME." Team";
  }

  //function for send email

  public function sendEmail($toEmail, $subject = '', $mailbody = '',$bcc="",$cc="",$attachement="") {

         $email = \Config\Services::email();

        // $config = Array(
        //         'protocol' => 'smtp',
        //         'smtp_host' => 'ssl://smtp.gmail.com',
        //         'smtp_port' => 465,
        //         'smtp_user' => 'support@geniemoney.in',
        //         'smtp_pass' => 'Geniemoney@123',
        //         'mailtype' => 'html',
        //         'charset' => 'iso-8859-1'
        //      );

       // $email->initialize($config);

        $email->setFrom('support@geniemoney.in');
        $email->setTo($toEmail);
       

        
        if($bcc)
        {
            $email->setBCC($bcc);
        }
        if($cc)
        {
            $email->setCC($cc);
        }
        
        if($attachement)
        {
            if(is_array($attachement))
            {
             
                foreach($attachement as $filepath)
                {
              
                 $email->attach($filepath); 

             
                }
            }
            else
            {
              $email->attach($attachement);  // i.e. /test/myfile.pdf
            }
        }
       

        $email->setSubject($subject);

        $email->setMessage($mailbody);


        $email->send();

        
        
        // $data = $email->printDebugger(['headers']);
       
        //   print_r($data);exit;
       
    }

    public function  smsotp($mobileno,$message)
    {
       $smsbaseurl = $this->SMS_BASE_URL;
        $url = $smsbaseurl."&mobile=".$mobileno."&message=".urlencode($message)."&peId=1301162488706014164&tempId=1307162521569403987";
          
          $client = \Config\Services::curlrequest();

                    $response = $client->request('GET',$url);
                    $body = $response->getBody();
                    $startus = $response->getStatusCode();
                

                    
                    return array('startus'=>$startus,"body"=>$body);
    }



  public function  send_sms($mobileno,$message)
    {
       $smsbaseurl = $this->SMS_BASE_URL;
        $url = $smsbaseurl."&mobile=".$mobileno."&message=".urlencode($message)."&peId=1301162488706014164&tempId=1307162521580870438";
          
          $client = \Config\Services::curlrequest();

                    $response = $client->request('GET',$url);
                    $body = $response->getBody();
                    $startus = $response->getStatusCode();
                

                    
                    return array('startus'=>$startus,"body"=>$body);
    }

    public function  sendSubcription($mobileno,$message)
    {
       $smsbaseurl = $this->SMS_BASE_URL;
        $url = $smsbaseurl."&mobile=".$mobileno."&message=".urlencode($message)."&peId=1301162488706014164&tempId=1307162521590273888";
          
          $client = \Config\Services::curlrequest();

                    $response = $client->request('GET',$url);
                    $body = $response->getBody();
                    $startus = $response->getStatusCode();
                

                    
                    return array('startus'=>$startus,"body"=>$body);
    }
	

}

?>