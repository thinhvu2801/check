<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MWeightGain extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
   
    public function Detail($start_date, $end_date, $start_time, $end_time, $lo_id='',$coi_id='')
    {
        $proc = "EXEC [dbo].[WeightGain_Stat_Detail]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@coi_id = '$coi_id'
                ,@lo_id = '$lo_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function General($start_date, $end_date, $start_time, $end_time, $lo_id='',$coi_id='')
    {
        $proc = "EXEC [dbo].[WeightGain_Stat_General]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@coi_id = '$coi_id'
                ,@lo_id = '$lo_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
   
}