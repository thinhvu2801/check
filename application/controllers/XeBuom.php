<?php
defined('BASEPATH') or exit('No direct script access allowed');
class XeBuom extends CI_Controller
{
    var $uti;
    function __construct()
    {
        parent::__construct();
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }
   
    public function detailIn()
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
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
            $product_id = "";
        }
        $this->load->model("MXeBuom");
        $this->load->model("MProduct");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("XeBuom_In");
        $product = $this->MProduct->ReadExistIn("XeBuom_In");
        $result = $this->MXeBuom->DetailIn($lo_id, $start_date, $end_date, $start_time, $end_time, $product_id);

        $data = array(
            'action' => 'stat_xebuom_detailin',
            'template' => 'statistic/xebuom/detailin',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'product' => $product, 'product_id' => $product_id
            )
        );

        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportDetailIn($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }

    public function ExportDetailIn($data)
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
                'B3' => "Thời gian",
                'C3' => "Lô",
                'D3' => "Mã sản phẩm",
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
                $i=0;
                foreach ($rs as $key => $value) {
                    if($i!=0){
                        $data[$ex->column[$startCol] . $startRow] = $value;
                        $startCol++;
                    }
                    $i++;
                }
                $startRow++;
            }
            $data["F" . ($startRow)] = "=SUBTOTAL(9,F4:F" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":D" . $startRow);
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "XeBuoim_detailIn.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function detailOut()
    {
        if (isset($_POST["datetime"])) {
            $datetime = explode(" ", $_POST["datetime"]);
            $lo_id = $_POST["lo_id"];
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
            $lo_id = "";
        }
        $this->load->model("MXeBuom");
        $this->load->model("MProduct");
        $this->load->model("MWorker");
        $this->load->model("MLoHang");
        $lohang = $this->MLoHang->ReadExistIn("XeBuom_Out");
        $product = $this->MProduct->ReadExistIn("XeBuom_Out");
        $worker = $this->MWorker->ReadExistIn("XeBuom_Out");
        $result = $this->MXeBuom->DetailOut($lo_id, $start_date, $end_date, $start_time, $end_time, $worker_id, $product_id);

        $data = array(
            'action' => 'stat_xebuom_detailout',
            'template' => 'statistic/xebuom/detailout',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
                'product' => $product, 'product_id' => $product_id,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'worker' => $worker, 'worker_id' => $worker_id
            )
        );

        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportDetailOut($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportDetailOut($data)
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
                'B3' => "Thời gian",
                'C3' => "Lô",
                'D3' => "Mã sản phẩm",
                'E3' => "Sản phẩm",
                'F3' => "Mã CN",
                'G3' => "Tên CN",
                'H3' => "Khối lượng",
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
                $i=0;
                foreach ($rs as $key => $value) {
                    if($i!=0){
                        $data[$ex->column[$startCol] . $startRow] = $value;
                        $startCol++;
                    }
                    $i++;
                }
                $startRow++;
            }
            $data["H" . ($startRow)] = "=SUBTOTAL(9,H4:H" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":F" . $startRow);
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "XeBuoim_detailOut.xls";
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
            $product_id = $_POST["product_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $product_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MXeBuom");
        $this->load->model("MProduct");
        $product = $this->MProduct->ReadExistIn("XeBuom_In");
        $result = $this->MXeBuom->Product($start_date, $end_date, $start_time, $end_time, $product_id);

        $data = array(
            'action' => 'stat_xebuom_product',
            'template' => 'statistic/xebuom/product',
            'result' => $result,
            'data' => array(
                'result' => $result,
                'product' => $product, 'product_id' => $product_id,
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
                'D3' => "Sản phẩm",
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
            $data["E" . ($startRow)] = "=SUBTOTAL(9,E4:E" . ($startRow - 2) . ")-E". ($startRow - 1). "";
            $data["F" . ($startRow)] = "=SUBTOTAL(9,F4:F" . ($startRow - 1) . ")";
            $data["G" . ($startRow)] = "=SUBTOTAL(9,G4:G" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":C" . $startRow);
            $data["A" . $startRow] = "Tổng khối lượng trước khi có cá trả về:";
            $ex->mergeCells("A" . ($startRow + 1) . ":C" . ($startRow + 1));
            $data["A" . ($startRow + 1)] = "Tổng khối lượng sau khi có cá trả về:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "XeBuoim_Product.xls";
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
            $worker_id = $_POST["worker_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $lo_id = "";
            $worker_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MXeBuom");
        $this->load->model("MLoHang");
        $this->load->model("MWorker");
        $worker = $this->MWorker->ReadExistIn("XeBuom_Out");
        $lohang = $this->MLoHang->ReadExistIn("XeBuom_Out");
        $result = $this->MXeBuom->Worker($lo_id, $start_date, $end_date, $start_time, $end_time,$worker_id);

        $data = array(
            'action' => 'stat_xebuom_worker', 
            'template' => 'statistic/xebuom/worker',
            'result' => $result,
            'data' => array(
                'result' => $result,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'worker' => $worker, 'worker_id' => $worker_id,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time
            )
        );

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
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "XeBuom_Worker.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
}
