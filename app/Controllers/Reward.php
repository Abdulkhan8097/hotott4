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

class Reward extends BaseController {

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

		
	
		      
        $RewardModel = new RewardModel();
        $data['action'] = "rewardlist";
        $data['title'] = "Reward List";
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
        $totalRecord = $RewardModel->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;		
		$data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["searchArray"] = $searchArray;
        $data['list'] = $RewardModel->getData($searchArray, $startLimit, $Limit);
        // print_r($data['list']);exit;

        $this->template->render('admintemplate', 'contents' , 'admin/Reward/rewardlist',$data);
	}
	   public function updatestatus()
    {
    	$id = $_POST['id'];
    	$status = $_POST['status'];
    	$formArr = array();
    	$formArr['status'] = $status; 
    	$RewardModel = new RewardModel();
	    $Update = $RewardModel->where('id', $id)->set($formArr)->update();

    }
		public function preview()
	{
			$id=$this->request->getGet('id');
		if(intval($id)>0)
		{	
			$RewardModel = new RewardModel();
			$data['title']='Reward Details';
			
			$searchArray['id']=$id;
			$data['preview'] = $RewardModel->getData($searchArray);
			
	 		
			 // echo"<pre>";
			 // print_r($data['preview']);exit;
			 $this->template->render('admintemplate', 'contents' , 'admin/Reward/rewardpreview',$data);
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
        	$RewardModel = new RewardModel();
        	$data['edit']=$RewardModel->where('r_id',$id)->first();
        	$data['title']='Update Reward';
        }else{
        	$data['title']='New Reward';
        }
        
        
       
        
        $this->template->render('admintemplate', 'contents' , 'admin/Reward/new',$data);

    }

    public function Save()
	{

		
			$formArr = array();
			$id =$this->request->getPost('id');
			$formArr['start_date'] = $start_date = (isset($_POST['start_date']) && !empty($_POST['start_date'])) ? $this->request->getPost('start_date') : '';
			$formArr['end_date'] = $end_date = (isset($_POST['end_date']) && !empty($_POST['end_date'])) ? $this->request->getPost('end_date') : '';
			$formArr['r_name'] = $r_name = (isset($_POST['r_name']) && !empty($_POST['r_name'])) ? $this->request->getPost('r_name') : '';
			$formArr['r_pin'] = $r_pin = (isset($_POST['r_pin']) && !empty($_POST['r_pin'])) ? $this->request->getPost('r_pin') : '';
			$formArr['price'] = $price = (isset($_POST['price']) && !empty($_POST['price'])) ? $this->request->getPost('price') : '';
			$formArr['title'] = $title = (isset($_POST['title']) && !empty($_POST['title'])) ? $this->request->getPost('title') : '';
			$formArr['description'] = $description = (isset($_POST['description']) && !empty($_POST['description'])) ? $this->request->getPost('description') : '';
			$RewardModel = new RewardModel();
			
                if(intval($id)>0){
				
				    $RewardModel->set($formArr)->where('r_id',$id)->update();
				 $this->session->setFlashdata('message', 'Updated Successfully..');
	               
	              return redirect()->to($_SERVER["HTTP_REFERER"]);
                }
	          else
				{
			
				 $RewardModel->save($formArr); 
				 $this->session->setFlashdata('message', 'Data has been saved successfully..');
              
        	              return redirect()->to($_SERVER["HTTP_REFERER"]);
	            }
				
			
	}

	 public function delete()
	{
		$id=$this->request->getGet('id');
		$RewardModel = new RewardModel();
		if(intval($id)>0)
		{
			$RewardModel->where('r_id', $id)->delete();
			 $this->session->setFlashdata('message', 'deleted successfully.');
			
		 } else {
            $this->session->setFlashdata('errmessage', 'Invalid access.');
        }

        return redirect()->to($_SERVER["HTTP_REFERER"]);
	}

	public function userlist() {
		$session = session();
		$user_id = $session->get('user_id');
		
		$userModel = new UserModel();
		$user_details = $userModel->getUserdetail($user_id);
		$data['username'] = $user_details['username'];

		$rewardModel = new RewardModel();

        $data['action'] = "rewardlist";
        $data['title'] = "Reward List";
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
        $searchPinArray = array('userid' => $user_id);
		$totalRecord = $rewardModel->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;		
		$data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["searchArray"] = $searchArray;
        $data['list'] = $rewardModel->getData($searchArray, $startLimit, $Limit);

        $this->template->render('admintemplate', 'contents' , 'user/Reward/rewardlist',$data);
	}

	function claim () {
		$id=$this->request->getGet('id');
		$userid = $this->request->getGet('userid');

		if(intval($id)>0)
		{	
			$offerclaimModel = new OfferClaimModel();
			$claimeddata = $offerclaimModel->where('username',$userid)->where('reward_id',$id)->first();

			if(empty($claimeddata)) {
				$session = session();
				$pinModel = new PinModel();
				$rewardModel = new RewardModel();
				$userModel = new UserModel();
				$offerclaimModel = new OfferClaimModel();

				$searchArray = array('id'=>$id);
				$list = $rewardModel->getData($searchArray);

				$start_date = $list[0]->start_date;
				$end_date = $list[0]->end_date;
				$totalPin = $list[0]->r_pin;

				$user_id = $session->get('user_id');

				$user_details = $userModel->getUserdetail($user_id);

				$username = $user_details['username'];

				$searchPinArray = array('userid' => $user_id, 'startdate'=> $start_date, 'enddate'=>$end_date);
				$totalPinRecord = $pinModel->getData($searchPinArray, '', '', '1');
				
				if($totalPinRecord >= $totalPin) {
					$arrSaveData = array(
						'user_id' => $user_id,
						'username' => $username,
						'reward_id' => $id,
						'type' => 'Reward',
						'status' => 'Claimed'
					);
					$offerclaimModel->save($arrSaveData);
					$this->session->setFlashdata('message', 'You have successfully claimed this reward.');
				}
				else {
					$this->session->setFlashdata('errmessage', 'Cannot claim this Reward.');
				}
			}
			else {
				$this->session->setFlashdata('errmessage', 'Already Claimed Reward');
			}
			return redirect()->to($_SERVER["HTTP_REFERER"]);
		}
	}
        
      

		
	
}
