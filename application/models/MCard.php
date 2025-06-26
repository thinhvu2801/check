<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MCard extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table = "RFID_check";
	}
	public function Check($card_id){
		$this->db->select('object_id');
        $this->db->from('RFID');
        $this->db->where('card_id', $card_id);
        $query = $this->db->get(); 
        return $query->result();
	}
	public function Create($card_id, $object_id, $object_type)
	{
		$error_code = 0;
		if ($object_id == "")
			$error_code = 1;
		elseif ($this->validCard($card_id, 5, $object_type)) {
			if ($object_type == 3) {
				$card_3 = $this->Card_Read_By_Object($object_id, $object_type);
				if (sizeof($card_3) >= 1)
					$error_code = 2;
			} else {
				$card = $this->Card_Read_By_Id($card_id);
				if (empty($card)) {
				} else {
					$error_code = 3;
				}
			}
		} else
			echo '<p style="color:red">Thẻ không hợp lệ!</p>';
		switch ($error_code) {
			case 0:
				$this->db->insert('RFID', array(
					'card_id' => $card_id,
					'object_id' => $object_id,
					'object_type' => $object_type,
					// 'action' => 0
				));
				
				echo '<p style="color:blue">Liên kết thẻ thành công!';
				break;
			case 1:
				echo '<p style="color:red">Chưa chọn đối tượng!</p>';
				break;
			case 2:
				echo '<p style="color:red">Một mã rổ chỉ được tạo 1 thẻ từ</p>';
				break;
			case 3:
				echo '<p style="color:red">Thẻ đã tồn tại!</p>';
				break;
		}
	}
	public function Create_Kho($card_id, $object_id, $object_type)
	{
		$error_code = 0;
		if ($object_id == "")
			$error_code = 1;
		elseif ($this->validCard($card_id, 5, $object_type)) {
			if ($object_type == 3) {
				$card_3 = $this->Card_Read_By_Object($object_id, $object_type);
				if (sizeof($card_3) >= 1)
					$error_code = 2;
			} else {
				$card = $this->Card_Read_By_Id($card_id);
				if (empty($card)) {
				} else {
					$error_code = 3;
				}
			}
		} else
			echo '<p style="color:red">Thẻ không hợp lệ!</p>';
		switch ($error_code) {
			case 0:
				$this->db->insert('RFID_Kho', array(
					'card_id' => $card_id,
					'object_id' => $object_id,
					'object_type' => $object_type
				));
				$proc = "EXEC [dbo].[RFID_INSERT_CARD] @card_id = '$card_id' ,@object_id = '$object_id' ,@object_type = '$object_type'";
        		$this->db->query($proc);
				echo '<p style="color:blue">Liên kết thẻ thành công!';
				break;
			case 1:
				echo '<p style="color:red">Chưa chọn đối tượng!</p>';
				break;
			case 2:
				echo '<p style="color:red">Một mã rổ chỉ được tạo 1 thẻ từ</p>';
				break;
			case 3:
				echo '<p style="color:red">Thẻ đã tồn tại!</p>';
				break;
		}
	}
	public function Create_Card_CNSP($card_id, $worker_id, $product_id)
	{
		if ($this->validCard($card_id, 5)) {
			$card = $this->Card_CNSP_Read_By_Id($card_id);
			if (empty($card)) {
				$this->db->insert('RFID_CNSP', array('card_id' => $card_id, 'worker_id' => $worker_id, 'product_id' => $product_id));
				echo '<p style="color:blue">Liên kết thẻ ' . $card_id . ': ' . $worker_id . '->' . $product_id . ' thành công!';
			} else
				echo '<p style="color:red">Thẻ đã tồn tại RFID_CNSP!</p>';
		} else
			echo '<p style="color:red">Thẻ không hợp lệ RFID_CNSP!</p>';
	}


	public function Card_Read_By_Id($card_id)
	{
		$this->db->where('card_id', $card_id);
		$this->db->where('action', 0);
		$query = $this->db->get('RFID');
		$result = $query->row();
		return $result;
	}

	public function Card_CNSP_Read_By_Id($card_id)
	{
		$this->db->where('card_id', $card_id);
		//$this->db->where('action', 0);
		$query = $this->db->get('RFID_CNSP');
		$result = $query->row();
		return $result;
	}
	public function Card_Read_By_Object_Type($object_type)
	{
		/*5: group_id
		2: worker_id
		1: product_id
		3: basket_id
		4: lot_id*/
		$this->db->where('object_type', $object_type);
		$query = $this->db->get('RFID');
		$result = $query->result();
		return $result;
	}

	public function Card_Read_By_Object($object_id, $object_type)
	{
		//$proc = "EXEC [dbo].[CARD_READ] @object_id = '" . $object_id . "', @object_type='" . $object_type . "'";
		$proc = "SELECT RFID.card_id, object_id, A.product_id, A.product_name
		FROM (SELECT * FROM RFID where object_id='$object_id' and object_type='$object_type' and action<>2) RFID 
		left join (
		  SELECT Product.PRODUCT_ID, Product.PRODUCT_NAME, RFID_CNSP.card_id
		  FROM RFID_CNSP
		  JOIN Product ON Product.PRODUCT_ID=RFID_CNSP.PRODUCT_ID
		) A
		on RFID.card_id = A.card_id";
		$query = $this->db->query($proc);
		return $query->result();
	}
	public function Card_Read_By_Object_Kho($object_id, $object_type)
	{
		//$proc = "EXEC [dbo].[CARD_READ] @object_id = '" . $object_id . "', @object_type='" . $object_type . "'";
		$proc = "SELECT RFID.card_id, object_id, A.product_id, A.product_name
		FROM (SELECT * FROM RFID_Kho where object_id='$object_id' and object_type='$object_type') RFID 
		left join (
		  SELECT Product.PRODUCT_ID, Product.PRODUCT_NAME, RFID_CNSP.card_id
		  FROM RFID_CNSP
		  JOIN Product ON Product.PRODUCT_ID=RFID_CNSP.PRODUCT_ID
		) A
		on RFID.card_id = A.card_id";
		$query = $this->db->query($proc);
		return $query->result();
	}


	public function Delete($card_id)
	{
		$this->db->where('card_id', $card_id);
		$this->db->delete('RFID');
		// $this->db->where('card_id', $card_id);
		// $this->db->update('RFID', array('action' => 2));
	}
	public function Delete_Kho($card_id)
	{
		$this->db->where('card_id',$card_id);
		$this->db->delete('RFID_Kho');
		// $this->db->where('card_id', $card_id);
		// $this->db->update('RFID', array('action' => 2));
	}


	public function Delete_CNSP($card_id)
	{
		$this->db->where('card_id', $card_id);
		$this->db->delete('RFID_CNSP');
	}


	public function CardInfo($card_id)
	{
		$proc = "EXEC [dbo].[RFID_INFO] @card_id = '" . $card_id . "'";
		$query = $this->db->query($proc);
		return $query->row();
	}
	public function Insert($data){
		$this->db->insert($this->table, $data);
	}
	public function Read(){
		$this->db->select('COUNT(card_id) as total_count');
		$query = $this->db->get($this->table);
		$result = $query->row();
		return $result->total_count;
	}

	public function CardInfo_Kho($card_id)
	{
		$proc = "EXEC [dbo].[RFID_Kho_The] @card_id = '" . $card_id . "'";
		$query = $this->db->query($proc);
		return $query->row();
	}


	public function Update_RFID_Status()
	{
		//kiểm tra trên bản của server là trạng thái đồng bộ rfid đang là 1(có) hay 0(không)
		$this->db->where('id', 1);
		$this->db->update('RFIDStatus', array('sync_rfid' => 1, 'thong_tin' => ""));
		// $phile_db = $this->load->database('phile', TRUE);
		// $suaca1_db = $this->load->database('suaca_1', TRUE);
		// $suaca2_db = $this->load->database('suaca_2', TRUE);
		// $nhapkho_db = $this->load->database('nhapkho', TRUE);

		// $phile_db->where('id', 1);
		// $phile_db->update('RFIDStatus', array('sync_rfid' => 1, 'thong_tin' => ""));

		// $suaca1_db->where('id', 1);
		// $suaca1_db->update('RFIDStatus', array('sync_rfid' => 1, 'thong_tin' => ""));

		// $suaca2_db->where('id', 1);
		// $suaca2_db->update('RFIDStatus', array('sync_rfid' => 1, 'thong_tin' => ""));
		
		// $nhapkho_db->where('id', 1);
		// $nhapkho_db->update('RFIDStatus', array('sync_rfid' => 1, 'thong_tin' => ""));
		//$this->db->where('id', 1);
		//$this->db->update('RFIDStatus', array('sync_rfid' => 0, 'thong_tin' => ""));
	}


	public function Get_RFID_Status($id)
	{
		$this->db->where('date', date('Y-m-d'));
		$this->db->order_by('time', 'desc');
		$query = $this->db->get('RFID_Client_Update');
		return $query->result();
	}


	public function updateObjectID($old_object_id, $new_object_id, $object_type)
	{
		$this->db->where('object_id', $old_object_id);
		$this->db->where('object_type', $object_type);
		$this->db->update('RFID', array('object_id' => $new_object_id));
	}

	public function validCard($cardid, $number, $object_type = 99)
	{
		/*if ($object_type != 3)
			return true;
		else{
			$sum = 0;
			$length = strlen($cardid) - 1;
			for ($i=0; $i < $number; $i++) { 
				$sum+=$cardid[$length-$i];
			}
			if($sum%10==8){
				return true;
			}
			return false;
		}*/

		return true;
	}
}
