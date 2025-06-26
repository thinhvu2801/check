<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MGraderSize extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "GraderSize";
	}
	public function CheckCode($size_name){
		$this->db->where('size_name',$size_name);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}

	public function Read(){
		$this->db->where('size_name !=','-');
		$this->db->order_by('min');
		$this->db->order_by('max');
		$query=$this->db->get($this->table);
    	return $query->result();
	}

	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$old_size_name){
		$this->db->where('size_name', $old_size_name);
      	$this->db->update($this->table, $data);
	}
	public function GetById($size_name){
	    $this->db->where('size_name',$size_name);
	    $query = $this->db->get($this->table);
		return $query->row();
	}
	public function Delete($size_name){
		$this->db->where('size_name', $size_name);
		$this->db->delete($this->table);
	}
	public function DeleteAll(){
		$this->db->empty_table($this->table);	
	}
}
?>