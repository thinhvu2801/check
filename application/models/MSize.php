<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MSize extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->table="Size";
	}
	public function CheckCode($size_id){
		$this->db->where('size_id',$size_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function Read(){
		$this->db->where('size_id !=','-');
		$this->db->order_by('order_by');
		$query=$this->db->get($this->table);
    	return $query->result();
	}
	public function ReadExistIn($table)
	{
		$where = "size_id = ANY (SELECT size_id FROM ".$table.")";
		$this->db->where($where);
		$this->db->where('size_id !=','-');
		$this->db->order_by('order_by');
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$size_id){
		$this->db->where('size_id', $size_id);
      	$this->db->update($this->table, $data);
	}
	
	public function GetById($size_id){
		$this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where('size_id',$size_id);
	    $query = $this->db->get();
		return $query->row();
	}
	public function Delete($size_id){
		$this->db->where('size_id', $size_id);
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