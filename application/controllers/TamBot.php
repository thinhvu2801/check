<?php
defined('BASEPATH') or exit('No direct script access allowed');
class TamBot extends CI_Controller
{
    var $uti;
    function __construct()
    {
        parent::__construct();
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }

    public function rutchidetail()
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
        $this->load->model("MTamBot");
        $this->load->model("MProduct");
        $this->load->model("MWorker");
        $product = $this->MProduct->ReadExistIn("BienDong_RutChi");
        $worker = $this->MWorker->ReadExistIn("BienDong_RutChi");
        $result = $this->MTamBot->RutChiDetail($start_date, $end_date, $start_time, $end_time, $worker_id, $product_id);

        $data = array(
            'action' => 'stat_rutchi_detail',
            'template' => 'statistic/tambot/rutchi/detail',
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
            $linkDownload = $this->ExportRutChiDetail($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }

    public function ExportRutChiDetail($data)
    {
        $this->load->model("MTamBot");
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
            $linkDownload = "RutChi-ChiTiet-" . $start_date->format('d-m-Y') . "-" . $end_date->format('d-m-Y') .".xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function rutchiworker()
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
        $this->load->model("MTamBot");
        $result = $this->MTamBot->RutChiWorker($start_date, $end_date, $start_time, $end_time);
        $datatest = array();
        $data = array(
            'action' => 'stat_rutchi_worker',
            'template' => 'statistic/tambot/rutchi/worker',
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
            $linkDownload = $this->ExportRutChiWorker($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } 

        $this->load->view('home', $data);
    }
    
    public function ExportRutChiWorker($data)
    {
        $this->load->model("MTamBot");
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
                'C3' => "Mã Công nhân",
                'D3' => "Tên Công nhân",
                'E3' => "Sản phẩm",
                'F3' => "Khối lượng",
            );
            $max_col = "F";
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
            $data["F" . ($startRow)] = "=SUBTOTAL(9,F4:F" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":E" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "RutChi-CongNhan-" . $start_date->format('d-m-Y') . "-" . $end_date->format('d-m-Y') .".xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }

    public function catbtpdetail()
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
        $this->load->model("MTamBot");
        $this->load->model("MProduct");
        $this->load->model("MWorker");
        $product = $this->MProduct->ReadExistIn("BienDong_RutChi");
        $worker = $this->MWorker->ReadExistIn("BienDong_RutChi");
        $result = $this->MTamBot->CatBTPDetail($start_date, $end_date, $start_time, $end_time, $worker_id, $product_id);

        $data = array(
            'action' => 'stat_catbtp_detail',
            'template' => 'statistic/tambot/catbtp/detail',
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
            $linkDownload = $this->ExportCatBTPDetail($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportCatBTPDetail($data)
    {
        $this->load->model("MTamBot");
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
            $linkDownload = "CatBTP-ChiTiet-" . $start_date->format('d-m-Y') . "-" . $end_date->format('d-m-Y') .".xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function catbtpworker()
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
        $this->load->model("MTamBot");
        $result = $this->MTamBot->CatBTPWorker($start_date, $end_date, $start_time, $end_time);
        $datatest = array();
        $data = array(
            'action' => 'stat_catbtp_worker',
            'template' => 'statistic/tambot/catbtp/worker',
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
            $linkDownload = $this->ExportCatBTPWorker($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } 

        $this->load->view('home', $data);
    }
    
    public function ExportCatBTPWorker($data)
    {
        $this->load->model("MTamBot");
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
                'C3' => "Mã Công nhân",
                'D3' => "Tên Công nhân",
                'E3' => "Sản phẩm",
                'F3' => "Khối lượng",
            );
            $max_col = "F";
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
            $data["F" . ($startRow)] = "=SUBTOTAL(9,F4:F" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":E" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "CatBTP-CongNhan-" . $start_date->format('d-m-Y') . "-" . $end_date->format('d-m-Y') .".xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function catbtpproduct()
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
        $this->load->model("MTamBot");
        $result = $this->MTamBot->CatBTPProduct($start_date, $end_date, $start_time, $end_time);
        $datatest = array();
        $data = array(
            'action' => 'stat_catbtp_product',
            'template' => 'statistic/tambot/catbtp/product',
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
            $linkDownload = $this->ExportCatBTPProduct($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } 

        $this->load->view('home', $data);
    }
    public function ExportCatBTPProduct($data)
    {
        $this->load->model("MTamBot");
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
                'B3' => "Sản phẩm",
                'C3' => "Khối lượng",
            );
            $max_col = "C";
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
            $data["C" . ($startRow)] = "=SUBTOTAL(9,C4:C" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":B" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "CatBTP-SanPham-" . $start_date->format('d-m-Y') . "-" . $end_date->format('d-m-Y') .".xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }

    public function btpngamdetail()
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
        $this->load->model("MTamBot");
        $result = $this->MTamBot->BTPNgamDetail($start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_btpngam_detail',
            'template' => 'statistic/tambot/btpngam/detail',
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
            $linkDownload = $this->ExportBTPNgamDetail($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ViewChiTiet()
    {
		$data = array();
		$this->load->view('btpngamview', $data);
    }
    public function ChiTiet()
    {
        $this->load->model("MTamBot");
        $result = $this->MTamBot->Working(100);
        $data = array(
            'result' => $result,
        );
        $this->view->parse('btpngam', $data);
    }
    public function ExportBTPNgamDetail($data)
    {
        $this->load->model("MTamBot");
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
                'C3' => "Rổ",
                'D3' => "TG vào",
                'E3' => "TG ra",
                'F3' => "KL vào",
                'G3' => "KL ra",
                'H3' => "Định mức",
            );
            $max_col = "H";
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
                    $data["H".($startRow)] = "=ROUND(G".($startRow)."/F".($startRow).",3)";
                    $data[$ex->column[$startCol] . $startRow] = $value;
                    $startCol++;
                }
                $startRow++;
            }
            $data["F" . ($startRow)] = "=SUBTOTAL(9,F4:F" . ($startRow - 1) . ")";
            $data["G" . ($startRow)] = "=SUBTOTAL(9,G4:G" . ($startRow - 1) . ")";
            $data["H" . ($startRow)] = "=ROUND(G".($startRow)."/F".($startRow).",3)";
            $ex->mergeCells("A" . $startRow . ":E" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "BTPNgam-" . $start_date->format('d-m-Y') . "-" . $end_date->format('d-m-Y') .".xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function btpngamnooutput()
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
        $this->load->model("MTamBot");
        $result = $this->MTamBot->BTPNgamNoOutPut($start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_btpngam_no_output',
            'template' => 'statistic/tambot/btpngam/no_output',
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
            $linkDownload = $this->ExportBTPNgamNoOutput($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportBTPNgamNoOutput($data)
    {
        $result = $data["result"];
        if (sizeof($result) > 0) {
            $this->load->library('myexcel');
            $this->load->library('utilities');
            $uti = new Utilities();
            $ex = new MyExcel();
            $ex->config["pagesetup"]["orientation"] = 0;
            $sheet = $ex->SetSheet(0, "ThongKe");
            $start_date = new DateTime($data["start_date"]);
            $end_date = new DateTime($data["end_date"]);
            $header = array('A1' => "THỐNG KÊ TỪ NGÀY " . $start_date->format('d/m/Y') . " ĐẾN NGÀY " . $end_date->format('d/m/Y'));
            $ex->SetValue($header);

            $headerRow = array(
                'A3' => "TT",
                'B3' => "Ngày",
                'C3' => "TG",
                'D3' => "Rổ",
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
            $linkDownload = "NoOutPut-" . $start_date->format('d-m-Y') . "-" . $end_date->format('d-m-Y') .".xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function btpngamnoinput()
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
        $this->load->model("MTamBot");
        $result = $this->MTamBot->BTPNgamNoInPut($start_date, $end_date, $start_time, $end_time);

        $data = array(
            'action' => 'stat_btpngam_no_input',
            'template' => 'statistic/tambot/btpngam/no_input',
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
            $linkDownload = $this->ExportBTPNgamNoInPut($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportBTPNgamNoInPut($data)
    {
        $result = $data["result"];
        if (sizeof($result) > 0) {
            $this->load->library('myexcel');
            $this->load->library('utilities');
            $uti = new Utilities();
            $ex = new MyExcel();
            $ex->config["pagesetup"]["orientation"] = 0;
            $sheet = $ex->SetSheet(0, "ThongKe");
            $start_date = new DateTime($data["start_date"]);
            $end_date = new DateTime($data["end_date"]);
            $header = array('A1' => "THỐNG KÊ TỪ NGÀY " . $start_date->format('d/m/Y') . " ĐẾN NGÀY " . $end_date->format('d/m/Y'));
            $ex->SetValue($header);

            $headerRow = array(
                'A3' => "TT",
                'B3' => "Ngày",
                'C3' => "TG",
                'D3' => "Rổ",
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
            $linkDownload = "NoInPut-" . $start_date->format('d-m-Y') . "-" . $end_date->format('d-m-Y') .".xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function overview()
    {
        $this->load->model("MTamBot");
        if (isset($_POST["statistic"]) || isset($_POST["export"])) {
            $dateInput = $_POST["day"];
            $dateObject = DateTime::createFromFormat('d/m/Y', $dateInput); 
            $start_date = $dateObject->format('m/d/Y');
        } else {
            $start_date = date("Y-m-d");
        }
        $result = $this->MTamBot->Overview($start_date);
        $data = array(
            'action' => 'stat_biendong_overview',
            'template' => 'statistic/tambot/overview',
            'date'=> $start_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'date'=> $this->uti->dateforpicker($start_date),
            )
        );

        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportDetailOverView($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
}
