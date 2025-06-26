<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PSO extends CI_Controller
{
    var $url;
    function __construct()
    {
        parent::__construct();
        $this->url = 'https://mentvn.com/Mentapi/psodetail/';
        $this->url_general = 'https://mentvn.com/Mentapi/psogeneral/';
        $this->uti = new Utilities();
    }
    public function detail()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (isset($_POST["date"])){
            $date= $_POST["date"];
        }else{
            $date=date("Y-m-d");
        }
        $serial_number = $this->session->userdata("serial_number");
        if ($serial_number!=""){
            $url = $this->url.$date."/".$serial_number;
            $result = json_decode(file_get_contents($url));
        }else
        $result=array();
        
        $data = array(
            'action' => 'pso_stat_detail', 
            'template' => 'statistic/pso/detail',
            'data' =>  array(
                'result' => $result,'date'=>$date
            )
        );        

        if (isset($_POST["export"])) {
            $this->uti->export(json_decode(json_encode($result), true),'pso');
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
        } else {
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $serial_number = $this->session->userdata("serial_number");
        if ($serial_number!=""){
            $url = $this->url_general.$start_date."/".$end_date."/".$serial_number;
            $result = json_decode(file_get_contents($url));
        }else
        $result=array();
        
        $data = array(
            'action' => 'pso_stat_general', 
            'template' => 'statistic/pso/general',
            'data' =>  array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
            )
        );        

        if (isset($_POST["export"])) {
            $this->uti->export(json_decode(json_encode($result), true),'pso');
        }
        $this->load->view('home', $data);
    }
}
