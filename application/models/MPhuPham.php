<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MPhuPham extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "Product";
		$this->otherdb = $this->load->database('canphupham', TRUE);
	}
	public function ChiTiet($date,$xe_id){
        $proc="EXEC [dbo].[PhuPham_Stat_ChiTiet] @date = '$date', @xe_id='$xe_id'";
        $query=$this->otherdb->query($proc);
        return $query->result_array();
    }
	public function TongHop($start_date, $end_date,$xe_id){
        $proc="EXEC [dbo].[PhuPham_Stat_TongHop] @start_date = '$start_date', @end_date='$end_date', @xe_id='$xe_id'";
        $query=$this->otherdb->query($proc);
        return $query->result_array();
    }
	public function CheckCode($product_id){
		$this->otherdb->where('product_id',$product_id);
		$query = $this->otherdb->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function ReadAll(){
		//$this->otherdb->where('parent_id !=',"0");
		$this->otherdb->where('product_id !=',"-");
		$query = $this->otherdb->get($this->table);
		return $query->result();
	}
	public function Read($parent_id = "0"){
		$query_string = "select distinct p1.*, p2.parent_id as has_child from product p1
						left join product p2 on p1.product_id = p2.parent_id
						where p1.parent_id = ? and p1.product_id !='-'";
		$query=$this->otherdb->query($query_string, array($parent_id));
    	return $query->result();
	}
	public function ReadExistIn($table,$date="")
	{
		$where = "product_id = ANY (SELECT product_id FROM ".$table;
		if ($date!="")
			$where=$where." where date='$date'";
		$where = $where.")";
		$this->otherdb->where($where);
		$this->otherdb->where('product_id !=','-');
		$query = $this->otherdb->get($this->table);
		return $query->result();
	}
	public function ReadById($product_id){
	    $this->otherdb->where('product_id',$product_id);
	    $query = $this->otherdb->get($this->table);
		return $query->row();
	}
	public function ReadLinkAble(){
		$this->otherdb->where('linkable',1);
		$query = $this->otherdb->get($this->table);
    	return $query->result();
	}
	public function Insert($data){
		$this->otherdb->insert('product', $data);
	}
	public function Update($data,$old_product_id){
		$this->otherdb->where('product_id', $old_product_id);
      	$this->otherdb->update($this->table, $data);
	}
	public function UpdateProductId($data,$id){
		$this->otherdb->where('id', $id);
      	$this->otherdb->update("PhuPham", $data);
	}
	public function Delete($product_id){
		$child = $this->Read($product_id);
		if (count($child)>0)
			redirect(base_url()."product");
		$this->otherdb->where('product_id', $product_id);
		$this->otherdb->delete($this->table);
	}
	public function DeleteAll(){
		$this->otherdb->empty_table($this->table);	
	}
	public function tryCatchSQL($string){
		$string = "BEGIN TRY ".$string;
		$string .=" END TRY BEGIN CATCH END CATCH";
		return $string;
	}
}
?>