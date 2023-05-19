<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Models\PamphletModel;

class PamphletController extends BaseController {
    
    protected $session;
    protected $isAdminLoggedIn;
    
	function __construct()
	{
        $this->pamphlet = new PamphletModel();
          
        $this->session = session();
        
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');   
	}

    function adminPamphlet() {
        set_title('Pamphlet | ' . SITE_NAME);
        $data['pamphlet'] = $this->pamphlet->getData();
        $this->template->render('admintemplate', 'contents' , 'admin/Pamphlet/admin_pamphlet', $data);
    }

    function savePamphlet() {
        $pamphlet_id = $this->request->getPost('pamphlet_id');
        $pamphlet_name = $this->request->getPost('pamphlet_name');

        if($pamphlet_id) {
            $arrSaveData = array(
                'pamphlet_name' => $pamphlet_name
            );

            // Pamphlet File
            $pamphlet = $this->request->getFile('pamphlet');
            $pamphletnewName = "";
            if ($pamphlet != "") {
                $pamphletnewName = $pamphlet->getRandomName();
                $pamphlet->move(FCPATH . 'admin/pdfs/pamphlet/', $pamphletnewName);
    
                // pamphlet File
                if ($pamphletnewName) {
                    $arrSaveData['Pamphlet_doc'] = $pamphletnewName;
                }
            }

            $res = $this->pamphlet->set($arrSaveData)->where('id', $pamphlet_id)->update();

            if ($res) {      
                $this->session->setFlashdata('message', 'Pamphlet Updated successfully.');
            } else {
                $this->session->setFlashdata('errmessage', 'Pamphlet not updated successfully.');
            }
        }
        else {
            $arrSaveData = array(
                'pamphlet_name' => $pamphlet_name
            );

            // Pamphlet File
            $pamphlet = $this->request->getFile('pamphlet');
            $pamphletnewName = "";
            if ($pamphlet != "") {
                $pamphletnewName = $pamphlet->getRandomName();
                $pamphlet->move(FCPATH . 'admin/pdfs/pamphlet/', $pamphletnewName);
    
                // pamphlet File
                if ($pamphletnewName) {
                    $arrSaveData['Pamphlet_doc'] = $pamphletnewName;
                }
            }
            
            $res = $this->pamphlet->save($arrSaveData);

            if ($res) {      
                $this->session->setFlashdata('message', 'Pamphlet Added successfully.');
            } else {
                $this->session->setFlashdata('errmessage', 'Pamphlet not added successfully.');
            }
        }
        return redirect()->to($_SERVER["HTTP_REFERER"]);
    }

    function userPamphlet() {
        set_title('Pamphlet | ' . SITE_NAME);
        $data['pamphlet'] = $this->pamphlet->getData();
        $this->template->render('admintemplate', 'contents' , 'user/Pamphlet/user_pamphlet', $data);
    }

}

?>