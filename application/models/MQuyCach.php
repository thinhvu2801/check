<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MQuyCach extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "QuyCach";
	}
	public function CheckCode($quycach_id){
		$this->db->where('quycach_id',$quycach_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}

	public function Read(){
		$this->db->where('quycach_id !=','-');
		$query=$this->db->get($this->table);
    	return $query->result();
	}

	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$old_quycach_id){
		$this->db->where('quycach_id', $old_quycach_id);
      	$this->db->update($this->table, $data);
	}
	public function GetById($quycach_id){
	    $this->db->where('quycach_id',$quycach_id);
	    $query = $this->db->get($this->table);
		return $query->row();
	}
	public function Delete($quycach_id){
		$this->db->where('quycach_id', $quycach_id);
		$this->db->delete($this->table);
	}
	public function DeleteAll(){
		$this->db->empty_table($this->table);	
	}
	public function Update_Kho($data,$table)
	{
		$kho_db = $this->load->database('nhapkho', TRUE);
		$kho_db->empty_table($table);
		$kho_db->query($data);
	}
}
?>