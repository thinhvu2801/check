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

    public function Insert()
    {
       
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
}
