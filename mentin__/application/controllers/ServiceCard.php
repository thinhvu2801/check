<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ServiceCard extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "servicecard";
        $this->object_type = 15;
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
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
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MServiceCard');

        $data = array(
            'action' => 'servicecard',
            'template' => 'servicecard/index',
            'data' => array(
                'servicecard' => $this->MServiceCard->Read(),
                'mes' => $mes
            )
        );

        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["sc_id"])) {
            $this->load->model('MServiceCard');
            if ($this->MServiceCard->CheckCode($_POST["sc_id"]))
                $this->View("Mã thẻ dịch vụ đã tồn tại!");
            else {
                $data = array(
                    'sc_id' => $_POST["sc_id"],
                    'note' => $_POST["note"],
                    'type' => $_POST["type"],
                    'order_by' => $_POST["order_by"]
                );
                $this->MServiceCard->Insert($data);
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
                $this->load->model('MServiceCard');
                $myexcel = new MyExcel();
                $fname = $myexcel->ToCSV($_FILES["file_xls"], 'upload');
                $file = fopen($fname, "r");

                $emapData = fgetcsv($file, 0, ",");
                if ($emapData != array('sc_id', 'note','type','order_by'))
                    $this->View("Cấu trúc file dữ liệu không đúng!");
                else {
                    while (($emapData = fgetcsv($file, 0, ",")) !== FALSE) {
                        $data = array(
                            'sc_id' => $emapData[0],
                            'note' => $emapData[1],
                            'type' => $emapData[2],
                            'order_by' => $emapData[3]
                        );
                        $status = "DONE";
                        if ($this->MServiceCard->CheckCode($emapData[0])) {
                            $status = "P_ERROR";
                            if (isset($_POST['thaythe'])) {
                                $this->db->where('sc_id', $emapData[0]);
                                $this->db->update('servicecard', $data);
                                $mes = "Đã được thay thế bằng dữ liệu mới!";
                            }
                        }
                        if ($status == "DONE") $this->MServiceCard->Insert($data);
                        else $pcode = $pcode . $emapData[0] . " ";
                    }
                    fclose($file);
                    unset($fname);
                    if ($pcode != "")
                        $this->View("Các mã rổ: " . $pcode . "Đã có trong hệ thống! " . $mes);
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
        if (isset($_POST["new_sc_id"])) {
            $this->load->model('MServiceCard');
            $this->load->model('MCard');
            if ($_POST["new_sc_id"] != $_POST["old_sc_id"]) {
                if ($this->MServiceCard->CheckCode($_POST["new_sc_id"]))
                    $this->View("Mã rổ đã tồn tại!");
                else {
                    $data = array(
                        'sc_id' => $_POST["new_sc_id"],
                        'note' => $_POST["note"],
                        'type' => $_POST["type"],
                        'order_by' => $_POST["order_by"]
                    );
                    $this->MServiceCard->Update($data, $_POST["old_sc_id"]);
                    $this->MCard->updateObjectID($_POST["old_sc_id"], $_POST["new_sc_id"], $this->object_type);
                }
            } else {
                $data = array('note' => $_POST["note"],
                'type' => $_POST["type"],
                'order_by' => $_POST["order_by"]);
                $this->MServiceCard->Update($data, $_POST["old_sc_id"]);
                $this->MCard->updateObjectID($_POST["old_sc_id"], $_POST["new_sc_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($sc_id)
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MServiceCard');
        $this->MServiceCard->Delete($sc_id);
        redirect(base_url() . $this->object);
    }
    public function card($sc_id = "0")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MServiceCard');
        $servicecard = $this->MServiceCard->Read();
        $data = array(
            'action' => 'servicecard', 
            'template' => 'servicecard/card',
            'data' => array('servicecard' => $servicecard, 'sc_id' => $sc_id)
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
            $this->view->parse('servicecard/card_read', $data);
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
}
