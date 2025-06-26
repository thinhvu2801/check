<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Truck extends CI_Controller
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
            $customer_id = $_POST["customer_id"];
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
        } else {
            $customer_id = "";
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
        }
        $this->load->model("MTruck");
        $this->load->model("MCustomer");
        $customer = $this->MCustomer->ReadExistIn("Godaco_Truck_Scale_Station");
        $result = $this->MTruck->Detail($start_date, $end_date, $start_time, $end_time,$customer_id);
        $data = array(
            'action' => 'stat_truck_detail',
            'template' => 'statistic/truck/detail',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'customer' => $customer, 'customer_id' => $customer_id,
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
        $this->load->model("MTruck");
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
                'B3' => "Biển số",
                'C3' => "Khách hàng",
                'D3' => "Tên sản phẩm",
                'E3' => "Khối lượng xe và hàng",
                'F3' => "Khối lượng xe",
                'G3' => "Khối lượng hàng",
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
                    if($i!=3 && $i!=6){
                        $data["G".($startRow)] = "=IF(F".($startRow)." <> 0,E".($startRow)."-F".($startRow).",0)";
                        $data[$ex->column[$startCol] . $startRow] = $value;
                        $startCol++;
                    }
                    $i++;
                }
                $startRow++;
            }
            $data["G" . ($startRow)] = "=SUBTOTAL(9,G4:G" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":D" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "Cang.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function detail2()
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
        $this->load->model("MTruck");
        $result = $this->MTruck->Detail2($start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_truck_detail2',
            'template' => 'statistic/truck/detail2',
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
            $linkDownload = $this->ExportDetail($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportDetail($data)
    {
        $this->load->model("MTruck");
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
                'B3' => "Thời gian vào",
                'C3' => "Thời gian ra",
                'D3' => "Biển số",
                'E3' => "Khách hàng",
                'F3' => "Tên sản phẩm",
                'G3' => "Khối lượng xe và hàng",
                'H3' => "Khối lượng xe",
                'I3' => "Khối lượng hàng",
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
                $i=0;
                $data["A" . $startRow] = $startRow - 3;
                foreach ($rs as $key => $value) {
                    if($i!=7){
                        $data["I".($startRow)] = "=IF(F".($startRow)." <> 0,G".($startRow)."-H".($startRow).",0)";
                        $data[$ex->column[$startCol] . $startRow] = $value;
                        $startCol++;
                    }
                    $i++;
                }
                $startRow++;
            }
            $data["I" . ($startRow)] = "=SUBTOTAL(9,I4:I" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":G" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "ChiTietCang.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function detailhistory()
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
        $this->load->model("MTruck");
        $result = $this->MTruck->DetailHistory($start_date, $end_date, $start_time, $end_time);
        $data = array(
            'action' => 'stat_truck_detail_history',
            'template' => 'statistic/truck/detailhistory',
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
            $linkDownload = $this->ExportDetailHistory($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportDetailHistory($data)
    {
        $this->load->model("MTruck");
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
                'B3' => "Giờ",
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
                $i=0;
                $data["A" . $startRow] = $startRow - 3;
                foreach ($rs as $key => $value) {
                    if($i!=0){
                        $data[$ex->column[$startCol] . $startRow] = $value;
                        $startCol++;
                    }
                    $i++;
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
            $linkDownload = "LichSuCang.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function general($customer_id,$date)
    {
        $this->load->model("MTruck");
        // $today = date("Y-m-d");
        $result = $this->MTruck->General($date, $customer_id);
        $result_extra_weight = $this->MTruck->ReadExtraWeight($customer_id,$date);
        if(!empty($result_extra_weight[0]['weight'])){
            $extra_weight = $result_extra_weight[0]['weight'];
        }else $extra_weight = 0;
        $data = array(
            'action' => 'stat_truck_general',
            'template' => 'statistic/truck/general',
            'date' => $date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'customer_id' => $customer_id,
                'date' => $date,
                'extra_weight' => $extra_weight
            )
        );
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportGeneral($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportGeneral($data)
    {
        $this->load->model("MTruck");
        $result = $data["result"];
        if (sizeof($result) > 0) {
            $this->load->library('myexcel');
            $this->load->library('utilities');
            $uti = new Utilities();
            $ex = new MyExcel();
            $ex->config["pagesetup"]["orientation"] = 0; //giấy dọc
            $sheet = $ex->SetSheet(0, "ThongKe");
            $date = new DateTime($data["date"]);
            $header = array('A1' => "THỐNG KÊ TỪ NGÀY " . $date->format('d/m/Y'));
            $ex->SetValue($header);

            $headerRow = array(
                'A3' => "TT",
                'B3' => "Số phiếu",
                'C3' => "Biển số",
                'D3' => "Tên khách hàng",
                'E3' => "Sản phẩm",
                'F3' => "Thời gian vào",
                'G3' => "Thời gian ra",
                'H3' => "Ghi chú",
                'I3' => "Khối lượng xe và hàng",
                'J3' => "Khối lượng xe",
                'K3' => "Khối lượng hàng",
            );
            $max_col = "K";
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
                    if($i!=0){
                        $data["K".($startRow)] = "=IF(J".($startRow)." <> 0,I".($startRow)."-J".($startRow).",0)";
                        $data[$ex->column[$startCol] . $startRow] = $value;
                        $startCol++;
                    }
                    $i++;
                }
                $startRow++;
            }
            $data["K" . ($startRow)] = "=SUBTOTAL(9,K4:K" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":J" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "ChiTietXe.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }

    public function WeightOut()
    {
        if (isset($_POST["date"])) {
            $date = $_POST["date"];
            $customer_id = $_POST["customer_id"];
        } else {
            $date = date("Y-m-d");
            $customer_id = "";
        }
        $this->load->model("MTruck");
        $this->load->model("MCustomer");
        $customer = $this->MCustomer->ReadExistIn("Godaco_Truck_Scale_Station");
        $result = $this->MTruck->WeightOut($date, $customer_id);
        $data = array(
            'action' => 'stat_truck_weight_out',
            'template' => 'statistic/truck/weightout',
            'data' => array(
                'result' => $result,
                'customer' => $customer, 'customer_id' => $customer_id,
                'date' => $date,
            )
        );
        $this->load->view('home', $data);
    }

    public function PrintValue($customer_id,$date,$extra_weight)
    {
        $this->load->model("MTruck");
        $result = $this->MTruck->General($date, $customer_id);
        $data = array(
            'result' => $result,
            'weightExtra' => $extra_weight
        );
        $this->load->view('statistic/truck/print',$data);
    }
    public function PrintDetail($so_phieu)
    {
        $this->load->model("MTruck");
        $result = $this->MTruck->Read($so_phieu);
        $customer_id = $result[0]['customer_id'];
        $product_id = $result[0]['product_id'];
        $this->load->model("MCustomer");
        $customer = $this->MCustomer->ReadById($customer_id);
        $this->load->model("MProduct");
        $product = $this->MProduct->ReadById($product_id);
        $data = array(
            'result' => $result,
            'customer_name' => $customer ? $customer->customer_name : '',
            'product_name' => $product ? $product->product_name : ''
        );
        $this->load->view('statistic/truck/print2',$data);
    }
    public function ExtraWeight()
    {
        $this->load->model("MTruck");
        $customer_id = $_POST["customer_id"];
        $date = $_POST["date"];
        $weight = $_POST["weight_remain"];
        $today = date("Y-m-d");
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $time_now = date('H:i:s');
        $data = array(
            'customer_id' => $customer_id,
            'weight' => $weight,
            'date' => $today,
            'time' => $time_now
        );
        $result_out = $this->MTruck->UpdateExtraWeight($data,$customer_id,$today);
        // redirect(base_url() . "truck/general/" . $customer_id . "/" . $date);
        
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportGeneral($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        }
        else {
            redirect(base_url() . "truck/general/" . $customer_id . "/" . $date);
        }
    }
    public function Update()
    {
        $this->load->model('MTruck');
        $customer_id = $_POST["customer_id"];
        $date = $_POST["date"];
        $today = date("Y-m-d");
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $time_now = date('H:i:s');
        $data = array(
            'weight_out' => $_POST["weight_out"],
            'note' => "Sửa Khối lượng ra lúc " . $today. " " . $time_now,
        );
        $result_out = $this->MTruck->Update($data, $_POST["so_phieu"]);
        var_dump($result_out);
        redirect(base_url() . "truck/general/" . $customer_id . "/" . $date);
    }
    
    public function customer()
    {
        if (isset($_POST["date"])) {
            $date = $_POST["date"];
        } else {
            $date = date("Y-m-d");
        }
        $this->load->model("MTruck");
        $result = $this->MTruck->Customer($date);
        $data = array(
            'action' => 'stat_truck_customer',
            'template' => 'statistic/truck/customer',
            'date'=> $date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'date'=> $date,
            )
        );
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportCustomer($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }

    public function ExportCustomer($data)
    {
        $this->load->model("MTruck");
        $result = $data["result"];
        if (sizeof($result) > 0) {
            $this->load->library('myexcel');
            $this->load->library('utilities');
            $uti = new Utilities();
            $ex = new MyExcel();
            $ex->config["pagesetup"]["orientation"] = 0; //giấy dọc
            $sheet = $ex->SetSheet(0, "ThongKe");
            $date = new DateTime($data["date"]);
            $header = array('A1' => "THỐNG KÊ TỪ NGÀY " . $date->format('d/m/Y'));
            $ex->SetValue($header);

            $headerRow = array(
                'A3' => "TT",
                'B3' => "Khách hàng",
                'C3' => "Khối lượng xe và hàng",
                'D3' => "Khối lượng xe",
                'E3' => "Khối lượng hàng",
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
                    $data["E".($startRow)] = "=IF(D".($startRow)." <> 0,C".($startRow)."-D".($startRow).",0)";
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
            $linkDownload = "KhachHang.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
}