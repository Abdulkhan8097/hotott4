<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Models\FeedbackModel;
use App\Models\UserModel;
use App\Libraries\Paginationnew;

class FeedbackController extends BaseController {
    
    protected $session;
    protected $isAdminLoggedIn;
    
	function __construct()
	{
        $this->feedback = new FeedbackModel();
          
        $this->session = session();
        
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');   
	}

    function index() {
        set_title('Admin Feedback | ' . SITE_NAME);

        $session = session();
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        $data['action'] = "feedback_list";
        $data['title'] = "Feedback List";
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
        $totalRecord = $this->feedback->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;		
		$data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["searchArray"] = $searchArray;
        $data['list'] = $this->feedback->getData($searchArray, $startLimit, $Limit);
        
        //echo "<pre>";print_r($data['list']);exit;
        $this->template->render('admintemplate', 'contents' , 'admin/Feedback/feedback_list', $data);
    } 

    function userFeedbackList() {
        $data['userid'] = $this->session->get('user_id');

        $user_id = $this->session->get('user_id');

        set_title('User Feedback | ' . SITE_NAME);

        $session = session();
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        $data['action'] = "feedback_list";
        $data['title'] = "Feedback List";
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
        $totalRecord = $this->feedback->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;		
		$data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["searchArray"] = $searchArray;
        $data['feedbacks'] = $this->feedback->getData($searchArray, $startLimit, $Limit);
        
        //echo "<pre>";print_r($data['list']);exit;
        $this->template->render('admintemplate', 'contents' , 'user/Feedback/userfeedbacklist', $data);
    }
    
    function userAddFeedback() {
        set_title('Feedback | ' . SITE_NAME);

        $data = array();

        $this->template->render('admintemplate', 'contents', 'user/Feedback/new', $data);
    }

    function saveNewFeedback() {
        $userModel = new UserModel();

        $userid = $this->session->get('user_id');

        $user_details = $userModel->getUserdetail($userid);
		$username = $user_details['username'];

        $formArr = array();

        $formArr['user_id'] = $userid;

        $formArr['username'] = $username;

        $formArr['feedback_title'] = $feedback_title = (isset($_POST['feedback_title']) && !empty($_POST['feedback_title'])) ? $this->request->getPost('feedback_title') : '';

        $formArr['feedback'] = $feedback = (isset($_POST['feedback']) && !empty($_POST['feedback'])) ? $this->request->getPost('feedback') : '';

        $this->feedback->save($formArr);

        $this->session->setFlashdata('message', 'Feedback Added Successfully');

        return redirect()->to(base_url('userfeedbacklist'));
    }
    
    function feedbackdetails() {
        $session = session();

        $isAdminLoggedIn = $session->get('isAdminLoggedIn');

        if (!$isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        $id = $this->request->getGet("id");

        $userid = $this->session->get('user_id');
     

        $data['preview'] = $this->feedback->getData(array('id'=>$id)); // return count value
        // echo"<pre>";
        //        print_r($data['preview']);exit;

        if (empty($data['preview'])) {
            $this->session->setFlashdata('errmessage', 'Feedback Id Does not exist!');
            if($userid) {
                return redirect()->to(site_url('userfeedbacklist'));
            }
            else if($isAdminLoggedIn) {
                return redirect()->to(site_url('adminfeedbacklists'));
            }
        }

        $this->template->render('admintemplate', 'contents', 'user/Feedback/preview', $data);
    }

}
?>