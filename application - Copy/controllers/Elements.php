<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Elements extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "Elements";
        $this->object_type = 3;
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        //echo base64_encode('{"expired":"2020-09-06","message":"Hệ thống cân thống kê hết hạn sử dụng từ ngày 06/09/2020.!"}');
        /*$MAC = exec('getmac');
        // $MAC = strtok($MAC, ' ');
        // $this->load->library('zip');
        // $this->zip->read_file('G:/HASACO2_STATISTIC_SCALE_MENT.bak', true);
        // $this->zip->download('HASACO.zip');*/
        $this->View();
    }
    public function View($mes = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MElements');

        $data = array(
            'action' => 'elements',
            'template' => 'elements/index',
            'data' => array(
                'elements' => $this->MElements->Read(),
                'mes' => $mes
            )
        );

        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (isset($_POST["role_id"])) {
            $this->load->model('MElements');
            if ($this->MElements->CheckCode($_POST["role_id"]))
                $this->View("Mã phần tử đã tồn tại!");
            else {
                $data = array(
                    'role_id' => $_POST["role_id"],
                    'role_name' => $_POST["role_name"],
                    'orderby' => $_POST["orderby"]
                );
                $this->MElements->Insert($data);
                redirect(base_url() . "role");
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }

    public function Update($key, $value)
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MElements');
        if ($value == 1)
			$value = 0;
		else $value = 1;
        echo $value;
        $data = array(
            $key => $value
        );
        $this->MElements->Update($data, 1);
        redirect(base_url() . $this->object);
    }
}
