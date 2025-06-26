<?php
defined('BASEPATH') or exit('No direct script access allowed');
class WareHouse extends CI_Controller
{
    var $object;
    var $object_type;
    // private $objects = [
    //     "warehouse_reason_out",
    //     "warehouse_infor",
    //     "warehouse_out",
    //     "warehouse_inventory",
    //     "warehouse_in_history",
    //     "warehouse_detail",
    //     "warehouse_total",
    //     "warehouse_out_history"
    // ];
    function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata("username"))
        //     redirect('user/login');
        // if (!$this->session->userdata("admin"))
        //     if (!in_array($this->object, $this->session->userdata("role")))
        //         redirect(base_url());
    }
    public function reason_out()
    {
        print_r($this->object);
        $this->load->model('MWareHouse');
        $mes = "";
        $date = date('Y-m-d');
        if (isset($_POST["reason_id"])) {
            if ($this->MWareHouse->CheckReasonOutCode($_POST["reason_id"]))
                $mes = "Mã lý do đã tồn tại!";
            else {
                $data = array(
                    'reason_id' => $_POST["reason_id"],
                    'reason_description' => $_POST["reason_description"],
                    'date' => $_POST["date"]
                );
                $this->MWareHouse->Reason_Insert($data);
            }
        }
        $reason_out = $this->MWareHouse->ReasonOutRead();
        $data = array(
            'action' => 'warehouse_reason_out',
            'template' => 'warehouse/reason_out',
            'data' => array(
                'mes' => $mes,
                'reason_out' => $reason_out,
                'date' => $date
            )
        );

        $this->load->view('home', $data);
    }
    public function infor()
    {
        $this->load->model('MProduct');
        $this->load->model('MSize');
        $this->load->model('MQuyCach');
        $this->load->model('MWareHouse');
        $product = $this->MProduct->Read("KHO");
        $size = $this->MSize->Read();
        $quycach = $this->MQuyCach->Read();
        $mes = "";
        if (isset($_POST["warehouse_id"])) {
            if ($this->MWareHouse->CheckCode($_POST["warehouse_id"]))
                $mes = "Mã kho đã tồn tại!";
            else {
                $data = array(
                    'warehouse_id' => $_POST["warehouse_id"],
                    'product_id' => $_POST["product_id"],
                    'quycach_id' => $_POST["quycach_id"],
                    'size_id' => $_POST["size_id"]
                );
                $this->MWareHouse->Infor_Insert($data);
            }
        }
        $warehouse_infor = $this->MWareHouse->Infor_Read();
        $data = array(
            'action' => 'warehouse_infor',
            'template' => 'warehouse/infor',
            'data' => array(
                'mes' => $mes,
                'size' => $size,
                'product' => $product,
                'quycach' => $quycach,
                'warehouse_infor' => $warehouse_infor
            )
        );

        $this->load->view('home', $data);
    }
    public function delete($id)
    {
        if (!$this->session->userdata("username"))
            redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MWareHouse');
        $this->MWareHouse->Delete($id);
        redirect(base_url() . "warehouse/infor");
    }

    public function out($reason_id = "")
    {
        $this->load->model('MWareHouse');
        $mes = "";
        $warehouse_id = "";

        // $reason_id="";
        if (isset($_POST["reason_id"])) {
            $reason_id = $_POST["reason_id"];
        }
        if (isset($_POST["warehouse_id"])) {
            $warehouse_id = $_POST["warehouse_id"];
        }
        if (isset($_POST["out"])) {
            $result_out = $this->MWareHouse->Out_Insert($reason_id, $warehouse_id, $_POST["quantity"], $_POST["note"]);
            if (sizeof($result_out) > 0) {
                $mes = $result_out[0]->message;
            }
        }
        $warehouse_infor = $this->MWareHouse->Inventory_Stat(date('Y-m-d'), '');
        $warehouse_out = $this->MWareHouse->Out_Stat($reason_id);
        $data = array(
            'action' => 'warehouse_out',
            'template' => 'warehouse/out',
            'data' => array(
                'mes' => $mes,
                'reason_id' => $reason_id,
                'warehouse_id' => $warehouse_id,
                'warehouse_infor' => $warehouse_infor,
                'warehouse_out' => $warehouse_out,
            )
        );
        $this->load->view('home', $data);
    }
    public function inventory($warehouse_id = "")
    {
        $this->load->model('MWareHouse');
        $mes = "";
        $date = date('Y-m-d');

        if (isset($_POST["date"])) {
            $date = $_POST["date"];
        }
        if (isset($_POST["warehouse_id"])) {
            $warehouse_id = $_POST["warehouse_id"];
        }
        $warehouse_infor = $this->MWareHouse->Infor_Read();
        $inventory = $this->MWareHouse->Inventory_Stat($date, $warehouse_id);
        $data = array(
            'action' => 'warehouse_inventory',
            'template' => 'warehouse/inventory',
            'data' => array(
                'mes' => $mes,
                'inventory' => $inventory,
                'date' => $date,
                'warehouse_infor' => $warehouse_infor,
                'warehouse_id' => $warehouse_id,
            )
        );
        $this->load->view('home', $data);
    }
    public function Import()
    {
        $pcode = "";
        $mes = "Không thể import!";
        if (isset($_POST['import'])) {
            if ($_FILES["file_xls"]["size"] > 0) {
                $this->load->library('myexcel');
                $this->load->model('MWareHouse');
                $myexcel = new MyExcel();
                $fname = $myexcel->ToCSV($_FILES["file_xls"], 'upload');
                $file = fopen($fname, "r");

                $emapData = fgetcsv($file, 0, ",");
                if ($emapData != array('warehouse_id', 'quantity', 'weight'))
                    $this->inhistory("","Cấu trúc file dữ liệu không đúng!");
                else {
                    while (($emapData = fgetcsv($file, 0, ",")) !== FALSE) {
                        // if($emapData[3]=='') $reason = "KIEMKE";
                        // else $reason = $emapData[3];
                        $reason = "KIEMKE";
                        $date = date("Y-m-d");
                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                        $time = date('H:i:s');
                        $dataIn = array(
                            'reason_id' => $reason,
                            'warehouse_id' => $emapData[0],
                            'quantity' => $emapData[1],
                            'weight' => $emapData[2],
                            'date' => $date,
                            'time' => $time
                        );
                        $status = "DONE";
                        if ($this->MWareHouse->CheckCodeIn($emapData[0])) {
                            $status = "P_ERROR";
                            if (isset($_POST['thaythe'])) {
                                $this->db->where('warehouse_id', $emapData[0]);
                                $this->db->update('WareHouse_In', $dataIn);
                                $mes = "Đã được thay thế bằng dữ liệu mới!";
                            }
                        }
                        if ($status == "DONE") {
                            if($this->MWareHouse->CheckCode($emapData[0])){
                                $this->MWareHouse->InsertIn($dataIn);
                            }else {
                                $pcode = $pcode . $emapData[0] . " ";
                                $mes = "Chưa khai báo " . $pcode;
                            }
                        } else {
                            $pcode = $pcode . $emapData[0] . " ";
                            $mes = "Các mã kho " . $pcode . " đã có trong kho";
                        }
                    }
                    fclose($file);
                    unset($fname);
                    if ($pcode != "")
                        $this->inhistory("",$mes);
                    else 
                    $this->inhistory();
                }
            } else {
                echo "E1";
            }
        } else {
            echo "E2";
        }
    }
    public function inhistory($warehouse_id = "",$mes = "")
    {
        $this->load->model('MWareHouse');
        // $mes = "";
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');
        $warehouse_infor = $this->MWareHouse->Infor_Read();
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');
        if (isset($_POST['start_date'])) {
            $start_date = $_POST['start_date'];
        }
        if (isset($_POST['end_date'])) {
            $end_date = $_POST['end_date'];
        }
        if (isset($_POST['warehouse_id'])) {
            $warehouse_id = $_POST['warehouse_id'];
        }
        $inhistory = $this->MWareHouse->InHistory($start_date, $end_date, $warehouse_id);
        $data = array(
            'action' => 'warehouse_in_history',
            'template' => 'warehouse/inhistory',
            'data' => array(
                'mes' => $mes,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'warehouse_id' => $warehouse_id,
                'warehouse_infor' => $warehouse_infor,
                'inhistory' => $inhistory
            )
        );
        $this->load->view('home', $data);
    }
    public function detail($warehouse_id = "")
    {
        $this->load->model('MWareHouse');
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');
        $warehouse_infor = $this->MWareHouse->Infor_Read();
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');
        if (isset($_POST['start_date'])) {
            $start_date = $_POST['start_date'];
        }
        if (isset($_POST['end_date'])) {
            $end_date = $_POST['end_date'];
        }
        if (isset($_POST['warehouse_id'])) {
            $warehouse_id = $_POST['warehouse_id'];
        }
        $result = $this->MWareHouse->Detail($start_date, $end_date, $warehouse_id);
        $data = array(
            'action' => 'warehouse_detail',
            'template' => 'warehouse/detail',
            'result' => $result,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'data' => array(
                'start_date' => $start_date,
                'end_date' => $end_date,
                'warehouse_id' => $warehouse_id,
                'warehouse_infor' => $warehouse_infor,
                'result' => $result
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
                'B3' => "Ngày nhập NL",
                'C3' => "Ngày cân",
                'D3' => "Giờ nhập",
                'E3' => "Lý do nhập",
                'F3' => "Mã kho",
                'G3' => "Quy cách",
                'H3' => "Hàng hóa",
                'I3' => "Mã cân",
                'J3' => "Số lượng",
                'K3' => "Khối lượng",
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
                    if($i!=7){
                        $data[$ex->column[$startCol] . $startRow] = $value;
                        $startCol++;
                    }
                    $i++;
                }
                $startRow++;
            }
            $data["J" . ($startRow)] = "=SUBTOTAL(9,J4:J" . ($startRow - 1) . ")";
            $data["K" . ($startRow)] = "=SUBTOTAL(9,K4:K" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":I" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "ChiTietKho.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function History()
    {
        if (isset($_POST['start_date'])) {
            $start_date = $_POST['start_date'];
        } else {
            $start_date = date('Y-m-d');
        }
        $this->load->model("MWareHouse");
        $result = $this->MWareHouse->History($start_date);
        // print_r($result);
        $data = array(
            'action' => 'warehouse_history',
            'template' => 'warehouse/history',
            'start_date'=> $start_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'start_date'=> $start_date,
            )
        );
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportHistory($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportHistory($data)
    {
        $result = $data["result"];
        if (sizeof($result) > 0) {
            $this->load->library('myexcel');
            $this->load->library('utilities');
            $uti = new Utilities();
            $ex = new MyExcel();
            $ex->config["pagesetup"]["orientation"] = 0; //giấy dọc
            $sheet = $ex->SetSheet(0, "ThongKe");
            $date = new DateTime($data["start_date"]);
            $header = array('A1' => "THỐNG KÊ TỪ NGÀY " . $date->format('d/m/Y'));
            $ex->SetValue($header);

            $headerRow = array(
                'A3' => "TT",
                'B3' => "Thời gian",
                'C3' => "Vị trí",
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
            $linkDownload = "LichSuVatTrenCan.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function total()
    {
        if (isset($_POST['start_date']) || isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
        } else {
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d');
        }
        $this->load->model("MWareHouse");
        $result = $this->MWareHouse->Total($start_date,$end_date);
        // print_r($result);
        $data = array(
            'action' => 'warehouse_total',
            'template' => 'warehouse/total',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'start_date'=> $start_date,
                'end_date'=> $end_date,
            )
        );
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportTotal($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportTotal($data)
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
                'B3' => "Mã kho",
                'C3' => "Quy cách",
                'D3' => "Hàng hóa",
                'E3' => "Size",
                'F3' => "Số lượng",
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
            $data["F" . ($startRow)] = "=SUBTOTAL(9,F4:F" . ($startRow - 1) . ")";
            $data["G" . ($startRow)] = "=SUBTOTAL(9,G4:G" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":E" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "TongHopKho.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function totalkho()
    {
        if (isset($_POST['start_date']) || isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
        } else {
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d');
        }
        $this->load->model("MWareHouse");
        $result = $this->MWareHouse->Total($start_date,$end_date);
        // print_r($result);
        $data = array(
            'action' => 'warehouse_totalkho',
            'template' => 'warehouse/totalkho',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'start_date'=> $start_date,
                'end_date'=> $end_date,
            )
        );
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportTotalKho($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportTotalKho($data)
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
                'B3' => "Mã kho",
                'C3' => "Quy cách",
                'D3' => "Hàng hóa",
                'E3' => "Size",
                'F3' => "Số lượng",
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
            $data["F" . ($startRow)] = "=SUBTOTAL(9,F4:F" . ($startRow - 1) . ")";
            $data["G" . ($startRow)] = "=SUBTOTAL(9,G4:G" . ($startRow - 1) . ")";
            $ex->mergeCells("A" . $startRow . ":E" . $startRow);
            $ex->FontStyle("A" . $startRow . ":" . $max_col . $startRow, "B");
            $data["A" . $startRow] = "Tổng cộng:";

            $ex->SetBorder("A3:" . $max_col . $startRow);
            $ex->SetValue($data);
            $ex->SetColumnAutoSize();
            $linkDownload = "TongHopKho.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function totalcoi()
    {
        if (isset($_POST['start_date']) || isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
        } else {
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d');
        }
        $this->load->model("MWareHouse");
        $result = $this->MWareHouse->TotalCoi($start_date,$end_date);
        // print_r($result);
        $data = array(
            'action' => 'warehouse_total_coi',
            'template' => 'warehouse/totalcoi',
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'result' => $result,
            'data' => array(
                'result' => $result,
                'start_date'=> $start_date,
                'end_date'=> $end_date,
            )
        );
        if (isset($_POST["export"])) {
            $linkDownload = $this->ExportTotalCoi($data);
            if ($linkDownload != "")
                redirect(base_url() . $linkDownload);
        } else {
            $this->load->view('home', $data);
        }
    }
    public function ExportTotalCoi($data)
    {
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
                'B3' => "Cối",
                'C3' => "Mã kho",
                'D3' => "Quy cách",
                'E3' => "Hàng hóa",
                'F3' => "Size",
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
            $linkDownload = "TongHopCoi.xls";
            $ex->Save($linkDownload);
            return $linkDownload;
        } else {
            return "";
        }
    }
    public function outhistory($warehouse_id = "")
    {
        $this->load->model('MWareHouse');
        $mes = "";
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');
        $warehouse_infor = $this->MWareHouse->Infor_Read();
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');
        if (isset($_POST['start_date'])) {
            $start_date = $_POST['start_date'];
        }
        if (isset($_POST['end_date'])) {
            $end_date = $_POST['end_date'];
        }
        if (isset($_POST['warehouse_id'])) {
            $warehouse_id = $_POST['warehouse_id'];
        }
        $outhistory = $this->MWareHouse->OutHistory($start_date, $end_date, $warehouse_id);
        $data = array(
            'action' => 'warehouse_out_history',
            'template' => 'warehouse/outhistory',
            'data' => array(
                'mes' => $mes,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'warehouse_id' => $warehouse_id,
                'warehouse_infor' => $warehouse_infor,
                'outhistory' => $outhistory
            )
        );
        $this->load->view('home', $data);
    }
    public function out_delete($reason_id, $warehouse_id)
    {
        if (!$this->session->userdata("username"))
            redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MWareHouse');
        $this->MWareHouse->Out_Delete($reason_id, $warehouse_id);
        redirect(base_url() . "warehouse/out/" . $reason_id);
    }
    public function kiemke()
    {
        $this->load->model('MWareHouse');
        $warehouse_id = $_POST["warehouse_id"];
        $remain = $_POST["remain"];
        $quantity = $_POST["quantity"];
        $weight = $_POST["weight"];
        for ($i = 0; $i < sizeof($warehouse_id); $i++) {
            if ($remain[$i] > $quantity[$i]) {
                //thêm vào xuất kho
                $result_out = $this->MWareHouse->Out_Insert('KIEMKE', $warehouse_id[$i], $remain[$i] - $quantity[$i], '');
               // print_r($result_out);
            }
            if ($remain[$i] < $quantity[$i]) {
                //thêm vào nhập kho
                $result_out = $this->MWareHouse->In_Insert('KIEMKE', $warehouse_id[$i], $quantity[$i] - $remain[$i],$weight[$i], '');
            }
            //echo $warehouse_id[$i] ." ".$remain[$i] ." ".$quantity[$i];
        }
        redirect(base_url() . "warehouse/inventory");
    }


     public function dongbo(){
        if(!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model("MWareHouse");
        $table_name = 'WareHouse_Infor';
        $sel=$this->MWareHouse->Infor_Read_2();
        //$this->load->database();
        $fields = $this->db->list_fields($table_name);
        $p="";
        for ($i=0; $i < Count($fields); $i++) { 
            $p.=$fields[$i];
            if($i<Count($fields)-1){
                $p.=',';
            }
        }
        $insert="";
        foreach($sel as $sel1){
            $temp = "";
            foreach ($sel1 as $key => $value) {
                $temp .= 'N'.'\''.$value . '\''.',';
            }
            $temp=substr($temp,0,strlen($temp)-1);
            $insert .= "INSERT INTO $table_name ($p) VALUES ($temp); ";
        }
        $this->MWareHouse->Update_Kho($insert,$table_name);
        return $this->infor();
    }
}