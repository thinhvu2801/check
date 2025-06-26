<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		if(!$this->session->userdata("username"))  redirect('user/login');
		$data = array('action' => 'home');
		$this->load->view('home', $data);
	}
	function data_read($result){
		$data = "";
		foreach ($result as $rs) {
			$data.=$rs->weight.",";
		}
		return $data;
	}
	function label_read($result){
		$data = "";
		foreach ($result as $rs) {
			$data.="'".$rs->product_name." (".$rs->weight.")',";
		}
		return $data;
	}
}
