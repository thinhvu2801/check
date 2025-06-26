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
    public function fillet_group_in()
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
        $lohang = $this->MLoHang->ReadExistIn("Fillet_Group_In");
        $result = $this->MStatistic->Fillet_Group_In($lo_id, $start_date, $end_date, $start_time, $end_time);
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
    public function fillet_group_out()
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
        $this->load->model("MGroup");
        $lohang = $this->MLoHang->ReadExistIn("Fillet_Group_Out");
        $result = $this->MStatistic->Fillet_Group_Out($lo_id, $start_date, $end_date, $start_time, $end_time);
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
    public function fillet_detail_read()
    {
        $data_table = new DataTable();
        $this->load->model("MStatistic");
        if (!isset($_GET["start_date"]))
            redirect(base_url());
        $start_date = explode(" ", $_GET["start_date"]);
        $end_date = explode(" ", $_GET["end_date"]);
        $data = $this->MStatistic->Fillet_Detail(
            $this->uti->dateforsql($start_date[0]),
            $start_date[1],
            $end_date[1],
            $_GET["worker_id"],
            $_GET["product_id"],
            $_GET["lo_id"],
            intval($_GET['start']),
            intval($_GET['length'])
        );
        $count =  $this->MStatistic->Fillet_Detail_Count(
            $this->uti->dateforsql($start_date[0]),
            $start_date[1],
            $end_date[1],
            $_GET["worker_id"],
            $_GET["product_id"],
            $_GET["lo_id"]
        );
        $so_luong = $count->so_luong;

        $result = $data_table::load($_GET, $data, $so_luong);
        echo $result;
    }

    public function fillet_detail()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_time = $datetime[5] . $datetime[6];
            $lo_id = $_POST["lo_id"];
            $product_id = $_POST["product_id"];
            $worker_id = $_POST["worker_id"];
        } else {
            $date = date("Y-m-d");
            $start_time = "00:00";
            $end_time = "23:59";
            $lo_id = "";
            $product_id = "";
            $worker_id = "";
        }
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $this->load->model("MProduct");
        $this->load->model("MWorker");
        $product = $this->MProduct->ReadExistIn("Fillet");
        $worker = $this->MWorker->ReadExistIn("Fillet");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $total =  $this->MStatistic->Fillet_Detail_Count(
            $date,
            $start_time,
            $end_time,
            $worker_id,
            $product_id,
            $lo_id
        );

        $data = array(
            'action' => 'stat_fillet_detail', 'total' => $total,
            'startDate' => $this->uti->dateforpicker($date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($date) . " " . $end_time,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'product' => $product, 'product_id' => $product_id,
            'worker' => $worker, 'worker_id' => $worker_id,
        );
        if (isset($_POST["export"])) {
            $result = $this->MStatistic->Fillet_Detail_Export($date, $start_time, $end_time, $worker_id, $product_id, $lo_id);
            $this->uti->export($result, 'fillet_detail-' . $date);
        }

        $this->load->view('home', $data);
    }
    public function fillet_product()
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
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $result = $this->MStatistic->Fillet_Product($lo_id, $start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_fillet_product', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'fillet_product-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    public function fillet_worker()
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
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        foreach ($lohang as $lo) {
            $this->MThreshold->AutoUpdate_Fillet_Threshold($start_date, $end_date, $lo->lo_id);
        }
        $result = $this->MStatistic->Fillet_Worker($lo_id, $start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_fillet_worker', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
        );
        if (isset($_POST["export"])) {
            $this->uti->export($result, 'fillet_worker-' . $start_date . '-' . $end_date);
        }

        $this->load->view('home', $data);
    }
    public function fillet_invalid()
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
        $this->load->model("MStatistic");
        $result = $this->MStatistic->Fillet_Invalid($start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_fillet_invalid', 'result' => $result,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'fillet_invalid-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    public function fillet_over_threshold()
    {
        if (isset($_POST["date"])) {
            $date = $_POST["date"];
            $lo_id = $_POST["lo_id"];
        } else {
            $date = date("Y-m-d");
            $lo_id = "";
        }
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $result = $this->MStatistic->Fillet_Over_Threshold($lo_id, $date);
        $data = array(
            'action' => 'stat_fillet_over_threshold',
            'lo_id' => $lo_id, 'lohang' => $lohang,
            'result' => $result, 'date' => $date
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'fillet_over_threshold-' . $date);
        $this->load->view('home', $data);
    }
    public function suaca_detail_read()
    {
        $data_table = new DataTable();
        $this->load->model("MStatistic");
        if (!isset($_GET["start_date"]))
            redirect(base_url());
        $start_date = explode(" ", $_GET["start_date"]);
        $end_date = explode(" ", $_GET["end_date"]);
        $data = $this->MStatistic->SuaCa_Detail(
            $this->uti->dateforsql($start_date[0]),
            $start_date[1],
            $end_date[1],
            $_GET["weight_in"],
            $_GET["worker_id"],
            $_GET["product_id"],
            $_GET["lo_id"],
            intval($_GET['start']),
            intval($_GET['length'])
        );
        $count =  $this->MStatistic->SuaCa_Detail_Count(
            $this->uti->dateforsql($start_date[0]),
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
    public function suaca_detail()
    {
        $weight_in =  4;
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $date = $this->uti->dateforsql($datetime[0]);
            $lo_id = $_POST["lo_id"];
            // $weight_in =  $_POST["weight_in"];
            $start_time = $datetime[1] . $datetime[2];
            $end_time = $datetime[5] . $datetime[6];
            $product_id = $_POST["product_id"];
            $worker_id = $_POST["worker_id"];
        } else {
            $lo_id = "";

            $date = date("Y-m-d");
            $start_time = "00:00";
            $end_time = "23:59";
            $product_id = "";
            $worker_id = "";
        }
        $this->load->model("MStatistic");
        $this->load->model("MProduct");
        $this->load->model("MWorker");
        $this->load->model("MLoHang");

        $product = $this->MProduct->ReadExistIn("SuaCa");
        $worker = $this->MWorker->ReadExistIn("SuaCa");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        $total =  $this->MStatistic->SuaCa_Detail_Count(
            $date,
            $start_time,
            $end_time,
            $weight_in,
            $worker_id,
            $product_id,
            $lo_id
        );
        $data = array(
            'action' => 'stat_suaca_detail', 'total' => $total,
            'startDate' => $this->uti->dateforpicker($date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($date) . " " . $end_time,
            'lohang' => $lohang, 'lo_id' => $lo_id, 'weight_in' => $weight_in,
            'product' => $product, 'product_id' => $product_id,
            'worker' => $worker, 'worker_id' => $worker_id
        );
        if (isset($_POST["export"])) {
            $result = $this->MStatistic->SuaCa_Detail_Export($date, $start_time, $end_time, $weight_in, $worker_id, $product_id);
            $this->uti->export($result, 'suaca_detail-' . $date);
        }

        $this->load->view('home', $data);
    }
    public function suaca_product()
    {
        $weight_in =  4;
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
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        $result = $this->MStatistic->SuaCa_Product($lo_id, $weight_in, $start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_suaca_product', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id, 'weight_in' => $weight_in,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'suaca_product-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    public function suaca_worker()
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
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        foreach ($lohang as $lo) {
            $this->MThreshold->AutoUpdate_SuaCa_Threshold($start_date, $end_date, $lo->lo_id, $weight_in);
        }
        $result = $this->MStatistic->SuaCa_Worker($lo_id, $weight_in, $start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_suaca_worker', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'weight_in' => $weight_in,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
        );
        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_worker-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function suaca_worker_no_input()
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
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        $result = $this->MStatistic->SuaCa_Worker_No_Input($lo_id, $start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_suaca_worker_no_input', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
        );
        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_worker-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function suaca_invalid()
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
        $this->load->model("MStatistic");
        $result = $this->MStatistic->SuaCa_Invalid($start_date, $end_date, $start_time, $end_time, $weight_in);
        $data = array(
            'action' => 'stat_suaca_invalid', 'result' => $result, 'weight_in' => $weight_in,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'suaca_invalid-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    public function phansize_detail()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_time = $datetime[5] . $datetime[6];
            $lo_id = $_POST["lo_id"];
            $group_id = $_POST["group_id"];
        } else {
            $date = date("Y-m-d");
            $start_time = "00:00";
            $end_time = "23:59";
            $lo_id = "";
            $group_id = "";
        }
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $this->load->model("MGroup");
        $result = $this->MStatistic->PhanSize_Detail($date, $start_time, $end_time, $lo_id, $group_id);
        $lohang = $this->MLoHang->ReadExistIn("PhanSize");
        $group = $this->MGroup->ReadExistIn("PhanSize");
        $data = array(
            'action' => 'stat_phansize_detail', 'result' => $result,
            'startDate' => $this->uti->dateforpicker($date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($date) . " " . $end_time,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'group' => $group, 'group_id' => $group_id
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'phansize_detail-' . $date);
        $this->load->view('home', $data);
    }
    public function suaca_over_threshold()
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
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        $result = $this->MStatistic->SuaCa_Over_Threshold($lo_id, $weight_in, $date);
        $data = array(
            'action' => 'stat_suaca_over_threshold',
            'lo_id' => $lo_id, 'lohang' => $lohang, 'weight_in' => $weight_in,
            'result' => $result, 'date' => $date
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'suaca_over_threshold-' . $date);
        $this->load->view('home', $data);
    }
    public function phansize_product()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $group_id = $_POST["group_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $group_id = "";
            $lo_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $this->load->model("MGroup");
        $lohang = $this->MLoHang->ReadExistIn("PhanSize");
        $group = $this->MGroup->ReadExistIn("PhanSize");
        $result = $this->MStatistic->PhanSize_Product($start_date, $end_date, $start_time, $end_time, $lo_id, $group_id);
        $data = array(
            'action' => 'stat_phansize_product', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'group' => $group, 'group_id' => $group_id,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'phansize_product-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
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
            'action' => 'stat_kirimi_in', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
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
            'action' => 'stat_kirimi_out', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
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
            'action' => 'stat_kirimi_in_detail', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
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

        // print_r($result);
        $data = array(
            'action' => 'stat_kirimi_out_detail', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
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
            'action' => 'stat_kirimi_in_product', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
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
            'action' => 'stat_kirimi_out_product', 'result' => $result,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'kirimi_out_product-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    public function canngheu_detail()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_time = $datetime[5] . $datetime[6];
            $lo_id = $_POST["lo_id"];
            $provider_id = $_POST["provider_id"];
            $product = $_POST["product"];
            $worker_id = $_POST["worker_id"];
            $process_id = $_POST["process_id"];
        } else {
            $date = date("Y-m-d");
            $start_time = "00:00";
            $end_time = "23:59";
            $lo_id = "";
            $provider_id = "";
            $product = "";
            $worker_id = "";
            $process_id = "";
        }
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $this->load->model("MWorker");
        $this->load->model("MProvider");
        $this->load->model("MProcess");
        $result = $this->MStatistic->CanNgheu_Detail($date, $start_time, $end_time, $lo_id, $provider_id, $process_id, $product, $worker_id);
        $lohang = $this->MLoHang->ReadExistIn("CanNgheu");
        $worker = $this->MWorker->ReadExistIn("CanNgheu");
        $provider = $this->MProvider->ReadExistIn("CanNgheu");
        $process = $this->MProcess->Read();
        $data = array(
            'action' => 'stat_canngheu_detail', 'result' => $result,
            'startDate' => $this->uti->dateforpicker($date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($date) . " " . $end_time,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'worker' => $worker, 'worker_id' => $worker_id,
            'product' => $product,
            'process' => $process, 'process_id' => $process_id,
            'provider' => $provider, 'provider_id' => $provider_id
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'canngheu_detail-' . $date);
        $this->load->view('home', $data);
    }
    public function canngheu_product()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $start_date = $this->uti->dateforsql($datetime[0]);
            $end_date = $this->uti->dateforsql($datetime[4]);
            $start_time = $datetime[1] . $datetime[2];
            $end_time = $datetime[5] . $datetime[6];
            $lo_id = $_POST["lo_id"];
            $provider_id = $_POST["provider_id"];
            $product = $_POST["product"];
            $process_id = $_POST["process_id"];
        } else {
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
            $start_time = "00:00";
            $end_time = "23:59";
            $lo_id = "";
            $provider_id = "";
            $product = "";
            $process_id = "";
        }
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $this->load->model("MProvider");
        $this->load->model("MProcess");
        $result = $this->MStatistic->CanNgheu_Product($start_date, $end_date, $start_time, $end_time, $lo_id, $provider_id, $process_id, $product);
        $lohang = $this->MLoHang->ReadExistIn("CanNgheu");
        $provider = $this->MProvider->ReadExistIn("CanNgheu");
        $process = $this->MProcess->Read();
        $data = array(
            'action' => 'stat_canngheu_product', 'result' => $result,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'product' => $product,
            'process' => $process, 'process_id' => $process_id,
            'provider' => $provider, 'provider_id' => $provider_id
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'canngheu_product-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    public function canngheu_worker()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $start_date = $this->uti->dateforsql($datetime[0]);
            $end_date = $this->uti->dateforsql($datetime[4]);
            $start_time = $datetime[1] . $datetime[2];
            $end_time = $datetime[5] . $datetime[6];
            $lo_id = $_POST["lo_id"];
            $provider_id = $_POST["provider_id"];
            $worker_id = $_POST["worker_id"];
            $process_id = $_POST["process_id"];
        } else {
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
            $start_time = "00:00";
            $end_time = "23:59";
            $lo_id = "";
            $provider_id = "";
            $worker_id = "";
            $process_id = "";
        }
        $this->load->model("MStatistic");
        $this->load->model("MLoHang");
        $this->load->model("MWorker");
        $this->load->model("MProvider");
        $this->load->model("MProcess");
        $result = $this->MStatistic->CanNgheu_Worker($start_date, $end_date, $start_time, $end_time, $lo_id, $provider_id, $process_id, $worker_id);
        $lohang = $this->MLoHang->ReadExistIn("CanNgheu");
        $worker = $this->MWorker->ReadExistIn("CanNgheu");
        $provider = $this->MProvider->ReadExistIn("CanNgheu");
        $process = $this->MProcess->Read();
        $data = array(
            'action' => 'stat_canngheu_worker', 'result' => $result,
            'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
            'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
            'lohang' => $lohang, 'lo_id' => $lo_id,
            'worker' => $worker, 'worker_id' => $worker_id,
            'process' => $process, 'process_id' => $process_id,
            'provider' => $provider, 'provider_id' => $provider_id
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'canngheu_worker-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
}
