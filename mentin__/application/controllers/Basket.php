<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Basket extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "basket";
        $this->object_type = 3;
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
        $this->load->model('MBasket');
        $this->load->model('MGeneral');
        $pathToSave = realpath("")."\\MenTPS.bak";
        $this->MGeneral->Backup($pathToSave);
        $data = array(
            'action' => 'basket',
            'template' => 'basket/index',
            'data' => array(
                'basket' => $this->MBasket->Read(),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["basket_id"])) {
            $this->load->model('MBasket');
            if ($this->MBasket->CheckCode($_POST["basket_id"]))
                $this->View("Mã rổ đã tồn tại!");
            else {
                $data = array(
                    'basket_id' => $_POST["basket_id"],
                    'note' => $_POST["note"]
                );
                $this->MBasket->Insert($data);
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
                $this->load->model('MBasket');
                $myexcel = new MyExcel();
                $fname = $myexcel->ToCSV($_FILES["file_xls"], 'upload');
                $file = fopen($fname, "r");

                $emapData = fgetcsv($file, 0, ",");
                if ($emapData != array('basket_id', 'note'))
                    $this->View("Cấu trúc file dữ liệu không đúng!");
                else {
                    while (($emapData = fgetcsv($file, 0, ",")) !== FALSE) {
                        $data = array(
                            'basket_id' => $emapData[0],
                            'note' => $emapData[1]
                        );
                        $status = "DONE";
                        if ($this->MBasket->CheckCode($emapData[0])) {
                            $status = "P_ERROR";
                            if (isset($_POST['thaythe'])) {
                                $this->db->where('basket_id', $emapData[0]);
                                $this->db->update('basket', $data);
                                $mes = "Đã được thay thế bằng dữ liệu mới!";
                            }
                        }
                        if ($status == "DONE") $this->MBasket->Insert($data);
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
        if (isset($_POST["new_basket_id"])) {
            $this->load->model('MBasket');
            $this->load->model('MCard');
            if ($_POST["new_basket_id"] != $_POST["old_basket_id"]) {
                if ($this->MBasket->CheckCode($_POST["new_basket_id"]))
                    $this->View("Mã rổ đã tồn tại!");
                else {
                    $data = array(
                        'basket_id' => $_POST["new_basket_id"],
                        'note' => $_POST["note"]
                    );
                    $this->MBasket->Update($data, $_POST["old_basket_id"]);
                    $this->MCard->updateObjectID($_POST["old_basket_id"], $_POST["new_basket_id"], $this->object_type);
                }
            } else {
                $data = array('note' => $_POST["note"]);
                $this->MBasket->Update($data, $_POST["old_basket_id"]);
                $this->MCard->updateObjectID($_POST["old_basket_id"], $_POST["new_basket_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($basket_id)
    {
        // if (!$this->session->userdata("username"))  redirect('user/login');
        // if (!$this->session->userdata("admin"))
        //     if (!in_array($this->object, $this->session->userdata("role")))
        //         redirect(base_url());
        $this->load->model('MBasket');
        $this->MBasket->Delete($basket_id);
        redirect(base_url() . "basket");
    }
    public function card($basket_id = "0")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MBasket');
        $basket = $this->MBasket->Read();
        $data = array(
            'action' => 'basket_card', 
            'template' => 'basket/card',
            'data' => array('basket' => $basket, 'basket_id' => $basket_id)
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
            $this->view->parse('basket/card_read', $data);
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
