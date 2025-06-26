<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ErrorLog extends CI_Controller
{
    var $uti;
    function __construct()
    {
        parent::__construct();
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }
    public function detail_read()
    {
        $data_table = new DataTable();
        $this->load->model("MErrorLog");
        if (!isset($_GET["start_date"]))
            redirect(base_url());
        $start_date = explode(" ", $_GET["start_date"]);
        $end_date = explode(" ", $_GET["end_date"]);
        $data = $this->MErrorLog->Detail(
            $this->uti->dateforsql($start_date[0]),
            $start_date[1],
            $end_date[1],
            intval($_GET['start']),
            intval($_GET['length'])
        );
        $count =  $this->MErrorLog->Detail_Count(
            $this->uti->dateforsql($start_date[0]),
            $start_date[1],
            $end_date[1]
        );
        $so_luong = $count->so_luong;

        $result = $data_table::load($_GET, $data, $so_luong);
        echo $result;
    }
    public function detail()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $date = date("Y-m-d");
            $start_time = "00:00";
            $end_time = "23:59";
        }
        $this->load->model("MErrorLog");
        $total =  $this->MErrorLog->Detail_Count(
            $date,
            $start_time,
            $end_time
        );

        $data = array(
            'action' => 'errorlog_stat_detail',
            'template' => 'statistic/errorlog/detail',
            'data' => array(
                'total' => $total,
                'startDate' => $this->uti->dateforpicker($date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($date) . " " . $end_time,
            )
        );
        if (isset($_POST["export"])) {
            $result = $this->MErrorLog->Detail_Export($date, $start_time, $end_time);
            $this->uti->export($result, 'errorlog_detail-' . $date);
        }

        $this->load->view('home', $data);
    }
    public function general()
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
        $this->load->model("MErrorLog");
        $result = $this->MErrorLog->General($start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'errorlog_stat_general',
            'template' => 'statistic/errorlog/general',
            'data' => array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'errorlog-general-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
}
