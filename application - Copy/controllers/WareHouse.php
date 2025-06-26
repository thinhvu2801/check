<?php
defined('BASEPATH') or exit('No direct script access allowed');
class WareHouse extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("username"))
            redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
    }
    public function reason_out()
    {
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
    public function inventory( $warehouse_id = "")
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
    public function inhistory($warehouse_id = "")
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
}