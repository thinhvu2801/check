<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MRecipe extends CI_Model
{
	var $table;
	function __construct()
	{
		parent::__construct();
		$this->table = "Recipe";
	}

	public function CheckCode($product_id, $spice_id)
	{
		$this->db->where('product_id', $product_id);
		$this->db->where('spice_id', $spice_id);
		$this->db->where('date', null);
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) return true;
		else return false;
	}

	public function Read($product_id)
	{
		$this->db->select('Recipe.*, Spice.spice_name');
		$this->db->from($this->table);
		$this->db->join('Spice', 'Spice.spice_id = Recipe.spice_id');
		$this->db->where('product_id', $product_id);
		$this->db->where('active', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function Insert($data)
	{
		$product_id=$data['product_id'];
		$spice_id=$data['spice_id'];
		$standard_weight=$data['standard_weight'];
		$weight=$data['weight'];
		$proc = "EXEC [dbo].[Recipe_Create] 
		@product_id = '$product_id',@spice_id = '$spice_id',@standard_weight = '$standard_weight',@weight = '$weight'";
        $query = $this->db->query($proc);
	}
	public function Update($data, $product_id)
	{
		$this->db->where('product_id', $product_id);
		$this->db->where('date', null);
		$this->db->update($this->table, $data);
	}
	public function History($product_id){
        $proc="EXEC [dbo].[Recipe_History] @product_id = '$product_id'";
        $query=$this->db->query($proc);
        return $query->result();
    }
	public function SelectVersion($product_id,$version){
        $proc="EXEC [dbo].[Recipe_SelectVersion] @product_id = '$product_id', @version = '$version'";
        $query=$this->db->query($proc);
    }
	public function Delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
	public function DeleteAll()
	{
		$this->db->empty_table($this->table);
	}
}
