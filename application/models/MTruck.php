<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MTruck extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table = "Godaco_Truck_Scale_Station";
        $this->table_extra = 'Godaco_Extra_Weight';
    }
    public function Detail($start_date, $end_date, $start_time, $end_time, $customer_id='')
    {
        $proc = "EXEC [dbo].[Godaco_Truck_Scale_Detail]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'
                ,@customer_id = '$customer_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Detail2($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Godaco_Truck_Scale_Detail2]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function General($date, $customer_id='')
    {
        $proc = "EXEC [dbo].[Godaco_Truck_Scale_Detail_Total]
                @date = '$date'
                ,@customer_id = '$customer_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function DetailHistory($start_date, $end_date, $start_time, $end_time)
    {
        $proc = "EXEC [dbo].[Godaco_Truck_Scale_Detail_History]
                @start_date = '$start_date'
                ,@end_date = '$end_date'
                ,@start_time = '$start_time'
                ,@end_time = '$end_time'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function ReadAll($table)
	{
		$proc = "SELECT * FROM ".$table."";
		$query = $this->db->query($proc);
		return $query->result_array();
	}
    public function WeightOut($date, $customer_id='')
    {
        $proc = "EXEC [dbo].[Godaco_Truck_Scale_Weight_Out]
                @date = '$date'
                ,@customer_id = '$customer_id'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Customer($date)
    {
        $proc = "EXEC [dbo].[Godaco_Truck_Scale_Customer]
                @date = '$date'";
        $query = $this->db->query($proc);
        return $query->result_array();
    }
    public function Read($so_phieu){
		$this->db->where('so_phieu',$so_phieu);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	public function Update($data,$so_phieu){
		$this->db->where('so_phieu', $so_phieu);
      	$this->db->update($this->table, $data);
	}
    public function UpdateExtraWeight($data,$customer_id,$date){
        $check = $this->db->get_where($this->table_extra, array('customer_id' => $customer_id, 'date' => $date))->row();

        if ($check) {
            $this->db->where(array('customer_id' => $customer_id, 'date' => $date));
            $this->db->update($this->table_extra, $data);
        } else {
            $this->db->insert($this->table_extra, $data);
        }
	}
    public function ReadExtraWeight($customer_id,$date){
		$this->db->where(array('customer_id' => $customer_id, 'date' => $date));
		$query = $this->db->get($this->table_extra);
		return $query->result_array();
	}
    // public function Insert($so_phieu, $xe_id, $customer_id, $product_id, $weight_in, $time_in, $weight_out, $time_out, $note, $sync, $hash_key, $date)
    // {
    //     $proc = "EXEC [dbo].[Godaco_Truck_Scale_Insert]
    //             @so_phieu = '$so_phieu'
    //             ,@xe_id = '$xe_id'
    //             ,@customer_id = '$customer_id'
    //             ,@product_id = '$product_id'
    //             ,@weight_in = '$weight_in'
    //             ,@time_in = '$time_in'
    //             ,@weight_out = '$weight_out'
    //             ,@time_out = '$time_out'
    //             ,@note = '$note'
    //             ,@sync = '$sync'
    //             ,@hash_key = '$hash_key'
    //             ,@date = '$date'
    //             ";
    //     $query = $this->db->query($proc);
    // }
    
	public function Insert($data,$table){
		$this->db->insert($table, $data);
	}
    
	public function CheckCode($hash_key,$table){
		$this->db->where('hash_key',$hash_key);
		$query = $this->db->get($table);
		if($query->num_rows()>0) return true;
		else return false;
	}
}