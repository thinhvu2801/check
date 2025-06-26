<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MServiceCard extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "ServiceCard";
	}
	public function CheckCode($sc_id){
		$this->db->where('sc_id',$sc_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}

	public function Read(){
		$this->db->where('sc_id !=','-');
		$this->db->order_by('type');
		$this->db->order_by('order_by');
		$query=$this->db->get($this->table);
    	return $query->result();
	}

	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$old_sc_id){
		$this->db->where('sc_id', $old_sc_id);
      	$this->db->update($this->table, $data);
	}
	public function GetById($sc_id){
	    $this->db->where('sc_id',$sc_id);
	    $query = $this->db->get($this->table);
		return $query->row();
	}
	public function Delete($sc_id){
		$this->db->where('sc_id', $sc_id);
		$this->db->delete($this->table);
	}
	public function DeleteAll(){
		$this->db->empty_table($this->table);	
	}
}
?>