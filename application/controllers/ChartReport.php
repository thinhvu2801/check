<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChartReport extends CI_Controller {
	public function overview(){ 
       // if(!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model("MOther");
        if (isset($_POST["thongke"])){
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
			$lo_id=$_POST["lo_id"];
           
        }else{
            $start_date=date("Y-m")."-01";
            $end_date=date("Y-m-d");
			$lo_id="";
        }
        $result=$this->MOther->OverView($start_date, $end_date);
		$this->load->model("MLoHang");
        $lohang = $this->MLoHang->Read();
		$data = array(
            'action' => 'stat_overview',
            'template' => 'statistic/overview/index',
            'data' =>  array(
				'start_date'=>$start_date,
				'end_date'=>$end_date,
				'lo_id'=>$lo_id,
				'lohang'=>$lohang,
                'result' => $result,
            )
        );
       
        $this->load->view('home',$data); 
    }
	public function index()
	{
		$this->load->model("MOther");
		$date =$_POST['date'];
		$result=$this->MOther->OverView($date, $date);
		$label_overview ="";
		$data_overview = "";
		
		if (sizeof($result)>0){
			$result = $result[0];
			$label_overview = "'Nguyên Liệu','Cắt Tiết','Phi Lê','Lạng Da','Sửa Cá'";
			//$label_overview ="'Nguyên liệu','Fillet N.Liệu','Fillet T.Phẩm ','Đầu vào T.Phẩm','Đầu ra T.Phẩm'";
		}
		$i = 1;
		foreach ($result as $value) {
			if($i>1)
				$data_overview .= $value . ",";
			$i++;
		}
		//$data_overview .="0";
		// $data = array(
        //     'action' => 'stat_hamdong_synthetic',
        //     'template' => 'statistic/overview/index',
        //     'data' =>  array(
		// 		'date'=>$date,
        //         'data_overview' => $data_overview,
        //         'label_overview' => $label_overview
        //     )
        // );

		$data = array('date'=>$date,'base_url'=>base_url(),'label_overview'=>$label_overview,'data_overview'=>$data_overview);
		$this->view->parse("statistic/overview/chart.report",$data);
	}
}