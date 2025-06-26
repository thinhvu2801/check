<?php
defined('BASEPATH') or exit('No direct script access allowed');
class SpiceProgram extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "spiceprogram";
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($product_id = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MRecipe');
        $this->load->model('MSpice');
        $this->load->model('MSpiceProgram');
        $this->load->model('MProduct');
        $mes = "";
        $product = $this->MProduct->ReadAll();
        $target_weight = 0;
        $quantity=0;
        if ($product_id == "") {
            if (isset($_POST["product_id"])) {
                $product_id = $_POST["product_id"];
                $quantity = $_POST["quantity"];
                $target_weight = $_POST["target_weight"];
            }
        }

        if (isset($_POST["recipe_insert"])) {
            $this->MSpiceProgram->Insert($_POST["product_id"],$_POST["quantity"],$_POST["target_weight"]);
            redirect(base_url().$this->object);
        }
        if (isset($_POST["date"])){
            $date=$_POST["date"];
        }else{
            $date=date("Y-m-d");
        }
        
        $data = array(
            'action' => 'spice_program',
            'template' => 'spiceprogram/index',
            'data' => array(
                'program' => $this->MSpiceProgram->Read($date),
                'recipe' => $this->MSpiceProgram->ReadRecipe(),
                'data_detail' => $this->MSpiceProgram->Data_Detail($date),
                'data_general' => $this->MSpiceProgram->Data_General($date),
                'product' => $product,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'target_weight' => $target_weight,
                'date'=>$date,
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
                    'product_id' => $_POST["product_id"],
                    'min' => $_POST["min"],
                    'max' => $_POST["max"],
                );
                $this->MSpice->Insert($data);
                redirect(base_url() . $this->object);
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }
    
    public function Selected()
    {
        if (isset($_POST["selected_program"])) {
            $id = $_POST["selected_program"];
            $method=$_POST["method".$id[0]];
            $this->load->model('MSpiceProgram');
            $this->MSpiceProgram->Update($id[0],$method[0]);
            //redirect(base_url() . $this->object);
             $this->View();
        } else {
            redirect(base_url() . $this->object);
        }
    }
   
}
