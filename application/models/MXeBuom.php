<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MXeBuom extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function DetailIn($lo_id='', $start_date, $end_date, $start_time, $end_time, $product_id='')
    {
        $proc = "EXEC [dbo].[XeBuom_Stat_Detail_In]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@product_id = '$product_id'
                ,@lo_id = '$lo_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function DetailOut($lo_id='', $start_date, $end_date, $start_time, $end_time, $worker_id='', $product_id='')
    {
        $proc = "EXEC [dbo].[XeBuom_Stat_Detail_Out]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@worker_id = '$worker_id'
                ,@product_id = '$product_id'
                ,@lo_id = '$lo_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }

    public function Product($start_date, $end_date, $start_time, $end_time, $product_id='')
    {
        $proc = "EXEC [dbo].[XeBuom_Stat_by_Product]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@product_id = '$product_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Worker($lo_id='', $start_date, $end_date, $start_time, $end_time, $worker_id='')
    {
        $proc = "EXEC [dbo].[XeBuom_Stat_by_Worker]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@worker_id = '$worker_id'
                ,@lo_id = '$lo_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    
}