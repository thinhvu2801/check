<?php
defined('BASEPATH') or exit('No direct script access allowed');
class BaoTuBongBong extends CI_Controller
{
    var $uti;
    function __construct()
    {
        parent::__construct();
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }

    public function detail()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $worker_id = $_POST["worker_id"];
            $product_id = $_POST["product_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
            $product_id = "";
            $worker_id = "";
        }
        $this->load->model("MBaoTuBongBong");
        $this->load->model("MProduct");
        $this->load->model("MWorker");
        $product = $this->MProduct->ReadExistIn("BaoTuBongBong");
        $worker = $this->MWorker->ReadExistIn("BaoTuBongBong");
        $result = $this->MBaoTuBongBong->Detail($start_date, $end_date, $start_time, $end_time, $worker_id, $product_id);

        $data = array(
            'action' => 'stat_baotubongbong_detail',
            'template' => 'statistic/baotubongbong/detail',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
                'product' => $product, 'product_id' => $product_id,
                'worker' => $worker, 'worker_id' => $worker_id
            )
        );

        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportDetail($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }

    public function ExportDetail($data)
    {
        $this->load->model("MBaoTuBongBong");
        $result = $data["result"];
        if (sizeof($result) > 0) {
            $this->load->library('myexcel');
            $this->load->library('utilities');
            $uti = new Utilities();
            $ex = new MyExcel();
            $ex->config["pagesetup"]["orientation"] = 0; //giấy dọc
            $sheet = $ex->SetSheet(0, "ThongKe");
            $start_date = new DateTime($data["start_date"]);
            $end_date = new DateTime($data["end_date"]);
            $header = array('A1' => "THỐNG KÊ TỪ NGÀY " . $start_date->format('d/m/Y') . " ĐẾN NGÀY " . $end_date->format('d/m/Y'));
            $ex->SetValue($header);

            $headerRow = array(
                'A3' => "TT",
                'B3' => "Thời gian",
                'C3' => "Mã thẻ",
                'D3' => "Mã Công nhân",
                'E3' => "Tên Công nhân",
                'F3' => "Sản phẩm",
                'G3' => "Khối lượng",
            );
            $max_col = "G";
            $ex->mergeCells("A1:" . $max_col . "1");
            $ex->mergeCells("A2:" . $max_col . "2");
            $ex->CellAlign("A1:" . $max_col . "2", "center");
            $ex->FontStyle("A1:" . $max_col . "3", "B");
            $ex->SetValue($headerRow);
            $startRow = 4;
            $data = array();
            foreach ($result as $rs) {
                $startCol = 1;
                $i=0;
                $data["A" . $startRow] = $startRow - 3;
                foreach ($rs as $key => $value) {
                    if($i>0 && $i!=5 && $i!=8){
                        $data[$ex->column[$startCol] . $startRow] = $value;
                        $startCol++;
                    }
                    $i++;
                }
                $startRow++;
            }
            $data["G" . ($startRow)] = "=SUBTOTAL(9,G4:G" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":F" . $startRow);
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "BaoTuBongBong_detail.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function detail_edit($mes="")
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
        }else $id="";
        $this->load->model("MBaoTuBongBong");
        $this->load->model("MProduct");
        $product = $this->MProduct->ReadExistIn("BaoTuBongBong");
        $result_id = $this->MBaoTuBongBong->CheckID($id);
        $result = $this->MBaoTuBongBong->Read();
        // print_r($result_id);
        $data = array(
            'action' => 'stat_baotubongbong_detail_edit',
            'template' => 'statistic/baotubongbong/detailedit',
            'data' => array(
                'mes' => $mes,
                'result' => $result,
                'result_id' => $result_id,
                'product' => $product
            )
        );
        $this->load->view('home', $data);
    }

    public function product()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            // $lo_id = $_POST["lo_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            // $lo_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MBaoTuBongBong");
        $result = $this->MBaoTuBongBong->Product($start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_baotubongbong_product',
            'template' => 'statistic/baotubongbong/product',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportProduct($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }

    public function ExportProduct($data)
    {
        $this->load->model("MBaoTuBongBong");
        $result = $data["result"];
        if (sizeof($result) > 0) {
            $this->load->library('myexcel');
            $this->load->library('utilities');
            $uti = new Utilities();
            $ex = new MyExcel();
            $ex->config["pagesetup"]["orientation"] = 0; //giấy dọc
            $sheet = $ex->SetSheet(0, "ThongKe");
            $start_date = new DateTime($data["start_date"]);
            $end_date = new DateTime($data["end_date"]);
            $header = array('A1' => "THỐNG KÊ TỪ NGÀY " . $start_date->format('d/m/Y') . " ĐẾN NGÀY " . $end_date->format('d/m/Y'));
            $ex->SetValue($header);

            $headerRow = array(
                'A3' => "TT",
                'B3' => "Mã sản phẩm",
                'C3' => "Tên sản phẩm",
                'D3' => "Khối lượng",
            );
            $max_col = "D";
            $ex->mergeCells("A1:" . $max_col . "1");
            $ex->mergeCells("A2:" . $max_col . "2");
            $ex->CellAlign("A1:" . $max_col . "2", "center");
            $ex->FontStyle("A1:" . $max_col . "3", "B");
            $ex->SetValue($headerRow);
            $startRow = 4;
            $data = array();
            foreach ($result as $rs) {
                $startCol = 1;
                $data["A" . $startRow] = $startRow - 3;
                foreach ($rs as $key => $value) {
                    $data[$ex->column[$startCol] . $startRow] = $value;
                    $startCol++;
                }
                $startRow++;
            }
            $data["D" . ($startRow)] = "=SUBTOTAL(9,D4:D" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":C" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "SanPham.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }

    public function worker()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MBaoTuBongBong");
        $result = $this->MBaoTuBongBong->Worker($start_date, $end_date, $start_time, $end_time);
        $datatest = array();
        $data = array(
            'action' => 'stat_baotubongbong_worker',
            'template' => 'statistic/baotubongbong/worker',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportWorker($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } 

        $this->load->view('home', $data);
    }

    public function ExportWorker($data)
    {
        $result = $data["result"];
        if (sizeof($result) > 0) {
            $this->load->library('myexcel');
            $this->load->library('utilities');
            $uti = new Utilities();
            $ex = new MyExcel();
            $ex->config["pagesetup"]["orientation"] = 0; //giấy dọc
            $sheet = $ex->SetSheet(0, "ThongKe");
            $start_date = new DateTime($data["start_date"]);
            $end_date = new DateTime($data["end_date"]);
            $header = array('A1' => "THỐNG KÊ TỪ NGÀY " . $start_date->format('d/m/Y') . " ĐẾN NGÀY " . $end_date->format('d/m/Y'));
            $ex->SetValue($header);

            $headerRow = array(
                'A3' => "TT",
                'B3' => "Mã CN",
                'C3' => "Tên CN",
                'D3' => "SP",
                'E3' => "KL trước 18h30",
                'F3' => "KL sau 18h30",
                'G3' => "KL Tổng",
            );
            $max_col = "G";
            $ex->mergeCells("A1:" . $max_col . "1");
            $ex->mergeCells("A2:" . $max_col . "2");
            $ex->CellAlign("A1:" . $max_col . "2", "center");
            $ex->CellAlign("A3:" . $max_col . "3", "center");
            $ex->FontStyle("A1:" . $max_col . "3", "B");
            $ex->SetValue($headerRow);
            $startRow = 4;
            $data = array();
            foreach ($result as $rs) {
                if ($rs['product_name'] === 'Bao Tử') {
                    $startCol = 1;
                    $data["A" . $startRow] = $startRow - 3;
                    foreach ($rs as $key => $value) {
                        // $data[$ex->column[$startCol] . $startRow] = $value;
                        if (($key === 'weight_before_18' && $value == 0)||($key === 'weight_after_18' && $value == 0)) {
                            $data[$ex->column[$startCol] . $startRow] = '-';
                        } else {
                            $data[$ex->column[$startCol] . $startRow] = $value;
                        }
                        $startCol++;
                    }
                    $startRow++;
                }
            }
            $data["E" . ($startRow)] = "=SUBTOTAL(9,E4:E" . ($startRow - 1) . ")";
            $data["F" . ($startRow)] = "=SUBTOTAL(9,F4:F" . ($startRow - 1) . ")";
            $data["G" . ($startRow)] = "=SUBTOTAL(9,G4:G" . ($startRow - 1) . ")";
            $ex->SetColor("A".$startRow.":" . $max_col . $startRow);
            $ex->mergeCells("A" . $startRow . ":D" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";
            
            $startrowbb=$startRow + 1;
            $startRow = $startRow + 1;
            // $data = array();
            foreach ($result as $rs) {
                if ($rs['product_name'] === 'Bong Bóng') {
                    $startCol = 1;
                    $data["A" . $startRow] = $startRow - 3;
                    foreach ($rs as $key => $value) {
                        // $data[$ex->column[$startCol] . $startRow] = $value;
                        if (($key === 'weight_before_18' && $value == 0)||($key === 'weight_after_18' && $value == 0)) {
                            $data[$ex->column[$startCol] . $startRow] = '-';
                        } else {
                            $data[$ex->column[$startCol] . $startRow] = $value;
                        }
                        $startCol++;
                    }
                    $startRow++;
                }
            }
            $data["E" . ($startRow)] = "=SUBTOTAL(9,E".$startrowbb.":E" . ($startRow - 1) . ")";
            $data["F" . ($startRow)] = "=SUBTOTAL(9,F".$startrowbb.":F" . ($startRow - 1) . ")";
            $data["G" . ($startRow)] = "=SUBTOTAL(9,G".$startrowbb.":G" . ($startRow - 1) . ")";
            $ex->SetColor("A".$startRow.":" . $max_col . $startRow);
            $ex->mergeCells("A" . $startRow . ":D" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->CellAlign("E4:" . $max_col . $startRow, "center");
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "CongNhan-" . $start_date->format('d-m-Y') . "-" . $end_date->format('d-m-Y') .".xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function Update()
    {
        $this->load->model('MBaoTuBongBong');
        if($this->MBaoTuBongBong->CheckCode($_POST["id"])){
            $this->detail_edit("Mỗi công nhân chỉ được sửa 1 lần");
        }else{
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $today = date("d-m-Y");
            $time_now = date('H:i:s');
            $data = array(
                'product_id' => $_POST["product_id"],
                'note' => 1,
            );
            $note = $this->session->userdata("username"). " " ."sửa sản phẩm ". " ". $_POST["old_product_id"]. " thành ".$_POST["product_id"]. " lúc " . $time_now ." ngày ". $today;
            $data_edit = array(
                'id' => $_POST["id"],
                'worker_id' => $_POST["worker_id"],
                'product_id' => $_POST["product_id"],
                'weight' => $_POST["weight"],
                'date' => $_POST["date"],
                'time' => $_POST["time"],
                'note' => $note
            );
            $this->MBaoTuBongBong->Update($data, $_POST["id"]);
            $this->MBaoTuBongBong->Insert($data_edit);
            redirect(base_url() . "baotubongbong/detail_edit");
        }
        // redirect(base_url() . "baotubongbong/detail_edit");
    }
    public function dauxuong()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MBaoTuBongBong");
        $result = $this->MBaoTuBongBong->DauXuong($start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_baotubongbong_dauxuong',
            'template' => 'statistic/baotubongbong/dauxuong',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
            )
        );

        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportDauXuong($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }

    public function ExportDauXuong($data)
    {
        $result = $data["result"];
        if (sizeof($result) > 0) {
            $this->load->library('myexcel');
            $this->load->library('utilities');
            $uti = new Utilities();
            $ex = new MyExcel();
            $ex->config["pagesetup"]["orientation"] = 0; //giấy dọc
            $sheet = $ex->SetSheet(0, "ThongKe");
            $start_date = new DateTime($data["start_date"]);
            $end_date = new DateTime($data["end_date"]);
            $header = array('A1' => "THỐNG KÊ TỪ NGÀY " . $start_date->format('d/m/Y') . " ĐẾN NGÀY " . $end_date->format('d/m/Y'));
            $ex->SetValue($header);

            $headerRow = array(
                'A3' => "TT",
                'B3' => "Ngày",
                'C3' => "Thời gian",
                'D3' => "Khối lượng",
            );
            $max_col = "D";
            $ex->mergeCells("A1:" . $max_col . "1");
            $ex->mergeCells("A2:" . $max_col . "2");
            $ex->CellAlign("A1:" . $max_col . "2", "center");
            $ex->FontStyle("A1:" . $max_col . "3", "B");
            $ex->SetValue($headerRow);
            $startRow = 4;
            $data = array();
            foreach ($result as $rs) {
                $startCol = 1;
                $data["A" . $startRow] = $startRow - 3;
                foreach ($rs as $key => $value) {
                    $data[$ex->column[$startCol] . $startRow] = $value;
                    $startCol++;
                }
                $startRow++;
            }
            $data["D" . ($startRow)] = "=SUBTOTAL(9,D4:D" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":C" . $startRow);
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "DauXuong.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    
    public function pscgeneral()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            // $lo_id = $_POST["lo_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            // $lo_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MBaoTuBongBong");
        $result = $this->MBaoTuBongBong->PSCGeneral($start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_baotubongbong_pscgeneral',
            'template' => 'statistic/baotubongbong/general',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportPSCGeneral($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }

    public function ExportPSCGeneral($data)
    {
        $this->load->model("MBaoTuBongBong");
        $result = $data["result"];
        if (sizeof($result) > 0) {
            $this->load->library('myexcel');
            $this->load->library('utilities');
            $uti = new Utilities();
            $ex = new MyExcel();
            $ex->config["pagesetup"]["orientation"] = 0; //giấy dọc
            $sheet = $ex->SetSheet(0, "ThongKe");
            $start_date = new DateTime($data["start_date"]);
            $end_date = new DateTime($data["end_date"]);
            $header = array('A1' => "THỐNG KÊ TỪ NGÀY " . $start_date->format('d/m/Y') . " ĐẾN NGÀY " . $end_date->format('d/m/Y'));
            $ex->SetValue($header);

            $headerRow = array(
                'A3' => "TT",
                'B3' => "Ngày",
                'C3' => "Tên sản phẩm",
                'D3' => "Khối lượng",
            );
            $max_col = "D";
            $ex->mergeCells("A1:" . $max_col . "1");
            $ex->mergeCells("A2:" . $max_col . "2");
            $ex->CellAlign("A1:" . $max_col . "2", "center");
            $ex->FontStyle("A1:" . $max_col . "3", "B");
            $ex->SetValue($headerRow);
            $startRow = 4;
            $data = array();
            foreach ($result as $rs) {
                $startCol = 1;
                $data["A" . $startRow] = $startRow - 3;
                foreach ($rs as $key => $value) {
                    $data[$ex->column[$startCol] . $startRow] = $value;
                    $startCol++;
                }
                $startRow++;
            }
            $data["D" . ($startRow)] = "=SUBTOTAL(9,D4:D" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":C" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "General" . $start_date->format('d/m/Y') . " ĐẾN NGÀY " . $end_date->format('d/m/Y') .".xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
}
