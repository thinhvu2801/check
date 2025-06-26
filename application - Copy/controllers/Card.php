<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Card extends CI_Controller {
    public function index($LOAI=1)
    {
        if(!$this->session->userdata("username"))  redirect('user/login');
        $data = array(
            'action' => 'card', 
            'template' => 'card/index',
            'data'=>array()
        );
        $this->load->view('home',$data);
    }
    public function viewinfo(){
        if(!$this->session->userdata("username"))  redirect('user/login');
        $card_id=$_POST["card_id"];
        $this->view->base_url=base_url();
        $this->load->model("MCard");
        $data = array('card_id' =>$card_id,
        'card' =>$this->MCard->CardInfo($card_id),
        'delete_card'=>$_POST["delete_card"]);
        $this->view->parse('card/info', $data);
    }
    public function delete($card_id){
        if(!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model("MCard");
        $this->MCard->Delete($card_id);
        redirect(base_url()."card");
    }
    public function dongbo(){
        if(!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model("MCard");
        $this->MCard->Update_RFID_Status();

        $data = array(
            'action' => 'dongbo', 
            'template' => 'card/rfid',
            'data' => array()
        );

        $this->load->view("home", $data);
    }
    public function viewDongbo(){
        $this->load->model("MCard");
        $status=$this->MCard->Get_RFID_Status(1);
        $this->view->parse("card/rfid_status",array('status' =>$status));
    }
}
