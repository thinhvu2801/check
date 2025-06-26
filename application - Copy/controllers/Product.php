<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "product";
        $this->object_type = 1;
        $this->object_related = array('SuaCa','Fillet');
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($parent_id = "0", $mes = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MProduct');
        $product = $this->MProduct->ReadById($parent_id);
        if (empty($product) && ($parent_id != "0"))
            redirect(base_url() . "product");

        $data = array(
            'action' => 'product',
            'template' => 'product/index',
            'data' => array(
                'product' => $this->MProduct->Read($parent_id),
                'group_product' => $this->MProduct->Read(),
                'parent_id' => $parent_id,
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["product_id"])) {
            $this->load->model('MProduct');
            if ($this->MProduct->CheckCode($_POST["product_id"]))
                $this->View($_POST["parent_id"], "Mã sản phẩm đã tồn tại!");
            else {
                $data = array(
                    'product_id' => $_POST["product_id"],
                    'product_name' => $_POST["product_name"],
                    'weight_min' => $_POST["weight_min"],
                    'weight_max' => $_POST["weight_max"],
                    'note' => $_POST["note"],
                    'parent_id' => $_POST["parent_id"],
                    'linkable' => $_POST["linkable"]
                );
                $this->MProduct->Insert($data);
                redirect(base_url() . "product/view/" . $_POST["parent_id"]);
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
                $this->load->model('MProduct');
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
                        if ($this->MProduct->CheckCode($emapData[0])) {
                            $status = "P_ERROR";
                            if (isset($_POST['thaythe'])) {
                                $this->db->where('product_id', $emapData[0]);
                                $this->db->update('product', $data);
                                $mes = "Đã được thay thế bằng dữ liệu mới!";
                            }
                        }
                        if ($status == "DONE") $this->MProduct->Insert($data);
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
    public function Update()
    {
        if (isset($_POST["new_product_id"])) {
            $this->load->model('MProduct');
            $this->load->model('MCard');
            $this->load->model('MGeneral');
            if ($_POST["new_product_id"] != $_POST["old_product_id"]) {
                if ($this->MProduct->CheckCode($_POST["new_product_id"]))
                    $this->View($_POST["parent_id"], "Mã sản phẩm đã tồn tại!");
                else {
                    $data = array(
                        'product_id' => $_POST["new_product_id"],
                        'product_name' => $_POST["product_name"],
                        'weight_min' => $_POST["weight_min"],
                        'weight_max' => $_POST["weight_max"],
                        'linkable' => $_POST["linkable"],
                        'hidden' => $_POST["hidden"],
                        'note' => $_POST["note"]
                    );
                    $this->MProduct->Update($data, $_POST["old_product_id"]);
                    $this->MGeneral->UpdateObjectRelated($this->object_related,"product_id", $_POST["old_product_id"],  $_POST["new_product_id"]);
                    $this->MCard->updateObjectID($_POST["old_product_id"], $_POST["new_product_id"], $this->object_type);
                }
            } else {
                $data = array(
                    'product_name' => $_POST["product_name"],
                    'weight_min' => $_POST["weight_min"],
                    'weight_max' => $_POST["weight_max"],
                    'linkable' => $_POST["linkable"],
                    'hidden' => $_POST["hidden"],
                    'note' => $_POST["note"]
                );
                $this->MProduct->Update($data, $_POST["old_product_id"]);
                $this->MCard->updateObjectID($_POST["old_product_id"], $_POST["new_product_id"], $this->object_type);
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
        $this->load->model('MProduct');
        $result = $this->MProduct->Delete($product_id);
        redirect(base_url() . "product/view/" . $parent_id);
    }
    public function card($product_id = "0")
    {
        if (!$this->session->userdata("username")) redirect('user/login');
        $this->load->model('MProduct');
        if ($product_id == "0")
            $product = $this->MProduct->ReadAll();
        else {
            $p = $this->MProduct->ReadById($product_id);
            $product = $this->MProduct->Read($p->parent_id);
        }
        $data = array(
            'action' => 'product_card',
            'template' => 'product/card',
            'data' => array('product' => $product, 'product_id' => $product_id)
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
            $this->view->parse('product/card_read', $data);
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
