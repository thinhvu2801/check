<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MCustomer extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "Customer";
	}
	public function CheckCode($customer_id){
		$this->db->where('customer_id',$customer_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function ReadById($customer_id){
		$this->db->where('customer_id',$customer_id);
		$query = $this->db->get($this->table);
		return $query->row();
	}
	public function Read(){
		$this->db->where('customer_id !=','-');
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function ReadExistIn($table)
	{
		$where = "customer_id = ANY (SELECT customer_id FROM ".$table.")";
		$this->db->where($where);
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$customer_id){
		$this->db->where('customer_id', $customer_id);
      	$this->db->update($this->table, $data);
	}

	public function Delete($customer_id){
		$this->db->where('customer_id', $customer_id);
		$this->db->delete($this->table);
	}
}
?>