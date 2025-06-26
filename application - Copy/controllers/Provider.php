<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Provider extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "provider";
        $this->object_type = 6;
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($mes = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('Mprovider');
        $data = array(
            'action' => 'provider',
            'template' => 'provider/index',
            'data' => array(
                'provider' => $this->Mprovider->Read(),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["provider_id"])) {
            $this->load->model('Mprovider');
            if ($this->Mprovider->CheckCode($_POST["provider_id"]))
                $this->View($_POST["parent_id"], "Mã nhà cung cấp đã tồn tại!");
            else {
                $data = array(
                    'provider_id' => $_POST["provider_id"],
                    'provider_name' => $_POST["provider_name"],
                    'note' => $_POST["note"]
                );
                $this->Mprovider->Insert($data);
                redirect(base_url() . "provider");
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }

    public function Update()
    {
        if (isset($_POST["new_provider_id"])) {
            $this->load->model('Mprovider');
            $this->load->model('MCard');
            if ($_POST["new_provider_id"] != $_POST["old_provider_id"]) {
                if ($this->Mprovider->CheckCode($_POST["new_provider_id"]))
                    $this->View("Mã nhà cung cấp đã tồn tại!");
                else {
                    $data = array(
                        'provider_id' => $_POST["new_provider_id"],
                        'provider_name' => $_POST["provider_name"],
                        'note' => $_POST["note"]
                    );
                    $this->Mprovider->Update($data, $_POST["old_provider_id"]);
                    $this->MCard->updateObjectID($_POST["old_provider_id"], $_POST["new_provider_id"], $this->object_type);
                }
            } else {
                $data = array(
                    'provider_name' => $_POST["provider_name"],
                    'note' => $_POST["note"]
                );
                $this->Mprovider->Update($data, $_POST["old_provider_id"]);
                $this->MCard->updateObjectID($_POST["old_provider_id"], $_POST["new_provider_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($provider_id)
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('Mprovider');
        $result = $this->Mprovider->Delete($provider_id);
        redirect(base_url() . "provider");
    }
    public function card($provider_id = "0")
    {
        if (!$this->session->userdata("username")) redirect('user/login');
        $this->load->model('Mprovider');
        $provider = $this->Mprovider->Read();
        $data = array(
            'action' => 'provider_card',
            'template' => 'provider/card',
            'data' => array('provider' => $provider, 'provider_id' => $provider_id)
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
            $this->view->parse('provider/card_read', $data);
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
