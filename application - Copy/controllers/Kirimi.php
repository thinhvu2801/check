<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Statistic extends CI_Controller
{
    var $uti;
    function __construct()
    {
        parent::__construct();
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }
    
    public function kirimi_in()
    {
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
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Kirimi_In");
        $result = $this->MStatistic->Kirimi_In($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_kirimi_in', 
            'template' => 'statistic/kirimi/in',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );
        
        if (isset($_POST["export"])) {
            $this->uti->export($result, 'kirimi_in-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function kirimi_out()
    {
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
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Kirimi_Out");
        $result = $this->MStatistic->Kirimi_Out($lo_id, $start_date, $end_date, $start_time, $end_time);
        
        $data = array(
            'action' => 'stat_kirimi_out', 
            'template' => 'statistic/kirimi/out',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );
        
        if (isset($_POST["export"])) {
            $this->uti->export($result, 'kirimi_out-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }

    public function kirimi_in_detail()
    {
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
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Kirimi_In");
        $result = $this->MStatistic->Kirimi_In_Detail($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_kirimi_in_detail', 
            'template' => 'statistic/kirimi/in_detail',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'kirimi_in_detail-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }

    public function kirimi_out_detail()
    {
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
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Kirimi_Out");
        $result = $this->MStatistic->Kirimi_Out_Detail($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_kirimi_out_detail', 
            'template' => 'statistic/kirimi/out_detail',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'kirimi_out_detail-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function kirimi_in_product()
    {
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
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Kirimi_In");
        $result = $this->MStatistic->Kirimi_in_Product($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_kirimi_in_product', 
            'template' => 'statistic/kirimi/in_product',
            'data' =>array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"]))
            $this->uti->export($result, 'kirimi_in_product-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }

    public function kirimi_out_product()
    {
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
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Kirimi_Out");
        $result = $this->MStatistic->Kirimi_out_Product($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_kirimi_out_product', 
            'template' => 'statistic/kirimi/in_product',
            'data' =>array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"]))
            $this->uti->export($result, 'kirimi_out_product-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
}
