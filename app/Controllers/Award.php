<?php
namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\RewardModel;
use App\Models\AwardModel;
use App\Models\UserModel;
use App\Models\PinModel;
use App\Models\OfferClaimModel;
use App\Libraries\Paginationnew;
use CodeIgniter\Session\Session;

class Award extends BaseController {

    protected $session;
    protected  $isUserLoggedIn;
    
    public function __construct() {
        $this->session = session();
     
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');
    }
        
	public function index()
	{
         $session = session();
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

		
	
		      
        $AwardModel = new AwardModel();
        $data['action'] = "awardlist";
        $data['title'] = "Award List";
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
        $totalRecord = $AwardModel->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;		
		$data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["searchArray"] = $searchArray;
        $data['list'] = $AwardModel->getData($searchArray, $startLimit, $Limit);
        // print_r($data['list']);exit;

        $this->template->render('admintemplate', 'contents' , 'admin/Award/awardlist',$data);
	}
	   public function updatestatus()
    {
    	$id = $_POST['id'];
    	$status = $_POST['status'];
    	$formArr = array();
    	$formArr['status'] = $status; 
    	$AwardModel = new AwardModel();
	    $Update = $AwardModel->where('id', $id)->set($formArr)->update();

    }
		public function preview()
	{
			$id=$this->request->getGet('id');
		if(intval($id)>0)
		{	
			$AwardModel = new AwardModel();
			$data['title']='Award Details';
			
			$searchArray['id']=$id;
			$data['preview'] = $AwardModel->getData($searchArray);
			
	 		
			 // echo"<pre>";
			 // print_r($data['preview']);exit;
			 $this->template->render('admintemplate', 'contents' , 'admin/Award/awardpreview',$data);
		}
	}
	  public function add()
    {
        if(!$this->isAdminLoggedIn)
        {  
               return redirect()->to(site_url('admin'));
        }
        $id=$this->request->getGet('id');

        if ($id) {
        	$AwardModel = new AwardModel();
        	$data['edit']=$AwardModel->where('a_id',$id)->first();
       
        	$data['title']='Update Award';
        }else{
        	$data['title']='New Award';
        }
        
        
       
        
        $this->template->render('admintemplate', 'contents' , 'admin/Award/new',$data);

    }

    public function Save()
	{

		
			$formArr = array();
			$id =$this->request->getPost('id');
			$formArr['duration'] = $duration = (isset($_POST['duration']) && !empty($_POST['duration'])) ? $this->request->getPost('duration') : '';
			$formArr['a_name'] = $a_name = (isset($_POST['a_name']) && !empty($_POST['a_name'])) ? $this->request->getPost('a_name') : '';
			$formArr['a_pin'] = $a_pin = (isset($_POST['a_pin']) && !empty($_POST['a_pin'])) ? $this->request->getPost('a_pin') : '';
			$formArr['price'] = $price = (isset($_POST['price']) && !empty($_POST['price'])) ? $this->request->getPost('price') : '';
			$formArr['title'] = $title = (isset($_POST['title']) && !empty($_POST['title'])) ? $this->request->getPost('title') : '';
			$formArr['description'] = $description = (isset($_POST['description']) && !empty($_POST['description'])) ? $this->request->getPost('description') : '';
			$AwardModel = new AwardModel();
			
                if(intval($id)>0){
				
				    $AwardModel->set($formArr)->where('a_id',$id)->update();
				 $this->session->setFlashdata('message', 'Updated Successfully..');
	               
	              return redirect()->to($_SERVER["HTTP_REFERER"]);
                }
	          else
				{
			
				 $AwardModel->save($formArr); 
				 $this->session->setFlashdata('message', 'Data has been saved successfully..');
              
        	              return redirect()->to($_SERVER["HTTP_REFERER"]);
	            }
				
			
	}

	 public function delete()
	{
		$id=$this->request->getGet('id');
		$AwardModel = new AwardModel();
		if(intval($id)>0)
		{
			$AwardModel->where('a_id', $id)->delete();
			 $this->session->setFlashdata('message', 'deleted successfully.');
			
		 } else {
            $this->session->setFlashdata('errmessage', 'Invalid access.');
        }

        return redirect()->to($_SERVER["HTTP_REFERER"]);
	}

