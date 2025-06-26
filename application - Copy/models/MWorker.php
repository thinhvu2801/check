<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MWorker extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "Worker";
	}
	public function CheckCode($worker_id){
		$this->db->where('worker_id',$worker_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function ReadById($worker_id){
	    $this->db->where('worker_id',$worker_id);
	    $query = $this->db->get($this->table);
		return $query->row();
	}
	public function Read($group_id="0"){
		if ($group_id!="0")
			$this->db->where('group_id',$group_id);
			$this->db->where('worker_id !=','-');
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function ReadExistIn($table)
	{
		$where = "worker_id = ANY (SELECT worker_id FROM ".$table.")";
		$this->db->where($where);
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$old_worker_id){
		$this->db->where('worker_id', $old_worker_id);
      	$this->db->update($this->table, $data);
	}
	public function Delete($worker_id){
		$this->db->where('worker_id', $worker_id);
		$this->db->delete($this->table);
	}
}
?>
