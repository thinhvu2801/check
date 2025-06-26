<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ShrimpPurchase extends CI_Controller
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
        $weight_in = 4;
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            //  $weight_in =  $_POST["weight_in"];
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        // foreach ($lohang as $lo) {
        //     $this->MThreshold->AutoUpdate_SuaCa_Threshold($start_date, $end_date, $lo->lo_id, $weight_in);
        // }
        $result = $this->MSuaCa->Worker($lo_id, $weight_in, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_suaca_worker',
            'template' => 'statistic/suaca/worker',
            'data' =>  array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'weight_in' => $weight_in,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
           $this->uti->export($result, 'suaca_worker'.$start_date);
        }
        $this->load->view('home', $data);
    }

    public function qcworker_detail()
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");

        $result = $this->MSuaCa->QCWorkerDetail($lo_id, $start_date, $end_date);

        $data = array(
            'action' => 'stat_suaca_qcworker_detail',
            'template' => 'statistic/suaca/qcworker_detail',
            'data' =>  array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_qcworker-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function qcworker_general()
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");

        $result = $this->MSuaCa->QCWorkerGeneral($lo_id, $start_date, $end_date);

        $data = array(
            'action' => 'stat_suaca_qcworker_general',
            'template' => 'statistic/suaca/qcworker_general',
            'data' =>  array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_qcworker-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function overtime()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $max_minute = $_POST["max_minute"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $max_minute = 80;
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");

        $result = $this->MSuaCa->OverTime($lo_id, $max_minute, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_suaca_overtime',
            'template' => 'statistic/suaca/overtime',
            'data' =>  array(
                'result' => $result,
                'max_minute' => $max_minute,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_overtime-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function worker_total()
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");

        $result = $this->MSuaCa->Worker_Total($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_suaca_worker_total',
            'template' => 'statistic/suaca/worker_total',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );


        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_worker-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function worker_no_input()
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        $result = $this->MSuaCa->Worker_No_Input($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_suaca_worker_no_input',
            'template' => 'statistic/suaca/no_input',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_no_input-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function no_output()
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        $result = $this->MSuaCa->Worker_No_Output($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_suaca_worker_no_output',
            'template' => 'statistic/suaca/no_output',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_no_output-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function invalid()
    {
        $weight_in = 4;
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
        $this->load->model("MSuaCa");
        $result = $this->MSuaCa->Invalid($start_date, $end_date, $start_time, $end_time, $weight_in);
        $data = array(
            'action' => 'stat_suaca_invalid',
            'template' => 'statistic/suaca/invalid',
            'data' => array(
                'result' => $result, 'weight_in' => $weight_in,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"]))
            $this->uti->export($result, 'suaca_invalid-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }

    public function over_threshold()
    {
        $weight_in = 4;
        if (isset($_POST["date"])) {
            $date = $_POST["date"];
            $lo_id = $_POST["lo_id"];
            // $weight_in = $_POST["weight_in"];
        } else {
            $date = date("Y-m-d");
            $lo_id = "";
        }
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        $result = $this->MSuaCa->Over_Threshold($lo_id, $weight_in, $date);
        $data = array(
            'action' => 'stat_suaca_over_threshold',
            'template' => 'statistic/suaca/over_threshold',
            'data' => array(
                'lo_id' => $lo_id, 'lohang' => $lohang, 'weight_in' => $weight_in,
                'result' => $result, 'date' => $date
            )
        );

        if (isset($_POST["export"]))
            $this->uti->export($result, 'suaca_over_threshold-' . $date);
        $this->load->view('home', $data);
    }
}
