<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MMachine extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = "Machine";
    }
    public function read()
    {
        $query = $this->db->get('Machine');
        return $query->result();
    }
    public function readById($machine_code, $machine_serial)
    {
        $this->db->where('machine_code',$machine_code);
        $this->db->where('machine_serial',$machine_serial);
        $query = $this->db->get('Machine');
        return $query->row();
    }
    public function Insert($data){
		$this->db->insert($this->table, $data);
	}
    public function Update($data,$id){
		$this->db->where('id', $id);
      	$this->db->update($this->table, $data);
	}
    public function Delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
}
