<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Fillet extends CI_Controller
{
    var $uti;
    function __construct()
    {
        parent::__construct();
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }
   
    public function detail_read()
    {
        $data_table = new DataTable();
        $this->load->model("MFillet");
        if (!isset($_GET["start_date"]))
            redirect(base_url());
        $start_date = explode(" ", $_GET["start_date"]);
        $end_date = explode(" ", $_GET["end_date"]);
        $data = $this->MFillet->Detail(
            $this->uti->dateforsql($start_date[0]),
            $this->uti->dateforsql($end_date[0]),
            $start_date[1],
            $end_date[1],
            $_GET["weight_in"],
            $_GET["worker_id"],
            $_GET["product_id"],
            $_GET["lo_id"],
            intval($_GET['start']),
            intval($_GET['length'])
        );
        $count =  $this->MFillet->Detail_Count(
            $this->uti->dateforsql($start_date[0]),
            $this->uti->dateforsql($end_date[0]),
            $start_date[1],
            $end_date[1],
            $_GET["weight_in"],
            $_GET["worker_id"],
            $_GET["product_id"],
            $_GET["lo_id"]
        );
        $so_luong = $count->so_luong;

        $result = $data_table::load($_GET, $data, $so_luong);
        echo $result;
    }

    public function detail()
    {
        $weight_in =  4;
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $start_date = $this->uti->dateforsql($datetime[0]);
            $end_date = $this->uti->dateforsql($datetime[4]);
            $lo_id = $_POST["lo_id"];
            // $weight_in =  $_POST["weight_in"];
            $start_time = $datetime[1] . $datetime[2];
            $end_time = $datetime[5] . $datetime[6];
            $product_id = $_POST["product_id"];
            $worker_id = $_POST["worker_id"];
        } else {
            $lo_id = "";

            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
            $start_time = "00:00";
            $end_time = "23:59";
            $product_id = "";
            $worker_id = "";
        }
        $this->load->model("MFillet");
        $this->load->model("MProduct");
        $this->load->model("MWorker");
        $this->load->model("MLoHang");

        $product = $this->MProduct->ReadExistIn("Fillet");
        $worker = $this->MWorker->ReadExistIn("Fillet");
        $lohang = $this->MLoHang->Read("Fillet");
        // $total =  $this->MFillet->Detail_Count(
        //     $start_date,
        //     $end_date,
        //     $start_time,
        //     $end_time,
        //     $weight_in,
        //     $worker_id,
        //     $product_id,
        //     $lo_id
        // );
        $result=$this->MFillet->Detail(
            $start_date,
            $end_date,
            $start_time,
            $end_time,
            $worker_id,
            $product_id,
            $lo_id
        );

        $data = array(
            'action' => 'stat_fillet_detail',
            'template' => 'statistic/fillet/detail',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $this->MFillet->Detail_Export($start_date, $end_date, $start_time, $end_time, $weight_in, $worker_id, $product_id),
            'data' => array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
                'lohang' => $lohang, 'lo_id' => $lo_id, 'weight_in' => $weight_in,
                'product' => $product, 'product_id' => $product_id,
                'worker' => $worker, 'worker_id' => $worker_id
            )
        );
        // if (isset($_POST["export"])) {
        //     $result = $this->MFillet->Detail_Export($start_date, $end_date, $start_time, $end_time, $weight_in, $worker_id, $product_id);
        //     $this->uti->export($result, 'fillet_detail-' . $start_date);
        // }

        // $this->load->view('home', $data);
        
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
        $this->load->model("MFillet");
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
                'B3' => "Lô",
                'C3' => "Mã công nhân",
                'D3' => "Tên công nhân",
                'E3' => "Mã sản phẩm",
                'F3' => "Tên sản phẩm",
                'G3' => "Khối lượng vào",
                'H3' => "Khối lượng ra",
                'I3' => "Định mức",
                'J3' => "TT vào",
                'K3' => "Thời gian vào",
                'L3' => "TT ra",
                'M3' => "Thời gian ra",
                'N3' => "Thời gian hoàn thành"
            );
            $max_col = "N";
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
            $data["G" . ($startRow)] = "=SUBTOTAL(9,G4:G" . ($startRow - 1) . ")";
            $data["H" . ($startRow)] = "=SUBTOTAL(9,H4:H" . ($startRow - 1) . ")";
            $data["I" . ($startRow)] = "=ROUND(G" . $startRow . "/H" . $startRow . ",3)";
            $ex->mergeCells("A" . $startRow . ":F" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "ChiTietFL.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }

    public function product()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $result = $this->MFillet->Product($lo_id, $start_date, $end_date, $start_time, $end_time);
        $resultback = $this->MFillet->ProductBack($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_product',
            'template' => 'statistic/fillet/product',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'resultback' => $resultback,
            'data' => array(
                'result' => $result,
                'resultback' => $resultback,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );
        
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportProduct($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } 
        elseif(isset($_POST["exportdetail"])) {
            $linkDownload = $this->ExportProductBack($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        }
        else {
            $this->load->view('home', $data);
        }
    }
    public function ExportProduct($data)
    {
        $this->load->model("MFillet");
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
                'B3' => "Lô",
                'C3' => "Mã sản phẩm",
                'D3' => "Tên sản phẩm",
                'E3' => "Khối lượng vào",
                'F3' => "Khối lượng ra",
                'G3' => "Định mức",
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
                $data["A" . $startRow] = $startRow - 3;
                foreach ($rs as $key => $value) {
                    $data[$ex->column[$startCol] . $startRow] = $value;
                    $startCol++;
                }
                $startRow++;
            }
            $data["E" . ($startRow)] = "=SUBTOTAL(9,E4:E" . ($startRow - 1) . ")";
            $data["F" . ($startRow)] = "=SUBTOTAL(9,F4:F" . ($startRow - 1) . ")";
            $data["G" . ($startRow)] = "=ROUND(E" . $startRow . "/F" . $startRow . ",3)";
            $ex->mergeCells("A" . $startRow . ":D" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "SanPhamFL.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function ExportProductBack($data)
    {
        $this->load->model("MFillet");
        $result = $data["resultback"];
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
                'B3' => "Lô",
                'C3' => "Mã sản phẩm",
                'D3' => "Tên sản phẩm",
                'E3' => "Khối lượng",
            );
            $max_col = "E";
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
            $data["E" . ($startRow)] = "=SUBTOTAL(9,E4:E" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":D" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "SanPhamFLTru.xls";
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
            $lo_id = $_POST["lo_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        foreach ($lohang as $lo) {
            $this->MThreshold->AutoUpdate_Fillet_Threshold($start_date, $end_date, $lo->lo_id);
        }
        $result = $this->MFillet->Worker($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_worker', 
            'template' => 'statistic/fillet/worker',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        // if (isset($_POST["export"])) {
        //     $this->uti->export($result, 'fillet_worker-' . $start_date . '-' . $end_date);
        // }

        // $this->load->view('home', $data);
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportWorker($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportWorker($data)
    {
        $this->load->model("MFillet");
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
                'B3' => "Lô",
                'C3' => "Mã công nhân",
                'D3' => "Tên công nhân",
                'E3' => "Tên sản phẩm",
                'F3' => "Tổng khối lượng vào",
                'G3' => "Tổng khối lượng ra",
                'H3' => "Số lượng vào",
                'I3' => "Số lượng ra",
                'J3' => "Định mức"
            );
            $max_col = "J";
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
                    if($i<11 && $i!=0 && $i!=4){
                        $data[$ex->column[$startCol] . $startRow] = $value;
                        $startCol++;
                    }
                    $i++;
                }
                $startRow++;
            }
            $ex->SetBorder("A3:" . $max_col . ($startRow-1));
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "CongNhanFL.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    
    public function workersl()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $result = $this->MFillet->Worker2($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_worker_sl', 
            'template' => 'statistic/fillet/workersl',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportWorkerSL($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportWorkerSL($data)
    {
        $this->load->model("MFillet");
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
                'B3' => "Lô",
                'C3' => "Mã công nhân",
                'D3' => "Tên công nhân",
                'E3' => "Tên sản phẩm",
                'F3' => "Tổng khối lượng vào",
                'G3' => "Tổng khối lượng ra",
                'H3' => "Số lượng vào",
                'I3' => "Số lượng ra",
                'J3' => "Định mức"
            );
            $max_col = "J";
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
            $ex->SetBorder("A3:" . $max_col . ($startRow-1));
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "CongNhanFL.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function overtime()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $max_minute = $_POST["max_minute"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $max_minute = 80;
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");

        $result = $this->MFillet->OverTime($lo_id, $max_minute, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_overtime',
            'template' => 'statistic/fillet/overtime',
            'data' =>  array(
                'result' => $result,
                'max_minute' => $max_minute,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'fillet_overtime-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    // public function worker_total()
    // {
    //     if (isset($_POST["datetime"])) {
    //         $datetime = explode(" ", $_POST["datetime"]);
    //         $lo_id = $_POST["lo_id"];
    //         $start_date = $this->uti->dateforsql($datetime[0]);
    //         $start_time = $datetime[1] . $datetime[2];
    //         $end_date = $this->uti->dateforsql($datetime[4]);
    //         $end_time = $datetime[5] . $datetime[6];
    //     } else {
    //         $lo_id = "";
    //         $start_date = date("Y-m-d");
    //         $start_time = "00:00";
    //         $end_date = date("Y-m-d");
    //         $end_time = "23:59";
    //     }
    //     date_default_timezone_set('Asia/Ho_Chi_Minh');
    //     $date = date("Y-m-d");
    //     $this->load->model("MFillet");
    //     $this->load->model("MLoHang");
    //     $lohang = $this->MLoHang->ReadExistIn("Fillet");
    //     $quantity = $this->MFillet->Quantity($date,"Fillet");
    //     $result = $this->MFillet->Worker_Total($lo_id, $start_date, $end_date, $start_time, $end_time);
    //     $quantity_in = $quantity[''];
    //     print_r($quantity_in);
    //     $data = array(
    //         'action' => 'stat_fillet_worker_total',
    //         'template' => 'statistic/fillet/worker_total',
    //         'data' => array(
    //             'result' => $result,
    //             'lohang' => $lohang, 'lo_id' => $lo_id,
    //             'quantity_in' => $quantity_in,
    //             'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
    //             'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
    //         )
    //     );


    //     if (isset($_POST["export"])) {
    //         $this->uti->export($result, 'fillet_worker-' . $start_date . '-' . $end_date);
    //     }
    //     $this->load->view('home', $data);
    // }
    
    public function worker_total()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date("Y-m-d");
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $result = $this->MFillet->Worker_Total($lo_id, $start_date, $end_date, $start_time, $end_time);
        $process_products = $this->MFillet->Product_Read($start_date,$end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_fillet_worker_total',
            'template' => 'statistic/fillet/worker_total',
            'process_products'=>$process_products,
            'start_date'=> $start_date,
            'start_time'=> $start_time,
            'end_date'=> $end_date,
            'end_time'=> $end_time,
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );


        if (isset($_POST["export"])) {
            // $this->uti->export($result, 'fillet_worker-' . $start_date . '-' . $end_date);
            $linkDownload = $this->ExportWorkerTotal($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        }
        if (isset($_POST["export_"])){
            $linkDownload = $this->export_worker($data);
            if ($linkDownload!="")
                redirect(base_url().$linkDownload);
        }
        $this->load->view('home', $data);
    }
    
    public function ExportWorkerTotal($data)
    {
        $this->load->model("MFillet");
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
                'B3' => "Lô",
                'C3' => "Mã nhà máy",
                'D3' => "Mã công nhân",
                'E3' => "Tên công nhân",
                'F3' => "Mã sản phẩm",
                'G3' => "Tên sản phẩm",
                'H3' => "Số lượng",
                'I3' => "Khối lượng vào",
                'J3' => "Khối lượng ra",
                'K3' => "Định mức",
                'L3' => "Thời gian vào",
                'M3' => "Thời gian ra",
                'N3' => "Tổng thời gian",
            );
            $max_col = "N";
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
            $data["I" . ($startRow)] = "=SUBTOTAL(9,I4:I" . ($startRow - 1) . ")";
            $data["J" . ($startRow)] = "=SUBTOTAL(9,J4:J" . ($startRow - 1) . ")";
            $data["K" . ($startRow)] = "=ROUND(I" . $startRow . "/J" . $startRow . ",3)";
            $ex->mergeCells("A" . $startRow . ":H" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "TongHopFillet.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function export_worker($data){
        $this->load->model("MFillet");
        $process_products=$data["process_products"];
        if (sizeof($process_products)>0) {
            $this->load->library('myexcel');
            $this->load->library('utilities');
            $uti=new Utilities();
            $ex=new MyExcel();
            $ex->config["pagesetup"]["orientation"]=0;//giấy dọc
            $ex->SetSheet(0,"ThongKe");
            $start_date = new DateTime($data["start_date"]); 
            $end_date = new DateTime($data["end_date"]);
            $header =array('A1' => "THỐNG KÊ TỪ NGÀY ".$start_date->format('d/m/Y')." ĐẾN NGÀY ".$end_date->format('d/m/Y')." (".$data["start_time"]."-".$data["end_time"].")",'A2'=>'');
            $ex->SetValue($header);
            $start_date = $data["start_date"]; 
            $end_date = $data["end_date"];
            $start_time=$data["start_time"];
            $end_time=$data["end_time"];
            $weight_in = $this->MFillet->Worker_Product(
                $start_date,$end_date,$start_time,$end_time,"SUM(WEIGHT_IN)","PRODUCT_ID");
          
            $count_in = $this->MFillet->Worker_Product(
                $start_date,$end_date,$start_time,$end_time,"COUNT(WEIGHT_OUT)","PRODUCT_ID");
            $weight_out = $this->MFillet->Worker_Product(
                $start_date,$end_date,$start_time,$end_time,"SUM(WEIGHT_OUT)","PRODUCT_ID");
            //$count_out = $this->MFillet->Worker_Product($fromday,$today,$fromtime,$totime,"COUNT(WEIGHT_OUT)","PRODUCT_ID_OUT",$xuong);
            $headerRow = array(
                'A3'=>"TT",
                'B3'=>"Mã",
                'C3'=>"Công nhân",
                'D3'=>"Nhóm"
            );
            $start_col=4;
            $col =  $start_col;
            foreach ($process_products as $product) {
                $headerRow[$ex->column[$col]."3"]=$product->product_name;
                $col = $col + 4;
            }
            $maxColumn = $ex->column[$col-1];
            $col =  $start_col;
            for ($i=0; $i < sizeof($process_products); $i++) { 
                $headerRow[$ex->column[$col]."4"]="Số lượng";
                $headerRow[$ex->column[$col+1]."4"]="KL vào";
                $headerRow[$ex->column[$col+2]."4"]="KL ra";
                $headerRow[$ex->column[$col+3]."4"]="Đ/mức";
                $ex->mergeCells($ex->column[$col]."3:".$ex->column[$col+3]."3");
                $col = $col + 4;
            }
            $ex->mergeCells("A1:".$maxColumn."1");
            $ex->mergeCells("A2:".$maxColumn."2");
            $ex->mergeCells("A3:A4");
            $ex->mergeCells("B3:B4");
            $ex->mergeCells("C3:C4");
            $ex->mergeCells("D3:D4");
            $ex->CellAlign("A1:".$maxColumn."2","center");
            $ex->FontStyle("A1:".$maxColumn."3","B");
            $ex->SetValue($headerRow);
            $startRow = 5;
            $data_excel = array();
            $i = 0;
            $length = count($weight_in);
           for ($i=0; $i < $length; $i++) { 
                $data_excel["A".$startRow] = $startRow - 4;
                $data_excel["B".$startRow] = $weight_in[$i]["worker_id"];//
                $data_excel["C".$startRow] = $weight_in[$i]["worker_name"];
                $data_excel["D".$startRow] = $weight_in[$i]["group_id"];
                $col =  $start_col;
                foreach ($process_products as $product) {
                    $data_excel[$ex->column[$col].$startRow]=$count_in[$i][$product->product_id]==null?"":$count_in[$i][$product->product_id];
                    $data_excel[$ex->column[$col+1].$startRow]=$weight_in[$i][$product->product_id]==null?"":$weight_in[$i][$product->product_id];
                    $data_excel[$ex->column[$col+2].$startRow]=$weight_out[$i][$product->product_id]==null?"":$weight_out[$i][$product->product_id];
                    $data_excel[$ex->column[$col+3].$startRow]="=IF(".$ex->column[$col+2].$startRow."<>0,ROUND(".$ex->column[$col+1].$startRow."/".$ex->column[$col+2].$startRow.',3),"")';
                    $col = $col + 4;
                }
                $startRow ++;
            }
           
            $ex->SetValue($data_excel);
            $ex->SetBorder("A3:".$maxColumn.($startRow-1));
            //$ex->SetColumnAutoSize();
            $linkDownload="fillet_worker.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        }else{
            return "";
        }
    }
    public function no_input()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $result = $this->MFillet->Worker_No_Input($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_worker_no_input',
            'template' => 'statistic/fillet/no_input',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'fillet_no_input-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    // public function no_output()
    // {
    //     if (isset($_POST["datetime"])) {
    //         $datetime = explode(" ", $_POST["datetime"]);
    //         $lo_id = $_POST["lo_id"];
    //         $start_date = $this->uti->dateforsql($datetime[0]);
    //         $start_time = $datetime[1] . $datetime[2];
    //         $end_date = $this->uti->dateforsql($datetime[4]);
    //         $end_time = $datetime[5] . $datetime[6];
    //     } else {
    //         $lo_id = "";
    //         $start_date = date("Y-m-d");
    //         $start_time = "00:00";
    //         $end_date = date("Y-m-d");
    //         $end_time = "23:59";
    //     }
    //     $this->load->model("MFillet");
    //     $this->load->model("MLoHang");
    //     $this->load->model("MThreshold");
    //     $lohang = $this->MLoHang->ReadExistIn("Fillet");
    //     $result = $this->MFillet->Worker_No_Output($lo_id, $start_date, $end_date, $start_time, $end_time);

    //     $data = array(
    //         'action' => 'stat_fillet_worker_no_output',
    //         'template' => 'statistic/fillet/no_output',
    //         'data' => array(
    //             'result' => $result,
    //             'lohang' => $lohang, 'lo_id' => $lo_id,
    //             'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
    //             'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
    //         )
    //     );

    //     if (isset($_POST["export"])) {
    //         $this->uti->export($result, 'fillet_no_output-' . $start_date . '-' . $end_date);
    //     }
    //     $this->load->view('home', $data);
    // }
    public function no_output()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date("Y-m-d");
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $result = $this->MFillet->Worker_No_Output($lo_id, $start_date, $end_date, $start_time, $end_time);
        
        $data = array(
            'action' => 'stat_fillet_worker_no_output',
            'template' => 'statistic/fillet/no_output',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'fillet_no_output-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function invalid()
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
        $this->load->model("MFillet");
        $result = $this->MFillet->Invalid($start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_invalid', 
            'template' => 'statistic/fillet/invalid',
            'data' => array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"]))
            $this->uti->export($result, 'fillet_invalid-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    public function over_threshold()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $result = $this->MFillet->Over_Threshold($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_over_threshold',
            'template' => 'statistic/fillet/over_threshold',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result, 
            'data' => array(
                'lo_id' => $lo_id, 'lohang' => $lohang,
                'result' => $result, 
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportOverThreshold($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
        // if (isset($_POST["export"]))
        //     $this->uti->export($result, 'fillet_over_threshold-' . $date);
        // $this->load->view('home', $data);
    }

    public function ExportOverThreshold($data)
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
                'C3' => "Lô",
                'D3' => "Mã công nhân",
                'E3' => "Tên công nhân",
                'F3' => "Sản phẩm",
                'G3' => "Định mức min",
                'H3' => "Định mức max",
                'I3' => "Khối lượng vào",
                'J3' => "Khối lượng ra",
                'K3' => "Định mức",
                'L3' => "Thời gian",
                'M3' => "Loại",
            );
            $max_col = "M";
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
            $data["I" . ($startRow)] = "=SUBTOTAL(9,I4:I" . ($startRow - 1) . ")";
            $data["J" . ($startRow)] = "=SUBTOTAL(9,J4:J" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":H" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "NgoaiDinhMuc.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function worker_over_threshold()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $start_date = date("Y-m-d", strtotime("-7 days"));
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        print_r($start_date);
        $this->load->model("MFillet");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("Fillet");
        $result = $this->MFillet->Worker_Over_Threshold($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_worker_over_threshold',
            'template' => 'statistic/fillet/worker_over_threshold',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result, 
            'data' => array(
                'lo_id' => $lo_id, 'lohang' => $lohang,
                'result' => $result, 
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportWorkerOverThreshold($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportWorkerOverThreshold($data)
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
                'C3' => "Lô",
                'D3' => "Mã công nhân",
                'E3' => "Tên công nhân",
                'F3' => "Sản phẩm",
                'G3' => "Số rổ",
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
                $data["A" . $startRow] = $startRow - 3;
                foreach ($rs as $key => $value) {
                    $data[$ex->column[$startCol] . $startRow] = $value;
                    $startCol++;
                }
                $startRow++;
            }
            $data["G" . ($startRow)] = "=SUBTOTAL(9,G4:G" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":F" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "CNBatThuong.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }

    public function working()
    {
        $data = array(
            'action' => 'stat_fillet_working',
            'template' => 'statistic/fillet/working_index',
            'data' => array(
            )
        );
        $this->load->view('home', $data);
    }
    public function workingcontent()
    {
        $this->load->model("MFillet");
        $result_in = $this->MFillet->WorkingIn(100);
        $result_out = $this->MFillet->WorkingOut(100);
        $data = array(
            'result_in' => $result_in,
            'result_out' => $result_out,
        );
        $this->view->parse('statistic/fillet/working_content', $data);
    }
    
    public function xuatban()
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
        $this->load->model("MFillet");
        $result = $this->MFillet->CaXuatBan($start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_fillet_caxuatban', 
            'template' => 'statistic/fillet/caxuatban',
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
            $linkDownload = $this->ExportCaXuatBan($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportCaXuatBan($data)
    {
        $this->load->model("MFillet");
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
                'B3' => "Mã Khách hàng",
                'C3' => "Tên Khách hàng",
                'D3' => "Tên sản phẩm",
                'E3' => "Khối lượng",
            );
            $max_col = "E";
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
            $data["E" . ($startRow)] = "=SUBTOTAL(9,E4:E" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":D" . $startRow);
            $ex->CellAlign("A" . $startRow . ":D" . $startRow, "right");
            $data["A" . $startRow] = "Tổng cộng:";
            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "CaXuatBan.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
}
