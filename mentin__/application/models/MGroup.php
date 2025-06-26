<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MGroup extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "Group";
	}
	public function CheckCode($group_id){
		$this->db->where('group_id',$group_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function ReadById($group_id){
		$this->db->where('group_id',$group_id);
		$query = $this->db->get($this->table);
		return $query->row();
	}
	public function Read(){
		$this->db->where('group_id !=','-');
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function ReadExistIn($table)
	{
		$where = "group_id = ANY (SELECT group_id FROM ".$table.")";
		$this->db->where($where);
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$group_id){
		$this->db->where('group_id', $group_id);
      	$this->db->update($this->table, $data);

		$this->db->where('group_id', $group_id);
		$data = array(
			'group_id' => $data["group_id"]
		);
      	$this->db->update("Worker", $data);
	}
	public function Delete($group_id){
		$this->db->where('group_id', $group_id);
		$this->db->delete($this->table);
	}
}
?>