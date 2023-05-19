<?php
namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model{

	protected $table = 'invoice';

	protected $primaryKey = 'i_id';

	protected $allowedFields = ['i_id', 'gst', 'pan', 'logo', 'company_address', 'add_more_description', 'created_on', 'edited_on'];
	
	public function getData($searchArray = array(), $offset = '', $limit = '', $coutOnly = '') {
        if ($coutOnly) {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        } else {
            $sql = "SELECT ad.* FROM $this->table AS ad ";
        }
        //$sql .= " LEFT JOIN users as U ON (ad.user_id = U.id) ";

        $sql .= " ";
        $sql .= " WHERE 1 ";
        
        if (isset($searchArray['id']) && $searchArray['id']) {
            $sql .= " AND ad.i_id = '" . $searchArray['id'] . "' ";
        }
       
        $sql .= " ORDER BY ad.$this->primaryKey DESC";
        

        if ($limit) {
            $sql .= " LIMIT $offset,$limit";
        }

        $query = $this->db->query($sql);
        $result = $query->getResult();

        if ($coutOnly) {
            return $result[0]->total_count;
        }

        return $result;
    }


}	

?>