<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminChargesModel extends Model {

    protected $table = 'admin_charges';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'Amount', 'remark', 'created', 'update_on', 'charges_type'];



    public function updatedata($id, $data) {
		return $this->db
                        ->table('admin_charges')
                        ->where(["id" => $id])
                        ->set($data)
                        ->update();
	}
    

}



?>
