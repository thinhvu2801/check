<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Xe extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "xe";
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
        $this->load->model('MXe');
        $data = array(
            'action' => 'xe',
            'template' => 'xe/index',
            'data' => array(
                'xe' => $this->MXe->Read(),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["xe_id"])) {
            $this->load->model('MXe');
            if ($this->MXe->CheckCode($_POST["xe_id"]))
                $this->View($_POST["parent_id"], "Mã xe đã tồn tại!");
            else {
                $data = array(
                    'xe_id' => $_POST["xe_id"],
                    'xe_name' => $_POST["xe_name"]
                );
                $this->MXe->Insert($data);
                redirect(base_url() . "xe");
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }

    public function Update()
    {
        if (isset($_POST["new_xe_id"])) {
            $this->load->model('MXe');
            $this->load->model('MCard');
            if ($_POST["new_xe_id"] != $_POST["old_xe_id"]) {
                if ($this->MXe->CheckCode($_POST["new_xe_id"]))
                    $this->View("Mã xe đã tồn tại!");
                else {
                    $data = array(
                        'xe_id' => $_POST["new_xe_id"],
                        'xe_name' => $_POST["xe_name"]
                    );
                    $this->MXe->Update($data, $_POST["old_xe_id"]);
                    $this->MCard->updateObjectID($_POST["old_xe_id"], $_POST["new_xe_id"], $this->object_type);
                }
            } else {
                $data = array(
                    'xe_name' => $_POST["xe_name"]
                );
                $this->MXe->Update($data, $_POST["old_xe_id"]);
                $this->MCard->updateObjectID($_POST["old_xe_id"], $_POST["new_xe_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($xe_id)
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MXe');
        $result = $this->MXe->Delete($xe_id);
        redirect(base_url() . "xe");
    }
    public function card($xe_id = "0")
    {
        if (!$this->session->userdata("username")) redirect('user/login');
        $this->load->model('MXe');
        $xe = $this->MXe->Read();
        $data = array(
            'action' => 'xe_card',
            'template' => 'xe/card',
            'data' => array(
                'xe' => $xe,
                'xe_id' => $xe_id
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
            $this->view->parse('xe/card_read', $data);
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
