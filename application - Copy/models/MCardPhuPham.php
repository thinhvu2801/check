<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MCardPhuPham extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->otherdb = $this->load->database('canphupham', TRUE);
	}
	public function Create($card_id, $object_id,$object_type){
		if ($object_id=="")
			echo '<p style="color:red">Chưa chọn đối tượng!</p>';
		elseif ($this->validCard($card_id,5)){
			$card = $this->Card_Read_By_Id($card_id);
			if (empty($card)){
				$this->otherdb->insert('RFID',array('card_id' => $card_id, 'object_id'=>$object_id,'object_type'=>$object_type));
				echo '<p style="color:blue">Liên kết thẻ '.$card_id.' thành công!';
			}else
			echo '<p style="color:red">Thẻ đã tồn tại!</p>';
		}else
			echo '<p style="color:red">Thẻ không hợp lệ!</p>';
	}
	public function Create_Card_CNSP($card_id, $worker_id,$product_id){
		if ($this->validCard($card_id,5)){
			$card = $this->Card_CNSP_Read_By_Id($card_id);
			if (empty($card)){
				$this->otherdb->insert('RFID_CNSP',array('card_id' => $card_id, 'worker_id'=>$worker_id,'product_id'=>$product_id));
				echo '<p style="color:blue">Liên kết thẻ '.$card_id.': '.$worker_id.'->'.$product_id.' thành công!';
			}else
			echo '<p style="color:red">Thẻ đã tồn tại RFID_CNSP!</p>';
		}else
			echo '<p style="color:red">Thẻ không hợp lệ RFID_CNSP!</p>';
	}
	public function Card_Read_By_Id($card_id){
		$this->otherdb->where('card_id', $card_id);
		$query = $this->otherdb->get('RFID');
		$result = $query->row();
		return $result;
	}
	public function Card_CNSP_Read_By_Id($card_id){
		$this->otherdb->where('card_id', $card_id);
		$query = $this->otherdb->get('RFID_CNSP');
		$result = $query->row();
		return $result;
	}
	public function Card_Read_By_Object_Type($object_type){
		/*5: group_id
		2: worker_id
		1: product_id
		3: basket_id
		4: lot_id*/
		$this->otherdb->where('object_type', $object_type);
		$query = $this->otherdb->get('RFID');
		$result = $query->result();
		return $result;
	}
	public function Card_Read_By_Object($object_id, $object_type){
		$proc="EXEC [dbo].[CARD_READ] @object_id = '".$object_id."', @object_type='".$object_type."'";
        $query=$this->otherdb->query($proc);
		return $query->result();
	}
	public function Delete($card_id){
		$this->otherdb->where('card_id', $card_id);
		$this->otherdb->delete('RFID');
	}
	public function Delete_CNSP($card_id){
		$this->otherdb->where('card_id', $card_id);
		$this->otherdb->delete('RFID_CNSP');
	}
	public function CardInfo($card_id){
        $proc="EXEC [dbo].[RFID_INFO] @card_id = '".$card_id."'";
        $query=$this->otherdb->query($proc);
        return $query->row();
    }
	public function Update_RFID_Status(){
		$this->otherdb->where('id',1);
      	$this->otherdb->update('RFIDStatus', array('sync_rfid' =>0,'thong_tin'=>""));
	}
	public function Get_RFID_Status($id){
		$query = $this->otherdb->get('RFIDStatus');
		return $query->row();
	}
	public function updateObjectID($old_object_id, $new_object_id, $object_type){
		$this->otherdb->where('object_id', $old_object_id);
		$this->otherdb->where('object_type', $object_type);
		$this->otherdb->update('RFID', array('object_id'=>$new_object_id));
	}
	public function validCard($cardid, $number){
		$sum = 0;
		$length = strlen($cardid) - 1;
		for ($i=0; $i < $number; $i++) { 
			$sum+=$cardid[$length-$i];
		}
		if($sum%10==5){
			//return true;
		}
		//return false;
		return true;
	}
}
?>