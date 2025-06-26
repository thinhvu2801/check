<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MSuaCa extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function ForWorkerView($card_id, $today)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_by_Worker_for_View] @card_id = '$card_id',@today = '$today'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function WorkingIn($number_row)
    {
        $suaca_db = $this->load->database('suaca', TRUE);
        $proc = "EXEC [dbo].[SuaCa_Working_In] @number_row = '$number_row'";
        $query = $suaca_db->query($proc);
        return $query->result_array();
    }
    public function WorkingOut($number_row)
    {
        $proc = "EXEC [dbo].[SuaCa_Working_Out] @number_row = '$number_row'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function SuaCa_Dinh_Muc($lo_id, $weight_in, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[SuaCa_Dinh_Muc] @lo_id = '" .
            $lo_id . "', @weight_in = '" . $weight_in . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function ReadById($id)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_ReadById] @id = '$id'";
        $query = $this->db->query($proc);
        return $query->row();
    }
    public function History_Insert($id_suaca, $lo_id, $product_id, $username, $deleted)
    {
        $proc = "EXEC [dbo].[SuaCa_History_Insert]
                @id_suaca = '$id_suaca'
                ,@lo_id = '$lo_id'
                ,@product_id = '$product_id'
                ,@username = '$username'
                ,@deleted = '$deleted'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function History_ReadById($id_suaca)
    {
        $proc = "EXEC [dbo].[SuaCa_History_ReadById] @id_suaca = '$id_suaca'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Detail($start_date, $end_date, $start_time, $end_time, $worker_id = '', $product_id = '', $lo_id = '')
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_Detail]
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
    public function Detail_Count($start_date, $end_date, $start_time, $end_time, $weight_in, $worker_id = '', $product_id = '', $lo_id = '')
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_Detail_Count]
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
    public function Detail_Export($start_date, $end_date, $start_time, $end_time, $worker_id = '', $product_id = '', $lo_id = '')
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_Detail_Export]
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
    public function Product($lo_id, $weight_in, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_by_Product] @lo_id = '" .
            $lo_id . "', @weight_in = '" . $weight_in . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function ProductBack($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_by_Product_Back] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Worker_Total($lo_id, $product_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_by_Worker] @lo_id = '$lo_id',@product_id = '$product_id', @start_date = '$start_date', @end_date = '$end_date', @start_time = '$start_time', @end_time = '$end_time'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Worker_Total_Time($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_by_Worker_Total_Time] @lo_id = '$lo_id',@start_date = '$start_date', @end_date = '$end_date', @start_time = '$start_time', @end_time = '$end_time'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Worker($lo_id, $weight_in, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_by_Worker_2] @lo_id = '" .
            $lo_id . "', @weight_in = '" . $weight_in . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time  . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function QCWorkerDetail($lo_id, $start_date, $end_date)
    {
        $proc = "EXEC [dbo].[SuaCa_QC_Worker_Detail] @lo_id = '" . $lo_id . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function QCWorkerGeneral($lo_id, $start_date, $end_date)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_by_GroupWorker] @lo_id = '" . $lo_id . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Worker_No_Input($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_by_Worker_No_Input] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Worker_No_Output($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $suaca_db = $this->load->database('suaca_1', TRUE);
        $proc = "EXEC [dbo].[SuaCa_Stat_by_Worker_No_Output] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $suaca_db->query($proc);
        return $query->result_array();
    }
    public function OverTime($lo_id, $max_minute, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_OverTime] @lo_id = '" .
            $lo_id . "', @max_minute = '" . $max_minute . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Invalid($start_date, $end_date, $start_time, $end_time, $weight_in)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_Invalid] @start_date = '" . $start_date . "', @end_date = '" . $end_date . "', @start_time = '" . $start_time . "', @end_time = '" . $end_time . "', @weight_in = '" . $weight_in . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Over_Threshold($lo_id, $weight_in, $date)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_Over_Threshold] @lo_id = '" . $lo_id . "', @weight_in = '" . $weight_in . "', @date = '" . $date . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }

    public function SkinMachine($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[SuaCa_Stat_SkinMachine] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date . "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
}
