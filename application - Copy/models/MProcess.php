<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MProcess extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "Process";
	}
	public function CheckCode($process_id){
		$this->db->where('process_id',$process_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function ReadById($process_id){
		$this->db->where('process_id',$process_id);
		$query = $this->db->get($this->table);
		return $query->row();
	}
	public function Read(){
		$this->db->where('process_id !=','-');
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$process_id){
		$this->db->where('process_id', $process_id);
      	$this->db->update($this->table, $data);
	}

	public function Delete($process_id){
		$this->db->where('process_id', $process_id);
		$this->db->delete($this->table);
	}
}
?>