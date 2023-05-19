<?php
namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\StaffModel;
use App\Libraries\SiteVariables;
use App\Libraries\EmailSms;
use App\Libraries\Paginationnew;
use CodeIgniter\Session\Session;

class StaffController extends BaseController {

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

		
	
		      
        $StaffModel = new StaffModel();
        $data['action'] = "liststaff";
        $data['title'] = "Staff List";
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
        $totalRecord = $StaffModel->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;		
		$data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["searchArray"] = $searchArray;
        $data['list'] = $StaffModel->getData($searchArray, $startLimit, $Limit);
        // print_r($data['list']);exit;

        $this->template->render('admintemplate', 'contents' , 'admin/staff/stafflist',$data);
	}
public function updatestatus()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $formArr = array();
        $formArr['status'] = $status; 
        $StaffModel=new StaffModel();
        $StaffModel->updateStatus($id, $formArr);
    }
	
	  public function add()
    {
        if(!$this->isAdminLoggedIn)
        {  
               return redirect()->to(site_url('admin'));
        }
        $id=$this->request->getGet('id');
        $siteVariables = new SiteVariables();
        $data['staff'] = $siteVariables->getVariable('staff');

        if ($id) {
        	$StaffModel = new StaffModel();
        	$data['edit']=$StaffModel->where('id',$id)->first();
       
        	$data['title']='Update Staff';
        }else{
        	$data['title']='Create New Staff';
        }


        
        $this->template->render('admintemplate', 'contents' , 'admin/staff/staff_form',$data);

    }

    public function Save()
	{

		
			$formArr = array();
			$id =$this->request->getPost('id');
			$formArr['name'] = $name = (isset($_POST['name']) && !empty($_POST['name'])) ? $this->request->getPost('name') : '';
			$formArr['admin_type'] = $admin_type = (isset($_POST['admin_type']) && !empty($_POST['admin_type'])) ? $this->request->getPost('admin_type') : '';
			$formArr['phone'] = $phone = (isset($_POST['phone']) && !empty($_POST['phone'])) ? $this->request->getPost('phone') : '';
			$formArr['email'] = $email = (isset($_POST['email']) && !empty($_POST['email'])) ? $this->request->getPost('email') : '';
			$formArr['password'] = $password = (isset($_POST['password']) && !empty($_POST['password'])) ? $this->request->getPost('password') : '';
			
			$StaffModel = new StaffModel();
			
                if(intval($id)>0){
				
				    $StaffModel->set($formArr)->where('id',$id)->update();
				 $this->session->setFlashdata('message', 'Updated Successfully..');
	               
	              return redirect()->to($_SERVER["HTTP_REFERER"]);
                }
	          else
				{
			
				 $StaffModel->save($formArr); 
				 $this->session->setFlashdata('message', 'Data has been saved successfully..');
              
        	              return redirect()->to($_SERVER["HTTP_REFERER"]);
	            }
				
			
	}

	 public function delete()
	{
		$id=$this->request->getGet('id');
		$StaffModel = new StaffModel();
		if(intval($id)>0)
		{
			$StaffModel->where('id', $id)->delete();
			 $this->session->setFlashdata('message', 'deleted successfully.');
			
		 } else {
            $this->session->setFlashdata('errmessage', 'Invalid access.');
        }

        return redirect()->to($_SERVER["HTTP_REFERER"]);
	}



    

		
	
}
