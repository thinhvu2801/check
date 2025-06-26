<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MProductType extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->table="ProductType";
	}
	public function CheckCode($product_type_id){
		$this->db->where('product_type_id',$product_type_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function Read(){
		$this->db->where('product_type_id !=','-');
		$query=$this->db->get($this->table);
    	return $query->result();
	}
	public function ReadExistIn($table)
	{
		$where = "product_type_id = ANY (SELECT product_type_id FROM ".$table.")";
		$this->db->where($where);
		$this->db->where('product_type_id !=','-');
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$product_type_id){
		$this->db->where('product_type_id', $product_type_id);
      	$this->db->update($this->table, $data);
	}
	
	public function GetById($product_type_id){
		$this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where('product_type_id',$product_type_id);
	    $query = $this->db->get();
		return $query->row();
	}
	public function Delete($product_type_id){
		$this->db->where('product_type_id', $product_type_id);
		$this->db->delete($this->table);
	}
	public function DeleteAll(){
		$this->db->empty_table($this->table);	
	}
}
?>