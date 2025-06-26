<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MentApi extends CI_Controller
{
  function __construct()
  {
      parent::__construct();
  }
  public function index()
  {
  }

  public function authentication(){
    $valid_passwords = array ("admin" => "admin");
    $valid_users = array_keys($valid_passwords);

    if (isset($_SERVER['PHP_AUTH_USER']))
      $user = $_SERVER['PHP_AUTH_USER'];
    if (isset($_SERVER['PHP_AUTH_PW']))
      $pass = $_SERVER['PHP_AUTH_PW'];
    $validated=false;
    if (isset($_SERVER['PHP_AUTH_USER'])&&isset($_SERVER['PHP_AUTH_PW']))
      $validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

    if (!$validated) {
      header('WWW-Authenticate: Basic realm="My Realm"');
      header('HTTP/1.0 401 Unauthorized');
      die ("Not authorized");
    }
    return $validated;
  }
  public function testapi(){
    $auth = $this->authentication();
    if ($auth){
        $date=$_POST["date"];
        $this->db->where('date',  $date);
        $query=$this->db->get("TestAPI");
        $result = $query->result();
        print_r(json_encode( $result));
    }
  }
  public function uploadadcloadcell()
  {
    $auth = $this->authentication();
    if ($auth){
        $filepath = $_FILES["file"]["tmp_name"];
        move_uploaded_file($filepath,"loadcell_adc.csv");
    }
  }

  // public function insertpso(){
  //     $receive_json = file_get_contents("php://input");
  //     $value=$receive_json;
  //     $obj = json_decode($value, true);
  //     $serial_number = $obj["serial_number"];
  //     $customer = $obj["customer"];
  //     $kind =$obj["kind"];
  //     $date =$obj["date"];
  //     $time =$obj["time"];
  //     $weight =$obj["weight"];
  //     $this->load->model("MPSO");
  //     $this->MPSO->Insert($serial_number,$customer,$kind,$date,$time,$weight);
  //     // $this->db->insert('pso', 
  //     //     array(
  // 		//   'serial_number' =>$serial_number,
  //     //       'customer' =>$customer,
  //     //       'kind' =>$kind,
  //     //       'date'=>$date,
  //     //       'time' =>$time,
  //     //       'weight' =>$weight 
  //     //   ));
        
  //     echo "Create successful ";
  // }
  public function checkwarehouse(){
    $receive_json = file_get_contents("php://input");
    $obj = json_decode($receive_json, true);
    $id = $obj["id"];
    $reasonId = $obj["reasonId"];
    
    $this->load->model("MWareHouse");
    $result = $this->MWareHouse->Read($id);
    $this->MWareHouse->Update($id, $reasonId );
    $result2 = $this->MWareHouse->ReadReason($reasonId);
    $detail = $this->MWareHouse->DetailWareHouse();
    $response = array(
      'result' => $result,
      'result2' => $result2,
      'detail' => $detail,
    );
    print_r(json_encode($response));
  }





  // public function inserttruck(){
  //   $receive_json = file_get_contents("php://input");
  //   $values = json_decode($receive_json, true);

  //   $this->load->model("MTruck");
  //   $i=1;
  //   $request = [];
  //   if (!empty($values)) {
  //     foreach ($values as $obj) {
  //       $so_phieu = $obj["so_phieu"];
  //       $xe_id = $obj["xe_id"];
  //       $customer_id = $obj["customer_id"];
  //       $product_id = $obj["product_id"];
  //       $weight_in = floatval($obj["weight_in"]);
  //       $time_in = $obj["time_in"];
  //       $weight_out = floatval($obj["weight_out"]);
  //       $time_out = $obj["time_out"];
  //       $note = $obj["note"];
  //       $sync = $obj["sync"];
  //       $date = $obj["date"];
  //       $dataToHash = $so_phieu . $xe_id . $customer_id . $product_id . $weight_in . $time_in . $weight_out . $time_out . $date . $note . $sync ;
  //       $hashedKey = sha1($dataToHash);
  //       $data = array(
  //         'so_phieu' => $so_phieu,
  //         'xe_id' => $xe_id,
  //         'customer_id' => $customer_id,
  //         'product_id' => $product_id,
  //         'weight_in' => $weight_in,
  //         'time_in' => $time_in,
  //         'weight_out' => $weight_out,
  //         'time_out' => $time_out,
  //         'note' => $note,
  //         'sync' => $sync,
  //         'hash_key' => $hashedKey,
  //         'date' => $date,
  //       );
  //       if($this->MTruck->CheckCode($hashedKey)){
  //         $i=-1;
  //       }
  //       else{
  //         $i=1;
  //         $this->MTruck->Insert($data);
  //       }
  //       $request[]=$obj["so_phieu"]*$i;
  //     }
  //   }
  //   print_r(json_encode($request, true));
  // }
  public function inserttruck(){
    $receive_json = file_get_contents("php://input");
    $json_obj = json_decode($receive_json, true);

    $values = $json_obj['result'];
    $table = $json_obj['table'][0];

    $this->load->model("MTruck");
    $request = [];
    if (!empty($values)) {
      foreach ($values as $obj) {
        $data = array();
        $dataToHash = '';
        foreach ($obj as $key => $value) {
          if (strtolower($key) != 'id' && strtolower($key) != 'sync' && strtolower($key) != 'hash_key') {
            $data[$key] = $value;
            $dataToHash .= $value;
          }
          else $id= $value;
        }
        $hashedKey = sha1($dataToHash);
        $data['hash_key'] = $hashedKey;
        if($this->MTruck->CheckCode($hashedKey,$table)){
          // $request[] = $obj['id']*-1;
          if (isset($obj['id'])) {
            $request[] = $obj['id'] * -1;
          } elseif (isset($obj['ID'])) {
              $request[] = $obj['ID'] * -1;
          }
        }
        else{
          $this->MTruck->Insert($data,$table);
          // $request[] = $obj['id']*1;
          if (isset($obj['id'])) {
            $request[] = $obj['id'] * 1;
          } elseif (isset($obj['ID'])) {
              $request[] = $obj['ID'] * 1;
          }
        }
      }
    }
    // Tạo đối tượng phản hồi
    $response = [
      'request' => $request,
      'table' => $table
    ];

    // Mã hóa đối tượng thành JSON và gửi phản hồi
    print_r(json_encode($response, true));
  }
  public function getTableList() {
    $this->load->database();
    $tables = $this->db->list_tables();
    echo json_encode($tables);
  }
  public function getTableColumns($tableName) {
    $this->load->database();
    $fields = $this->db->field_data($tableName);
    $field_names = array_map(function($field){
        return $field->name;
    }, $fields);
    echo json_encode($field_names);
  }
  public function RFIDTable() {
    // Kết nối với cơ sở dữ liệu
    $this->load->database();
    // Kiểm tra xem có dòng nào trong bảng RFIDStatus với sync_rfid = 1 hay không
    $this->db->where("sync_rfid", 1);
    $status_query = $this->db->get("RFIDStatus");

    // Nếu không tìm thấy dòng nào, trả về API rỗng
    if ($status_query->num_rows() == 0) {
        echo json_encode([]);
        return; // Kết thúc hàm
    }
    // Lấy toàn bộ dữ liệu từ bảng RFID
    $query = $this->db->get("RFID");
    
    // Kiểm tra dữ liệu có tồn tại không
    if ($query->num_rows() > 0) {
        // Trả về dữ liệu dưới dạng JSON
        echo json_encode($query->result_array());
    }
  }












    public function insertdisconnectpso(){
      $receive_json = file_get_contents("php://input");
      $value=$receive_json;
      $obj = json_decode($value, true);
      $this->load->model("MPSO");
      $data = array(
        'serial_number' => $obj["serial_number"],
        'date' =>$obj["date"],
        'time' =>$obj["time"]
    );
      $this->MPSO->InsertDisconnect($data);
      // $this->db->insert('pso', 
      //     array(
      //   'serial_number' =>$serial_number,
      //       'customer' =>$customer,
      //       'kind' =>$kind,
      //       'date'=>$date,
      //       'time' =>$time,
      //       'weight' =>$weight 
      //   ));
        
      echo "Create successful ";
  }
    public function psodetail($date,$serial_number){
      $this->load->model("MPSO");
      $result = $this->MPSO->Detail($date, $serial_number);
      print_r(json_encode($result));
    }
    public function psogeneral($start_date,$end_date,$serial_number){
      $this->load->model("MPSO");
      $result = $this->MPSO->General($start_date,$end_date, $serial_number);
      print_r(json_encode($result));
    }
    public function insertdevice(){
        $receive_json = file_get_contents("php://input");
        $value=$receive_json;
        $obj = json_decode($value, true);
        $serial_number = $obj["serial_number"];
        $position =$obj["position"];
        $date =$obj["date"];
        $export_info =$obj["export_info"];
        $sn_parent =$obj["sn_parent"];
        $this->load->model("MAPI");

        $this->db->where('serial_number',  $serial_number);
        $query=$this->db->get("ThietBi");
        $result = $query->result();
        if (sizeof($result)>0){

          echo "Device ".$serial_number." is already exist!";
        }
        else{
          $this->db->insert('ThietBi', 
            array(
              'serial_number' =>$serial_number,
              'position' =>$position,
              'date' =>$date,
              'export_info' =>$export_info,
              'sn_parent'=>$sn_parent 
          ));
          echo "Create successful";
        }
    }
    public function insertbaotri(){
        $receive_json = file_get_contents("php://input");
        $value=$receive_json;
        $obj = json_decode($value, true);
        $serial_number = $obj["serial_number"];
        $reason =$obj["reason"];
        $solution =$obj["solution"];
        $this->load->model("MAPI");
        $this->MAPI->BaoTri_Insert($serial_number,$reason,$solution);
        $data = array('serial_number' =>$serial_number,'reason'=>$reason,'solution'=>$solution);
        $this->pushnotify("MenT Automation","ThÃ´ng bÃ¡o báº£o trÃ¬ má»›i: ".$serial_number);
        echo json_encode($data);
    }
    public function updatebaotri(){
        $receive_json = file_get_contents("php://input");
        $value=$receive_json;
        $obj = json_decode($value, true);
        $id = $obj["id"];
        $reason =$obj["reason"];
        $solution =$obj["solution"];
        $this->load->model("MAPI");
        $this->MAPI->BaoTri_Update($id,$reason,$solution);
        $data = array('id' =>$id,'reason'=>$reason,'solution'=>$solution);
         $this->pushnotify("MenT Automation","ThÃ´ng bÃ¡o báº£o trÃ¬ má»›i");
        echo json_encode($data);
    }
    public function thietbi($serial_number)
    {
        $this->load->model("MAPI");
        $result = $this->MAPI->ThietBi_Read($serial_number);
        $json = json_encode($result);
        echo $json;
    }
    public function thietbicon($serial_number)
    {
        $this->load->model("MAPI");
        $result = $this->MAPI->ThietBiCon_Read($serial_number);
        $json = json_encode($result);
        echo $json;
    }
     public function baotri($serial_number)
    {
        $this->load->model("MAPI");
        $result = $this->MAPI->BaoTri_Read($serial_number);
        $json = json_encode($result);
        echo $json;
    }
     public function baotridetail($id)
    {
        $this->load->model("MAPI");
        $result = $this->MAPI->BaoTri_Read_Detail($id);
        $json = json_encode($result);
        echo $json;
    }
    public function pushnotify($title,$body){
        $data = array(
          'flutterAppId' => '943',
          'flutterAppToken' => 'eoLfJU0G8XKZEvHutZpQJF',
          'title' => $title,
          'body'=>$body
        );
    
          $post_data = json_encode($data);
            
          // Prepare new cURL resource
          $crl = curl_init('https://app.nativenotify.com/api/flutter/notification');
          curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($crl, CURLINFO_HEADER_OUT, true);
          curl_setopt($crl, CURLOPT_POST, true);
          curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
            
          // Set HTTP Header for POST request 
          curl_setopt($crl, CURLOPT_HTTPHEADER, array(
              'Content-Type: application/json')
          );
            
          // Submit the POST request
          $result = curl_exec($crl);
    }


    public function saveloadcelladc()
    {
      $json = file_get_contents("php://input");
      $obj = json_decode($json, true);

      $data = array(
        'loadcell_code' => $obj["loadcell_code"],
        'adc_value' => $obj["adc_value"],
        'times' => $obj["times"],
        'date_time' =>$obj["date_time"]
      );
      if ($obj["action"]=="insert"){
        $this->db->where('loadcell_code',  $obj["loadcell_code"]);
        $this->db->where('times',  $obj["times"]);
        $query=$this->db->get("Loadcell");
        $result = $query->result();
        
        if (sizeof($result)>0){
          $this->db->where('loadcell_code',  $obj["loadcell_code"]);
          $this->db->where('times',  $obj["times"]);
          $this->db->update('Loadcell', $data);
        }else{
          $this->db->insert('Loadcell', $data);

          $this->db->where('serial_number',  $obj["loadcell_code"]);
          $query=$this->db->get("ThietBi");
          $result = $query->result();
          if (sizeof($result)==0){
            $this->db->insert('ThietBi', array('serial_number' =>$obj["loadcell_code"] ));
          }
        }

      }else{

          $this->db->where('loadcell_code',  $obj["loadcell_code"]);
          $this->db->where('times',  $obj["times"]);
          $this->db->update('Loadcell', $data);
      }
    }
}
