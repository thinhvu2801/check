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
        $sum=$card_id[9]+$card_id[8]+$card_id[7]+$card_id[6]+$card_id[5];
        $typecard=$sum%10;
        $this->view->base_url=base_url();
        $this->load->model("MCard");
        if(strlen($card_id) == 10){
            $this->view->base_url=base_url();
            $this->load->model("MCard");
            $card=$this->MCard->CardInfo($card_id);
            // echo $card[0]->object_id;
                
            if(empty($card)){
                $data_rfid = array(
                    'card_id' => $card_id,
                    'date' => date("Y-m-d")
                );
                $this->MCard->Insert($data_rfid);    
            }
            $card_sl=$this->MCard->Read();
            $data = array(
                'typecard' =>$typecard,
                'card_id' =>$card_id,
                'card' =>$card,
                'card_sl' =>$card_sl,
                'delete_card'=>$_POST["delete_card"]
            );
            $this->view->parse('card/info', $data);    
        }else{
            redirect(base_url() . 'card');
        }
    }
    public function delete($card_id){
        if(!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model("MCard");
        $this->MCard->Delete($card_id);
        $this->MCard->Delete_Kho($card_id);
        redirect(base_url()."card");
    }
    public function dongbo(){
        if(!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model("MCard");
        $this->MCard->Update_RFID_Status();
        // $this->MCard->UpdateRFIDStatus();

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
    public function reset_data()
    {
        $this->load->database(); 
        $this->db->trans_start();
        $this->db->query('INSERT INTO RFID_check2 SELECT * FROM RFID_check');
        $this->db->query('DELETE FROM RFID_check');
        $this->db->trans_complete();

        redirect('card/index'); 
    }
}
