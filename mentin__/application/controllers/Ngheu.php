<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ngheu extends CI_Controller
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
            'action' => 'stat_canngheu_detail', 
            'template' => 'statistic/canngheu/detail',
            'data' =>array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($date) . " " . $end_time,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'worker' => $worker, 'worker_id' => $worker_id,
                'product' => $product,
                'process' => $process, 'process_id' => $process_id,
                'provider' => $provider, 'provider_id' => $provider_id
            )
        );

        if (isset($_POST["export"]))
            $this->uti->export($result, 'canngheu_detail-' . $date);
        $this->load->view('home', $data);
    }
    public function product()
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
            'action' => 'stat_canngheu_product', 
            'template' => 'statistic/canngheu/product',
            'data' =>array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'product' => $product,
                'process' => $process, 'process_id' => $process_id,
                'provider' => $provider, 'provider_id' => $provider_id
            )
        );

        if (isset($_POST["export"]))
            $this->uti->export($result, 'canngheu_product-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    public function worker()
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
            'action' => 'stat_canngheu_worker', 
            'template' => 'statistic/canngheu/worker',
            'data' =>array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'worker' => $worker, 'worker_id' => $worker_id,
                'process' => $process, 'process_id' => $process_id,
                'provider' => $provider, 'provider_id' => $provider_id
            )
        );

        if (isset($_POST["export"]))
            $this->uti->export($result, 'canngheu_worker-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
}
