<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PhuPham2 extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "phupham";
        $this->object_type = 1;
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }
    public function detail()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_time = $datetime[5] . $datetime[6];
            $customer_id=$_POST["customer_id"];
        } else {
            $date = date("Y-m-d");
            $start_time = "00:00";
            $end_time = "23:59";
            $customer_id="";
        }
        $this->load->model('MPhuPham2');
        $this->load->model('MCustomer');
        $result = $this->MPhuPham2->ChiTiet($date,$customer_id);
        $customer = $this->MCustomer->Read();
        $data = array(
            'action' => 'phu_pham_stat_detail',
            'template' => 'phupham2/detail',
            'data' => array(
                'startDate' => $this->uti->dateforpicker($date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($date) . " " . $end_time,
                'customer'=>$customer,
                'customer_id'=>$customer_id,
                'result' => $result
            )
        );
        if (isset($_POST["export"])) {
            $this->uti->export($result, 'phupham-chitiet-' . $date);
        }
        $this->load->view('home', $data);
    }
    public function general()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
            $customer_id=$_POST["customer_id"];
        } else {
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
            $customer_id="";
        }
        $this->load->model('MPhuPham2');
        $this->load->model('MCustomer');
        $customer = $this->MCustomer->Read();
        $result = $this->MPhuPham2->TongHop($start_date, $end_date,$customer_id);
        // $this->load->model('MXe');
        // $xe = $this->MXe->Read();
        $data = array(
            'action' => 'phu_pham_stat_general',
            'template' => 'phupham2/general',
            'data' => array(
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
                'customer'=>$customer,
                'customer_id'=>$customer_id,
                'result' => $result
            )
        );
        if (isset($_POST["export"])) {
            $this->uti->export($result, 'phupham-tonghop-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
}
