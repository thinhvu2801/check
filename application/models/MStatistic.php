<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MStatistic extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function OverView($start_date,$end_date){
        $proc="EXEC [dbo].[Stat_OverView] @start_date = '$start_date', @end_date = '$end_date'";
        $query=$this->db->query($proc);
        return $query->result_array();
    }
    /*Working*/
    public function NguyenLieu_Detail($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[NguyenLieu_Stat_ChiTiet] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function NguyenLieu_Product($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[NguyenLieu_Stat_TongHop] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Working_NguyenLieu_Detail()
    {
        $proc = "EXEC [dbo].[Working_NguyenLieu_Detail]";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Working_Fillet_Detail()
    {
        $proc = "EXEC [dbo].[Working_Fillet_Detail]";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Working_SuaCa_Detail($weight_in)
    {
        $proc = "EXEC [dbo].[Working_SuaCa_Detail] @weight_in = '" .$weight_in . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Fillet_Group_In($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Group_In_Stat] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Fillet_Group_Out($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Group_Out_Stat] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Fillet_Dinh_Muc($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Dinh_Muc] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Fillet_Detail($date, $start_time, $end_time, $worker_id='', $product_id='', $lo_id='',$offset, $limit)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_Detail] @date = '" .
            $date . "', @start_time = '" .$start_time . "', @end_time = '" . $end_time. "', @offset = '" . $offset . "', @limit = '" . $limit . "', @worker_id = '" . $worker_id . "', @product_id = '" . $product_id. "', @lo_id = '" . $lo_id . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Fillet_Detail_Export($date, $start_time, $end_time, $worker_id='', $product_id='', $lo_id='')
    {
        $proc = "EXEC [dbo].[Fillet_Stat_Detail_Export] @date = '" .
            $date. "', @start_time = '" .$start_time . "', @end_time = '" . $end_time . "', @worker_id = '" . $worker_id . "', @product_id = '" . $product_id. "', @lo_id = '" . $lo_id . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Fillet_Detail_Count($date, $start_time, $end_time, $worker_id='', $product_id='', $lo_id='')
    {
        $proc = "EXEC [dbo].[Fillet_Stat_Detail_Count] @date = '" .
            $date . "', @start_time = '" . $start_time . "', @end_time = '" . $end_time. "', @worker_id = '" . $worker_id . "', @product_id = '" . $product_id. "', @lo_id = '" . $lo_id . "'";
        $query = $this->db->query($proc);
        return $query->row();
    }
    public function Fillet_Product($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_by_Product] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Fillet_Worker($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_by_Worker_2] @lo_id = '" .
        $lo_id . "', @start_date = '" . $start_date. "', @end_date = '" . $end_date. "', @start_time = '" .$start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Fillet_Invalid($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_Invalid] @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Fillet_Over_Threshold($lo_id, $date)
    {
        $proc = "EXEC [dbo].[Fillet_Stat_Over_Threshold] @lo_id = '" . $lo_id. "', @date = '" . $date . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function SuaCa_Dinh_Muc($lo_id, $weight_in, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[SuaCa_Dinh_Muc] @lo_id = '" .
            $lo_id . "', @weight_in = '" . $weight_in. "', @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function SuaCa_Detail($date, $start_time, $end_time, $weight_in, $worker_id='', $product_id='', $lo_id='',$offset, $limit)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_Detail]
                @date = '$date'
                ,@weight_in = '$weight_in'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@worker_id = '$worker_id'
                ,@product_id = '$product_id'
                ,@lo_id = '$lo_id'
                ,@offset = '$offset'
                ,@limit = '$limit'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function SuaCa_Detail_Count($date, $start_time, $end_time, $weight_in, $worker_id='', $product_id='', $lo_id='')
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_Detail_Count]
                @date = '$date'
                ,@weight_in = '$weight_in'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@worker_id = '$worker_id'
                ,@product_id = '$product_id'
                ,@lo_id = '$lo_id'";
        $query = $this->db->query($proc);
        return $query->row();
    }
    public function SuaCa_Detail_Export($date, $start_time, $end_time, $weight_in, $worker_id='', $product_id='', $lo_id='')
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_Detail_Export]
                @date = '$date'
                ,@weight_in = '$weight_in'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@worker_id = '$worker_id'
                ,@product_id = '$product_id'
                ,@lo_id = '$lo_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function SuaCa_Product($lo_id, $weight_in, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_by_Product] @lo_id = '" .
            $lo_id ."', @weight_in = '" .$weight_in."', @start_date = '" .$start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function SuaCa_Worker($lo_id, $weight_in, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_by_Worker_2] @lo_id = '" .
        $lo_id ."', @weight_in = '" .$weight_in."', @start_date = '" .$start_date . "', @end_date = '" . $end_date. "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time  . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function SuaCa_Worker_No_Input($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_by_Worker_No_Input] @lo_id = '" .
        $lo_id ."', @start_date = '" .$start_date . "', @end_date = '" . $end_date. "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function SuaCa_Invalid($start_date, $end_date, $start_time, $end_time, $weight_in)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_Invalid] @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .$start_time . "', @end_time = '" . $end_time. "', @weight_in = '" . $weight_in. "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function SuaCa_Over_Threshold($lo_id, $weight_in, $date)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_Over_Threshold] @lo_id = '" . $lo_id. "', @weight_in = '" . $weight_in. "', @date = '" . $date . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function PhanSize_Detail($date, $start_time, $end_time, $lo_id='', $group_id='')
    {
        $proc = "EXEC [dbo].[PhanSize_Stat_Detail] @date = '" .
            $date . "', @start_time = '" . $start_time . "', @end_time = '" . $end_time . "', @lo_id = '" . $lo_id . "', @group_id = '" . $group_id . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function PhanSize_Product($start_date, $end_date, $start_time, $end_time, $lo_id='', $group_id='')
    {
        $proc = "EXEC [dbo].[PhanSize_Stat_by_Product] @start_date = '" .
            $start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time. "', @lo_id = '" . $lo_id. "', @group_id = '" . $group_id . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Kirimi_In($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Kirimi_In_Stat] @lo_id = '" .
            $lo_id ."', @start_date = '" .$start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Kirimi_Out($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Kirimi_Out_Stat] @lo_id = '" .
            $lo_id ."', @start_date = '" .$start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Kirimi_In_Detail($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Kirimi_In_Stat_Detail] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Kirimi_Out_Detail($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Kirimi_Out_Stat_Detail] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Kirimi_in_Product($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Kirimi_in_Stat_by_Product] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Kirimi_out_Product($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Kirimi_out_Stat_by_Product] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    
    public function CanNgheu_Detail($date, $start_time, $end_time, $lo_id='', $provider_id='',$process_id='', $product='',$worker_id='')
    {
        $proc = "EXEC [dbo].[CanNgheu_Stat_Detail] @date = '" . $date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time. "', @lo_id = '" . $lo_id. "', @provider_id = '" . $provider_id. "', @process_id = '" . $process_id. "', @product = '" . $product. "', @worker_id = '" . $worker_id . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function CanNgheu_Product($start_date,$end_date, $start_time, $end_time, $lo_id='', $provider_id='',$process_id='', $product='')
    {
        $proc = "EXEC [dbo].[CanNgheu_Stat_Product] @start_date = '" . $start_date . "', @end_date = '" .
            $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time. "', @lo_id = '" . $lo_id. "', @provider_id = '" . $provider_id. "', @process_id = '" . $process_id. "', @product = '" . $product. "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function CanNgheu_Worker($start_date,$end_date,$start_time, $end_time, $lo_id='', $provider_id='',$process_id='',$worker_id='')
    {
        $proc = "EXEC [dbo].[CanNgheu_Stat_Worker] @start_date = '" . $start_date . "', @end_date = '". $end_date . "', @start_time = '".$start_time . "', @end_time = '" . $end_time. "', @lo_id = '" . $lo_id. "', @provider_id = '" . $provider_id. "', @process_id = '" . $process_id. "', @worker_id = '" . $worker_id . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
}