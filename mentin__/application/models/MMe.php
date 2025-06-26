<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MMe extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	public function CheckCode($me_id){
		$this->db->where('me_id',$me_id);
		$query = $this->db->get('Me');
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function Read(){
		$this->db->where('me_id !=','-');
		$query=$this->db->get('Me');
    	return $query->result();
	}
	public function ReadExistIn($table)
	{
		$where = "me_id = ANY (SELECT me_id FROM ".$table.")";
		$this->db->where($where);
		$this->db->where('me_id !=','-');
		$query = $this->db->get('Me');
		return $query->result();
	}
	public function Insert($data){
		$this->db->insert('Me', $data);
	}
	public function Update($data,$me_id){
		$this->db->where('me_id', $me_id);
      	$this->db->update('Me', $data);
	}
	
	public function GetById($me_id){
		$this->db->select('*');
	    $this->db->from('Me');
	    $this->db->where('me_id',$me_id);
	    $query = $this->db->get();
		return $query->row();
	}
	public function Delete($me_id){
		$this->db->where('me_id', $me_id);
		$this->db->delete('Me');
	}
	public function DeleteAll(){
		$this->db->empty_table('Me');	
	}
}
?>