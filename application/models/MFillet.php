<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MFillet extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function ForWorkerView($card_id, $today)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_by_Worker_for_View] @card_id = '$card_id',@today = '$today'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Product_Read($start_date, $end_date,$start_time, $end_time){
        $proc="EXEC [dbo].[Fillet_Stat_Product_Read] @start_date = '".$start_date."', @end_date = '".$end_date."', @start_time = '".$start_time."', @end_time = '".$end_time."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function WorkingIn($number_row)
    {
        $phile_db = $this->load->database('phile', TRUE);
        $proc = "EXEC [dbo].[Fillet_Working_In] @number_row = '$number_row'";
        $query = $phile_db->query($proc);
        return $query->result_array();
    }
    public function WorkingOut($number_row)
    {
        $proc = "EXEC [dbo].[Fillet_Working_Out] @number_row = '$number_row'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Working_Fillet_Detail()
    {
        $proc = "EXEC [dbo].[Working_Fillet_Detail]";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    
    public function Dinh_Muc($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Dinh_Muc] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Detail($start_date, $end_date, $start_time, $end_time, $worker_id = '', $product_id = '', $lo_id = '')
    {
        $proc = "EXEC [dbo].[Fillet_Stat_Detail]
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
    public function Detail_Count($start_date, $end_date, $start_time, $end_time, $weight_in, $worker_id='', $product_id='', $lo_id='')
    {
        $proc = "EXEC [dbo].[Fillet_Stat_Detail_Count]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@weight_in = '$weight_in'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@worker_id = '$worker_id'
                ,@product_id = '$product_id'
                ,@lo_id = '$lo_id'";
        $query = $this->db->query($proc);
        return $query->row();
    }
    public function Detail_Export($start_date, $end_date, $start_time, $end_time, $weight_in, $worker_id='', $product_id='', $lo_id='')
    {
        $proc = "EXEC [dbo].[Fillet_Stat_Detail_Export]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@weight_in = '$weight_in'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@worker_id = '$worker_id'
                ,@product_id = '$product_id'
                ,@lo_id = '$lo_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Product($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_by_Product] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function ProductBack($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_by_Product_Back] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function CaXuatBan($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[CaXuatBan_Customer] @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Worker($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_by_Worker_2] @lo_id = '" .
        $lo_id . "', @start_date = '" . $start_date. "', @end_date = '" . $end_date. "', @start_time = '" .$start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Worker2($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_by_Worker_3] @lo_id = '" .
        $lo_id . "', @start_date = '" . $start_date. "', @end_date = '" . $end_date. "', @start_time = '" .$start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Worker_Total($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_by_Worker] @lo_id = '" .
        $lo_id ."', @start_date = '" .$start_date . "', @end_date = '" . $end_date. "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time  . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Worker_No_Input($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_by_Worker_No_Input] @lo_id = '" .
        $lo_id ."', @start_date = '" .$start_date . "', @end_date = '" . $end_date. "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
     public function Worker_No_Output($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $phile_db = $this->load->database('phile', TRUE);
        $proc = "EXEC [dbo].[Fillet_Stat_by_Worker_No_Output] @lo_id = '" .
        $lo_id ."', @start_date = '" .$start_date . "', @end_date = '" . $end_date. "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $phile_db->query($proc);
        return $query->result_array();
    }
    public function Quantity($date,$table)
    {
        $phile_db = $this->load->database('phile', TRUE);
        $proc = "SELECT COUNT(weight_in) FROM ".$table." where date='".$date."'";
        $query = $phile_db->query($proc);
        return $query->row_array();
    }
    public function OverTime($lo_id,$max_minute, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_OverTime] @lo_id = '" .
        $lo_id ."', @max_minute = '" .$max_minute."', @start_date = '" .$start_date . "', @end_date = '" . $end_date. "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Invalid($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_Invalid] @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Over_Threshold($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_Over_Threshold] @lo_id = '" . $lo_id. "', @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
        $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Worker_Over_Threshold($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Worker_Fillet_Stat_Over_Threshold] @lo_id = '" . $lo_id. "', @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
        $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    
}