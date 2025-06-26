<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "group";
        $this->object_type = 5;
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($mes = "")
    {
        if (!$this->session->userdata("username")) redirect('user/login');
        $this->load->model('MGroup');
        $data = array(
            'action' => 'group',
            'template' => 'group/index',
            'data' => array(
                'group' => $this->MGroup->Read(),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }
    public function Insert()
    {
        if (isset($_POST["group_id"])) {
            $this->load->model('MGroup');
            if ($this->MGroup->CheckCode($_POST["group_id"]))
                $this->View("Mã tổ SX đã tồn tại!");
            else {
                $data = array(
                    'group_id' => $_POST["group_id"],
                    'group_name' => $_POST["group_name"],
                    'note' => $_POST["note"]
                );
                $this->MGroup->Insert($data);
                redirect(base_url() . "Group");
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Update()
    {
        if (isset($_POST["new_group_id"])) {
            $this->load->model('MGroup');
            $this->load->model('MCard');
            if ($_POST["new_group_id"] != $_POST["old_group_id"]) {
                if ($this->MGroup->CheckCode($_POST["new_group_id"]))
                    $this->View("Mã nhóm đã tồn tại!");
                else {
                    $data = array(
                        'group_id' => $_POST["new_group_id"],
                        'group_name' => $_POST["group_name"],
                        'note' => $_POST["note"]
                    );
                    $this->MGroup->Update($data, $_POST["old_group_id"]);
                    $this->MCard->updateObjectID($_POST["old_group_id"], $_POST["new_group_id"], $this->object_type);
                }
            } else {
                $data = array(
                    'group_name' => $_POST["group_name"],
                    'note' => $_POST["note"]
                );
                $this->MGroup->Update($data, $_POST["old_group_id"]);
                $this->MCard->updateObjectID($_POST["old_group_id"], $_POST["new_group_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }

    public function Delete($group_id)
    {
        if (!$this->session->userdata("username")) redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MGroup');
        $this->MGroup->Delete($group_id);
        redirect(base_url() . "group");
    }
    public function card($group_id = "")
    {
        $this->load->model('MGroup');
        $group = $this->MGroup->Read();
        $data = array(
            'action' => 'group_card', 
            'template' => 'group/card',
            'data' => array('group' => $group, 'group_id' => $group_id)
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
            $this->view->parse('group/card_read', $data);
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
