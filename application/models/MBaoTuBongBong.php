<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MBaoTuBongBong extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = "BaoTuBongBong";
        $this->tableed = "BaoTuBongBong_Edit";
    }
    
    public function Detail($start_date, $end_date, $start_time, $end_time, $worker_id='', $product_id='')
    {
        $proc = "EXEC [dbo].[BaoTuBongBong_Detail]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@worker_id = '$worker_id'
                ,@product_id = '$product_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
	public function CheckCode($id){
		$this->db->where('id',$id);
		$query = $this->db->get($this->tableed);
		if($query->num_rows()>0) return true;
		else return false;
	}
    public function CheckID($id)
    {
        $proc = "EXEC [dbo].[BaoTuBongBong_Stat_Detail_Edit] @id = '$id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Read()
    {
        $proc = "SELECT 
        C1.date,C1.time, C1.worker_id as factory_id, W.factory_id as worker_id, W.worker_name, 
        P.product_name, ROUND(C1.weight, 2, 1) as weight,C1.note,C1.id
        FROM (
            SELECT worker_id, product_id, weight,time,date,note,id
              FROM BaoTuBongBong_Edit
            ) C1
        LEFT JOIN Product P ON P.product_id = C1.product_id
        LEFT JOIN Worker W ON W.worker_id = C1.worker_id
        
        ORDER BY W.worker_id, P.product_id,C1.time";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Product($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[BaoTuBongBong_Product]  @start_date = '" . $start_date. "', @end_date = '" . $end_date . "', @start_time = '" .
            $start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }

    public function Worker($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[BaoTuBongBong_Worker] @start_date = '" . $start_date. "', @end_date = '" . $end_date. "', @start_time = '" .$start_time . "', @end_time = '" . $end_time . "'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }

	public function Update($data,$id){
		$this->db->where('id', $id);
      	$this->db->update($this->table, $data);
	}
	public function Insert($data){
		$this->db->insert("BaoTuBongBong_Edit", $data);
	}
    public function DauXuong($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[DauXuong_Detail]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function PSCGeneral($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[DauXuong_General]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
}