<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MThreshold extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->table = "Threshold";
    }
    public function Read($lo_id){
        $proc="EXEC [dbo].[Threshold_Read] @lo_id = '" . $lo_id."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function Fillet_Threshold_Read($date, $lo_id){
        $proc="EXEC [dbo].[Fillet_Threshold_Read] @date = '".$date. "', @lo_id = '" . $lo_id."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function SuaCa_Threshold_Read($date, $lo_id, $weight_in){
        $proc="EXEC [dbo].[SuaCa_Threshold_Read] @date = '".$date. "', @lo_id = '" . $lo_id. "', @weight_in = '" . $weight_in."'";
        $query=$this->db->query($proc);
        return $query->result();
    }
    public function Update($data){
        $this->db->where('lo_id',$data['lo_id']);
        $this->db->where('product_id',$data['product_id']);
      //  $this->db->where('date',$data['date']);
        $this->db->update($this->table, $data);
    }
    public function Insert($data){
        if ($data['lo_id']!="")
            $this->db->insert($this->table, $data);
    }
    public function Exist($data){
        $this->db->where('lo_id',$data['lo_id']);
        $this->db->where('product_id',$data['product_id']);
       // $this->db->where('date',$data['date']);
        $query = $this->db->get($this->table);
        if($query->num_rows()>0) return true;
        else return false;
    }
    public function AutoUpdate_Fillet_Threshold($start_date, $end_date, $lo_id){
        $i=0;
        $do = true;
        while ( $do ) {
            $date = date('Y-m-d', strtotime($start_date .' +'.$i.' day'));
            $result = $this->Fillet_Threshold_Read($date, $lo_id);
            foreach ($result as $rs) {
                $data = array('lo_id'=>$rs->lo_id,'product_id'=>$rs->product_id,'date'=>$date,'threshold'=>$rs->dinh_muc);
                if (!$this->Exist($data)){
                    $this->Insert($data);
                }
            }
            if($date==$end_date) $do = false;
            $i++;
        }
    }
    public function AutoUpdate_SuaCa_Threshold($start_date, $end_date,$weight_in){
        $i=0;
        $do = true;
        while ( $do ) {
            $date = date('Y-m-d', strtotime($start_date .' +'.$i.' day'));
            $result = $this->SuaCa_Threshold_Read($date, '',$weight_in);
            foreach ($result as $rs) {
                $data = array('lo_id'=>$rs->lo_id,
                    'product_id'=>$rs->product_id,
                    'date'=>$date,
                    'threshold'=>round($rs->dinh_muc,3));
                if (!$this->Exist($data)){
                    $this->Insert($data);
                }
            }
            if($date==$end_date) $do = false;
            $i++;
        }
    }
}
?>