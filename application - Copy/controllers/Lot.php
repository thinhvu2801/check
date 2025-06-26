<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lot extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "lot";
        $this->object_type = 4;
        $this->object_related = array('SuaCa','Fillet');
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($mes = "")
    {
        $this->load->model('MLoHang');
        $data = array(
            'action' => 'lohang',
            'template' => 'lohang/index',
            'data' => array(
                'lohang' => $this->MLoHang->Read(),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["lo_id"])) {
            $this->load->model('MLohang');
            if ($this->MLohang->CheckCode($_POST["lo_id"]))
                $this->View("Mã lô đã tồn tại!");
            else {
                $data = array(
                    'lo_id' => $_POST["lo_id"],
                    'note' => $_POST["note"]
                );
                $this->MLohang->Insert($data);
                redirect(base_url() . $this->object);
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }

    public function Update()
    {
        if (isset($_POST["new_lo_id"])) {
            $this->load->model('MLohang');
            $this->load->model('MCard');
            $this->load->model('MGeneral');
            if ($_POST["new_lo_id"] != $_POST["old_lo_id"]) {
                if ($this->MLohang->CheckCode($_POST["new_lo_id"]))
                    $this->View("Mã lô đã tồn tại!");
                else {
                    $data = array(
                        'lo_id' => $_POST["new_lo_id"],
                        'note' => $_POST["note"]
                    );
                    $this->MLohang->Update($data, $_POST["old_lo_id"]);
                    $this->MGeneral->UpdateObjectRelated($this->object_related,"lo_id", $_POST["old_lo_id"],  $_POST["new_lo_id"]);
                    $this->MCard->updateObjectID($_POST["old_lo_id"], $_POST["new_lo_id"], $this->object_type);
                }
            } else {
                $data = array('note' => $_POST["note"]);
                $this->MLohang->Update($data, $_POST["old_lo_id"]);
                $this->MCard->updateObjectID($_POST["old_lo_id"], $_POST["new_lo_id"], $this->object_type);
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
        $this->load->model('MLohang');
        $this->MLohang->Delete($lid);
        redirect(base_url() . $this->object);
    }
    public function card($lo_id = "")
    {
        $this->load->model('MLohang');
        $lohang = $this->MLohang->Read();
        $data = array(
            'action' => 'lohang_card', 
            'template' => 'lohang/card',
            'data' => array('lohang' => $lohang, 'lo_id' => $lo_id)
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
            $this->view->parse('lohang/card_read', $data);
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
