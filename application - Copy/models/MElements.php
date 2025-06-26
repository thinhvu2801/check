<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MElements extends CI_Model
{
	var $table;
	function __construct()
	{
		parent::__construct();
		$this->table = "Elements";
	}
	public function Read()
	{
		$query = $this->db->get($this->table);
		$result = $query->result();
		return $result;
		//$fields = $this->db->list_fields($this->table);
	}
	public function Update($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}
}
