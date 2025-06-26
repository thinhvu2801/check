<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MRole extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "Role";
	}
	public function CheckCode($role_id){
		$this->db->where('role_id',$role_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}

	public function Read(){
		$this->db->where('role_id !=','-');
		$this->db->order_by('active','desc');
		$this->db->order_by('orderby');
		$query=$this->db->get($this->table);
    	return $query->result();
	}

	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$old_role_id){
		$this->db->where('role_id', $old_role_id);
      	$this->db->update($this->table, $data);
	}
	public function GetById($role_id){
	    $this->db->where('role_id',$role_id);
	    $query = $this->db->get($this->table);
		return $query->row();
	}
	public function Delete($role_id){
		$this->db->where('role_id', $role_id);
		$this->db->delete($this->table);
	}
	public function DeleteAll(){
		$this->db->empty_table($this->table);	
	}
}
?>