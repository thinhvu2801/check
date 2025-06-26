<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MDataWeigh extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    public function Detail($machine_db, $date,$start_time, $end_time){
        $proc="EXEC [dbo].[Stat_Batcher_Detail] @date='$date', @start_time='$start_time', @end_time='$end_time'";
        $query=$machine_db->query($proc);
        return $query->result_array();
    }

    public function General($machine_db, $start_date,$end_date){
        $proc="EXEC [dbo].[Stat_Batcher_General] @start_date='$start_date', @end_date='$end_date',@tong_hop='1'";
        $query=$machine_db->query($proc);
        return $query->result_array();
    }
    public function Reject($machine_db, $start_date,$end_date){
        $proc="EXEC [dbo].[Stat_Batcher_Reject] @start_date='$start_date', @end_date='$end_date',@program_id='0'";
        $query=$machine_db->query($proc);
        return $query->result_array();
    }
}
?>