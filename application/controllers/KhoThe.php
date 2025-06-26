<?php
defined('BASEPATH') or exit('No direct script access allowed');
class KhoThe extends CI_Controller
{
    var $object;
    
    function __construct()
    {
        parent::__construct();
        $this->object = "khothe";
        $this->object_type = 2;
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($mes = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MKhoThe');

        $data = array(
            'action' => 'khothe',
            'template' => 'khothe/index',
            'data' => array(
                'khothe' => $this->MKhoThe->Read('RFID_MaThe'),
                'mes' => $mes
            )
        );

        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["id"])) {
            $this->load->model('MKhoThe');
            if(!preg_match('/^[a-zA-Z0-9-_]+$/', $_POST["id"])) {
                $this->View("Mã thẻ không hợp lệ"); // Hiển thị thông báo khi không hợp lệ
            }
            elseif ($this->MKhoThe->CheckCode($_POST["id"]))
                $this->View("Mã thẻ đã tồn tại!");
            else {
                $data = array(
                    'id' => $_POST["id"]
                );
                $this->MKhoThe->Insert($data);
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
                $this->load->model('MKhoThe');
                $myexcel = new MyExcel();
                $fname = $myexcel->ToCSV($_FILES["file_xls"], 'upload');
                $file = fopen($fname, "r");

                $emapData = fgetcsv($file, 0, ",");
                if ($emapData != array('id'))
                    $this->View("Cấu trúc file dữ liệu không đúng!");
                else {
                    while (($emapData = fgetcsv($file, 0, ",")) !== FALSE) {
                        $data = array(
                            'id' => $emapData[0]
                        );
                        $status = "DONE";
                        if ($this->MKhoThe->CheckCode($emapData[0])) {
                            $status = "P_ERROR";
                            if (isset($_POST['thaythe'])) {
                                $this->db->where('id', $emapData[0]);
                                $this->db->update('khothe', $data);
                                $mes = "Đã được thay thế bằng dữ liệu mới!";
                            }
                        }
                        if ($status == "DONE") $this->MKhoThe->Insert($data);
                        else $pcode = $pcode . $emapData[0] . " ";
                    }
                    fclose($file);
                    unset($fname);
                    if ($pcode != "")
                        $this->View("Các mã thẻ: " . $pcode . "Đã có trong hệ thống! " . $mes);
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
        if (isset($_POST["new_id"])) {
            $this->load->model('MKhoThe');
            $this->load->model('MCard');
            // if ($_POST["new_id"] != $_POST["old_id"]) {
                if ($this->MKhoThe->CheckCode($_POST["new_id"]))
                    $this->View("Mã thẻ đã tồn tại!");
                else {
                    $data = array(
                        'id' => $_POST["new_id"]
                    );
                    $this->MKhoThe->Update($data, $_POST["old_id"]);
                    $this->MCard->updateObjectID($_POST["old_id"], $_POST["new_id"], $this->object_type);
                }
            // } else {
            //     $data = array('note' => $_POST["note"],
            //     'type' => $_POST["type"],
            //     'order_by' => $_POST["order_by"]);
            //     $this->MKhoThe->Update($data, $_POST["old_id"]);
            //     $this->MCard->updateObjectID($_POST["old_id"], $_POST["new_id"], $this->object_type);
            // }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($id)
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MKhoThe');
        $this->MKhoThe->Delete($id);
        redirect(base_url() . $this->object);
    }
    public function card($id = "0")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MKhoThe');
        $khothe = $this->MKhoThe->Read('RFID_MaThe');
        $data = array(
            'action' => 'khothe', 
            'template' => 'khothe/card',
            'data' => array('khothe' => $khothe, 'id' => $id)
        );
        $this->load->view('home', $data);
    }
    public function card_delete()
    {
        if (isset($_POST["card_id"])) {
            $this->load->model('MCard');
            $this->MCard->Delete_Kho($_POST["card_id"]);
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
            $card_list = $this->MCard->Card_Read_By_Object_Kho($object_id, $this->object_type);
            $data = array('card_list' => $card_list);
            $this->view->base_url = base_url();
            $this->view->parse('khothe/card_read', $data);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function card_create()
    {
        if (isset($_POST["card_id"])) {
            $card_id = $_POST["card_id"];
            $object_id = $_POST["object_id"];
            $typecard = $_POST["typecard"];
            $this->load->model('MCard');
            $type=explode(',',$typecard);
            $validCardFound = false;
            // $this->MCard->Create($card_id, $object_id, $this->object_type);
            
            foreach ($type as $t) {
                if ($this->MCard->validCard($card_id, $t)) {
                    $this->MCard->Create($card_id, $object_id, $this->object_type,$t);
                    $validCardFound = true;
                    break; 
                }
            }

            if (!$validCardFound) {
                echo '<p style="color:red">Thẻ không lệ!</p>';
            }

        } else {
            redirect(base_url() . $this->object);
        }
    }
}
