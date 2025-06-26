<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MPCXK extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->table="pcxk";
	}

	public function Stat_Detail($date, $worker_id, $product_id)
    {
        $proc = "EXEC [dbo].[PCXK_Stat_Detail] @date='$date', @worker_id='$worker_id', @product_id='$product_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
	public function Stat_Product($start_date, $end_date, $product_id)
    {
        $proc = "EXEC [dbo].[PCXK_Stat_Product] @start_date='$start_date', @end_date='$end_date', @product_id='$product_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
	public function Stat_Worker($start_date, $end_date,$worker_id, $product_id)
    {
        $proc = "EXEC [dbo].[PCXK_Stat_Worker] @start_date='$start_date', @end_date='$end_date', @worker_id='$worker_id', @product_id='$product_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
}
?>