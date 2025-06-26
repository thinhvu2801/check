<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Worker extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "worker";
        $this->object_type = 2;
        $this->object_related = array('SuaCa','Fillet');
    }
    public function index($group_id = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if ($group_id == "")
            redirect(base_url() . "group");
        $this->View($group_id);
    }

    public function View($group_id, $mes = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MWorker');
        $this->load->model('MGroup');
        $group = $this->MGroup->ReadById($group_id);
        if (empty($group))
            redirect(base_url() . "group");
        $data = array(
            'action' => 'worker',
            'template' => 'worker/index',
            'data' => array(
                'group' => $group,
                'groups' => $this->MGroup->Read(),
                'worker' => $this->MWorker->Read($group_id),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["worker_id"])) {
            $this->load->model('MWorker');
            $this->load->model('MGroup');
            if ($this->MWorker->CheckCode($_POST["worker_id"]))
                $this->View($_POST["group_id"], "Mã công nhân đã tồn tại!");
            else {
                $data = array(
                    'worker_id' => $_POST["worker_id"],
                    'factory_id' => $_POST["factory_id"],
                    'worker_name' => $_POST["worker_name"],
                    'note' => $_POST["note"],
                    'group_id' => $_POST["group_id"]
                );
                $this->MWorker->Insert($data);
                redirect(base_url() . "worker/index/" . $_POST["group_id"]);
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Import()
    {
        $wcode = "";
        $mes = "Không thể import!";
        if (isset($_POST['import'])) {
            if ($_FILES["file_xls"]["size"] > 0) {
                $this->load->library('myexcel');
                $this->load->model('MWorker');
                $myexcel = new MyExcel();
                $fname = $myexcel->ToCSV($_FILES["file_xls"], 'upload');
                $file = fopen($fname, "r");

                $emapData = fgetcsv($file, 0, ",");
                if ($emapData != array('stt','factory_id', 'worker_id', 'worker_name'))
                    $this->View($_POST["group_id"], "Cấu trúc file dữ liệu không đúng!");
                else {

                    while (($emapData = fgetcsv($file, 0, ",")) !== FALSE) {
                        $worker_id = trim($emapData[1]);
                        if ($worker_id != "") {
                            $data = array(
                                'worker_id' => $emapData[2],
                                'factory_id' => $emapData[1],
                                'worker_name' => $emapData[3],
                                'group_id' => $_POST["group_id"]
                            );
                            $status = "DONE";
                            if ($this->MWorker->CheckCode($emapData[1])) {
                                $status = "W_ERROR";
                                if (isset($_POST['thaythe'])) {
                                    $this->db->where('worker_id', $emapData[1]);
                                    $this->db->update('worker', $data);
                                    $mes = "Đã được thay thế bằng dữ liệu mới!";
                                }
                            }
                            if ($status == "DONE") $this->MWorker->Insert($data);
                            else $wcode = $wcode . $emapData[1] . " ";
                        }
                    }
                    fclose($file);
                    unset($fname);
                    if (($wcode != ""))
                        $this->View($_POST["group_id"], "Các mã công nhân: " . $wcode . "đã có trong hệ thống! " . $mes);
                    else $this->View($_POST["group_id"]);
                }
            } else {
                //redirect(base_url());
                echo "E1";
            }
        } else {
            //redirect(base_url());
            echo "E2";
        }
    }
    public function Update()
    {
        if (isset($_POST["new_worker_id"])) {
            $this->load->model('MWorker');
            $this->load->model('MCard');
            $this->load->model('MGeneral');
            if ($_POST["new_worker_id"] != $_POST["old_worker_id"]) {
                if ($this->MWorker->CheckCode($_POST["new_worker_id"]))
                    $this->View($_POST["group_id"], "Mã công nhân đã tồn tại!");
                else {
                    $data = array(
                        'worker_id' => $_POST["new_worker_id"],
                        'factory_id' => $_POST["factory_id"],
                        'worker_name' => $_POST["worker_name"],
                        'group_id' => $_POST["group_id"],
                        'note' => $_POST["note"]
                    );
                    $this->MWorker->Update($data, $_POST["old_worker_id"]);
                    $this->MGeneral->UpdateObjectRelated($this->object_related,"worker_id", $_POST["old_worker_id"],  $_POST["new_worker_id"]);
                    $this->MCard->updateObjectID($_POST["old_worker_id"], $_POST["new_worker_id"], $this->object_type);
                    $this->View($_POST["group_id"]);
                }
            } else {
                $data = array(
                    'worker_name' => $_POST["worker_name"],
                    'factory_id' => $_POST["factory_id"],
                    'group_id' => $_POST["group_id"],
                    'note' => $_POST["note"]
                );
                $this->MWorker->Update($data, $_POST["old_worker_id"]);
                
                $this->MCard->updateObjectID($_POST["old_worker_id"], $_POST["new_worker_id"], $this->object_type);
            }
            redirect(base_url() . $this->object . "/view/" . $_POST["group_id"]);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($wid, $group_id)
    {
        if (!$this->session->userdata("username")) redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MWorker');
        $this->MWorker->Delete($wid);
        redirect(base_url() . "worker/index/" . $group_id);
    }

    public function card($worker_id = "0")
    {
        if (!$this->session->userdata("username")) redirect('user/login');
        $this->load->model('MWorker');
        $this->load->model("MProduct");
        $product = $this->MProduct->ReadLinkAble();

        if ($worker_id == "0")
            $worker = $this->MWorker->Read();
        else {
            $w = $this->MWorker->ReadById($worker_id);
            $worker = $this->MWorker->Read($w->group_id);
        }
        $data = array(
            'action' => 'worker_card',
            'template' => 'worker/card',
            'data' =>  array(
                'product' => $product, 'worker' => $worker, 'worker_id' => $worker_id
            )
        );
        $this->load->view('home', $data);
    }
    public function card_delete()
    {
        if (isset($_POST["card_id"])) {
            $this->load->model('MCard');
            $this->MCard->Delete($_POST["card_id"]);
            $this->MCard->Delete_CNSP($_POST["card_id"]);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function card_read()
    {
        if (isset($_POST["object_id"])) {
            $object_id = $_POST["object_id"];
            $this->load->model('MCard');
            $card_list = $this->MCard->Card_Read_By_Object($object_id, 2); //2: worker card
            $data = array('card_list' => $card_list);
            $this->view->base_url = base_url();
            $this->view->parse('worker/card_read', $data);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function card_create()
    {
        if (isset($_POST["card_id"])) {
            $card_id = $_POST["card_id"];
            $worker_id = $_POST["worker_id"];
            $product_id = $_POST["product_id"];
            $this->load->model('MCard');
            if ($product_id == "0")
                $this->MCard->Create($card_id, $worker_id, $this->object_type);
            else {
                $this->MCard->Create($card_id, $worker_id, $this->object_type);
                $this->MCard->Create_Card_CNSP($card_id, $worker_id, $product_id);
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }
}
