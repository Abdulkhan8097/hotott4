<?php
namespace App\Models;

use CodeIgniter\Model;

class TDSmodel extends Model{

	protected $table = 'tds';

	protected $primaryKey = 'id';

	protected $allowedFields = ['id','tds','created_on','edited_on'];

	 public function updatedata($id, $data) {
        return $this->db
                        ->table('tds')
                        ->where(["id" => $id])
                        ->set($data)
                        ->update();
    }



}	

?>