<?php
defined('BASEPATH') or exit('No direct script access allowed');
class GraderSize extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "gradersize";
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
    }
    public function index()
    {
        $this->View();
    }
    public function View($mes = "")
    {
       // if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MGraderSize');

        $data = array(
            'action' => 'gradersize',
            'template' => 'gradersize/index',
            'data' => array(
                'gradersize' => $this->MGraderSize->Read(),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["size_name"])) {
            $this->load->model('MGraderSize');
            if ($this->MGraderSize->CheckCode($_POST["size_name"]))
                $this->View("Tên size đã tồn tại!");
            else {
                $data = array(
                    'size_name' => $_POST["size_name"],
                    'min' => $_POST["min"],
                    'max' => $_POST["max"]
                );
                $this->MGraderSize->Insert($data);
                redirect(base_url()  . $this->object);
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }
    
    public function Update()
    {
        if (isset($_POST["new_size_name"])) {
            $this->load->model('MGraderSize');
            if ($_POST["new_size_name"] != $_POST["old_size_name"]) {
                if ($this->MGraderSize->CheckCode($_POST["new_size_name"]))
                    $this->View("Tên size đã tồn tại!");
                else {
                    $data = array(
                        'size_name' => $_POST["new_size_name"],
                            'min' => $_POST["min"],
                            'max' => $_POST["max"]
                    );
                    $this->MGraderSize->Update($data, $_POST["old_size_name"]);
                }
            } else {
                $data = array(
                        'min' => $_POST["min"],
                        'max' => $_POST["max"]
                    );
                $this->MGraderSize->Update($data, $_POST["old_size_name"]);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($gradersize_id)
    {
        // if (!$this->session->userdata("username"))  redirect('user/login');
        // if (!$this->session->userdata("admin"))
        //     if (!in_array($this->object, $this->session->userdata("role")))
        //         redirect(base_url());
        $this->load->model('MGraderSize');
        $this->MGraderSize->Delete($gradersize_id);
        redirect(base_url() .$this->object);
    }
}
