<?php

namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\IdentityModel;
use App\Models\UserModel;
use CodeIgniter\Session\Session;
use App\Libraries\Paginationnew;
use Dompdf\Dompdf;


class IdentityController extends BaseController {

	
    protected $session;
    protected  $isAdminLoggedIn;
    private $IdentityModel;
    private $UserModel;
    private $username;
    public function __construct()
    {
        $this->IdentityModel = new IdentityModel();
        $this->UserModel = new UserModel();
        $this->session = session();
      // echo "<pre>"; print_r($session);die;
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');
        //$this->username = $session->get('username');

	}

	public function index(){
		
        $this->template->render('admintemplate', 'contents' , 'admin/IdentityCard/addform');

	}

	public function save_data(){
		helper(['form']);

		$rules = [
	            'email' => 'required|valid_email|is_unique[identitycard.identity_email]',
	            'mobile' => 'required|is_unique[identitycard.mobile_number]',
	           	// 'mobile' => 'required|numeric|regex_match[/^[0-9]{10}$/]',
	        ];
	    if($this->validate($rules)){

	        $data = array(
						'identity_name' => $this->request->getPost('identity_name'),
						'position_name' => $this->request->getPost('position_name'),
						'identity_email' => $this->request->getPost('email'),
						'mobile_number' => $this->request->getPost('mobile'),
						'date_of_birth' => $this->request->getPost('date_of_birth'),
						'identity_address' => $this->request->getPost('address'),
						'profile_image' => $this->request->getPost('profile_image')
					);
						// var_dump($data);die;
	        $this->IdentityModel->insert($data);

	        return $this->response->redirect(site_url('/save'));
    	}else{

				$data['validation'] = $this->validator;
            	// echo view('admin/IdentityCard/addform', $data);
            	$this->template->render('admintemplate', 'contents' , 'admin/IdentityCard/addform',$data);
			}
	}


	public function card_history(){
		$session = session();
		$user_id = $session->get('user_id');


		// $PinModel = new PinModel();
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
        $totalRecord = $this->IdentityModel->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;		
				$data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;

    
           $data["searchArray"] = $searchArray;

        $data['carddata'] = $this->IdentityModel->getData($searchArray, $startLimit, $Limit);

		
		$userid = $this->UserModel->where('id',$user_id)->first();

		
		$userdata['row'] = $userid;
		
		 

		if($session->get('admin_id')){
			
			$this->template->render('admintemplate', 'contents' , 'admin/IdentityCard/Cardhistory',$data);
		}else{
			$this->template->render('admintemplate', 'contents' , 'admin/IdentityCard/usercarddata',$userdata);
		}
	}

	public function idcard(){



        $id=$this->request->getGet('id');
        if ($id) {
        	  $userdata = $this->UserModel->where('id',$id)->first();
              $data['list']=$userdata;
        }
      

        helper('url');
		$dompdf = new \Dompdf\Dompdf();
       

        $options = $dompdf->getOptions();
		$options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);

        $html = view('admin/IdentityCard/idcard',$data);
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('resume.pdf', [ 'Attachment' => false ]);


	}

}