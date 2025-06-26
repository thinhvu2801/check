<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductType extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "producttype";
        $this->object_type = 11;
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($mes = "")
    {
        $this->load->model('MProductType');
        $data = array(
            'action' => 'product_type',
            'template' => 'producttype/index',
            'data' => array(
                'product_type' => $this->MProductType->Read(),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["product_type_id"])) {
            $this->load->model('MProductType');
            if ($this->MProductType->CheckCode($_POST["product_type_id"]))
                $this->View("Mã loại SP đã tồn tại!");
            else {
                $data = array(
                    'product_type_id' => $_POST["product_type_id"],
                    'product_type_name' => $_POST["product_type_name"],
                    'note' => $_POST["note"]
                );
                $this->MProductType->Insert($data);
                redirect(base_url() . $this->object);
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }

    public function Update()
    {
        if (isset($_POST["new_product_type_id"])) {
            $this->load->model('MProductType');
            $this->load->model('MCard');
            if ($_POST["new_product_type_id"] != $_POST["old_product_type_id"]) {
                if ($this->MProductType->CheckCode($_POST["new_product_type_id"]))
                    $this->View("Mã loại SP đã tồn tại!");
                else {
                    $data = array(
                        'product_type_id' => $_POST["new_product_type_id"],
                        'product_type_name' => $_POST["product_type_name"],
                        'note' => $_POST["note"]
                    );
                    $this->MProductType->Update($data, $_POST["old_product_type_id"]);
                    $this->MCard->updateObjectID($_POST["old_product_type_id"], $_POST["new_product_type_id"], $this->object_type);
                }
            } else {
                $data = array('note' => $_POST["note"]);
                $this->MProductType->Update($data, $_POST["old_product_type_id"]);
                $this->MCard->updateObjectID($_POST["old_product_type_id"], $_POST["new_product_type_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($lid)
    {
        if (!$this->session->userdata("username")) redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MProductType');
        $this->MProductType->Delete($lid);
        redirect(base_url() . $this->object);
    }
    public function card($product_type_id = "")
    {
        $this->load->model('MProductType');
        $product_type = $this->MProductType->Read();
        $data = array(
            'action' => 'product_type_card',
            'template' => 'producttype/card',
            'data' => array(
                'product_type' => $product_type,
                'product_type_id' => $product_type_id
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
            $this->view->parse('producttype/card_read', $data);
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