	public function userlist()
	{
         $session = session();
		 //echo "<pre>";print_r($session);die();
		 $user_id = $session->get('user_id');
		 $userModel = new UserModel();
		$user_details = $userModel->getUserdetail($user_id);
		$data['username'] = $user_details['username'];

		$pinModel = new PinModel();
		$offerclaimModel = new OfferClaimModel();

		$searchPinArray = array('userid' => $user_id);
		$totalPinRecord = $pinModel->getData($searchPinArray, '', '', '1');
	
        $AwardModel = new AwardModel();
        $data['action'] = "awardlist";
        $data['title'] = "Award List";
        $paginationnew = new Paginationnew();
        $txtsearch = $this->request->getGet('txtsearch');
        $searchArray = array();
        if($txtsearch)
        {
            $searchArray['txtsearch'] = $txtsearch;
        }
		$searchArray['userid'] = $user_id;
       
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $AwardModel->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;		
		$data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["searchArray"] = $searchArray;
        $data['list'] = $AwardModel->getData($searchArray, $startLimit, $Limit);

        $this->template->render('admintemplate', 'contents' , 'user/Award/awardlist',$data);
	}

    function awardclaim () {
		$id=$this->request->getGet('id');
		$userid = $this->request->getGet('userid');

		if(intval($id)>0)
		{	
			$session = session();
			$pinModel = new PinModel();
			$awardModel = new AwardModel();
			$userModel = new UserModel();
			$offerclaimModel = new OfferClaimModel();

			$claimeddata = $offerclaimModel->where('username',$userid)->where('award_id',$id)->first();

			if(empty($claimeddata)) {

				$claimData = $offerclaimModel->getLastData(array('username'=>$userid));

				$user_id = $session->get('user_id');

				$searchArray = array('id'=>$id);
				$list = $awardModel->getData($searchArray);

				$totalPin = $list[0]->a_pin;

				$user_details = $userModel->getUserdetail($user_id);

				$username = $user_details['username'];

				$duration = $list[0]->duration;

				$user_created = date("Y-m-d", strtotime($user_details['created']));

				if(!empty($claimData)) {
						$newDateClaimed = date('Y-m-d', strtotime($user_details['created']. ' + ' . $claimData['award_duration']. ' months'));

						$newDate = date('Y-m-d', strtotime($newDateClaimed. ' + ' . $duration. ' months'));
	
						$searchPinArray = array('userid' => $username, 'startdate'=> $newDateClaimed, 'enddate'=>$newDate);
						$totalUserPin = $pinModel->getData($searchPinArray, '', '', '1');
						//echo $pinModel->getLastQuery();die;
					
						if($totalUserPin >= $totalPin) {
							$arrSaveData = array(
								'user_id' => $user_id,
								'username' => $username,
								'award_id' => $id,
								'award_duration' => $duration,
								'type' => 'Award',
								'status' => 'Claimed'
							);
							$offerclaimModel->save($arrSaveData);
							$this->session->setFlashdata('message', 'Claimed Award');
						}
						else {
							$this->session->setFlashdata('errmessage', 'Cannot Claim Award');
							
						}
				}else{
					$newDate = date('Y-m-d', strtotime($user_details['created']. ' + ' . $duration. ' months'));

					$searchPinArray = array('userid' => $user_id, 'startdate'=> $user_created, 'enddate'=>$newDate);
					$totalUserPin = $pinModel->getData($searchPinArray, '', '', '1');
					//echo $pinModel->getLastQuery();die;
				
					if($totalUserPin >= $totalPin) {
						$arrSaveData = array(
							'user_id' => $user_id,
							'username' => $username,
							'award_id' => $id,
							'award_duration' => $duration,
							'type' => 'Award',
							'status' => 'Claimed'
						);
						$offerclaimModel->save($arrSaveData);
						$this->session->setFlashdata('message', 'Claimed Award');
					}
					else {
						$this->session->setFlashdata('errmessage', 'Cannot Claim Award');
						
					}
				}
			}
			else {
				$this->session->setFlashdata('errmessage', 'Already Claimed Award');
			}
			return redirect()->to($_SERVER["HTTP_REFERER"]);
		}
    }
      

		
	
}
