<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MPhuPham2 extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
		$this->table = "Product";
	}
	public function ChiTiet($date, $customer_id){
        $proc="EXEC [dbo].[PhuPham_Stat_ChiTiet] @date = '$date',@customer_id = '$customer_id'";
        $query=$this->db->query($proc);
        return $query->result_array();
    }
	public function TongHop($start_date, $end_date, $customer_id){
        $proc="EXEC [dbo].[PhuPham_Stat_TongHop] @start_date = '$start_date', @end_date='$end_date',@customer_id = '$customer_id'";
        $query=$this->db->query($proc);
        return $query->result_array();
    }
}
?>