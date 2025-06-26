<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Me extends CI_Controller {
    var $object;
    var $object_type;
    function __construct(){
        parent::__construct();
        $this->object = "me";
        $this->object_type = 13;
    }
    public function index()
    {
        if(!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($mes=""){
    	$this->load->model('MMe');
        $data = array(
            'action' => 'me',
            'template' => 'me/index',
            'data' => array(
                'me' => $this->MMe->Read(),
                'mes' => $mes
            )
        );
       
        $this->load->view('home',$data);
    }
    
    public function Insert(){
        if (isset($_POST["me_id"])){
        	$this->load->model('MMe');
        	if($this->MMe->CheckCode($_POST["me_id"]))
        		$this->View("Mã mẻ đã tồn tại!");
        	else{
    	    	$data = array('me_id' => $_POST["me_id"],
                            'note'=>$_POST["note"]);
    	    	$this->MMe->Insert($data);
    	    	redirect(base_url()."me");
        	}
        }else{
            redirect(base_url().$this->object);
        }
    }
    
    public function Update(){
        if (isset($_POST["new_me_id"])){
            $this->load->model('MMe');
            $this->load->model('MCard');
            if ($_POST["new_me_id"]!=$_POST["old_me_id"]){
                if($this->MMe->CheckCode($_POST["new_me_id"]))
                    $this->View("Mã mẻ đã tồn tại!");
                else{
                    $data = array(
                            'me_id'=>$_POST["new_me_id"],
                            'note'=>$_POST["note"]);    
                    $this->MMe->Update($data,$_POST["old_me_id"]);
                    $this->MCard->updateObjectID($_POST["old_me_id"], $_POST["new_me_id"], $this->object_type);
                }
            }else{
                $data = array('note'=>$_POST["note"]);    
                $this->MMe->Update($data,$_POST["old_me_id"]);
                $this->MCard->updateObjectID($_POST["old_me_id"], $_POST["new_me_id"], $this->object_type);
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
    	$this->load->model('MMe');
        $this->MMe->Delete($lid);
        redirect(base_url()."me");
    }
    public function card($me_id=""){
        $this->load->model('MMe');
        $me = $this->MMe->Read();

        $data = array(
            'action' => 'me_card',
            'template' => 'me/card',
            'data' => array(
                'me' => $me,
                'me_id'=>$me_id
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
            $this->view->parse('me/card_read', $data);
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
