<?php
namespace App\Models;

use CodeIgniter\Model;

class GSTModel extends Model{

	protected $table = 'gst';

	protected $primaryKey = 'id';

	protected $allowedFields = ['id','cgst','sgst','created_on','edited_on'];

  public function updatedata($id, $data) {
        return $this->db
                        ->table('gst')
                        ->where(["id" => $id])
                        ->set($data)
                        ->update();
    }


}	

?>