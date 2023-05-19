<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Models\BrochureModel;

class BrochureController extends BaseController {
    
    protected $session;
    protected $isAdminLoggedIn;
    
	function __construct()
	{
        $this->brochure = new BrochureModel();
          
        $this->session = session();
        
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');   
	}

    function adminBrochure() {
        set_title('Brochure | ' . SITE_NAME);
        $data['brochure'] = $this->brochure->getData();
        $this->template->render('admintemplate', 'contents' , 'admin/Brochure/admin_brochure', $data);
    }

    function savebrochure() {
        $brochure_id = $this->request->getPost('brochure_id');
        $brochure_name = $this->request->getPost('brochure_name');

        if($brochure_id) {
            $arrSaveData = array(
                'brochure_name' => $brochure_name
            );

            // Brochure File
            $brochure = $this->request->getFile('brochure');
            $brochurenewName = "";
            if ($brochure != "") {
                $brochurenewName = $brochure->getRandomName();
                $brochure->move(FCPATH . 'admin/pdfs/brochure/', $brochurenewName);
    
                // Brochure File
                if ($brochurenewName) {
                    $arrSaveData['file_name'] = $brochurenewName;
                }
            }

            $res = $this->brochure->set($arrSaveData)->where('id', $brochure_id)->update();

            if ($res) {      
                $this->session->setFlashdata('message', 'Brochure Updated successfully.');
            } else {
                $this->session->setFlashdata('errmessage', 'Brochure not updated successfully.');
            }
        }
        else {
            $arrSaveData = array(
                'brochure_name' => $brochure_name
            );

            // Brochure File
            $brochure = $this->request->getFile('brochure');
            $brochurenewName = "";
            if ($brochure != "") {
                $brochurenewName = $brochure->getRandomName();
                $brochure->move(FCPATH . 'admin/pdfs/brochure/', $brochurenewName);
    
                // Brochure File
                if ($brochurenewName) {
                    $arrSaveData['file_name'] = $brochurenewName;
                }
            }

            $res = $this->brochure->save($arrSaveData);

            if ($res) {      
                $this->session->setFlashdata('message', 'Brochure Added successfully.');
            } else {
                $this->session->setFlashdata('errmessage', 'Brochure not added successfully.');
            }
        }
        return redirect()->to($_SERVER["HTTP_REFERER"]);
    }

    function userBrochure() {
        set_title('Brochure | ' . SITE_NAME);
        $data['brochure'] = $this->brochure->getData();
        $this->template->render('admintemplate', 'contents' , 'user/Brochure/user_brochure', $data);
    }

}

?>