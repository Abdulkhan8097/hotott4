<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Models\BookletModel;

class BookletController extends BaseController {
    
    protected $session;
    protected $isAdminLoggedIn;
    
	function __construct()
	{
        $this->booklet = new BookletModel();
          
        $this->session = session();
        
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');   
	}

    function adminBooklet() {
        set_title('Booklet | ' . SITE_NAME);
        $data['booklet'] = $this->booklet->getData();
        $this->template->render('admintemplate', 'contents' , 'admin/Booklet/admin_booklet', $data);
    }

    function saveBooklet() {
        $booklet_id = $this->request->getPost('booklet_id');
        $booklet_name = $this->request->getPost('booklet_name');

        if($booklet_id) {
            $arrSaveData = array(
                'booklet_name' => $booklet_name
            );

            // Booklet File
            $booklet = $this->request->getFile('booklet');
            $bookletnewName = "";
            if ($booklet != "") {
                $bookletnewName = $booklet->getRandomName();
                $booklet->move(FCPATH . 'admin/pdfs/booklet/', $bookletnewName);
    
                // booklet File
                if ($bookletnewName) {
                    $arrSaveData['file_name'] = $bookletnewName;
                }
            }

            $res = $this->booklet->set($arrSaveData)->where('id', $booklet_id)->update();

            if ($res) {      
                $this->session->setFlashdata('message', 'Booklet Updated successfully.');
            } else {
                $this->session->setFlashdata('errmessage', 'Booklet not updated successfully.');
            }
        }
        else{
            $arrSaveData = array(
                'booklet_name' => $booklet_name
            );

            // Booklet File
            $booklet = $this->request->getFile('booklet');
            $bookletnewName = "";
            if ($booklet != "") {
                $bookletnewName = $booklet->getRandomName();
                $booklet->move(FCPATH . 'admin/pdfs/booklet/', $bookletnewName);
    
                // booklet File
                if ($bookletnewName) {
                    $arrSaveData['file_name'] = $bookletnewName;
                }
            }

            $res = $this->booklet->save($arrSaveData);

            if ($res) {      
                $this->session->setFlashdata('message', 'Booklet Added successfully.');
            } else {
                $this->session->setFlashdata('errmessage', 'Booklet not added successfully.');
            }
        }
        return redirect()->to($_SERVER["HTTP_REFERER"]);
    }

    function userBooklet() {
        set_title('Booklet | ' . SITE_NAME);
        $data['booklet'] = $this->booklet->getData();
        $this->template->render('admintemplate', 'contents' , 'user/Booklet/user_booklet', $data);
    }

}

?>