<?php
defined('BASEPATH') or exit('No direct script access allowed');
class QuyCach extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "quycach";
        $this->object_type = 30;
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
    }
    public function index()
    {
       // if (!$this->session->userdata("username"))  redirect('user/login');
        //echo base64_encode('{"expired":"2020-09-06","message":"Hệ thống cân thống kê hết hạn sử dụng từ ngày 06/09/2020.!"}');
        /*$MAC = exec('getmac');
        // $MAC = strtok($MAC, ' ');
        // $this->load->library('zip');
        // $this->zip->read_file('G:/HASACO2_STATISTIC_SCALE_MENT.bak', true);
        // $this->zip->download('HASACO.zip');*/
        $this->View();
    }
    public function View($mes = "")
    {
       // if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MQuyCach');
       // $this->load->model('MGeneral');
        //$pathToSave = realpath("")."\\MenTPS.bak";
       // $this->MGeneral->Backup($pathToSave);
        $data = array(
            'action' => 'quycach',
            'template' => 'quycach/index',
            'data' => array(
                'quycach' => $this->MQuyCach->Read(),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["quycach_id"])) {
            $this->load->model('MQuyCach');
            if ($this->MQuyCach->CheckCode($_POST["quycach_id"]))
                $this->View("Mã quy cách đã tồn tại!");
            else {
                $data = array(
                    'quycach_id' => $_POST["quycach_id"],
                    'quycach_name' => $_POST["quycach_name"],
                    'netweight' => $_POST["netweight"],
                    'note' => $_POST["note"]
                );
                $this->MQuyCach->Insert($data);
                redirect(base_url()  . $this->object);
            }
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
                $this->load->model('MQuyCach');
                $myexcel = new MyExcel();
                $fname = $myexcel->ToCSV($_FILES["file_xls"], 'upload');
                $file = fopen($fname, "r");

                $emapData = fgetcsv($file, 0, ",");
                if ($emapData != array('quycach_id', 'quycach_name','netweight', 'note'))
                    $this->View("Cấu trúc file dữ liệu không đúng!");
                else {
                    while (($emapData = fgetcsv($file, 0, ",")) !== FALSE) {
                        $data = array(
                            'quycach_id' => $emapData[0],
                            'quycach_name' => $emapData[1],
                            'netweight' => $emapData[2],
                            'note' => $emapData[3]
                        );
                        $status = "DONE";
                        if ($this->MQuyCach->CheckCode($emapData[0])) {
                            $status = "P_ERROR";
                            if (isset($_POST['thaythe'])) {
                                $this->db->where('quycach_id', $emapData[0]);
                                $this->db->update('quycach', $data);
                                $mes = "Đã được thay thế bằng dữ liệu mới!";
                            }
                        }
                        if ($status == "DONE") $this->MQuyCach->Insert($data);
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
    public function Update()
    {
        if (isset($_POST["new_quycach_id"])) {
            $this->load->model('MQuyCach');
            $this->load->model('MCard');
            if ($_POST["new_quycach_id"] != $_POST["old_quycach_id"]) {
                if ($this->MQuyCach->CheckCode($_POST["new_quycach_id"]))
                    $this->View("Mã quy cách đã tồn tại!");
                else {
                    $data = array(
                        'quycach_id' => $_POST["new_quycach_id"],
                        'quycach_name' => $_POST["quycach_name"],
                        'netweight' => $_POST["netweight"],
                        'note' => $_POST["note"]
                    );
                    $this->MQuyCach->Update($data, $_POST["old_quycach_id"]);
                    $this->MCard->updateObjectID($_POST["old_quycach_id"], $_POST["new_quycach_id"], $this->object_type);
                }
            } else {
                $data = array(
                'quycach_name' => $_POST["quycach_name"],
                'note' => $_POST["note"],
                'netweight' => $_POST["netweight"]);
                $this->MQuyCach->Update($data, $_POST["old_quycach_id"]);
                $this->MCard->updateObjectID($_POST["old_quycach_id"], $_POST["new_quycach_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($quycach_id)
    {
        // if (!$this->session->userdata("username"))  redirect('user/login');
        // if (!$this->session->userdata("admin"))
        //     if (!in_array($this->object, $this->session->userdata("role")))
        //         redirect(base_url());
        $this->load->model('MQuyCach');
        $this->MQuyCach->Delete($quycach_id);
        redirect(base_url() . "quycach");
    }
    public function card($quycach_id = "0")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MQuyCach');
        $quycach = $this->MQuyCach->Read();
        $data = array(
            'action' => 'quycach_card', 
            'template' => 'quycach/card',
            'data' => array('quycach' => $quycach, 'quycach_id' => $quycach_id)
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
            $this->view->parse('quycach/card_read', $data);
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
        $this->load->model("MQuyCach");
        $table_name = 'QuyCach';
        $sel=$this->MQuyCach->Read();
        $this->load->database();
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
        $this->MQuyCach->Update_Kho($insert,$table_name);
        return $this->View();
    }
}
