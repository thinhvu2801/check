<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MInventory extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->table="KiemKe_HamDong";
	}
	public function read($ham_id, $product_type_id, $date)
    {
        $proc = "EXEC [dbo].[KiemKe_HamDong_Read] @ham_id='$ham_id', @product_type_id='$product_type_id', @date='$date'";
        $query = $this->db->query($proc);
        return $query->result();
    }
	public function Insert($data){
		$this->db->where('ham_id',$data['ham_id']);
		$this->db->where('date',$data['date']);
		$this->db->where('product_type_id',$data['product_type_id']);
		$this->db->where('size_id',$data['size_id']);
		$query=$this->db->get($this->table);
		$rs = $query->row();
		if (is_null($rs))
			$this->db->insert($this->table, $data);
		else{
			$this->db->where('id', $rs->id);
			$this->db->update($this->table, $data);
		}
			
	}
	
}
?>