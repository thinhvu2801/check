<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CongDoan extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "congdoan";
        $this->object_type = 20;
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($mes = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MCongDoan');
        $data = array(
            'action' => 'congdoan',
            'template' => 'congdoan/index',
            'data' => array(
                'congdoan' => $this->MCongDoan->Read(),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["congdoan_id"])) {
            $this->load->model('MCongDoan');
            if ($this->MCongDoan->CheckCode($_POST["congdoan_id"]))
                $this->View($_POST["parent_id"], "Mã congdoan đã tồn tại!");
            else {
                $data = array(
                    'congdoan_id' => $_POST["congdoan_id"],
                    'congdoan_name' => $_POST["congdoan_name"],
                    'heso' => $_POST["heso"]
                );
                $this->MCongDoan->Insert($data);
                redirect(base_url() . $this->object);
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }

    public function Update()
    {
        if (isset($_POST["new_congdoan_id"])) {
            $this->load->model('MCongDoan');
            $this->load->model('MCard');
            if ($_POST["new_congdoan_id"] != $_POST["old_congdoan_id"]) {
                if ($this->MCongDoan->CheckCode($_POST["new_congdoan_id"]))
                    $this->View("Mã công đoạn đã tồn tại!");
                else {
                    $data = array(
                        'congdoan_id' => $_POST["new_congdoan_id"],
                        'congdoan_name' => $_POST["congdoan_name"],
                        'heso' => $_POST["heso"]
                    );
                    $this->MCongDoan->Update($data, $_POST["old_congdoan_id"]);
                    $this->MCard->updateObjectID($_POST["old_congdoan_id"], $_POST["new_congdoan_id"], $this->object_type);
                }
            } else {
                $data = array(
                    'congdoan_name' => $_POST["congdoan_name"],
                    'heso' => $_POST["heso"]
                );
                $this->MCongDoan->Update($data, $_POST["old_congdoan_id"]);
                $this->MCard->updateObjectID($_POST["old_congdoan_id"], $_POST["new_congdoan_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($congdoan_id)
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MCongDoan');
        $result = $this->MCongDoan->Delete($congdoan_id);
        redirect(base_url() .  $this->object);
    }
    public function card($congdoan_id = "0")
    {
        if (!$this->session->userdata("username")) redirect('user/login');
        $this->load->model('MCongDoan');
        $congdoan = $this->MCongDoan->Read();
        $data = array(
            'action' => 'congdoan_card',
            'template' => 'congdoan/card',
            'data' => array(
                'congdoan' => $congdoan,
                'congdoan_id' => $congdoan_id
            )
        );
        $this->load->view('home', $data);
    }
    public function card_delete()
    {
        if (isset($_POST["card_id"])) {
            $this->load->model('MCardPhuPham');
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
            $this->view->parse('congdoan/card_read', $data);
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
