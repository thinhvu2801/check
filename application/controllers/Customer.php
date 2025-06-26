<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Customer extends CI_Controller
{
    var $object;
    var $object_type;
    function __construct()
    {
        parent::__construct();
        $this->object = "customer";
        $this->object_type = 8;
    }
    public function index()
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->View();
    }
    public function View($mes = "")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $this->load->model('MCustomer');
        $data = array(
            'action' => 'customer',
            'template' => 'customer/index',
            'data' => array(
                'customer' => $this->MCustomer->Read(),
                'mes' => $mes
            )
        );
        $this->load->view('home', $data);
    }

    public function Insert()
    {
        if (isset($_POST["customer_id"])) {
            $this->load->model('MCustomer');
            if ($this->MCustomer->CheckCode($_POST["customer_id"]))
                $this->View($_POST["parent_id"], "Mã nhà cung cấp đã tồn tại!");
            else {
                $data = array(
                    'customer_id' => $_POST["customer_id"],
                    'customer_name' => $_POST["customer_name"],
                    'note' => $_POST["note"]
                );
                $this->MCustomer->Insert($data);
                redirect(base_url() . $this->object);
            }
        } else {
            redirect(base_url() . $this->object);
        }
    }

    public function Update()
    {
        if (isset($_POST["new_customer_id"])) {
            $this->load->model('MCustomer');
            $this->load->model('MCard');
            if ($_POST["new_customer_id"] != $_POST["old_customer_id"]) {
                if ($this->MCustomer->CheckCode($_POST["new_customer_id"]))
                    $this->View("Mã nhà cung cấp đã tồn tại!");
                else {
                    $data = array(
                        'customer_id' => $_POST["new_customer_id"],
                        'customer_name' => $_POST["customer_name"],
                        'note' => $_POST["note"]
                    );
                    $this->MCustomer->Update($data, $_POST["old_customer_id"]);
                    $this->MCard->updateObjectID($_POST["old_customer_id"], $_POST["new_customer_id"], $this->object_type);
                }
            } else {
                $data = array(
                    'customer_name' => $_POST["customer_name"],
                    'note' => $_POST["note"]
                );
                $this->MCustomer->Update($data, $_POST["old_customer_id"]);
                $this->MCard->updateObjectID($_POST["old_customer_id"], $_POST["new_customer_id"], $this->object_type);
            }
            redirect(base_url() . $this->object);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    public function Delete($customer_id)
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        if (!$this->session->userdata("admin"))
            if (!in_array($this->object, $this->session->userdata("role")))
                redirect(base_url());
        $this->load->model('MCustomer');
        $result = $this->MCustomer->Delete($customer_id);
        redirect(base_url() . "customer");
    }
    // public function card($customer_id = "0")
    // {
    //     if (!$this->session->userdata("username")) redirect('user/login');
    //     $this->load->model('MCustomer');
    //     $customer = $this->MCustomer->Read();
    //     $data = array(
    //         'action' => 'customer_card',
    //         'template' => 'customer/card',
    //         'data' => array('customer' => $customer, 'customer_id' => $customer_id)
    //     );
    //     $this->load->view('home', $data);
    // }
    public function card($customer_id = "0")
    {
        if (!$this->session->userdata("username"))  redirect('user/login');
        $typecard = $this->session->userdata('typecard');
        if(empty($typecard)){
            $file_name = "typecard.txt";
            $myfile = fopen($file_name, "r");
            $typecard = fread($myfile, filesize($file_name));
        }
        $this->load->model('MCustomer');
        $customer = $this->MCustomer->Read();
        $data = array(
            'action' => 'customer_card',
            'template' => 'customer/card',
            'data' => array('customer' => $customer, 'customer_id' => $customer_id,'typecard' => $typecard)
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
            $this->view->parse($this->object.'/card_read', $data);
        } else {
            redirect(base_url() . $this->object);
        }
    }
    // public function card_create()
    // {
    //     if (isset($_POST["card_id"])) {
    //         $card_id = $_POST["card_id"];
    //         $object_id = $_POST["object_id"];
    //         $this->load->model('MCard');
    //         $this->MCard->Create($card_id, $object_id, $this->object_type);
    //     } else {
    //         redirect(base_url() . $this->object);
    //     }
    // }
    public function card_create()
    {
        if (isset($_POST["card_id"])) {
            $card_id = $_POST["card_id"];
            $object_id = $_POST["object_id"];
            $typecard = $_POST["typecard"];
            $this->load->model('MCard');
            $type=explode(',',$typecard);
            $validCardFound = false;
            
            foreach ($type as $t) {
                if ($this->MCard->validCard($card_id, $t)) {
                    $this->MCard->Create($card_id, $object_id, $this->object_type,$typecard);
                    $validCardFound = true;
                    break; 
                }
            }

            if (!$validCardFound) {
                echo '<p style="color:red">Thẻ không lệ!</p>';
            }

        } else {
            redirect(base_url() . $this->object);
        }
    }
}
