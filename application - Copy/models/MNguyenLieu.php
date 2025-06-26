<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MNguyenLieu extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function Detail($lo_id, $start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[NguyenLieu_Stat_ChiTiet] @lo_id = '" .
            $lo_id . "', @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Product($lo_id, $start_date, $end_date, $start_time, $end_time)
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
}