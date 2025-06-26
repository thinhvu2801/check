<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MProvider extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "Provider";
	}
	public function CheckCode($provider_id){
		$this->db->where('provider_id',$provider_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function ReadById($provider_id){
		$this->db->where('provider_id',$provider_id);
		$query = $this->db->get($this->table);
		return $query->row();
	}
	public function Read(){
		$this->db->where('provider_id !=','-');
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function ReadExistIn($table)
	{
		$where = "provider_id = ANY (SELECT provider_id FROM ".$table.")";
		$this->db->where($where);
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$provider_id){
		$this->db->where('provider_id', $provider_id);
      	$this->db->update($this->table, $data);
	}

	public function Delete($provider_id){
		$this->db->where('provider_id', $provider_id);
		$this->db->delete($this->table);
	}
}
?>