<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Role extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "Role";
        $this->object_type = 3;
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        //echo base64_encode('{"expired":"2020-09-06","message":"Hệ thống cân thống kê hết hạn sử dụng từ ngày 06/09/2020.!"}');
        /*$MAC = exec('getmac');
        // $MAC = strtok($MAC, ' ');
        // $this->load->library('zip');
        // $this->zip->read_file('G:/HASACO2_STATISTIC_SCALE_MENT.bak', true);
        // $this->zip->download('HASACO.zip');*/
        $this->View();
    }
    public function View($mes = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MRole');

        $data = array(
            'action' => 'role',
            'template' => 'role/index',
            'data' => array(
                'role' => $this->MRole->Read(),
                'mes' => $mes
            )
        );

        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["role_id"])) {
            $this->load->model('MRole');
            if ($this->MRole->CheckCode($_POST["role_id"]))
                $this->View("Mã quyền đã tồn tại!");
            else {
                $data = array(
                    'role_id' => $_POST["role_id"],
                    'role_name' => $_POST["role_name"],
                    'orderby' => $_POST["orderby"]
                );
                $this->MRole->Insert($data);
                redirect(base_url() . "role");
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Import()
    {
        $pcode = "";
        $mes = "Không thể import!";
        if (isset($_POST['import'])) {
            if ($_FILES["file_xls"]["size"] > 0) {
                $this->load->library('myexcel');
                $this->load->model('MRole');
                $myexcel = new MyExcel();
                $fname = $myexcel->ToCSV($_FILES["file_xls"], 'upload');
                $file = fopen($fname, "r");

                $emapData = fgetcsv($file, 0, ",");
                if ($emapData != array('role_id','role_name', 'orderby'))
                    $this->View("Cấu trúc file dữ liệu không đúng!");
                else {
                    while (($emapData = fgetcsv($file, 0, ",")) !== FALSE) {
                        $data = array(
                            'role_id' => $emapData[0],
                            'role_name' => $emapData[1],
                            'orderby' => $emapData[2],
                        );
                        $status = "DONE";
                        if ($this->MRole->CheckCode($emapData[0])) {
                            $status = "P_ERROR";
                            if (isset($_POST['thaythe'])) {
                                $this->db->where('role_id', $emapData[0]);
                                $this->db->update('role', $data);
                                $mes = "Đã được thay thế bằng dữ liệu mới!";
                            }
                        }
                        if ($status == "DONE") $this->MRole->Insert($data);
                        else $pcode = $pcode . $emapData[0] . " ";
                    }
                    fclose($file);
                    unset($fname);
                    if ($pcode != "")
                        $this->View("Các mã quyền: " . $pcode . "Đã có trong hệ thống! " . $mes);
                    else $this->View();
                }
            } else {
                echo "E1";
            }
        } else {
            echo "E2";
        }
    }
    public function Update()
    {
        if (isset($_POST["new_role_id"])) {
            $this->load->model('MRole');
            $this->load->model('MCard');
            if ($_POST["new_role_id"] != $_POST["old_role_id"]) {
                if ($this->MRole->CheckCode($_POST["new_role_id"]))
                    $this->View("Mã quyền đã tồn tại!");
                else {
                    $data = array(
                        'role_id' => $_POST["new_role_id"],
                        'role_name' => $_POST["role_name"],
                        'orderby' => $_POST["orderby"],
                        'active' => $_POST["active"]
                    );
                    $this->MRole->Update($data, $_POST["old_role_id"]);
                    $this->MCard->updateObjectID($_POST["old_role_id"], $_POST["new_role_id"], $this->object_type);
                }
            } else {
                $data = array(
                    'role_name' => $_POST["role_name"],
                    'orderby' => $_POST["orderby"],
                    'active' => $_POST["active"]
                );
                $this->MRole->Update($data, $_POST["old_role_id"]);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($role_id)
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MRole');
        $this->MRole->Delete($role_id);
        redirect(base_url() . "role");
    }
}
