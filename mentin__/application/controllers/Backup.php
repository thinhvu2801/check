<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Backup extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
    }
    public function index()
    {
        $this->load->model('MGeneral');
        $pathToSave = realpath("") . "\\MenTPS.bak";

        if (file_exists($pathToSave)) {
            unlink($pathToSave);
        } 

        $this->MGeneral->Backup($pathToSave);
        if (file_exists($pathToSave)) {
            $data = array(
                'action' => 'backup',
                'template' => 'backup/index',
                'data' => array('success'=>'1')
            );
        } else{
            $data = array(
                'action' => 'backup',
                'template' => 'backup/index',
                'data' => array('success'=>'0')
            );
        }
        
        $this->load->view('home', $data);
    }
}