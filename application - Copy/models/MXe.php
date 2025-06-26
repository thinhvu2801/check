<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MXe extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "Xe";
		$this->otherdb = $this->load->database('canphupham', TRUE);
	}
	public function CheckCode($xe_id){
		$this->otherdb->where('xe_id',$xe_id);
		$query = $this->otherdb->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function ReadById($xe_id){
		$this->otherdb->where('xe_id',$xe_id);
		$query = $this->otherdb->get($this->table);
		return $query->row();
	}
	public function Read(){
		$query = $this->otherdb->get($this->table);
		return $query->result();
	}
	public function ReadExistIn($table)
	{
		$where = "xe_id = ANY (SELECT xe_id FROM ".$table.")";
		$this->otherdb->where($where);
		$query = $this->otherdb->get($this->table);
		return $query->result();
	}
	public function Insert($data){
		$this->otherdb->insert($this->table, $data);
	}
	public function Update($data,$xe_id){
		$this->otherdb->where('xe_id', $xe_id);
      	$this->otherdb->update($this->table, $data);
	}
	public function Delete($xe_id){
		$this->otherdb->where('xe_id', $xe_id);
		$this->otherdb->delete($this->table);
	}
}
?>