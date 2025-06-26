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
   
    public function htpweightgain()
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
        $this->load->model("MWeightGain");
        $result = $this->MWeightGain->HiepThanhPhat_WeightGain($start_date);
        $data = array(
            'action' => 'stat_weightgain_general',
            'template' => 'statistic/weightgain/htp',
            'data' => array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'tangtrong-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
}
