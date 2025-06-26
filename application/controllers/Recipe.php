<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Recipe extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "recipe";
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($product_id = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MRecipe');
        $this->load->model('MSpice');
        $this->load->model('MProduct');
        $mes="";
        $product = $this->MProduct->ReadAll();
        $spice = $this->MSpice->Read();
        $spice_id = "";
        $standard_weight=0;
        if ($product_id==""){
            
            if (sizeof($product) > 0)
                $product_id = $product[0]->product_id;
            if (sizeof($spice) > 0)
                $spice_id = $spice[0]->spice_id;

            if (isset($_POST["product_id"])) {
                $spice_id = $_POST["spice_id"];
                $product_id = $_POST["product_id"];
                $standard_weight = $_POST["standard_weight"];
            }
        }
        
        if (isset($_POST["recipe_insert"])) {
            if ($this->MRecipe->CheckCode($_POST["product_id"], $_POST["spice_id"]))
                $mes = "Mã gia vị đã tồn tại!";
            else {
                $data = array(
                    'spice_id' => $_POST["spice_id"],
                    'product_id' => $_POST["product_id"],
                    'standard_weight' => $_POST["standard_weight"],
                    'weight' => $_POST["weight"],
                );
                $this->MRecipe->Insert($data);
            }
        }

        if (isset($_POST["recipe_create"])) {
            $data = array(
                'date' => date("Y-m-d"),
                'active'=>0
            );
            $this->MRecipe->Update($data, $_POST["product_id"]);
         }

        $data = array(
            'action' => 'recipe',
            'template' => 'recipe/index',
            'data' => array(
                'recipe' => $this->MRecipe->Read($product_id),
                'spice' => $spice,
                'product' => $product,
                'product_id' => $product_id,
                'spice_id' => $spice_id,
                'standard_weight'=>$standard_weight,
                'mes' => $mes
            )
        );

        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["spice_id"])) {
            $this->load->model('MSpice');
            if ($this->MSpice->CheckCode($_POST["spice_id"]))
                $this->View("Mã gia vị đã tồn tại!");
            else {
                $data = array(
                    'spice_id' => $_POST["spice_id"],
                    'product_id' => $_POST["product_id"],
                    'min' => $_POST["min"],
                    'max' => $_POST["max"],
                );
                $this->MSpice->Insert($data);
                redirect(base_url() . $this->object);
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function History()
    {
        $this->load->model('MProduct');
        $this->load->model('MRecipe');
        $product_id="";
        if (isset($_POST["product_id"])){
            $product_id=$_POST["product_id"];
            if(isset($_POST["recipe_active"]))
            {
                $this->MRecipe->SelectVersion($_POST["product_id"],$_POST["recipe_active"][0]);
             //   redirect(base_url() . $this->object."/history");
            }
        }
        $product=$this->MProduct->ReadAll(-1);
        if ($product_id==""&& sizeof($product)>0)
            $product_id=$product[0]->product_id;
        $data = array(
            'action' => 'recipe_history',
            'template' => 'recipe/history',
            'data' => array(
                'product'=>$product,
                'product_id'=>$product_id,
                'recipe'=> $this->MRecipe->History($product_id)
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
                $this->load->model('MSpice');
                $myexcel = new MyExcel();
                $fname = $myexcel->ToCSV($_FILES["file_xls"], 'upload');
                $file = fopen($fname, "r");

                $emapData = fgetcsv($file, 0, ",");
                if ($emapData != array('spice_id', 'spice_name'))
                    $this->View("Cấu trúc file dữ liệu không đúng!");
                else {
                    while (($emapData = fgetcsv($file, 0, ",")) !== FALSE) {
                        $data = array(
                            'spice_id' => $emapData[0],
                            'spice_name' => $emapData[1]
                        );
                        $status = "DONE";
                        if ($this->MSpice->CheckCode($emapData[0])) {
                            $status = "P_ERROR";
                            if (isset($_POST['thaythe'])) {
                                $this->db->where('spice_id', $emapData[0]);
                                $this->db->update('spice', $data);
                                $mes = "Đã được thay thế bằng dữ liệu mới!";
                            }
                        }
                        if ($status == "DONE") $this->MSpice->Insert($data);
                        else $pcode = $pcode . $emapData[0] . " ";
                    }
                    fclose($file);
                    unset($fname);
                    if ($pcode != "")
                        $this->View("Các mã rổ: " . $pcode . "Đã có trong hệ thống! " . $mes);
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
        if (isset($_POST["new_spice_id"])) {
            $this->load->model('MSpice');
            $this->load->model('MCard');
            if ($_POST["new_spice_id"] != $_POST["old_spice_id"]) {
                if ($this->MSpice->CheckCode($_POST["new_spice_id"]))
                    $this->View("Mã rổ đã tồn tại!");
                else {
                    $data = array(
                        'spice_id' => $_POST["new_spice_id"],
                        'spice_name' => $_POST["spice_name"]
                    );
                    $this->MSpice->Update($data, $_POST["old_spice_id"]);
                    $this->MCard->updateObjectID($_POST["old_spice_id"], $_POST["new_spice_id"], $this->object_type);
                }
            } else {
                $data = array('spice_name' => $_POST["spice_name"]);
                $this->MSpice->Update($data, $_POST["old_spice_id"]);
                $this->MCard->updateObjectID($_POST["old_spice_id"], $_POST["new_spice_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($id, $product_id)
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MRecipe');
        $this->MRecipe->Delete($id);
        $this->View($product_id);
        //redirect(base_url() . $this->object);
    }
}
