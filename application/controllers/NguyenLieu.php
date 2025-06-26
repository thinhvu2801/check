<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NguyenLieu extends CI_Controller {
    var $object;
    var $object_type;
    function __construct(){
        parent::__construct();
        $this->object = "nguyenlieu";
        $this->object_type=1;
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }
    public function chitiet()
    {
        if(!$this->session->userdata("username"))  redirect('user/login');
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model('MNguyenLieu');
        $result=$this->MNguyenLieu->Detail($lo_id, $start_date, $end_date, $start_time, $end_time);
        $this->load->model('MLoHang');
        $lohang=$this->MLoHang->Read();
        $data = array(
            'action' => 'nguyenlieu_stat_chitiet',
            'template' => 'statistic/nguyenlieu/chitiet',
            'data' => array(
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
                'lohang'=>$lohang, 'lo_id'=>$lo_id,
                'result'=>$result
            )
        );
        if (isset($_POST["export"])){
            $this->uti->export($result, 'nguyenlieu-chitiet-'.$start_date.'-'.$end_date);
        }
        $this->load->view('home',$data);
    }
    public function tonghop()
    {
        if(!$this->session->userdata("username"))  redirect('user/login');
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
            $lo_id=$_POST["lo_id"];
        } else {
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
            $lo_id="";
        }
        $this->load->model('MNguyenLieu');
        $result=$this->MNguyenLieu->Product($lo_id, $start_date, $end_date, $start_time, $end_time);
        $this->load->model('MLoHang');
        $lohang=$this->MLoHang->Read();
        $data = array(
            'action' => 'nguyenlieu_stat_product',
            'template' => 'statistic/nguyenlieu/tonghop',
            'data' => array(
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
                'lohang'=>$lohang,'lo_id'=>$lo_id,
                'result'=>$result
            )
        );
        if (isset($_POST["export"])){
            $this->uti->export($result, 'nguyenlieu-product-'.$start_date.'-'.$end_date);
        }
        $this->load->view('home',$data);
    }
}
