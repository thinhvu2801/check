<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MCheckWeigher extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    public function Statistic($machine_db,$serial_number, $start_date,$end_date){
        $proc="EXEC [dbo].[Grader_Stat_General]  @serial_number = '$serial_number', @start_date = '$start_date', @end_date = '$end_date'";
        $query=$machine_db->query($proc);
        return $query->result_array();
    }
}
?>