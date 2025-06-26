<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MCoi extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->table="coi";
	}
	public function CheckCode($coi_id){
		$this->db->where('coi_id',$coi_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function Read(){
		$this->db->where('coi_id !=','-');
		$query=$this->db->get($this->table);
    	return $query->result();
	}
	public function ReadExistIn($table)
	{
		$where = "coi_id = ANY (SELECT coi_id FROM ".$table.")";
		$this->db->where($where);
		$this->db->where('coi_id !=','-');
		$query = $this->db->get('Me');
		return $query->result();
	}
	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$coi_id){
		$this->db->where('coi_id', $coi_id);
      	$this->db->update($this->table, $data);
	}
	
	public function GetById($coi_id){
		$this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where('coi_id',$coi_id);
	    $query = $this->db->get();
		return $query->row();
	}
	public function Delete($coi_id){
		$this->db->where('coi_id', $coi_id);
		$this->db->delete($this->table);
	}
	public function DeleteAll(){
		$this->db->empty_table($this->table);	
	}
}
?>