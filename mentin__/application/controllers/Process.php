<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Process extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "process";
        $this->object_type = 7;
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($mes = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MProcess');
        $data = array(
            'action' => 'process',
            'template' => 'product/index',
            'data' => array(
                'process' => $this->MProcess->Read(),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["process_id"])) {
            $this->load->model('Mprocess');
            if ($this->Mprocess->CheckCode($_POST["process_id"]))
                $this->View($_POST["parent_id"], "Mã nhà cung cấp đã tồn tại!");
            else {
                $data = array(
                    'process_id' => $_POST["process_id"],
                    'process_name' => $_POST["process_name"],
                    'note' => $_POST["note"]
                );
                $this->Mprocess->Insert($data);
                redirect(base_url() . "process");
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }

    public function Update()
    {
        if (isset($_POST["new_process_id"])) {
            $this->load->model('Mprocess');
            $this->load->model('MCard');
            if ($_POST["new_process_id"] != $_POST["old_process_id"]) {
                if ($this->Mprocess->CheckCode($_POST["new_process_id"]))
                    $this->View("Mã quy trình đã tồn tại!");
                else {
                    $data = array(
                        'process_id' => $_POST["new_process_id"],
                        'process_name' => $_POST["process_name"],
                        'note' => $_POST["note"]
                    );
                    $this->Mprocess->Update($data, $_POST["old_process_id"]);
                    $this->MCard->updateObjectID($_POST["old_process_id"], $_POST["new_process_id"], $this->object_type);
                }
            } else {
                $data = array(
                    'process_name' => $_POST["process_name"],
                    'note' => $_POST["note"]
                );
                $this->Mprocess->Update($data, $_POST["old_process_id"]);
                $this->MCard->updateObjectID($_POST["old_process_id"], $_POST["new_process_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($process_id)
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('Mprocess');
        $result = $this->Mprocess->Delete($process_id);
        redirect(base_url() . "process");
    }
    public function card($process_id = "0")
    {
        if (!$this->session->userdata("username")) redirect('user/login');
        $this->load->model('Mprocess');
        $process = $this->Mprocess->Read();
        $data = array(
            'action' => 'process_card',
            'template' => 'product/card',
            'data' => array(
                'process' => $process,
                'process_id' => $process_id
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
            $this->view->parse('process/card_read', $data);
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
