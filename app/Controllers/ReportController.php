<?php

namespace App\Controllers;
use App\Models\StateModel;
use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\UserModel;
use App\Models\TransactionModel;
use App\Libraries\Paginationnew;
use App\Models\SitevariableModel;

class ReportController extends BaseController {

    protected $session;
    protected $isAdminLoggedIn;

    public function __construct() {
        $this->session = session();
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');
    }

    function index() {
         $searchArray = array();

  $session = session();
       
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        
        if ($session->get('admin_id')) {
            $isAdminLoggedIn = $session->get('admin_id');
            $username = $session->get('name');

            $isAdminLoggedIn = $session->get('admin_id');
        } else if ($session->get('user_id')) {
            $user_id = $session->get('user_id');
            $uid = $session->get('username');

            if ($user_id) {
               $searchArray['user_id'] = $user_id;
            }
        }

        $data['pageurl'] = "reports";
       $CountryModel = new CountryModel();
       $StateModel = new StateModel();
       $CityModel = new CityModel();
       $data['country']=$CountryModel->find();
       $data['state']=$StateModel->find();
       $data['city']=$CityModel->find();
       $UserModel = new UserModel();

         $paginationnew = new Paginationnew();
        $txtsearch = $this->request->getGet('txtsearch');
       
        if($txtsearch)
        {
            $searchArray['txtsearch'] = $txtsearch;
        }
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');
        $username = $this->request->getGet('username');

        $country = $this->request->getGet('country');
        $state = $this->request->getGet('state');
        $city = $this->request->getGet('city');
        $mobile = $this->request->getGet('mobile');  
        // $pin_type = $this->request->getGet('pin_type');
        $side = $this->request->getGet('side');
        $amount = $this->request->getGet('amount');
        $pin = $this->request->getGet('pin');
       

        if($start_date) {
            $searchArray['start_date'] = $start_date ? $start_date : "";
          
        }
         if($username) {
           $searchArray['username'] = $username;
        }
        if($end_date) {
           $searchArray['end_date'] = $end_date;
        }
        if($country){
            $searchArray['country'] = $country;
        }
        if($state){
            $searchArray['state'] = $state;
        }        
        if($city) {
            $searchArray['city'] = $city;
        }       
        if($mobile){
            $searchArray['mobile'] = $mobile;
        }
        if($pin_type) {
            $searchArray['pin_type'] = $pin_type;
        }        
        if($side) {
            $searchArray['side'] = $side;
        }
        if($amount) {
            $searchArray['amount'] = $amount;
        }
      
        if($pin){
            $searchArray['pin'] = $pin;
        }

        //////////// pagination ////////////
            
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;  
        $startLimit = ($page - 1) * $Limit;
        $totalRecord =0;
        $pagination =array();
        $customers = array();


        
        if($start_date || $end_date || $country || $state || $city || $mobile ||$pin_type || $side || $amount || $pin){
        $totalRecord = $UserModel->getDatauser($searchArray, '', '', '1');
     
        $customers = $UserModel->getDatauser($searchArray, $startLimit, $Limit);


        }
         $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
      

        $data['startLimit'] = $startLimit;
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["searchArray"] = $searchArray;
        // print_r($data["searchArray"]);exit;
        $data['customers'] = $customers;
        
        
        $this->template->render('admintemplate', 'contents' , 'admin/report/customerlist',$data);
    }

     function TransactionReport() {
         $searchArray = array();

  $session = session();
       
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        
        if ($session->get('admin_id')) {
            $isAdminLoggedIn = $session->get('admin_id');
            $username = $session->get('name');

            $isAdminLoggedIn = $session->get('admin_id');
        } else if ($session->get('user_id')) {
            $user_id = $session->get('user_id');
            $uid = $session->get('username');

            if ($user_id) {
               $searchArray['user_id'] = $user_id;
            }
        }

        $data['pageurl'] = "reports";
       $CountryModel = new CountryModel();
       $StateModel = new StateModel();
       $CityModel = new CityModel();
       $data['country']=$CountryModel->find();
       $data['state']=$StateModel->find();
       $data['city']=$CityModel->find();
       $TransactionModel = new TransactionModel();

         $paginationnew = new Paginationnew();
        $txtsearch = $this->request->getGet('txtsearch');
       
        if($txtsearch)
        {
            $searchArray['txtsearch'] = $txtsearch;
        }
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');
        $username = $this->request->getGet('username');

        $country = $this->request->getGet('country');
        $state = $this->request->getGet('state');
        $city = $this->request->getGet('city');
        $mobile = $this->request->getGet('mobile');  
        // $pin_type = $this->request->getGet('pin_type');
        $side = $this->request->getGet('side');
        $amount = $this->request->getGet('amount');
        $pin = $this->request->getGet('pin');
       

        if($start_date) {
            $searchArray['start_date'] = $start_date ? $start_date : "";
          
        }
         if($username) {
           $searchArray['username'] = $username;
        }
        if($end_date) {
           $searchArray['end_date'] = $end_date;
        }
        if($country){
            $searchArray['country'] = $country;
        }
        if($state){
            $searchArray['state'] = $state;
        }        
        if($city) {
            $searchArray['city'] = $city;
        }       
        if($mobile){
            $searchArray['mobile'] = $mobile;
        }
        if($pin_type) {
            $searchArray['pin_type'] = $pin_type;
        }        
        if($side) {
            $searchArray['side'] = $side;
        }
        if($amount) {
            $searchArray['amount'] = $amount;
        }
      
        if($pin){
            $searchArray['pin'] = $pin;
        }

        //////////// pagination ////////////
            
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;  
        $startLimit = ($page - 1) * $Limit;
        $totalRecord =0;
        $pagination =array();
        $customers = array();


        
        if($start_date || $end_date || $country || $state || $city || $mobile ||$pin_type || $side || $amount || $pin){
        $totalRecord = $TransactionModel->getReport($searchArray, '', '', '1');
     
        $transactionreport = $TransactionModel->getReport($searchArray, $startLimit, $Limit);
// print_r($transactionreport);exit;

        }
         $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
      

        $data['startLimit'] = $startLimit;
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["searchArray"] = $searchArray;
        // print_r($data["searchArray"]);exit;
        $data['transactionreport'] = $transactionreport;
        
        
        $this->template->render('admintemplate', 'contents' , 'admin/report/transactionlist',$data);
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
        echo '<option value="'.$id.'" >'.$name.'</option>';
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
    

}

?>

