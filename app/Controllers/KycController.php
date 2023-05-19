<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Models\KycModel;
use App\Libraries\Paginationnew;

class KycController extends BaseController {
    
    protected $session;
    protected $isAdminLoggedIn;
    
	function __construct()
	{
        $this->kyc = new KycModel();
          
        $this->session = session();
        
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');   
	}

    function index() {
        $data['userid'] = $this->session->get('user_id');
        set_title('User KYC | ' . SITE_NAME);
        $data['user_details'] = $this->kyc->getUserDetails($data['userid']);
        //echo "<pre>";print_r($data);die();
        $this->template->render('admintemplate', 'contents' , 'user/Kyc/user_kyc', $data);
    } 

    function saveKyc() {
        $user_id = $this->request->getPost('userid');
        $kycid = $this->request->getPost('kycid');

        if($kycid == '') {
            $arrSaveData = array(
                'user_id' => $user_id
            );
    
            
            // Aadhar Card doc - Front Side
            $aadhardoc_front = $this->request->getFile('aadhardoc_front');
            $aadhardoc_frontnewName = "";
            if ($aadhardoc_front != "") {
                $aadhardoc_frontnewName = $aadhardoc_front->getRandomName();
                $aadhardoc_front->move(FCPATH . 'admin/images/kyc/aadhar_front/', $aadhardoc_frontnewName);
    
                // Aadhar Card doc - Front Side
                if ($aadhardoc_frontnewName) {
                    $arrSaveData['aadhar_card_front'] = $aadhardoc_frontnewName;
                }
            }
            
            // Aadhar Card doc - Back Side
            $aadhardoc_back = $this->request->getFile('aadhardoc_back');
            $aadhardoc_backnewName = "";
            if ($aadhardoc_back != "") {
                $aadhardoc_backnewName = $aadhardoc_front->getRandomName();
                $aadhardoc_back->move(FCPATH . 'admin/images/kyc/aadhar_back/', $aadhardoc_backnewName);

                // Aadhar Card doc - Back Side
                if ($aadhardoc_backnewName) {
                    $arrSaveData['aadhar_card_back'] = $aadhardoc_backnewName;
                }
            }
    
            $pandoc = $this->request->getFile('pandoc');
            $pandocnewName = "";
            if ($pandoc != "") {
                $pandocnewName = $pandoc->getRandomName();
                $pandoc->move(FCPATH . 'admin/images/kyc/pan/', $pandocnewName);

                // PAN Card doc
                if ($pandocnewName) {
                    $arrSaveData['pan'] = $pandocnewName;
                }
            }

            $drivingdoc = $this->request->getFile('drivingdoc');
            $drivingdocnewName = "";
            if ($drivingdoc != "") {
                $drivingdocnewName = $drivingdoc->getRandomName();
                $drivingdoc->move(FCPATH . 'admin/images/kyc/driving_license/', $drivingdocnewName);

                // Driving License doc
                if ($drivingdocnewName) {
                    $arrSaveData['driving_license'] = $drivingdocnewName;
                }
            }

            $voterdoc = $this->request->getFile('voterdoc');
            $voterdocnewName = "";
            if ($voterdoc != "") {
                $voterdocnewName = $voterdoc->getRandomName();
                $voterdoc->move(FCPATH . 'admin/images/kyc/voter/', $voterdocnewName);

                // Voter Card doc
                if ($voterdocnewName) {
                    $arrSaveData['voter_card'] = $voterdocnewName;
                }
            }

            $elecdoc = $this->request->getFile('elecdoc');
            $elecdocnewName = "";
            if ($elecdoc != "") {
                $elecdocnewName = $elecdoc->getRandomName();
                $elecdoc->move(FCPATH . 'admin/images/kyc/electric_bill/', $elecdocnewName);

                // Electric Bill doc
                if ($elecdocnewName) {
                    $arrSaveData['electric_bill'] = $elecdocnewName;
                }
            }

            $passportdoc = $this->request->getFile('passportdoc');
            $passportdocnewName = "";
            if ($passportdoc != "") {
                $passportdocnewName = $passportdoc->getRandomName();
                $passportdoc->move(FCPATH . 'admin/images/kyc/passport/', $passportdocnewName);

                // Passport doc
                if ($passportdocnewName) {
                    $arrSaveData['passport'] = $passportdocnewName;
                }
            }
            
            //echo "<pre>";print_r($arrSaveData);die;
            $res = $this->kyc->save($arrSaveData);

            if ($res) {      
                $this->session->setFlashdata('message', 'KYC Uploaded successfully.');
            } else {
                $this->session->setFlashdata('errmessage', 'KYC not uploaded successfully.');
            }
        }
        else {
            $arrSaveData = array(
                'user_id' => $user_id
            );

            // Aadhar Card doc - Front Side
            $aadhardoc_front = $this->request->getFile('aadhardoc_front');
            $aadhardoc_frontnewName = "";
            if ($aadhardoc_front != "") {
                $aadhardoc_frontnewName = $aadhardoc_front->getRandomName();
                $aadhardoc_front->move(FCPATH . 'admin/images/kyc/aadhar_front/', $aadhardoc_frontnewName);
    
                // Aadhar Card doc - Front Side
                if ($aadhardoc_frontnewName) {
                    $arrSaveData['aadhar_card_front'] = $aadhardoc_frontnewName;
                }
            }
            
            // Aadhar Card doc - Back Side
            $aadhardoc_back = $this->request->getFile('aadhardoc_back');
            $aadhardoc_backnewName = "";
            if ($aadhardoc_back != "") {
                $aadhardoc_backnewName = $aadhardoc_front->getRandomName();
                $aadhardoc_back->move(FCPATH . 'admin/images/kyc/aadhar_back/', $aadhardoc_backnewName);

                // Aadhar Card doc - Back Side
                if ($aadhardoc_backnewName) {
                    $arrSaveData['aadhar_card_back'] = $aadhardoc_backnewName;
                }
            }

            $pandoc = $this->request->getFile('pandoc');
            $pandocnewName = "";
            if ($pandoc != "") {
                $pandocnewName = $pandoc->getRandomName();
                $pandoc->move(FCPATH . 'admin/images/kyc/pan/', $pandocnewName);

                // PAN Card doc
                if ($pandocnewName) {
                    $arrSaveData['pan'] = $pandocnewName;
                }
            }

            $drivingdoc = $this->request->getFile('drivingdoc');
            $drivingdocnewName = "";
            if ($drivingdoc != "") {
                $drivingdocnewName = $drivingdoc->getRandomName();
                $drivingdoc->move(FCPATH . 'admin/images/kyc/driving_license/', $drivingdocnewName);

                // Driving License doc
                if ($drivingdocnewName) {
                    $arrSaveData['driving_license'] = $drivingdocnewName;
                }
            }

            $voterdoc = $this->request->getFile('voterdoc');
            $voterdocnewName = "";
            if ($voterdoc != "") {
                $voterdocnewName = $voterdoc->getRandomName();
                $voterdoc->move(FCPATH . 'admin/images/kyc/voter/', $voterdocnewName);

                // Voter Card doc
                if ($voterdocnewName) {
                    $arrSaveData['voter_card'] = $voterdocnewName;
                }
            }

            $elecdoc = $this->request->getFile('elecdoc');
            $elecdocnewName = "";
            if ($elecdoc != "") {
                $elecdocnewName = $elecdoc->getRandomName();
                $elecdoc->move(FCPATH . 'admin/images/kyc/electric_bill/', $elecdocnewName);

                // Electric Bill doc
                if ($elecdocnewName) {
                    $arrSaveData['electric_bill'] = $elecdocnewName;
                }
            }

            $passportdoc = $this->request->getFile('passportdoc');
            $passportdocnewName = "";
            if ($passportdoc != "") {
                $passportdocnewName = $passportdoc->getRandomName();
                $passportdoc->move(FCPATH . 'admin/images/kyc/passport/', $passportdocnewName);

                // Passport doc
                if ($passportdocnewName) {
                    $arrSaveData['passport'] = $passportdocnewName;
                }
            }

            $res = $this->kyc->set($arrSaveData)->where('id', $kycid)->update();

            if ($res) {      
                $this->session->setFlashdata('message', 'KYC Updated successfully.');
            } else {
                $this->session->setFlashdata('errmessage', 'KYC not updated successfully.');
            }
        }
        return redirect()->to($_SERVER["HTTP_REFERER"]);
    }

    public function adminKycList() {
        $session = session();
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        $data['action'] = "kyc_list";
        $data['title'] = "KYC List";
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
        $totalRecord = $this->kyc->getData($searchArray, '', '', '1');
        $startLimit = ($page - 1) * $Limit;		
		$data['reverse'] = $totalRecord-($page -1) * $Limit;
        $data['startLimit'] = $startLimit;
        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["searchArray"] = $searchArray;
        $data['list'] = $this->kyc->getData($searchArray, $startLimit, $Limit);
        
        //echo "<pre>";print_r($data['list']);exit;

        $this->template->render('admintemplate', 'contents' , 'admin/Kyc/kyclist',$data);
    }

    public function delKyc() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $id = $this->request->getGet("id");
        $this->kyc->where('id', $id)->delete();
        $this->session->setFlashdata('errmessage', 'KYC deleted succesfully.');

        return redirect()->to($_SERVER["HTTP_REFERER"]);
    }

}

?>