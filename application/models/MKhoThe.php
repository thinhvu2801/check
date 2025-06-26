<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MKhoThe extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "RFID_MaThe";
	}
    public function CheckCode($id){
		$this->db->where('id',$id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function Read($table)
	{
		$proc = "SELECT * FROM ".$table."";
		$query = $this->db->query($proc);
		return $query->result();
	}
	public function Update($data,$old_id){
		$this->db->where('id', $old_id);
      	$this->db->update($this->table, $data);
	}
    public function Delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
    public function Insert($data){
		$this->db->insert($this->table, $data);
	}
}
?>