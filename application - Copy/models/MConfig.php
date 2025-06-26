<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MConfig extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	public function Get($id){
		$query = $this->db->get('CONFIG');
		return $query->row();
	}
	public function Update($data){
		$this->db->where('id',1);
      	$this->db->update('CONFIG', $data);
	}
}
?>