<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MTamBot extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function RutChiDetail($start_date, $end_date, $start_time, $end_time, $worker_id='', $product_id='')
    {
        $proc = "EXEC [dbo].[BienDong_RutChi_Detail]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@worker_id = '$worker_id'
                ,@product_id = '$product_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function RutChiWorker($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[BienDong_RutChi_Worker] @start_date = '" . $start_date. "', @end_date = '" . $end_date. "', @start_time = '" .$start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function CatBTPDetail($start_date, $end_date, $start_time, $end_time, $worker_id='', $product_id='')
    {
        $proc = "EXEC [dbo].[BienDong_CatBTP_Detail]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@worker_id = '$worker_id'
                ,@product_id = '$product_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function CatBTPWorker($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[BienDong_CatBTP_Worker] @start_date = '" . $start_date. "', @end_date = '" . $end_date. "', @start_time = '" .$start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function CatBTPProduct($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[BienDong_CatBTP_Product] @start_date = '" . $start_date. "', @end_date = '" . $end_date. "', @start_time = '" .$start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function BTPNgamDetail($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[BienDong_BTPNgam_Detail] @start_date = '" . $start_date. "', @end_date = '" . $end_date. "', @start_time = '" .$start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function BTPNgamNoOutPut($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[BienDong_BTPNgam_No_Output] @start_date = '" . $start_date. "', @end_date = '" . $end_date. "', @start_time = '" .$start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function BTPNgamNoInPut($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[BienDong_BTPNgam_No_Input] @start_date = '" . $start_date. "', @end_date = '" . $end_date. "', @start_time = '" .$start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Overview($date)
    {
        $proc = "EXEC [dbo].[BienDong_Stat_Overview]
                @date = '$date'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Working($number_row)
    {
        $proc = "EXEC [dbo].[BTPNgam_Working] @number_row = '$number_row'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    // public function Working($number_row)
    // {
    //     $phile_db = $this->load->database('phile', TRUE);
    //     $proc = "EXEC [dbo].[BTPNgam_Working] @number_row = '$number_row'";
    //     $query = $phile_db->query($proc);
    //     return $query->result_array();
    // }
}