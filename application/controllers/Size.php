<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Size extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "size";
        $this->object_type = 9;
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View()
    {
        $this->load->model('MSize');
        $mes="";
        if (isset($_POST["size_id"])) {
            if ($this->MSize->CheckCode($_POST["size_id"]))
                $mes="Mã size đã tồn tại!";
            else {
                $data = array(
                    'size_id' => $_POST["size_id"],
                    'size_name' => $_POST["size_name"],
                    'order_by' => $_POST["order_by"]
                );
                $this->MSize->Insert($data);
             //   redirect(base_url() . "size");
            }
        }
        // } else {
        //     redirect(base_url() . $this->object);
        // }

        $data = array(
            'action' => 'size',
            'template' => 'size/index',
            'data' => array(
                'size' => $this->MSize->Read(),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Update()
    {
        if (isset($_POST["new_size_id"])) {
            $this->load->model('MSize');
            $this->load->model('MCard');
            if ($_POST["new_size_id"] != $_POST["old_size_id"]) {
                if ($this->MSize->CheckCode($_POST["new_size_id"]))
                    $this->View("Mã size đã tồn tại!");
                else {
                    $data = array(
                        'size_id' => $_POST["new_size_id"],
                        'size_name' => $_POST["size_name"],
                        'order_by' => $_POST["order_by"]
                    );
                    $this->MSize->Update($data, $_POST["old_size_id"]);
                    $this->MCard->updateObjectID($_POST["old_size_id"], $_POST["new_size_id"], $this->object_type);
                }
            } else {
                $data = array(
                    'size_name' => $_POST["size_name"],
                    'order_by' => $_POST["order_by"]
                );
                $this->MSize->Update($data, $_POST["old_size_id"]);
                $this->MCard->updateObjectID($_POST["old_size_id"], $_POST["new_size_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Import()
    {
        $pcode = "";
        $mes = "Không thể import!";
        if (isset($_POST['import'])) {
            if ($_FILES["file_xls"]["size"] > 0) {
                $this->load->library('myexcel');
                $this->load->model('MSize');
                $myexcel = new MyExcel();
                $fname = $myexcel->ToCSV($_FILES["file_xls"], 'upload');
                $file = fopen($fname, "r");

                $emapData = fgetcsv($file, 0, ",");
                if ($emapData != array('size_id', 'size_name','note'))
                    $this->View("Cấu trúc file dữ liệu không đúng!");
                else {
                    while (($emapData = fgetcsv($file, 0, ",")) !== FALSE) {
                        $data = array(
                            'size_id' => $emapData[0],
                            'size_name' => $emapData[1],
'note' => $emapData[2]
                        );
                        $status = "DONE";
                        if ($this->MSize->CheckCode($emapData[0])) {
                            $status = "P_ERROR";
                            if (isset($_POST['thaythe'])) {
                                $this->db->where('size_id', $emapData[0]);
                                $this->db->update('size', $data);
                                $mes = "Đã được thay thế bằng dữ liệu mới!";
                            }
                        }
                        if ($status == "DONE") $this->MSize->Insert($data);
                        else $pcode = $pcode . $emapData[0] . " ";
                    }
                    fclose($file);
                    unset($fname);
                    if ($pcode != "")
                        $this->View("Các mã quy cách: " . $pcode . "Đã có trong hệ thống! " . $mes);
                    else $this->View();
                }
            } else {
                echo "E1";
            }
        } else {
            echo "E2";
        }
    }
    public function Delete($lid)
    {
        if (!$this->session->userdata("username")) redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MSize');
        $this->MSize->Delete($lid);
        redirect(base_url() . "size");
    }
    public function card($size_id = "")
    {
        $this->load->model('MSize');
        $size = $this->MSize->Read();
        $data = array(
            'action' => 'size_card',
            'template' => 'size/card',
            'data' => array(
                'size' => $size,
                'size_id' => $size_id
            )
        );
        $this->load->view('home', $data);
    }
    public function card_delete()
    {
        if (isset($_POST["card_id"])) {
            $this->load->model('MCard');
            $this->MCard->Delete($_POST["card_id"]);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function card_read()
    {
        if (isset($_POST["object_id"])) {
            $object_id = $_POST["object_id"];
            $this->load->model('MCard');
            $card_list = $this->MCard->Card_Read_By_Object($object_id, $this->object_type);
            $data = array('card_list' => $card_list);
            $this->view->base_url = base_url();
            $this->view->parse('size/card_read', $data);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function card_create()
    {
        if (isset($_POST["card_id"])) {
            $card_id = $_POST["card_id"];
            $object_id = $_POST["object_id"];
            $this->load->model('MCard');
            $this->MCard->Create($card_id, $object_id, $this->object_type);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function dongbo(){
        if(!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model("MSize");
        $table_name = 'Size';
        $sel=$this->MSize->Read();
        //$this->load->database();
        $fields = $this->db->list_fields($table_name);
        $p="";
        for ($i=0; $i < Count($fields); $i++) { 
            $p.=$fields[$i];
            if($i<Count($fields)-1){
                $p.=',';
            }
        }
        $insert="";
        foreach($sel as $sel1){
            $temp = "";
            foreach ($sel1 as $key => $value) {
                $temp .= 'N'.'\''.$value . '\''.',';
            }
            $temp=substr($temp,0,strlen($temp)-1);
            $insert .= "INSERT INTO $table_name ($p) VALUES ($temp); ";
        }
        $this->MSize->Update_Kho($insert,$table_name);
        return $this->View();
    }
}
