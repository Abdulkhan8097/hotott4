<?php
namespace App\Models;

use CodeIgniter\Model;

class UserWalletModel extends Model{

	protected $table = 'user_wallet';

	protected $primaryKey = 'w_id';

	protected $allowedFields = ['w_id','username','current_amount','created','update_date'];


        
      


}	

?>