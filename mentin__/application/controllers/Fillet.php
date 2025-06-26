<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Fillet extends CI_Controller
{
    var $uti;
    function __construct()
    {
        parent::__construct();
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }
    public function group_in()
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
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Fillet_Group_In");
        $result = $this->MFillet->Fillet_Group_In($lo_id, $start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_fillet_group_in', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'fillet_group_in-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    public function group_out()
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
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $this->load->model("MGroup");
        $lohang = $this->MLoHang->ReadExistIn("Fillet_Group_Out");
        $result = $this->MFillet->Fillet_Group_Out($lo_id, $start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_fillet_group_out', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
        );
        if (isset($_POST["export"])) {
            $this->uti->export($result, 'fillet_group_out-' . $start_date . '-' . $end_date);
        }

        $this->load->view('home', $data);
    }
    public function detail_read()
    {
        $data_table = new DataTable();
        $this->load->model("MFillet");
        if (!isset($_GET["start_date"]))
            redirect(base_url());
        $start_date = explode(" ", $_GET["start_date"]);
        $end_date = explode(" ", $_GET["end_date"]);
        $data = $this->MFillet->Detail(
            $this->uti->dateforsql($start_date[0]),
            $this->uti->dateforsql($end_date[0]),
            $start_date[1],
            $end_date[1],
            $_GET["weight_in"],
            $_GET["worker_id"],
            $_GET["product_id"],
            $_GET["lo_id"],
            intval($_GET['start']),
            intval($_GET['length'])
        );
        $count =  $this->MFillet->Detail_Count(
            $this->uti->dateforsql($start_date[0]),
            $this->uti->dateforsql($end_date[0]),
            $start_date[1],
            $end_date[1],
            $_GET["weight_in"],
            $_GET["worker_id"],
            $_GET["product_id"],
            $_GET["lo_id"]
        );
        $so_luong = $count->so_luong;

        $result = $data_table::load($_GET, $data, $so_luong);
        echo $result;
    }

    public function detail()
    {
        $weight_in =  4;
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $start_date = $this->uti->dateforsql($datetime[0]);
            $end_date = $this->uti->dateforsql($datetime[4]);
            $lo_id = $_POST["lo_id"];
            // $weight_in =  $_POST["weight_in"];
            $start_time = $datetime[1] . $datetime[2];
            $end_time = $datetime[5] . $datetime[6];
            $product_id = $_POST["product_id"];
            $worker_id = $_POST["worker_id"];
        } else {
            $lo_id = "";

            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
            $start_time = "00:00";
            $end_time = "23:59";
            $product_id = "";
            $worker_id = "";
        }
        $this->load->model("MFillet");
        $this->load->model("MProduct");
        $this->load->model("MWorker");
        $this->load->model("MLoHang");

        $product = $this->MProduct->ReadExistIn("Fillet");
        $worker = $this->MWorker->ReadExistIn("Fillet");
        $lohang = $this->MLoHang->Read("Fillet");
        $total =  $this->MFillet->Detail_Count(
            $start_date,
            $end_date,
            $start_time,
            $end_time,
            $weight_in,
            $worker_id,
            $product_id,
            $lo_id
        );

        $data = array(
            'action' => 'stat_fillet_detail',
            'template' => 'statistic/fillet/detail',
            'data' => array(
                'total' => $total,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
                'lohang' => $lohang, 'lo_id' => $lo_id, 'weight_in' => $weight_in,
                'product' => $product, 'product_id' => $product_id,
                'worker' => $worker, 'worker_id' => $worker_id
            )
        );
        if (isset($_POST["export"])) {
            $result = $this->MFillet->Detail_Export($start_date, $end_date, $start_time, $end_time, $weight_in, $worker_id, $product_id);
            $this->uti->export($result, 'fillet_detail-' . $start_date);
        }

        $this->load->view('home', $data);
    }
    public function product()
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
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $result = $this->MFillet->Product($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_product',
            'template' => 'statistic/fillet/product',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"]))
            $this->uti->export($result, 'fillet_product-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    public function worker()
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
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        foreach ($lohang as $lo) {
            $this->MThreshold->AutoUpdate_Fillet_Threshold($start_date, $end_date, $lo->lo_id);
        }
        $result = $this->MFillet->Worker($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_worker', 
            'template' => 'statistic/fillet/worker',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'fillet_worker-' . $start_date . '-' . $end_date);
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
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");

        $result = $this->MFillet->OverTime($lo_id, $max_minute, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_overtime',
            'template' => 'statistic/fillet/overtime',
            'data' =>  array(
                'result' => $result,
                'max_minute' => $max_minute,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'fillet_overtime-' . $start_date . '-' . $end_date);
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
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");

        $result = $this->MFillet->Worker_Total($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_worker_total',
            'template' => 'statistic/fillet/worker_total',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );


        if (isset($_POST["export"])) {
            $this->uti->export($result, 'fillet_worker-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function no_input()
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
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $result = $this->MFillet->Worker_No_Input($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_worker_no_input',
            'template' => 'statistic/fillet/no_input',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'fillet_no_input-' . $start_date . '-' . $end_date);
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
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $result = $this->MFillet->Worker_No_Output($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_worker_no_output',
            'template' => 'statistic/fillet/no_output',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'fillet_no_output-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function invalid()
    {
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
        $this->load->model("MFillet");
        $result = $this->MFillet->Invalid($start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_invalid', 
            'template' => 'statistic/fillet/invalid',
            'data' => array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"]))
            $this->uti->export($result, 'fillet_invalid-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    public function over_threshold()
    {
        if (isset($_POST["date"])) {
            $date = $_POST["date"];
            $lo_id = $_POST["lo_id"];
        } else {
            $date = date("Y-m-d");
            $lo_id = "";
        }
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $result = $this->MFillet->Over_Threshold($lo_id, $date);

        $data = array(
            'action' => 'stat_fillet_over_threshold',
            'template' => 'statistic/fillet/over_threshold',
            'data' => array(
                'lo_id' => $lo_id, 'lohang' => $lohang,
                'result' => $result, 'date' => $date
            )
        );

        if (isset($_POST["export"]))
            $this->uti->export($result, 'fillet_over_threshold-' . $date);
        $this->load->view('home', $data);
    }


    public function working()
    {
        $data = array(
            'action' => 'stat_fillet_working',
            'template' => 'statistic/fillet/working_index',
            'data' => array(
            )
        );
        $this->load->view('home', $data);
    }
    public function workingcontent()
    {
        $this->load->model("MFillet");
        $result_in = $this->MFillet->WorkingIn(100);
        $result_out = $this->MFillet->WorkingOut(100);
        $data = array(
            'result_in' => $result_in,
            'result_out' => $result_out,
        );
        $this->view->parse('statistic/fillet/working_content', $data);
    }
}
