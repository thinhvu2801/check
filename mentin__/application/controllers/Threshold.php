<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Threshold extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');

        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->Read();
        if (isset($_POST['lo_id'])) {
            $lo_id = $_POST['lo_id'];
        } else {
            $lo_id = $lohang[0]->lo_id;
        }
        if (isset($_POST["update"])) {
            $product_id = $_POST["product_id"];
            $threshold_min = $_POST["threshold_min"];
            $threshold_max = $_POST["threshold_max"];
            $len = count($product_id);
            for ($i = 0; $i < $len; $i++) {
                $data = array(
                    'lo_id' => $lo_id,
                    'product_id' => $product_id[$i],
                    'min' => $threshold_min[$i],
                    'max' => $threshold_max[$i]
                );
                if ($this->MThreshold->Exist($data))
                    $this->MThreshold->Update($data);
                else
                    $this->MThreshold->Insert($data);
            }
        }
        $data = array(
            'action' => 'threshold',
            'template' => 'threshold/index',
            'data' => array(
                'lohang' =>  $lohang,
                'lo_id' => $lo_id,
                'result' => $this->MThreshold->Read($lo_id),
            )
        );
        $this->load->view('home', $data);
    }


    // public function Fillet_Read()
    // {
    //     if (!$this->session->userdata("username"))  redirect('user/login');
    //     if (isset($_POST["date"])) {
    //         $date = $_POST["date"];
    //         $lo_id = $_POST["lo_id"];
    //     }else{
    //         $date = date("Y-m-d");
    //         $lo_id = "";
    //     }
    //     $this->load->model('MThreshold');
    //     $this->load->model('MLoHang');
    //     $lohang = $this->MLoHang->ReadExistIn("Fillet");
    //     foreach ($lohang as $lo) {
    //        $this->MThreshold->AutoUpdate_Fillet_Threshold($date, $date, $lo->lo_id);
    //     }
    //     $result = $this->MThreshold->Fillet_Threshold_Read($date,$lo_id);

    //     $data = array(
    //         'action' => "fillet_threshold",
    //         'template' => 'threshold/fillet',
    //         'data' => array(
    //             'date'=>$date,
    //             'lo_id'=>$lo_id,
    //             'lohang'=>$lohang,
    //             'result' => $result,
    //             'option' => "fillet"
    //         )
    //     );

    //     $this->load->view('home', $data);
    // }
    // public function SuaCa_Read($option="")
    // { 
    //     $weight_in = 4;
    //     if (!$this->session->userdata("username"))  redirect('user/login');
    //     if (isset($_POST["date"])) {
    //         $date = $_POST["date"];
    //         $lo_id ="";// $_POST["lo_id"];
    //         //$weight_in = $_POST["weight_in"];
    //     }else{
    //         $date = date("Y-m-d");
    //         $lo_id = "";
    //     }
    //     $this->load->model('MThreshold');
    //     $this->load->model('MLoHang');
    //     $lohang = $this->MLoHang->ReadExistIn("SuaCa");
    //     foreach ($lohang as $lo) {
    //         //$this->MThreshold->AutoUpdate_SuaCa_Threshold($date, $date, $lo->lo_id, round($weight_in,3));
    //     }
    //     $this->MThreshold->AutoUpdate_SuaCa_Threshold($date, $date, round($weight_in,3));
    //     $result = $this->MThreshold->SuaCa_Threshold_Read($date,$lo_id,$weight_in);

    //     $data = array(
    //         'action' => "suaca_threshold",
    //         'template' => 'threshold/suaca',
    //         'data' => array(
    //             'date'=>$date,
    //             'lo_id'=>$lo_id,
    //             'weight_in'=>$weight_in,
    //             'lohang'=>$lohang,
    //             'result' => $result,
    //             'option' => "suaca"
    //         )
    //     );

    //     $this->load->view('home', $data);
    // }
    // public function Update()
    // {
    //     if (!$this->session->userdata("username"))  redirect('user/login');
    //     if (isset($_POST["product_id"])) {
    //         $date= $_POST["date"];
    //         $product_id = $_POST["product_id"];
    //         $threshold = $_POST["threshold"];
    //         $option = $_POST["option"];
    //         $lo_id=$_POST["lo_id"];
    //         $len = count($product_id);
    //         $this->load->model('MThreshold');

    //         for ($i=0; $i < $len; $i++) { 
    //             $data = array('lo_id'=>$lo_id[$i],'product_id'=>$product_id[$i],'date'=>$date,'threshold'=>$threshold[$i]);
    //             if ($this->MThreshold->Exist($data))
    //                 $this->MThreshold->Update($data);
    //             else 
    //                 $this->MThreshold->Insert($data);
    //         }
    //         if ($option=="fillet")
    //             $this->Fillet_Read();
    //         else 
    //             $this->SuaCa_Read();
    //     }
    // }
}
