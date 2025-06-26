<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Other extends CI_Controller
{
    public function overview()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model("MStatistic");
        if (isset($_POST["thongke"])) {
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
        } else {
            $start_date = date("Y-m") . "-01";
            $end_date = date("Y-m-d");
        }
        $result = $this->MStatistic->OverView($start_date, $end_date);

        $data = array(
            'action' => 'stat_overview',
            'template' => 'statistic/overview/index',
            'data' => array(
                'start_date' => $start_date, 'end_date' => $end_date,
                'result' => $result
            )
        );

        $this->load->view('home', $data);
    }
}
