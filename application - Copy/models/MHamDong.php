<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MHamDong extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->table="Ham";
	}
	public function CheckCode($ham_id){
		$this->db->where('ham_id',$ham_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}
	public function Read(){
		$this->db->where('ham_id !=','-');
		$query=$this->db->get($this->table);
    	return $query->result();
	}
	public function ReadExistIn($table)
	{
		$where = "ham_id = ANY (SELECT ham_id FROM ".$table.")";
		$this->db->where($where);
		$this->db->where('ham_id !=','-');
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Update($data,$ham_id){
		$this->db->where('ham_id', $ham_id);
      	$this->db->update($this->table, $data);
	}
	
	public function GetById($ham_id){
		$this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where('ham_id',$ham_id);
	    $query = $this->db->get();
		return $query->row();
	}
	public function Delete($ham_id){
		$this->db->where('ham_id', $ham_id);
		$this->db->delete($this->table);
	}
	public function DeleteAll(){
		$this->db->empty_table($this->table);	
	}

	public function Stat_Detail($date, $ham_id, $lo_id, $in_out)
    {
        $proc = "EXEC [dbo].[HamDong_Stat_Detail] @date='$date', @ham_id='$ham_id', @lo_id='$lo_id', @in_out=$in_out";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
	public function Stat_Synthetic($date, $ham_id, $lo_id)
    {
        $proc = "EXEC [dbo].[HamDong_Stat_Synthetic] @date='$date', @ham_id='$ham_id', @lo_id='$lo_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
	public function KiemKe($date,$time,$lo_id, $ham_id, $product_type_id, $size_id,$weight_ton)
    {
        $proc = "EXEC [dbo].[HamDong_KiemKe] @date='$date',@time='$time',
		@lo_id='$lo_id', @ham_id='$ham_id', @product_type_id='$product_type_id', @size_id='$size_id', @weight_ton='$weight_ton'";
        $this->db->query($proc);
    }
}
?>