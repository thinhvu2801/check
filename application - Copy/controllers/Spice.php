<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Spice extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "spice";
        $this->object_type = 14;
        $this->uti = new Utilities();
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($mes = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MSpice');

        $data = array(
            'action' => 'spice',
            'template' => 'spice/index',
            'data' => array(
                'spice' => $this->MSpice->Read(),
                'mes' => $mes
            )
        );

        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["spice_id"])) {
            $this->load->model('MSpice');
            if ($this->MSpice->CheckCode($_POST["spice_id"]))
                $this->View("Mã gia vị đã tồn tại!");
            else {
                $data = array(
                    'spice_id' => $_POST["spice_id"],
                    'spice_name' => $_POST["spice_name"]
                );
                $this->MSpice->Insert($data);
                redirect(base_url() . "spice");
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Detail(){
        $this->load->model('MSpiceProgram');
        $program_id = 0;
        $date=date("Y-m-d");    
        if (isset($_POST["date"])){
            $date=$_POST["date"];
        }
        if (isset($_POST["program_id"])){
            $program_id = $_POST["program_id"][0];
        }
        $program = $this->MSpiceProgram->Read($date);
        if ($program_id ==0 && sizeof($program)>0)
            $program_id=$program[0]->id;
        $total_spice = $this->MSpiceProgram->TotalSpice($date);
        $data_detail=$this->MSpiceProgram->Stat_Detail_ById($program_id);
        $data_general = $this->MSpiceProgram->Stat_General_ById($program_id);
        $data = array(
            'action' => 'spice_stat_detail',
            'template' => 'spiceprogram/detail',
            'data' => array(
                'date'=>$date,
                'program_id'=>$program_id,
                'program' =>$program ,
                'total_spice'=>$total_spice,
                'recipe' => $this->MSpiceProgram->ReadRecipeByProgram($program_id),
                'data_detail' =>$data_detail,
                'data_general' => $data_general,
            )
        );
        if (isset($_POST["export_detail"])) {
            $result = json_decode(json_encode($data_detail), true);
            $this->uti->export($result, 'detail-' . $date);
        }
        if (isset($_POST["export_general"])) {
            $result = json_decode(json_encode($data_general), true);
            $this->uti->export($result, 'general-' . $date);
        }
        if (isset($_POST["export_spice"])) {
            $result = json_decode(json_encode($total_spice), true);
            $this->uti->export($result, 'detail-' . $date);
        }
        $this->load->view('home', $data);
    }
    public function General(){
        $this->load->model('MSpiceProgram');
        $this->load->model('MProduct');
        $this->load->model('MSpice');
        $start_date=date("Y-m-d");    
        $end_date=date("Y-m-d");    
        $product_id="";
        $spice_id="";
        if (isset($_POST["start_date"])){
            $start_date=$_POST["start_date"];
            $end_date=$_POST["end_date"];
            $product_id=$_POST["product_id"];
            $spice_id=$_POST["spice_id"];
        }
        $result= $this->MSpiceProgram->Stat_General($product_id,$spice_id,$start_date,$end_date);
        $data = array(
            'action' => 'spice_stat_general',
            'template' => 'spiceprogram/general',
            'data' => array(
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'product'=>$this->MProduct->ReadAll(-1),
                'spice'=>$this->MSpice->Read(),
                'product_id'=>$product_id,
                'spice_id'=>$spice_id,
                'result'=> $result,
                'result_check'=> $this->MSpiceProgram->Stat_General($product_id,$spice_id,$start_date,$end_date,1)
            )
        );
        if (isset($_POST["export_general"])) {
            $result = json_decode(json_encode($result), true);
            $this->uti->export($result, 'general-' . $start_date."-".$end_date);
        }
        $this->load->view('home', $data);
    }
    public function Update()
    {
        if (isset($_POST["new_spice_id"])) {
            $this->load->model('MSpice');
            $this->load->model('MCard');
            if ($_POST["new_spice_id"] != $_POST["old_spice_id"]) {
                if ($this->MSpice->CheckCode($_POST["new_spice_id"]))
                    $this->View("Mã rổ đã tồn tại!");
                else {
                    $data = array(
                        'spice_id' => $_POST["new_spice_id"],
                        'spice_name' => $_POST["spice_name"]
                    );
                    $this->MSpice->Update($data, $_POST["old_spice_id"]);
                    $this->MCard->updateObjectID($_POST["old_spice_id"], $_POST["new_spice_id"], $this->object_type);
                }
            } else {
                $data = array('spice_name' => $_POST["spice_name"]);
                $this->MSpice->Update($data, $_POST["old_spice_id"]);
                $this->MCard->updateObjectID($_POST["old_spice_id"], $_POST["new_spice_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($spice_id)
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MSpice');
        $this->MSpice->Delete($spice_id);
        redirect(base_url() . "spice");
    }
    public function card($spice_id = "0")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MSpice');
        $spice = $this->MSpice->Read();
        $data = array(
            'action' => 'spice_card', 
            'template' => 'spice/card',
            'data' => array('spice' => $spice, 'spice_id' => $spice_id)
        );
        $this->load->view('home', $data);
    }
    public function card_delete()
    {
        if (isset($_POST["card_id"])) {
            $this->load->model('MCard');
            $this->MCard->Delete($_POST["card_id"]);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function card_read()
    {
        if (isset($_POST["object_id"])) {
            $object_id = $_POST["object_id"];
            $this->load->model('MCard');
            $card_list = $this->MCard->Card_Read_By_Object($object_id, $this->object_type);
            $data = array('card_list' => $card_list);
            $this->view->base_url = base_url();
            $this->view->parse('spice/card_read', $data);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function card_create()
    {
        if (isset($_POST["card_id"])) {
            $card_id = $_POST["card_id"];
            $object_id = $_POST["object_id"];
            $this->load->model('MCard');
            $this->MCard->Create($card_id, $object_id, $this->object_type);
        } else {
            redirect(base_url() . $this->object);
        }
    }
}
