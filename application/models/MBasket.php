<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MBasket extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "Basket";
	}
	public function CheckCode($basket_id){
		$this->db->where('basket_id',$basket_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}

	public function Read(){
		$this->db->where('basket_id !=','-');
		$query=$this->db->get($this->table);
    	return $query->result();
	}

	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$old_basket_id){
		$this->db->where('basket_id', $old_basket_id);
      	$this->db->update($this->table, $data);
	}
	public function GetById($basket_id){
	    $this->db->where('basket_id',$basket_id);
	    $query = $this->db->get($this->table);
		return $query->row();
	}
	public function Delete($basket_id){
		$this->db->where('basket_id', $basket_id);
		$this->db->delete($this->table);
	}
	public function DeleteAll(){
		$this->db->empty_table($this->table);	
	}
}
?>