<?php

namespace App\Libraries;

/* * ***************************************************************************\
  +-----------------------------------------------------------------------------+
  | Project        : fluid9                                           		  |
  | FileName       : sitevariables.php                                           |
  | Version        : 1.0                                                      |
  | Developer      : subedar Yadav                                            |
  | Created On     : 15-03-2021                                               |
  | Modified On    :                                                          |
  | Modified   By  :                                                          |
  | Authorised By  :  subedar Yadav                                           |
  | Comments       :  This class used for site message		  		          |
  | Email          : subedar2507@gmail.com                                    |
  +-----------------------------------------------------------------------------+
  \**************************************************************************** */

class SiteVariables {

    private $arrMessage = array();

    public function getVariable($key) {


        //message for registration 
        $this->arrMessage['position'] = array('L' => 'Left', 'M' => 'Middle', 'R' => 'Right', 'other' => 'Others');
        $this->arrMessage['genderarb'] = array('male' => 'Male', 'female' => 'Female');
        $this->arrMessage['staff'] = array('Account' => 'Account', 'Social_media' => 'Social_media', 'HR' => 'HR');
      
        if (array_key_exists($key, $this->arrMessage)) {
            return $this->arrMessage[$key];
        }
    }

}

?>