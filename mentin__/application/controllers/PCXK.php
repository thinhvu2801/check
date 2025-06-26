<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PCXK extends CI_Controller {
    var $object;
    var $object_type;
    function __construct(){
        parent::__construct();
        $this->object = "pcxk";
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }

    public function detail()
    {
        if(!$this->session->userdata("username"))  redirect('user/login');
        if (isset($_POST["date"])) {
            $worker_id = $_POST["worker_id"];
            $product_id = $_POST["product_id"];
            $date = $_POST["date"];
        } else {
            $worker_id = "";
            $product_id = "";
            $date = date("Y-m-d");
        }
        $this->load->model("MPCXK");
        $this->load->model("MWorker");
        $this->load->model("MProduct");
        $worker = $this->MWorker->ReadExistIn("PCXK");
        $product = $this->MProduct->ReadExistIn("PCXK");
        $result = $this->MPCXK->Stat_Detail($date,$worker_id, $product_id);

        $data = array(
            'action' => 'stat_pcxk_detail',
            'template' => 'statistic/pcxk/detail',
            'data' => array(
                
                'result' => $result,
                'worker' => $worker,'worker_id'=>$worker_id,
                'product' => $product,'product_id'=>$product_id,
                'date'=>$date
            )
        );

        if (isset($_POST["export"])){
            $this->uti->export($result, 'pcxk-'.$date);
        }
            
        $this->load->view('home', $data);
    }

    public function product()
    {
        if(!$this->session->userdata("username"))  redirect('user/login');
        if (isset($_POST["datetime"])) {
            $product_id = $_POST["product_id"];
            $datetime = explode(" ", $_POST["datetime"]);
            $start_date = $this->uti->dateforsql($datetime[0]);
            $end_date = $this->uti->dateforsql($datetime[2]);
        } else {
            $product_id = "";
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
        }
        $this->load->model("MPCXK");
        $this->load->model("MProduct");
        $product = $this->MProduct->ReadExistIn("PCXK");
        $result = $this->MPCXK->Stat_Product($start_date,$end_date, $product_id);

        $data = array(
            'action' => 'stat_pcxk_product',
            'template' => 'statistic/pcxk/product',
            'data' => array(
                'result' => $result,
                'product' => $product,'product_id'=>$product_id,
                'start_date'=>$this->uti->dateforpicker($start_date),'end_date'=>$this->uti->dateforpicker($end_date)
            )
        );

        if (isset($_POST["export"])){
            $this->uti->export($result, 'pcxk-'.$start_date);
        }
            
        $this->load->view('home', $data);
    }

    public function worker()
    {
        if(!$this->session->userdata("username"))  redirect('user/login');
        if (isset($_POST["datetime"])) {
            $worker_id = $_POST["worker_id"];
            $product_id = $_POST["product_id"];
            $datetime = explode(" ", $_POST["datetime"]);
            $start_date = $this->uti->dateforsql($datetime[0]);
            $end_date = $this->uti->dateforsql($datetime[2]);
        } else {
            $worker_id = "";
            $product_id = "";
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
        }
        $this->load->model("MPCXK");
        $this->load->model("MWorker");
        $this->load->model("MProduct");
        $worker = $this->MWorker->ReadExistIn("PCXK");
        $product = $this->MProduct->ReadExistIn("PCXK");
        $result = $this->MPCXK->Stat_Worker($start_date,$end_date,$worker_id, $product_id);

        $data = array(
            'action' => 'stat_pcxk_worker',
            'template' => 'statistic/pcxk/worker',
            'data' => array(
                'action' => 'stat_pcxk_worker',
                'result' => $result,
                'worker' => $worker,'worker_id'=>$worker_id,
                'product' => $product,'product_id'=>$product_id,
                'start_date'=>$this->uti->dateforpicker($start_date),'end_date'=>$this->uti->dateforpicker($end_date)
            )
        );

        if (isset($_POST["export"])){
            $this->uti->export($result, 'pcxk-'.$start_date);
        }
            
        $this->load->view('home', $data);
    }
}
