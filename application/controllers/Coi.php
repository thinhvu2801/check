<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coi extends CI_Controller {
    var $object;
    var $object_type;
    function __construct(){
        parent::__construct();
        $this->object = "coi";
        $this->object_type = 16;
    }
    public function index()
    {
        if(!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($mes=""){
    	$this->load->model('MCoi');
        $data = array(
            'action' => 'coi',
            'template' => 'coi/index',
            'data' => array(
                'coi' => $this->MCoi->Read(),
                'mes' => $mes
            )
        );
       
        $this->load->view('home',$data);
    }
    
    public function Insert(){
        if (isset($_POST["coi_id"])){
        	$this->load->model('MCoi');
        	if($this->MCoi->CheckCode($_POST["coi_id"]))
        		$this->View("Mã cối đã tồn tại!");
        	else{
    	    	$data = array('coi_id' => $_POST["coi_id"],
                            'note'=>$_POST["note"]);
    	    	$this->MCoi->Insert($data);
    	    	redirect(base_url().$this->object);
        	}
        }else{
            redirect(base_url().$this->object);
        }
    }
    
    public function Update(){
        if (isset($_POST["new_coi_id"])){
            $this->load->model('MCoi');
            $this->load->model('MCard');
            if ($_POST["new_coi_id"]!=$_POST["old_coi_id"]){
                if($this->MCoi->CheckCode($_POST["new_coi_id"]))
                    $this->View("Mã cối đã tồn tại!");
                else{
                    $data = array(
                            'coi_id'=>$_POST["new_coi_id"],
                            'note'=>$_POST["note"]);    
                    $this->MCoi->Update($data,$_POST["old_coi_id"]);
                    $this->MCard->updateObjectID($_POST["old_coi_id"], $_POST["new_coi_id"], $this->object_type);
                }
            }else{
                $data = array('note'=>$_POST["note"]);    
                $this->MCoi->Update($data,$_POST["old_coi_id"]);
                $this->MCard->updateObjectID($_POST["old_coi_id"], $_POST["new_coi_id"], $this->object_type);
            }
            redirect(base_url().$this->object);
        }else{
            redirect(base_url().$this->object);
        }
    }
    public function Delete($lid){
        if(!$this->session->userdata("username")) redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
    	$this->load->model('MCoi');
        $this->MCoi->Delete($lid);
        redirect(base_url().$this->object);
    }
    public function card($coi_id=""){
        $this->load->model('MCoi');
        $coi = $this->MCoi->Read();

        $data = array(
            'action' => 'coi_card',
            'template' => 'coi/card',
            'data' => array(
                'coi' => $coi,
                'coi_id'=>$coi_id
            )
        );

        $this->load->view('home',$data);
    }
    public function card_delete(){
        if(isset($_POST["card_id"])){
            $this->load->model('MCard');
            $this->MCard->Delete($_POST["card_id"]);
        }else{
            redirect(base_url().$this->object);
        }
    }
    public function card_read(){
        if (isset($_POST["object_id"])){
            $object_id = $_POST["object_id"];
            $this->load->model('MCard');
            $card_list = $this->MCard->Card_Read_By_Object($object_id, $this->object_type);
            $data = array('card_list' => $card_list);
            $this->view->base_url=base_url();
            $this->view->parse('coi/card_read', $data);
        }else{
            redirect(base_url().$this->object);
        }
    }
    public function card_create(){
        if (isset($_POST["card_id"])){
            $card_id = $_POST["card_id"];
            $object_id = $_POST["object_id"];
            $this->load->model('MCard');
            $this->MCard->Create($card_id, $object_id, $this->object_type);
        }else{
            redirect(base_url().$this->object);
        }
    }
}
