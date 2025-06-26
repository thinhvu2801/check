<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MErrorLog extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
   
   
    public function Detail($date, $start_time, $end_time,$offset, $limit)
    {
        $proc = "EXEC [dbo].[ErrorLog_Stat_Detail]
                @date = '$date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@offset = '$offset'
                ,@limit = '$limit'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Detail_Count($date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[ErrorLog_Stat_Detail_Count]
                @date = '$date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'";
        $query = $this->db->query($proc);
        return $query->row();
    }
    public function Detail_Export($date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[ErrorLog_Stat_Detail_Export]
                @date = '$date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function General($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[ErrorLog_Stat_General]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
}