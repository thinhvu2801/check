<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MWareHouse extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->infor_table = "WareHouse_Infor";
        $this->out_table = "WareHouse_Out";
        $this->reason_out_table = "WareHouse_ReasonOut";
    }
    public function Infor_Read()
    {
        $proc = "EXEC [dbo].[Warehouse_Infor_Stat]";
        $query = $this->db->query($proc);
        return $query->result();
    }
    public function Inventory_Stat($date, $warehouse_id)
    {
        $proc = "EXEC [dbo].[Warehouse_Inventory_Stat] @date = '$date',@warehouse_id = '$warehouse_id'";
        $query = $this->db->query($proc);
        return $query->result();
    }
    public function InHistory($start_date,$end_date, $warehouse_id)
    {
        $proc = "EXEC [dbo].[Warehouse_InHistory] @start_date = '$start_date',@end_date = '$end_date',@warehouse_id = '$warehouse_id'";
        $query = $this->db->query($proc);
        return $query->result();
    }
    public function OutHistory($start_date,$end_date, $warehouse_id)
    {
        $proc = "EXEC [dbo].[Warehouse_OutHistory] @start_date = '$start_date',@end_date = '$end_date',@warehouse_id = '$warehouse_id'";
        $query = $this->db->query($proc);
        return $query->result();
    }
    public function CheckCode($warehouse_id){
		$this->db->where('warehouse_id',$warehouse_id);
		$query = $this->db->get($this->infor_table);
		if($query->num_rows()>0) return true;
		else return false;
	}
    public function Out_Stat($reason_id){
        $proc="EXEC [dbo].[WareHouse_Out_Stat] @reason_id = '$reason_id'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function Infor_Insert($data)
    {
        $this->db->insert($this->infor_table, $data);
    }
    public function Delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->infor_table);
	}

    public function Out_Insert($reason_id, $warehouse_id, $quantity,$note)
    {
        $proc = "EXEC [dbo].[Warehouse_Out_Proc] @reason_id = '$reason_id',@warehouse_id = '$warehouse_id',@quantity = '$quantity',@note = '$note'";
        $query = $this->db->query($proc);
        return $query->result();
    }
    public function In_Insert($reason_id, $warehouse_id, $quantity, $weight, $note)
    {
        $proc = "EXEC [dbo].[Warehouse_In_Proc] @reason_id = '$reason_id',@warehouse_id = '$warehouse_id',@quantity = '$quantity',@weight = '$weight',@note = '$note',@return_value = '0'";
        $query = $this->db->query($proc);
        return $query->result();
    }
    public function Out_Delete($reason_id,$warehouse_id){
		$this->db->where('reason_id', $reason_id);
        $this->db->where('warehouse_id', $warehouse_id);
		$this->db->delete($this->out_table);
	}


    public function ReasonOutRead(){
		$query=$this->db->get($this->reason_out_table);
    	return $query->result();
	}
    public function CheckReasonOutCode($reason_id){
		$this->db->where('reason_id',$reason_id);
		$query = $this->db->get($this->reason_out_table);
		if($query->num_rows()>0) return true;
		else return false;
	}
    public function Reason_Insert($data)
    {
        $this->db->insert($this->reason_out_table, $data);
    }
}
