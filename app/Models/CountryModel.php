<?php
namespace App\Models;

use CodeIgniter\Model;

class CountryModel extends Model{

	protected $table = 'countriess';

	protected $primaryKey = 'id';

	protected $allowedFields = ['id','sortname','name','flag'];


        
      


}	

?>