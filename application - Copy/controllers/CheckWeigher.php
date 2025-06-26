<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckWeigher extends CI_Controller {
    public function index(){ 
        if(!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model("MCheckWeigher");
        if (isset($_POST["thongke"])){
            $date = $_POST["date"];
           
        }else{
            $date=date("Y-m-d");
        }
        $result=$this->MCheckWeigher->Statistic($date);
        $data = array('action' => 'checkweigher',
        'date'=>$date,
        'result'=>$result);
        if (isset($_POST["export"])){
            $linkDownload = $this->export($data);
            if ($linkDownload!="")
                redirect(base_url().$linkDownload);
        }else{
            $this->load->view('home',$data); 
        }
        //$this->load->view('home',$data); 
    }
    public function export($data){
        $result = $data["result"];
        if (sizeof($result)>0) {
            $this->load->library('myexcel');
            $this->load->library('utilities');
            $uti=new Utilities();
            $ex=new MyExcel();
            $ex->config["pagesetup"]["orientation"]=1;//giấy ngang
            $sheet=$ex->SetSheet(0,"ThongKe");
            $date = new DateTime($data["date"]); 
            
            $header =array('A1' => "THỐNG KÊ NGÀY ".$date->format('d/m/Y'),
                    'A2'=>"");
            $ex->SetValue($header);

            /*-------------Liệt kê nguyên liệu--------*/
            $ex->setWidth(array('A' =>3.5,'B'=>20,'C'=>15,'D'=>10,'E'=>10));
            $headerRow = array(
                'A3'=>"TT",
                // 'B3'=>"Sản phẩm",
                'B3'=>"Size",
                'C3'=>"Số lượng",
                'D3'=>"Khối lượng",
            );
            $ex->mergeCells("A1:E1");
            $ex->mergeCells("A2:E2");
            $ex->CellAlign("A1:E2","center");
            $ex->FontStyle("A1:E3","B");
            $ex->SetValue($headerRow);
            $startRow = 4;
            $data  = array();
            foreach ($result as $rs) {
                if ($rs["size"]!="Total"){
                    $data["A".$startRow] = $startRow - 3;
                    // $data["B".$startRow] = $rs["product"];//
                    $data["B".$startRow] = $rs["size"];
                    $data["C".$startRow] = $rs["quantity"];
                    $data["D".$startRow] = $rs["weight"];
                    $startRow++;
                }
            }
            $data["C".($startRow)] = "=SUM(C4:C".($startRow-1).")";
             $data["D".($startRow)] = "=SUM(D4:D".($startRow-1).")";
            $ex->mergeCells("A".$startRow.":B".$startRow);
            $data["A".$startRow] = "Tổng cộng:";
            $ex->SetBorder("A3:D".$startRow);
            $ex->SetValue($data);
            $linkDownload="checkweigher".".xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        }else{
            return "";
        }
    }
}
