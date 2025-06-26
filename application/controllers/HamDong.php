<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HamDong extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "hamdong";
        $this->object_type = 10;
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($mes = "")
    {
        $this->load->model('MHamDong');
        $data = array(
            'action' => 'hamdong',
            'template' => 'hamdong/index',
            'data' => array(
                'hamdong' => $this->MHamDong->Read(),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["ham_id"])) {
            $this->load->model('MHamDong');
            if ($this->MHamDong->CheckCode($_POST["ham_id"]))
                $this->View("Mã hầm đã tồn tại!");
            else {
                $data = array(
                    'ham_id' => $_POST["ham_id"],
                    'ham_name' => $_POST["ham_name"],
                    'note' => $_POST["note"]
                );
                $this->MHamDong->Insert($data);
                redirect(base_url() . "hamdong");
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }

    public function Update()
    {
        if (isset($_POST["new_ham_id"])) {
            $this->load->model('MHamDong');
            $this->load->model('MCard');
            if ($_POST["new_ham_id"] != $_POST["old_ham_id"]) {
                if ($this->MHamDong->CheckCode($_POST["new_ham_id"]))
                    $this->View("Mã hầm đã tồn tại!");
                else {
                    $data = array(
                        'ham_id' => $_POST["new_ham_id"],
                        'ham_name' => $_POST["ham_name"],
                        'note' => $_POST["note"]
                    );
                    $this->MHamDong->Update($data, $_POST["old_ham_id"]);
                    $this->MCard->updateObjectID($_POST["old_ham_id"], $_POST["new_ham_id"], $this->object_type);
                }
            } else {
                $data = array('note' => $_POST["note"]);
                $this->MHamDong->Update($data, $_POST["old_ham_id"]);
                $this->MCard->updateObjectID($_POST["old_ham_id"], $_POST["new_ham_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($lid)
    {
        if (!$this->session->userdata("username")) redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MHamDong');
        $this->MHamDong->Delete($lid);
        redirect(base_url() . "hamdong");
    }
    public function card($ham_id = "")
    {
        $this->load->model('MHamDong');
        $hamdong = $this->MHamDong->Read();
        $data = array(
            'action' => 'hamdong_card',
            'template' => 'hamdong/card',
            'data' => array(
                'hamdong' => $hamdong,
                'ham_id' => $ham_id
            )
        );
        $this->load->view('home', $data);
    }
    public function card_delete()
    {
        if (isset($_POST["card_id"])) {
            $this->load->model('MCard');
            $this->MCard->Delete($_POST["card_id"]);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function card_read()
    {
        if (isset($_POST["object_id"])) {
            $object_id = $_POST["object_id"];
            $this->load->model('MCard');
            $card_list = $this->MCard->Card_Read_By_Object($object_id, $this->object_type);
            $data = array('card_list' => $card_list);
            $this->view->base_url = base_url();
            $this->view->parse('hamdong/card_read', $data);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function card_create()
    {
        if (isset($_POST["card_id"])) {
            $card_id = $_POST["card_id"];
            $object_id = $_POST["object_id"];
            $this->load->model('MCard');
            $this->MCard->Create($card_id, $object_id, $this->object_type);
        } else {
            redirect(base_url() . $this->object);
        }
    }


    public function detail()
    {
        if (isset($_POST["date"])) {
            $ham_id = $_POST["ham_id"];
            $lo_id = $_POST["lo_id"];
            $date = $_POST["date"];
        } else {
            $lo_id = "";
            $ham_id = "";
            $date = date("Y-m-d");
        }
        $this->load->model("MHamDong");
        $this->load->model("MLoHang");
        $hamdong = $this->MHamDong->Read();
        $lohang = $this->MLoHang->ReadExistIn("HamDong");
        $result_in = $this->MHamDong->Stat_Detail($date, $ham_id, $lo_id, 1);
        $result_out = $this->MHamDong->Stat_Detail($date, $ham_id, $lo_id, -1);

        $data = array(
            'action' => 'stat_hamdong_detail',
            'template' => 'statistic/hamdong/detail',
            'data' =>  array(
                'result_in' => $result_in,
                'result_out' => $result_out,
                'hamdong' => $hamdong, 'ham_id' => $ham_id,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'date' => $date
            )
        );

        if (isset($_POST["export"])) {
            //$this->uti->export($result_in, 'hamdong_in-'.$date);
            $this->uti->export(array_merge($result_in, $result_out), 'hamdong_out-' . $date);
        }

        $this->load->view('home', $data);
    }

    public function synthetic()
    {
        if (isset($_POST["start_date"])) {
            $ham_id = $_POST["ham_id"];
            $lo_id = $_POST["lo_id"];
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
        } else {
            $ham_id = $lo_id = "";
            $start_date = $end_date = date("Y-m-d");
        }
        $this->load->model("MHamDong");
        $this->load->model("MLoHang");

        if (isset($_POST["inventory"])) {
            $data = $_POST["data"];
            $weight_ton = $_POST["weight_ton"];
            $i = 0;
            foreach ($data as $dt) {
                $values = explode(",", $dt);
                $this->MHamDong->KiemKe(
                    $_POST['date'],
                    $_POST['time'],
                    $values[0],
                    $values[1],
                    $values[2],
                    $values[3],
                    $weight_ton[$i]
                );
                $i++;
            }
            $start_date = $end_date = $_POST['date'];
        }

        $hamdong = $this->MHamDong->Read();
        $lohang = $this->MLoHang->ReadExistIn("HamDong");

        $interval = DateInterval::createFromDateString('+1 day');
        $next_end_date = new DateTime($end_date);
        $period = new DatePeriod(new DateTime($start_date), $interval, $next_end_date->modify('+1 day'));
        $result = array();
        foreach ($period as $dt) {
            $data = $this->MHamDong->Stat_Synthetic($dt->format("Y-m-d"), $ham_id, $lo_id);
            if (sizeof($data) > 0) {
                $result[] = $data;
            }
        }

        $data = array(
            'action' => 'stat_hamdong_synthetic',
            'template' => 'statistic/hamdong/synthetic',
            'data' =>  array(
                'result' => $result,
                'hamdong' => $hamdong, 'ham_id' => $ham_id,
                'lohang' => $lohang, 'lo_id' => $lo_id,
                'start_date' => $start_date,
                'end_date' => $end_date
            )
        );
        $data2 = array();
        if (isset($_POST["export"])) {
            foreach ($result as $rsl) {
                foreach ($rsl as $rs) {
                    $data2[] = $rs;
                }
                $data2[] = array();
            }
            $this->uti->export($data2, 'hamdong-' . $start_date . '-' . $end_date);
        }
        $this->load->view('home', $data);
    }
    public function inventory()
    {
        $this->load->model("MHamDong");
        $data = $_POST["data"];
        $weight_ton = $_POST["weight_ton"];
        $i = 0;
        foreach ($data as $dt) {
            $values = explode(",", $dt);
            $this->MHamDong->KiemKe(
                $_POST['date'],
                $_POST['time'],
                $values[0],
                $values[1],
                $values[2],
                $values[3],
                $weight_ton[$i]
            );
            $i++;
        }
    }
    // public function inventory()
    // {
    //     $this->load->model("MHamDong");
    //     $this->load->model("MInventory");
    //     $this->load->model("MSize");
    //     $this->load->model("MProductType");
    //     $hamdong = $this->MHamDong->Read();
    //     $product_type = $this->MProductType->Read();

    //     if (isset($_POST["date"])) {
    //         $ham_id = $_POST["ham_id"];
    //         $product_type_id = $_POST["product_type_id"];
    //         $date = $_POST["date"];
    //         $time = $_POST["time"];
    //     } else {
    //         $ham_id = $hamdong[0]->ham_id;
    //         $product_type_id = $product_type[0]->product_type_id;
    //         $date = date("Y-m-d");
    //         date_default_timezone_set('Asia/Ho_Chi_Minh');
    //         $time = date("H:i");
    //     }

    //     if (isset($_POST["inventory"])) {
    //         $this->load->model("MInventory");
    //         $ham_id=$_POST['ham_id'];
    //         $product_type_id = $_POST["product_type_id"];
    //         $date = $_POST["date"];
    //         if (isset($_POST["size_id"])){
    //             $size_id = $_POST["size_id"];
    //             foreach ($size_id as $s) {
    //                 $this->MInventory->insert(
    //                     array(
    //                         'date'=>$date,
    //                         'time'=>$time,
    //                         'ham_id'=>$ham_id,
    //                         'size_id'=>$s,
    //                         'product_type_id'=>$product_type_id,
    //                         'weight'=>$_POST[$s]
    //                     )
    //                 );
    //             }
    //         }
    //     }
    //     $size = $this->MInventory->read($ham_id, $product_type_id,$date);
    //     $data = array(
    //         'action' => 'stat_hamdong_inventory',
    //         'product_type' => $product_type,
    //         'product_type_id' => $product_type_id,
    //         'hamdong' => $hamdong,
    //         'ham_id' => $ham_id,
    //         'size' => $size, 
    //         'date' => $date,
    //         'time'=>$time
    //     );

    //     $this->load->view('home', $data);
    // }
}
