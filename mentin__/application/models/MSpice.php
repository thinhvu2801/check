<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MSpice extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "Spice";
	}
	public function CheckCode($spice_id){
		$this->db->where('spice_id',$spice_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}

	public function Read(){
		$this->db->where('spice_id !=','-');
		$query=$this->db->get($this->table);
    	return $query->result();
	}

	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$old_spice_id){
		$this->db->where('spice_id', $old_spice_id);
      	$this->db->update($this->table, $data);
	}
	public function GetById($spice_id){
	    $this->db->where('spice_id',$spice_id);
	    $query = $this->db->get($this->table);
		return $query->row();
	}
	public function Delete($spice_id){
		$this->db->where('spice_id', $spice_id);
		$this->db->delete($this->table);
	}
	public function DeleteAll(){
		$this->db->empty_table($this->table);	
	}
}
?>