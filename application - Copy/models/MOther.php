<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MOther extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	public function OverView($start_date,$end_date,$lo_id=""){
        $proc="EXEC [dbo].[Stat_OverView] @start_date = '$start_date', @end_date = '$end_date', @lo_id = '$lo_id'";
        $query=$this->db->query($proc);
        return $query->result_array();
    }
}
?>