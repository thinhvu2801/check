<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MCongDoan extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "ADD_CongDoan";
		//$this->db = $this->load->database('canphupham', TRUE);
	}
	public function CheckCode($congdoan_id){
		$this->db->where('congdoan_id',$congdoan_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function ReadById($congdoan_id){
		$this->db->where('congdoan_id',$congdoan_id);
		$query = $this->db->get($this->table);
		return $query->row();
	}
	public function Read(){
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function ReadExistIn($table)
	{
		$where = "congdoan_id = ANY (SELECT congdoan_id FROM ".$table.")";
		$this->db->where($where);
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$congdoan_id){
		$this->db->where('congdoan_id', $congdoan_id);
      	$this->db->update($this->table, $data);
	}
	public function Delete($congdoan_id){
		$this->db->where('congdoan_id', $congdoan_id);
		$this->db->delete($this->table);
	}
}
?>