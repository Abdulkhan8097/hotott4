<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Models\InvoiceModel;
use App\Libraries\Paginationnew;

class InvoiceController extends BaseController {
    
    protected $session;
    protected $isAdminLoggedIn;
    
	function __construct()
	{
        $this->invoice = new InvoiceModel();
          
        $this->session = session();
        
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');   
	}
	
    function index() {
        set_title('Invoice Details | ' . SITE_NAME);
        $data['invoice_details'] = $this->invoice->find();
        //echo "<pre>";print_r($data);die();
        $this->template->render('admintemplate', 'contents' , 'admin/editInvoice', $data);
    }
    
    function saveInvoice() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
      
        $id=$this->request->getPost('invoice_id');
        
        $gst = (isset($_POST['gst']) && !empty($_POST['gst'])) ? $this->request->getPost('gst') : '';
        $pan = (isset($_POST['pan']) && !empty($_POST['pan'])) ? $this->request->getPost('pan') : '';
        
        $address = (isset($_POST['address']) && !empty($_POST['address'])) ? $this->request->getPost('address') : '';
        $more_desc = (isset($_POST['more_desc']) && !empty($_POST['more_desc'])) ? $this->request->getPost('more_desc') : '';
        
        $arrSaveData = array(
            'gst' => $gst,
            'pan' => $pan,
            'company_address' => $address,
            'add_more_description' => $more_desc
        );
        
        // Company Logo
            $logo = $this->request->getFile('comp_logo');
            $logonewName = "";
            if ($logo != "") {
                $logonewName = $logo->getRandomName();
                $logo->move(FCPATH . 'admin/images/', $logonewName);
    
                // Company Logo
                if ($logonewName) {
                    $arrSaveData['logo'] = $logonewName;
                }
            }
        
        if($id) {
            $arrSaveData['edited_on'] = date("Y-m-d H:i:s");
            
            //echo "<pre>";print_r($arrSaveData);die;
            
            $res = $this->invoice->set($arrSaveData)->where('i_id', $id)->update();
            
            if ($res) {      
                $this->session->setFlashdata('message', 'Invoice Updated successfully.');
            } else {
                $this->session->setFlashdata('errmessage', 'Invoice not updated successfully.');
            }
        }
        else{
            $res = $this->invoice->save($arrSaveData);
            
            if ($res) {      
                $this->session->setFlashdata('message', 'Invoice Uploaded successfully.');
            } else {
                $this->session->setFlashdata('errmessage', 'Invoice not uploaded successfully.');
            }
        }
        return redirect()->to($_SERVER["HTTP_REFERER"]);
    }
	
}

?>