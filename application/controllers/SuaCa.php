<?php
defined('BASEPATH') or exit('No direct script access allowed');
class SuaCa extends CI_Controller
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
        $this->load->model("MSuaCa");
        if (!isset($_GET["start_date"]))
            redirect(base_url());
        $start_date = explode(" ", $_GET["start_date"]);
        $end_date = explode(" ", $_GET["end_date"]);
        $data = $this->MSuaCa->Detail(
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
        $count =  $this->MSuaCa->Detail_Count(
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
    public function phieucan($id_suaca = "")
    {
        $this->load->model("MSuaCa");
        $this->load->model("MProduct");
        $this->load->model("MLoHang");
        if (isset($_POST["id_suaca"])) {
            $id_suaca = $_POST["id_suaca"];
        }
        $deleted = 0;
        $product_id = "-";
        $lo_id = "-";
        if (isset($_POST["update"]) || isset($_POST["delete"])) {
            if (isset($_POST["delete"])) {
                $deleted = 1;
            }
            if (isset($_POST["update"])) {
                $product_id = $_POST["product_id"];
                $lo_id = $_POST["lo_id"];
                $deleted = 0;
            }

            if ($id_suaca != "")
                $this->MSuaCa->History_Insert($id_suaca, $lo_id, $product_id, $this->session->userdata("username"), $deleted);
        }

        $result = $this->MSuaCa->ReadById($id_suaca);
        $history = $this->MSuaCa->History_ReadById($id_suaca);
        $product = $this->MProduct->ReadAll();
        $lohang = $this->MLoHang->Read();
        $data = array(
            'action' => 'edit_phieucan',
            'template' => 'statistic/phieucan/index',
            'data' =>  array(
                'result' => $result,
                'history' => $history,
                'id_suaca' => $id_suaca,
                'product' => $product,
                'lohang' => $lohang
            )
        );

        $this->load->view('home', $data);
    }
    public function DeletePhieuCan($id_suaca)
    {
        $this->db->where('id_suaca', $id_suaca);
        $this->db->delete('SuaCa_History');
        redirect(base_url() . "suaca/phieucan/" . $id_suaca);
    }
    public function detail()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $start_date = $this->uti->dateforsql($datetime[0]);
            $end_date = $this->uti->dateforsql($datetime[4]);
            $lo_id = $_POST["lo_id"];
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
        $this->load->model("MSuaCa");
        $this->load->model("MProduct");
        $this->load->model("MWorker");
        $this->load->model("MLoHang");

        $product = $this->MProduct->ReadExistIn("SuaCa");
        $worker = $this->MWorker->ReadExistIn("SuaCa");
        $lohang = $this->MLoHang->Read("SuaCa");
        $result =  $this->MSuaCa->Detail(
            $start_date,
            $end_date,
            $start_time,
            $end_time,
            $worker_id,
            $product_id,
            $lo_id
        );

        $data = array(
            'action' => 'stat_suaca_detail',
            'template' => 'statistic/suaca/detail',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
                'lohang' => $lohang, 'lo_id' => $lo_id,
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
                'C3' => "TT vào",
                'D3' => "TG vào",
                'E3' => "TT ra",
                'F3' => "TG ra",
                'G3' => "TG hoàn thành",
                'H3' => "Lô",
                'I3' => "Rổ",
                'J3' => "Mã công nhân",
                'K3' => "Mã thẻ",
                'L3' => "Tên công nhân",
                'M3' => "Mã sản phẩm",
                'N3' => "Sản phẩm",
                'O3' => "KL vào",
                'P3' => "KL ra",
                'Q3' => "Định mức",
            );
            $max_col = "Q";
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
            $data["O" . ($startRow)] = "=SUBTOTAL(9,O4:O" . ($startRow - 1) . ")";
            $data["P" . ($startRow)] = "=SUBTOTAL(9,P4:P" . ($startRow - 1) . ")";
            $data["Q" . ($startRow)] = "=ROUND(O" . $startRow . "/P" . $startRow . ",3)";
            $ex->mergeCells("A" . $startRow . ":N" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "ChiTietDH.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function product()
    {
        $weight_in =  4;
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        $result = $this->MSuaCa->Product($lo_id, $weight_in, $start_date, $end_date, $start_time, $end_time);
        // $resultback = $this->MSuaCa->ProductBack($lo_id, $start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_suaca_product',
            'template' => 'statistic/suaca/product',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            // 'resultback' => $resultback,
            'data' => array(
                'result' => $result,
                // 'resultback' => $resultback,
                'lohang' => $lohang, 'lo_id' => $lo_id, 'weight_in' => $weight_in,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportProduct($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } 
        // elseif(isset($_POST["exportdetail"])) {
        //     $linkDownload = $this->ExportProductBack($data);
        //     if ($linkDownload != "")
        //         redirect(base_url() . $linkDownload);
        // }
        else {
            $this->load->view('home', $data);
        }
    }
    // public function ExportProduct($data)
    // {
    //     $this->load->model("MSuaCa");
    //     $result = $data["result"];
    //     if (sizeof($result) > 0) {
    //         $this->load->library('myexcel');
    //         $this->load->library('utilities');
    //         $uti = new Utilities();
    //         $ex = new MyExcel();
    //         $ex->config["pagesetup"]["orientation"] = 0; //giấy dọc
    //         $sheet = $ex->SetSheet(0, "ThongKe");
    //         $start_date = new DateTime($data["start_date"]);
    //         $end_date = new DateTime($data["end_date"]);
    //         $header = array('A1' => "THỐNG KÊ TỪ NGÀY " . $start_date->format('d/m/Y') . " ĐẾN NGÀY " . $end_date->format('d/m/Y'));
    //         $ex->SetValue($header);

    //         $headerRow = array(
    //             'A3' => "TT",
    //             'B3' => "Lô",
    //             'C3' => "Mã sản phẩm",
    //             'D3' => "Tên sản phẩm",
    //             'E3' => "Khối lượng vào thực tế",
    //             'F3' => "Khối lượng vào",
    //             'G3' => "Khối lượng ra",
    //             'H3' => "Định mức",
    //         );
    //         $max_col = "H";
    //         $ex->mergeCells("A1:" . $max_col . "1");
    //         $ex->mergeCells("A2:" . $max_col . "2");
    //         $ex->CellAlign("A1:" . $max_col . "2", "center");
    //         $ex->FontStyle("A1:" . $max_col . "3", "B");
    //         $ex->SetValue($headerRow);
    //         $startRow = 4;
    //         $data = array();
    //         foreach ($result as $rs) {
    //             $startCol = 1;
    //             // $i=0;
    //             $data["A" . $startRow] = $startRow - 3;
    //             foreach ($rs as $key => $value) {
    //                 // if($i!=3 && $i!=6){
    //                     $data[$ex->column[$startCol] . $startRow] = $value;
    //                     $startCol++;
    //                 // }
    //                 // $i++;
    //             }
    //             $startRow++;
    //         }
    //         $data["E" . ($startRow)] = "=SUBTOTAL(9,E4:E" . ($startRow - 1) . ")";
    //         $data["F" . ($startRow)] = "=SUBTOTAL(9,F4:F" . ($startRow - 1) . ")";
    //         $data["G" . ($startRow)] = "=SUBTOTAL(9,G4:G" . ($startRow - 1) . ")";
    //         $data["H" . ($startRow)] = "=ROUND(F" . $startRow . "/G" . $startRow . ",3)";
    //         $ex->mergeCells("A" . $startRow . ":D" . $startRow);
    //         $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
    //         $data["A" . $startRow] = "Tổng cộng:";

    //         $ex->SetBorder("A3:" . $max_col . $startRow);
    //         $ex->SetValue($data);
    //         $ex->SetColumnAutoSize();
    //         $linkDownload = "SanPhamDH.xls";
    //         $ex->Save($linkDownload);
    //         return $linkDownload;
    //     } else {
    //         return "";
    //     }
    // }
    public function ExportProduct($data)
    {
        $this->load->model("MSuaCa");
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
                'D3' => "Khối lượng vào thực tế",
                'E3' => "Khối lượng vào",
                'F3' => "Khối lượng vào sau khi trả về",
                'G3' => "Khối lượng ra",
                'H3' => "Khối lượng ra sau khi trả về",
                'I3' => "Định mức",
            );
            $max_col = "I";
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
            $data["E" . ($startRow)] = "=SUBTOTAL(9,E4:E" . ($startRow - 1) . ")";
            $data["F" . ($startRow)] = "=SUBTOTAL(9,F4:F" . ($startRow - 1) . ")";
            $data["G" . ($startRow)] = "=SUBTOTAL(9,G4:G" . ($startRow - 1) . ")";
            $data["H" . ($startRow)] = "=SUBTOTAL(9,H4:H" . ($startRow - 1) . ")";
            // $data["H" . ($startRow)] = "=ROUND(F" . $startRow . "/G" . $startRow . ",3)";
            $ex->mergeCells("A" . $startRow . ":C" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "SanPhamDH.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    // public function ExportProductBack($data)
    // {
    //     $this->load->model("MSuaCa");
    //     $result = $data["resultback"];
    //     if (sizeof($result) > 0) {
    //         $this->load->library('myexcel');
    //         $this->load->library('utilities');
    //         $uti = new Utilities();
    //         $ex = new MyExcel();
    //         $ex->config["pagesetup"]["orientation"] = 0; //giấy dọc
    //         $sheet = $ex->SetSheet(0, "ThongKe");
    //         $start_date = new DateTime($data["start_date"]);
    //         $end_date = new DateTime($data["end_date"]);
    //         $header = array('A1' => "THỐNG KÊ TỪ NGÀY " . $start_date->format('d/m/Y') . " ĐẾN NGÀY " . $end_date->format('d/m/Y'));
    //         $ex->SetValue($header);

    //         $headerRow = array(
    //             'A3' => "TT",
    //             'B3' => "Lô",
    //             'C3' => "Mã sản phẩm",
    //             'D3' => "Tên sản phẩm",
    //             'E3' => "Khối lượng",
    //         );
    //         $max_col = "E";
    //         $ex->mergeCells("A1:" . $max_col . "1");
    //         $ex->mergeCells("A2:" . $max_col . "2");
    //         $ex->CellAlign("A1:" . $max_col . "2", "center");
    //         $ex->FontStyle("A1:" . $max_col . "3", "B");
    //         $ex->SetValue($headerRow);
    //         $startRow = 4;
    //         $data = array();
    //         foreach ($result as $rs) {
    //             $startCol = 1;
    //             $data["A" . $startRow] = $startRow - 3;
    //             foreach ($rs as $key => $value) {
    //                 $data[$ex->column[$startCol] . $startRow] = $value;
    //                 $startCol++;
    //             }
    //             $startRow++;
    //         }
    //         $data["E" . ($startRow)] = "=SUBTOTAL(9,E4:E" . ($startRow - 1) . ")";
    //         $ex->mergeCells("A" . $startRow . ":D" . $startRow);
    //         $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
    //         $data["A" . $startRow] = "Tổng cộng:";

    //         $ex->SetBorder("A3:" . $max_col . $startRow);
    //         $ex->SetValue($data);
    //         $ex->SetColumnAutoSize();
    //         $linkDownload = "SanPhamDHTru.xls";
    //         $ex->Save($linkDownload);
    //         return $linkDownload;
    //     } else {
    //         return "";
    //     }
    // }
    public function skinmachine()
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        $result = $this->MSuaCa->SkinMachine($lo_id, $start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_suaca_skinmachine',
            'template' => 'statistic/suaca/skinmachine',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );
        if (isset($_POST["export"]))
            $this->uti->export($result, 'suaca_landa-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }
    public function working()
    {
        $data = array(
            'action' => 'stat_suaca_working',
            'template' => 'statistic/suaca/working_index',
            'data' => array()
        );
        $this->load->view('home', $data);
    }
    public function workingcontent()
    {
        $this->load->model("MSuaCa");
        $result_in = $this->MSuaCa->WorkingIn(100);
        $result_out = $this->MSuaCa->WorkingOut(100);
        $data = array(
            'result_in' => $result_in,
            'result_out' => $result_out,
        );
        $this->view->parse('statistic/suaca/working_content', $data);
    }
    public function workerforview()
    {
        $data = array(
            'action' => 'stat_suaca_worker_for_view',
            'template' => 'statistic/suaca/worker_view',
            'data' =>  array()
        );
        $this->load->view('home', $data);
    }
    public function dataworkerforview()
    {
        if (isset($_POST["card_id"])) {
            $card_id = $_POST["card_id"];
        } else {
            $card_id = "";
        }
       /// $today = date('Y-m-d');
        //$yesterday = date('Y-m-d', strtotime('-1 day'));
        $this->load->model("MSuaCa");
        $result_today = $this->MSuaCa->ForWorkerView($card_id, 1);
        $result_yesterday = $this->MSuaCa->ForWorkerView($card_id, 0);

        $data = array(
            'result_today' => $result_today,
            'result_yesterday' => $result_yesterday,
        );
        $this->view->parse('statistic/suaca/worker_view_data', $data);
    }
    public function worker()
    {
        $weight_in = 4;
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            //  $weight_in =  $_POST["weight_in"];
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        // foreach ($lohang as $lo) {
        //     $this->MThreshold->AutoUpdate_SuaCa_Threshold($start_date, $end_date, $lo->lo_id, $weight_in);
        // }
        $result = $this->MSuaCa->Worker($lo_id, $weight_in, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_suaca_worker',
            'template' => 'statistic/suaca/worker',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' =>  array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'weight_in' => $weight_in,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        // if (isset($_POST["export"])) {
        //     $this->uti->export($result, 'suaca_worker' . $start_date);
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
        $this->load->model("MSuaCa");
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
            $linkDownload = "CongNhanDH.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }

    public function qcworker_detail()
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");

        $result = $this->MSuaCa->QCWorkerDetail($lo_id, $start_date, $end_date);

        $data = array(
            'action' => 'stat_suaca_qcworker_detail',
            'template' => 'statistic/suaca/qcworker_detail',
            'data' =>  array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_qcworker-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function qcworker_general()
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");

        $result = $this->MSuaCa->QCWorkerGeneral($lo_id, $start_date, $end_date);

        $data = array(
            'action' => 'stat_suaca_qcworker_general',
            'template' => 'statistic/suaca/qcworker_general2',
            'data' =>  array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_qcworker-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");

        $result = $this->MSuaCa->OverTime($lo_id, $max_minute, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_suaca_overtime',
            'template' => 'statistic/suaca/overtime',
            'data' =>  array(
                'result' => $result,
                'max_minute' => $max_minute,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_overtime-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function worker_total()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
            $product_id = $_POST["product_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $product_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $this->load->model("MProduct");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        $product = $this->MProduct->ReadExistIn("SuaCa");
        $result = $this->MSuaCa->Worker_Total($lo_id,$product_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_suaca_worker_total',
            'template' => 'statistic/suaca/worker_total',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'product' => $product, 'product_id' => $product_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );


        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_worker-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        $result = $this->MSuaCa->Worker_No_Input($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_suaca_worker_no_input',
            'template' => 'statistic/suaca/no_input',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_no_input-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
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
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $this->load->model("MThreshold");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        $result = $this->MSuaCa->Worker_No_Output($lo_id, $start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_suaca_worker_no_output',
            'template' => 'statistic/suaca/no_output',
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"])) {
            $this->uti->export($result, 'suaca_no_output-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function invalid()
    {
        $weight_in = 4;
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
        $this->load->model("MSuaCa");
        $result = $this->MSuaCa->Invalid($start_date, $end_date, $start_time, $end_time, $weight_in);
        $data = array(
            'action' => 'stat_suaca_invalid',
            'template' => 'statistic/suaca/invalid',
            'data' => array(
                'result' => $result, 'weight_in' => $weight_in,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

        if (isset($_POST["export"]))
            $this->uti->export($result, 'suaca_invalid-' . $start_date . '-' . $end_date);
        $this->load->view('home', $data);
    }

    public function over_threshold()
    {
        $weight_in = 4;
        if (isset($_POST["date"])) {
            $date = $_POST["date"];
            $lo_id = $_POST["lo_id"];
            // $weight_in = $_POST["weight_in"];
        } else {
            $date = date("Y-m-d");
            $lo_id = "";
        }
        $this->load->model("MSuaCa");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("SuaCa");
        $result = $this->MSuaCa->Over_Threshold($lo_id, $weight_in, $date);
        $data = array(
            'action' => 'stat_suaca_over_threshold',
            'template' => 'statistic/suaca/over_threshold',
            'data' => array(
                'lo_id' => $lo_id, 'lohang' => $lohang, 'weight_in' => $weight_in,
                'result' => $result, 'date' => $date
            )
        );

        if (isset($_POST["export"]))
            $this->uti->export($result, 'suaca_over_threshold-' . $date);
        $this->load->view('home', $data);
    }
}
