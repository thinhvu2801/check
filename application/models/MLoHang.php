<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MLoHang extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	public function CheckCode($lo_id){
		$this->db->where('lo_id',$lo_id);
		$query = $this->db->get('LoHang');
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function Read(){
		$this->db->where('lo_id !=','-');
		$query=$this->db->get('LoHang');
    	return $query->result();
	}
	public function ReadExistIn($table)
	{
		$where = "lo_id = ANY (SELECT lo_id FROM ".$table.")";
		$this->db->where($where);
		$this->db->where('lo_id !=','-');
		$query = $this->db->get('LoHang');
		return $query->result();
	}
	public function Insert($data){
		$this->db->insert('LoHang', $data);
	}
	public function Update($data,$lo_id){
		$this->db->where('lo_id', $lo_id);
      	$this->db->update('LoHang', $data);
	}
	
	public function GetById($lo_id){
		$this->db->select('*');
	    $this->db->from('LoHang');
	    $this->db->where('lo_id',$lo_id);
	    $query = $this->db->get();
		return $query->row();
	}
	public function Delete($lo_id){
		$this->db->where('lo_id', $lo_id);
		$this->db->delete('LoHang');
	}
	public function DeleteAll(){
		$this->db->empty_table('LoHang');	
	}
}
?>