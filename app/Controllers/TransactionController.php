<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\StateModel;
use App\Models\AdminModel;
use App\Models\TransactionModel;
use App\Models\CityModel;
use App\Models\ActiveUserModel;
use App\Models\CountryModel;
use App\Models\PinModel;
use App\Models\InvoiceModel;
use App\Libraries\Paginationnew;
use App\Libraries\SiteVariables;
use App\Libraries\EmailSms;
use Mpdf\Mpdf;

class TransactionController extends BaseController {

    protected $session;
    protected $isAdminLoggedIn;


    public function __construct() {
        $this->session = session();
        $siteVariables = new SiteVariables();
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');
    }

    public function index() {
        $session = session();
          $searchArray = array();
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        if ($session->get('user_id')) {

            
            $username = $session->get('username');

             if($username)
        {
           
            $searchArray['username'] = $username;

        }

        }
 
        $TransactionModel = new TransactionModel();
        $paginationnew = new Paginationnew();
        $txtsearch = $this->request->getGet('txtsearch');
        $Payment_status = $this->request->getGet('Payment_status');
        $pay_by = $this->request->getGet('pay_by');
        
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');
      
        if($txtsearch)
        {
            $searchArray['txtsearch'] = $txtsearch;
        }
        if($Payment_status)
        {
            $searchArray['Payment_status'] = $Payment_status;
        }

          if($pay_by)
        {
            $searchArray['pay_by'] = $pay_by;
        }
        
        if($start_date)
        {
            $searchArray['start_date'] = $start_date;
        }
        
        if($end_date)
        {
            $searchArray['end_date'] = $end_date;
        }
        $siteVariables = new SiteVariables();
      

        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $TransactionModel->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;		
		$data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
     
           $data["searchArray"] = $searchArray;
        
        
       

        $data['list'] = $TransactionModel->getData($searchArray, $startLimit, $Limit);
        
        $totalAmount = $TransactionModel->getTotalAmount($searchArray, '', '', '1');
        
        $data['totalAmt'] = $totalAmount;

        // echo"<pre>";
        //   print_r($data);exit;

        $this->template->render('admintemplate', 'contents', 'admin/transaction/transactionlist', $data);
    }

  
    public function preview() {
        $session = session();

        $isAdminLoggedIn = $session->get('isAdminLoggedIn');

        if (!$isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        $id = $this->request->getGet("id");
      $searchArray["tr_id"] = $id;

        $TransactionModel = new TransactionModel();
        $data['preview'] = $TransactionModel->getData($searchArray); // return count value
// echo"<pre>";
//        print_r($data['preview']);exit;

        if (!$data['preview']) {
            $this->session->setFlashdata('errmessage', 'Does not exist!');
            return redirect()->to(site_url('viewtransaction'));
        }

        $this->template->render('admintemplate', 'contents', 'admin/transaction/preview', $data);
    }
    
    function invoice() {
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

        $id = $this->request->getGet("id");
        $username = $this->request->getGet("username");

        $data = array();

        $userModel = new UserModel();
        $user_detail = $userModel->getUserdetailByUsername($username);
        //echo "<pre>";print_r($user_detail);die;

        if($user_detail['address_line1'] == '' || $user_detail['address_line2'] == '') {
            $CountryModel = new CountryModel();
            $data['country']=$CountryModel->find();
            $data['userid'] = $user_detail['id'];
            $this->template->render('admintemplate', 'contents', 'admin/transaction/addAddress', $data);
        }
        else {
            $data['user_details'] = $user_detail;
            $searchArray["tr_id"] = $id;
            $TransactionModel = new TransactionModel();
            $InvoiceModel = new InvoiceModel();
            $data['transaction_details'] = $TransactionModel->getData($searchArray);
            $data['invoice_details'] = $InvoiceModel->getData();
            //echo "<pre>";print_r($data);die;
            $this->template->render('admintemplate', 'contents', 'admin/transaction/invoice', $data);
        }
    }
    
    function downloadPDF() {
        $id = $this->request->getGet("i_id");
        
        $searchArray["tr_id"] = $id;
        $TransactionModel = new TransactionModel();
        $InvoiceModel = new InvoiceModel();
        $data['transaction_details'] = $TransactionModel->getData($searchArray);
        $data['invoice_details'] = $InvoiceModel->getData();
        //echo "<pre>";print_r($data);die;
        
        //$this->template->render('admintemplate', 'contents', 'admin/transaction/invoice', $data);
        
        $html = view('admin/transaction/invoice', $data);
        
        //$html = view('admin/bookings/pdfbookinglist',$data);

        $pdfFileName = 'Invoice_'. date('d-m-Y') . ".pdf";

        $mpdf = new Mpdf();
        $mpdf->SetTitle('Invoice');
        $mpdf->WriteHTML($html);
        //$mpdf->Output($pdfFileName,'I');// opens in browser
		$mpdf->Output($pdfFileName,'D'); // it downloads the file into the user system, with give name
		die;
    }

    function saveAddressForInvoice() {
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

        $id = (isset($_POST['id']) && !empty($_POST['id'])) ? $this->request->getPost('id') : '';

        $formArr = array();

        $formArr['address_line1'] = $address_line1 = (isset($_POST['address_line1']) && !empty($_POST['address_line1'])) ? $this->request->getPost('address_line1') : '';
        $formArr['address_line2'] = $address_line2 = (isset($_POST['address_line2']) && !empty($_POST['address_line2'])) ? $this->request->getPost('address_line2') : '';
        $formArr['country'] = $country = (isset($_POST['country']) && !empty($_POST['country'])) ? $this->request->getPost('country') : '';
        $formArr['state'] = $state = (isset($_POST['state']) && !empty($_POST['state'])) ? $this->request->getPost('state') : '';
        $formArr['city'] = $city = (isset($_POST['city']) && !empty($_POST['city'])) ? $this->request->getPost('city') : '';

        if ($id) {
            $UserModel->set($formArr)->where('id',$id)->update();
            $this->session->setFlashdata('message', 'Updated Successfully..');
            return redirect()->to($_SERVER["HTTP_REFERER"]);
        }
    }






}

?>

