<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Working extends CI_Controller {
    var $uti;
    function __construct(){
        parent::__construct();
    }
    public function index(){ 
        $data = array(
            'action' => 'working', 
            'template' => 'statistic/working/index',
            'data' => array()
        );
        $this->load->view('home', $data);
    }
    public function nguyenlieu(){ 
        $this->load->model("MStatistic");
        $result =  $this->MStatistic->Working_NguyenLieu_Detail();
        $data = array(
            'result'=>$result,
        );
        $this->view->parse('statistic/working/nguyenlieu', $data);
    }
    public function fillet_detail(){ 
        $this->load->model("MStatistic");
        $result =  $this->MStatistic->Working_Fillet_Detail();
        $data = array(
            'result'=>$result,
        );
        $this->view->parse('statistic/working/fillet_detail', $data);
    }
   
    public function fillet_over_threshold(){
        $date = date("Y-m-d");
        $lo_id = "";
        $this->load->model("MStatistic");
        $result = $this->MStatistic->Fillet_Over_Threshold($lo_id, $date);
        $data = array(
            'result' => $result
        );
        $this->view->parse('statistic/working/fillet_over_threshold', $data);
    }
    public function suaca_detail(){ 
        $this->load->model("MStatistic");
        if (isset($_POST["weight_in"])) {
            $weight_in = $_POST["weight_in"];
        }else{
            $weight_in = 4;
        }
        $result =  $this->MStatistic->Working_SuaCa_Detail($weight_in);
        $data = array(
            'result'=>$result,
        );
        $this->view->parse('statistic/working/suaca_detail', $data);
    }

    public function suaca_over_threshold(){
        if (isset($_POST["weight_in"])) {
            $weight_in = $_POST["weight_in"];
        } else {
            $weight_in = 4;
        }
        
        $date = date("Y-m-d");
        $lo_id = "";
        $this->load->model("MStatistic");
        $result = $this->MStatistic->SuaCa_Over_Threshold($lo_id, $weight_in, $date);
        $data = array(
            'weight_in'=>$weight_in,
            'result' => $result,
        );
        $this->view->parse('statistic/working/suaca_over_threshold', $data);
    }
}
