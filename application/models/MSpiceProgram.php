<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MSpiceProgram extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "Spice_Program";
	}
	public function CheckCode($spice_id){
		$this->db->where('spice_id',$spice_id);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0) return true;
		else return false;
	}

	public function Read($date){
		$proc = "EXEC [dbo].[SpiceProgram_Read] @date='$date'";
        $query = $this->db->query($proc);
        return $query->result();
	}
	public function ReadRecipe(){
		$proc = "EXEC [dbo].[SpiceProgram_ReadRecipe]";
        $query = $this->db->query($proc);
        return $query->result();
	}
	public function ReadRecipeByProgram($program_id){
		$proc = "EXEC [dbo].[SpiceProgram_ReadRecipe_ByProgram] @program_id='$program_id'";
        $query = $this->db->query($proc);
        return $query->result();
	}
	public function TotalSpice($date){
		$proc = "EXEC [dbo].[Spice_Data_Stat_Total] @date='$date'";
        $query = $this->db->query($proc);
        return $query->result();
	}
	public function Data_Detail($date){
		$proc = "EXEC [dbo].[Spice_Data_Stat_Detail_BySelected] @date='$date'";
        $query = $this->db->query($proc);
        return $query->result();
	}
	public function Data_General($date){
		$proc = "EXEC [dbo].[Spice_Data_Stat_General_BySelected] @date='$date'";
        $query = $this->db->query($proc);
        return $query->result();
	}
	public function Stat_Detail_ById($program_id){
		$proc = "EXEC [dbo].[Spice_Data_Stat_Detail_ById] @program_id='$program_id'";
        $query = $this->db->query($proc);
        return $query->result();
	}
	public function Stat_General_ById($program_id){
		$proc = "EXEC [dbo].[Spice_Data_Stat_General_ById] @program_id='$program_id'";
        $query = $this->db->query($proc);
        return $query->result();
	}
	public function Stat_General($product_id,$spice_id,$start_date,$end_date){
		$proc = "EXEC [dbo].[Spice_Data_Stat_General] @product_id='$product_id',@spice_id='$spice_id',@start_date='$start_date',@end_date='$end_date'";
        $query = $this->db->query($proc);
        return $query->result();
	}
	public function Insert($product_id, $quantity, $target_weight){
		$proc = "EXEC [dbo].[Spice_Program_Insert] 
		@product_id = '$product_id',@quantity = '$quantity',@target_weight = '$target_weight'";
        $query = $this->db->query($proc);
        //return $query->result_array();
	}
	public function Update($id,$method){
		$proc = "EXEC [dbo].[Spice_Program_Update] @id = '$id', @method = '$method'";
        $query = $this->db->query($proc);
	}
	public function GetById($spice_id){
	    $this->db->where('spice_id',$spice_id);
	    $query = $this->db->get($this->table);
		return $query->row();
	}
	public function Delete($spice_id){
		$this->db->where('spice_id', $spice_id);
		$this->db->delete($this->table);
	}
	public function DeleteAll(){
		$this->db->empty_table($this->table);	
	}
}
?>