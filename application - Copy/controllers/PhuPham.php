<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PhuPham extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "phupham";
        $this->object_type = 1;
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }
    public function chitiet()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_time = $datetime[5] . $datetime[6];
            $xe_id = $_POST["xe_id"];
        } else {
            $date = date("Y-m-d");
            $start_time = "00:00";
            $end_time = "23:59";
            $xe_id = "";
        }
        $this->load->model('MPhuPham');
        $product = $this->MPhuPham->ReadAll();
        $result = $this->MPhuPham->ChiTiet($date, $xe_id);
        $this->load->model('MXe');
        $xe = $this->MXe->Read();
        $data = array(
            'action' => 'phupham_stat_chitiet',
            'template' => 'phupham/chitiet',
            'data' => array(
                'startDate' => $this->uti->dateforpicker($date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($date) . " " . $end_time,
                'xe' => $xe, 'xe_id' => $xe_id,
                'product' => $product,
                'result' => $result
            )
        );
        if (isset($_POST["export"])) {
            $this->uti->export($result, 'phupham-chitiet-' . $date);
        }
        $this->load->view('home', $data);
    }
    public function tonghop()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
            $xe_id = $_POST["xe_id"];
        } else {
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
            $xe_id = "";
        }
        $this->load->model('MPhuPham');
        $result = $this->MPhuPham->TongHop($start_date, $end_date, $xe_id);
        $this->load->model('MXe');
        $xe = $this->MXe->Read();
        $data = array(
            'action' => 'phupham_stat_tonghop',
            'template' => 'phupham/tonghop',
            'data' => array(
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
                'xe' => $xe, 'xe_id' => $xe_id,
                'result' => $result
            )
        );
        if (isset($_POST["export"])) {
            $this->uti->export($result, 'phupham-tonghop-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($parent_id = "0", $mes = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MPhuPham');
        $product = $this->MPhuPham->ReadById($parent_id);
        if (empty($product) && ($parent_id != "0"))
            redirect(base_url() . "phupham");

        $data = array(
            'action' => 'phupham',
            'template' => 'phupham/index',
            'data' => array(
                'product' => $this->MPhuPham->Read($parent_id),
                'group_product' => $this->MPhuPham->Read(),
                'parent_id' => $parent_id,
                'mes' => $mes
            )
        );

        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["product_id"])) {
            $this->load->model('MPhuPham');
            if ($this->MPhuPham->CheckCode($_POST["product_id"]))
                $this->View($_POST["parent_id"], "Mã sản phẩm đã tồn tại!");
            else {
                $data = array(
                    'product_id' => $_POST["product_id"],
                    'product_name' => $_POST["product_name"],
                    'note' => $_POST["note"],
                    'parent_id' => $_POST["parent_id"],
                    'linkable' => $_POST["linkable"]
                );
                $this->MPhuPham->Insert($data);
                redirect(base_url() . "phupham/view/" . $_POST["parent_id"]);
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
                $this->load->model('MPhuPham');
                $myexcel = new MyExcel();
                $fname = $myexcel->ToCSV($_FILES["file_xls"], 'upload');
                $file = fopen($fname, "r");

                $emapData = fgetcsv($file, 0, ",");
                if ($emapData != array('product_id', 'product_name', 'note'))
                    $this->View($_POST["parent_id"], "Cấu trúc file dữ liệu không đúng!");
                else {
                    while (($emapData = fgetcsv($file, 0, ",")) !== FALSE) {
                        $data = array(
                            'product_id' => $emapData[0],
                            'product_name' => $emapData[1],
                            'parent_id' => $_POST["parent_id"],
                            'note' => $emapData[2]
                        );
                        $status = "DONE";
                        if ($this->MPhuPham->CheckCode($emapData[0])) {
                            $status = "P_ERROR";
                            if (isset($_POST['thaythe'])) {
                                $this->db->where('product_id', $emapData[0]);
                                $this->db->update('product', $data);
                                $mes = "Đã được thay thế bằng dữ liệu mới!";
                            }
                        }
                        if ($status == "DONE") $this->MPhuPham->Insert($data);
                        else $pcode = $pcode . $emapData[0] . " ";
                    }
                    fclose($file);
                    unset($fname);
                    if ($pcode != "")
                        $this->View($_POST["parent_id"], "Các mã sản phẩm: " . $pcode . "Đã có trong hệ thống! " . $mes);
                    else $this->View($_POST["parent_id"]);
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }
    public function updateproductid()
    {
        $this->load->model('MPhuPham');
        if (isset($_POST["new_product_id"])) {
            $data = array(
                'product_id' => $_POST["new_product_id"]
            );
            $this->MPhuPham->UpdateProductId($data, $_POST["id"]);
            redirect(base_url() . "phupham/chitiet");
        }
    }
    public function Update()
    {
        if (isset($_POST["new_product_id"])) {
            $this->load->model('MPhuPham');
            $this->load->model('MCardPhuPham');
            if ($_POST["new_product_id"] != $_POST["old_product_id"]) {
                if ($this->MPhuPham->CheckCode($_POST["new_product_id"]))
                    $this->View($_POST["parent_id"], "Mã sản phẩm đã tồn tại!");
                else {
                    $data = array(
                        'product_id' => $_POST["new_product_id"],
                        'product_name' => $_POST["product_name"],
                        'linkable' => $_POST["linkable"],
                        'note' => $_POST["note"]
                    );
                    $this->MPhuPham->Update($data, $_POST["old_product_id"]);
                    $this->MCardPhuPham->updateObjectID($_POST["old_product_id"], $_POST["new_product_id"], $this->object_type);
                }
            } else {
                $data = array(
                    'product_name' => $_POST["product_name"],
                    'linkable' => $_POST["linkable"],
                    'note' => $_POST["note"]
                );
                $this->MPhuPham->Update($data, $_POST["old_product_id"]);
                $this->MCardPhuPham->updateObjectID($_POST["old_product_id"], $_POST["new_product_id"], $this->object_type);
            }
            redirect(base_url() . $this->object . "/view/" . $_POST["parent_id"]);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($product_id, $parent_id = "0")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MPhuPham');
        $result = $this->MPhuPham->Delete($product_id);
        redirect(base_url() . "phupham/view/" . $parent_id);
    }
    public function card($product_id = "0")
    {
        if (!$this->session->userdata("username")) redirect('user/login');
        $this->load->model('MPhuPham');
        if ($product_id == "0")
            $product = $this->MPhuPham->ReadAll();
        else {
            $p = $this->MPhuPham->ReadById($product_id);
            $product = $this->MPhuPham->Read($p->parent_id);
        }
        $data = array(
            'action' => 'phupham_card',
            'template' => 'phupham/card',
            'data' => array(
                'product' => $product,
                'product_id' => $product_id
            )
        );
        $this->load->view('home', $data);
    }
    public function card_delete()
    {
        if (isset($_POST["card_id"])) {
            $this->load->model('MCardPhuPham');
            $this->MCardPhuPham->Delete($_POST["card_id"]);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function card_read()
    {
        if (isset($_POST["object_id"])) {
            $object_id = $_POST["object_id"];
            $this->load->model('MCardPhuPham');
            $card_list = $this->MCardPhuPham->Card_Read_By_Object($object_id, $this->object_type);
            $data = array('card_list' => $card_list);
            $this->view->base_url = base_url();
            $this->view->parse('phupham/card_read', $data);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function card_create()
    {
        if (isset($_POST["card_id"])) {
            $card_id = $_POST["card_id"];
            $object_id = $_POST["object_id"];
            $this->load->model('MCardPhuPham');
            $this->MCardPhuPham->Create($card_id, $object_id, $this->object_type);
        } else {
            redirect(base_url() . $this->object);
        }
    }
}
