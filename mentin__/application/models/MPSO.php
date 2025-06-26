<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MPSO extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
   
    public function Insert($serial_number, $customer, $kind, $date, $time, $weight)
    {
        $proc = "EXEC [dbo].[PSO_Insert]
                @serial_number = '$serial_number'
                ,@customer = '$customer'
                ,@kind = '$kind'
                ,@date = '$date'
                ,@time = '$time'
                ,@weight = '$weight'
                ";
        $query = $this->db->query($proc);
       // return $query->result_array();
    }
    public function InsertDisconnect($data)
    {
        $this->db->insert("mentauto.PSO_Disconnect", $data);
    }
    public function Detail($date, $serial_number)
    {
        $proc = "EXEC [mentauto].[PSO_Stat_Detail]
                @serial_number = '$serial_number'
                ,@date = '$date'
                ";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function General($start_date, $end_date, $serial_number)
    {
        $proc = "EXEC [dbo].[PSO_Stat_General]
                @serial_number = '$serial_number'
                ,@start_date = '$start_date'
                ,@end_date = '$end_date'
                ";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
}