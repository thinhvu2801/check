<?php
defined('BASEPATH') or exit('No direct script access allowed');
class WeightGain extends CI_Controller
{
    var $uti;
    function __construct()
    {
        parent::__construct();
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }
   
    public function detail()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $coi_id = $_POST["coi_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $coi_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MWeightGain");
        $this->load->model("MLoHang");
        $this->load->model("MProduct");
        $lohang = $this->MLoHang->ReadExistIn("WeightGain");
        $product = $this->MProduct->ReadExistIn("WeightGain");
        $result = $this->MWeightGain->Detail($start_date, $end_date, $start_time, $end_time,$lo_id,$coi_id);
        $data = array(
            'action' => 'stat_weightgain_detail',
            'template' => 'statistic/weightgain/detail',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id, 
                'product' => $product, 'coi_id' => $coi_id, 
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'weightgain-detail-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    public function general()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $coi_id = $_POST["coi_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $coi_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MWeightGain");
        $this->load->model("MLoHang");
        $this->load->model("MProduct");
        $lohang = $this->MLoHang->ReadExistIn("WeightGain");
        $product = $this->MProduct->ReadExistIn("WeightGain");
        $result = $this->MWeightGain->General($start_date, $end_date, $start_time, $end_time,$lo_id,$coi_id);
        $data = array(
            'action' => 'stat_weightgain_general',
            'template' => 'statistic/weightgain/general',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id, 
                'product' => $product, 'coi_id' => $coi_id, 
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'suaca_product-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    
}
