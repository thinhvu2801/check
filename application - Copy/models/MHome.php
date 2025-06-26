<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MHome extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	public function Chart_Report_Total(){
		$proc="EXEC [dbo].[Chart_Report_Total]";
        $query=$this->db->query($proc);
        return $query->row();
	}
	public function Chart_Report_TiepNhan(){
		$proc="EXEC [dbo].[Chart_Report_TiepNhan]";
        $query=$this->db->query($proc);
        return $query->result();
	}
	public function Chart_Report_Fillet(){
		$proc="EXEC [dbo].[Chart_Report_Fillet]";
        $query=$this->db->query($proc);
        return $query->result();
	}
	public function Chart_Report_SuaCa(){
		$proc="EXEC [dbo].[Chart_Report_SuaCa]";
        $query=$this->db->query($proc);
        return $query->result();
	}
}
?>