<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MProduct extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "Product";
	}
	public function CheckCode($product_id){
		$this->db->where('product_id',$product_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function ReadAll($hidden=0){
		$this->db->where('parent_id !=',"0");
		$this->db->where('product_id !=',"-");
		if ($hidden>-1)
			$this->db->where('hidden',$hidden);
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function Read($parent_id = "0"){
		$query_string = "select distinct p1.*, p2.parent_id as has_child from product p1
						left join product p2 on p1.product_id = p2.parent_id
						where p1.parent_id = ? and p1.product_id !='-'";
		$query=$this->db->query($query_string, array($parent_id));
    	return $query->result();
	}
	public function ReadExistIn($table)
	{
		$where = "product_id = ANY (SELECT product_id FROM ".$table.")";
		$this->db->where($where);
		$this->db->where('product_id !=','-');
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function ReadById($product_id){
	    $this->db->where('product_id',$product_id);
	    $query = $this->db->get($this->table);
		return $query->row();
	}
	public function ReadLinkAble(){
		$this->db->where('linkable',1);
		$query = $this->db->get($this->table);
    	return $query->result();
	}
	public function Insert($data){
		$this->db->insert('product', $data);
	}
	public function Update($data,$old_product_id){
		$this->db->where('product_id', $old_product_id);
      	$this->db->update($this->table, $data);

		$this->db->where('parent_id', $old_product_id);
		$data = array(
			'parent_id' => $data["product_id"],
		);

		$this->db->update($this->table, $data);
	}

	public function Delete($product_id){
		$child = $this->Read($product_id);
		if (count($child)>0)
			redirect(base_url()."product");
		$this->db->where('product_id', $product_id);
		$this->db->delete($this->table);
	}
	public function DeleteAll(){
		$this->db->empty_table($this->table);	
	}
	public function tryCatchSQL($string){
		$string = "BEGIN TRY ".$string;
		$string .=" END TRY BEGIN CATCH END CATCH";
		return $string;
	}
}
?>