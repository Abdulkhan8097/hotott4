<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Models\OfferClaimModel;
use App\Libraries\Paginationnew;
use CodeIgniter\Session\Session;

class OffersClaim extends BaseController {

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
		      
        $offerClaimModel = new OfferClaimModel();
        $data['action'] = "offerlist";
        $data['title'] = "Offer Claimed List";
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
        $totalRecord = $offerClaimModel->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;		
		$data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["searchArray"] = $searchArray;
        $data['list'] = $offerClaimModel->getData($searchArray, $startLimit, $Limit);

        $this->template->render('admintemplate', 'contents' , 'admin/Offer/offerclaimlist',$data);
	}

    public function userList() {
        $session = session();

        $userid = $this->session->get('user_id');
		      
        $offerClaimModel = new OfferClaimModel();
        $data['action'] = "offerlist";
        $data['title'] = "Offer Claimed List";
        $paginationnew = new Paginationnew();
        $txtsearch = $this->request->getGet('txtsearch');
        $searchArray = array();
        if($txtsearch)
        {
            $searchArray['txtsearch'] = $txtsearch;
        }
        $searchArray['userid'] = $userid;
       
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $offerClaimModel->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;		
		$data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["searchArray"] = $searchArray;
        $data['list'] = $offerClaimModel->getData($searchArray, $startLimit, $Limit);

        $this->template->render('admintemplate', 'contents' , 'user/Offer/offerclaimlist',$data);
    }

}

?>