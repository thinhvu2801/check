<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Machine extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('Utilities');
        $this->uti = new Utilities();
    }
    public function manager(){
        $this->load->model("MMachine");
        if (isset($_POST["insert"])) {
            $data = array(
                'machine_code' => $_POST["machine_code"],
                'machine_serial' => $_POST["machine_serial"],
                'machine_name' => $_POST["machine_name"],
                'db_name' => $_POST["db_name"],
                'password' => $_POST["password"],
                'server' => $_POST["server"],
                '_user' => $_POST["user"]
            );
            $this->MMachine->Insert($data);
        } 
        if (isset($_POST["update"])) {
            $data = array(
                'machine_code' => $_POST["machine_code"],
                'machine_serial' => $_POST["machine_serial"],
                'machine_name' => $_POST["machine_name"],
                'db_name' => $_POST["db_name"],
                'password' => $_POST["password"],
                'server' => $_POST["server"],
                '_user' => $_POST["user"]
            );
            $this->MMachine->Update($data,$_POST["id"]);
        }
        $data = array(
            'action' => 'machine_manager',
            'template' => 'statistic/machine/manager',
            'data' => array(
                'machine' => $this->MMachine->Read()
            )
        );
       $this->load->view('home', $data);
    }
    public function delete($id){
        $this->load->model("MMachine");
        $this->MMachine->Delete($id);
        redirect(base_url() . "machine/manager");
    }
    
    public function index($machine_code = 0, $machine_serial = 0)
    {
        $this->load->model("MMachine");
        if (isset($_POST["machine_code"])) {
            $machine_code = $_POST["machine_code"];
            $machine_serial = $_POST["machine_serial"];
            $datetime = explode(" ", $_POST["datetime"]);
            $start_date = $this->uti->dateforsql($datetime[0]);
            $start_time = $datetime[1] . $datetime[2];
            $end_date = $this->uti->dateforsql($datetime[4]);
            $end_time = $datetime[5] . $datetime[6];
            $option = $_POST["option"];
        } else {
            $start_date = date("Y-m-d");
            $start_time = "00:00";
            $end_date = date("Y-m-d");
            $end_time = "23:59";
            $option = 1;
        }
        
        if (isset($_POST["detail"]))
            $option=0;
        if (isset($_POST["general"]))
            $option=1;
        $machine = $this->MMachine->readById($machine_code, $machine_serial);

        // Outputs: This is a plain-text message!
        $template = "statistic/machine/nodevice";
        $result = array();
        if ($machine != null) {
            $config = array(
                'dsn'    => '',
                'hostname' => $machine->server,
                'username' => $machine->_user,
                'password' => $machine->password,//--$this->encryption->decrypt(),
                'database' => $machine->db_name,
                'dbdriver' => 'sqlsrv',
                'dbprefix' => '',
                'pconnect' => FALSE,
                'db_debug' => (ENVIRONMENT !== 'production'),
                'cache_on' => FALSE,
                'cachedir' => '',
                'char_set' => 'utf8',
                'dbcollat' => 'utf8_general_ci',
                'swap_pre' => '',
                'encrypt' => FALSE,
                'compress' => FALSE,
                'stricton' => FALSE,
                'failover' => array(),
                'save_queries' => TRUE
            );
            $machine_db = $this->load->database($config, true);
            switch ($machine_code) {
                case 21:
                    $this->load->model("MDataWeigh");
                    if ($option==1){
                        $result = $this->MDataWeigh->General($machine_db, $start_date,$end_date);

                    }else{
                        $result = $this->MDataWeigh->Detail($machine_db, $start_date,$start_time, $end_time);
                    }
                    $reject = $this->MDataWeigh->Reject($machine_db, $start_date,$end_date);
                    $template = 'statistic/machine/combineweigh/general';
                    break;
                case 22:
                    $this->load->model("MCheckWeigher");
                    
                    $result = $this->MCheckWeigher->Statistic($machine_db, $machine_serial,$start_date, $end_date);
                    $template = 'statistic/machine/grader/general';
                    $reject=new stdClass();
                    break;
            }
        }

        $data = array(
            'action' => 'stat_machine',
            'template' => $template,
            'data' => array(
                'option'=>$option,
                'machine_code' => $machine_code,
                'machine_serial' => $machine_serial,
                'startDate' => $this->uti->dateforpicker($start_date) . " " . $start_time,
                'endDate' => $this->uti->dateforpicker($end_date) . " " . $end_time,
                'result' => $result,
                'reject'=>$reject
            )
        );
        $myObjects = array();
        foreach ($result as $r) {
            $myObjects[]=$r;
        }

        
        foreach ($reject as $r) {
            $stdReject=new stdClass();
            $stdReject->program_id="";
            $stdReject->batch=$r['type_combine'];
            $stdReject->num_pieces=$r['num_pieces'];
            $stdReject->size="";
            $stdReject->count_combine=$r['count_combine'];
            $stdReject->total_weight=$r['total_weight'];
            $stdReject->avg_combine="";
            $stdReject->time_run="";
            $stdReject->note=$r['note'];

            $myObjects[]=(array)$stdReject;
        }
       

        if (isset($_POST["export"])) {
            if ($option==1){
                 $this->uti->export($myObjects, $machine_code.'-' . $start_date);
            }
            else{
                $this->uti->export($result, $machine_code.'-' . $start_date);
            }
        }
        $this->load->view('home', $data);

        // $this->myforge = $this->load->dbforge($db2, TRUE);
        // if ($this->myforge->create_database('my_db')) {
        //     echo 'Database created!';
        // }
        // $fields = $this->TableBasket();
        // $this->myforge->add_field($fields);
        // $this->myforge->add_key('basket_id', TRUE);
        // $this->myforge->create_table('Basket');

        // $fields = $this->TableProduct();
        // $this->myforge->add_field($fields);
        // $this->myforge->add_key('product_id', TRUE);
        // $this->myforge->create_table('Product');
        // if (!$this->db->table_exists('NguyenLieu')) {
        //     $fields = $this->TableNguyenLieu();
        //     $this->myforge->add_field($fields);
        //     $this->myforge->add_key('id', TRUE);
        //     $this->myforge->create_table('NguyenLieu');
        // } 
        // if (!$this->db->table_exists('DinhHinh')) {
        //     $fields = $this->TableDinhHinh();
        //     $this->myforge->add_field($fields);
        //     $this->myforge->add_key('id', TRUE);
        //     $this->myforge->create_table('DinhHinh');
        // } 
        // if (!$this->db->table_exists('Fillet') )
        // {
        //   $fields = $this->TableFillet();
        //   $this->myforge->add_field($fields);
        //   $this->myforge->add_key('id', TRUE);
        //   $this->myforge->create_table('Fillet');
        // }
    }


    public function create()
    {
    }
    function TableBasket()
    {
        $fields = array(
            'basket_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'note' => array(
                'type' => 'NVARCHAR',
                'constraint' => '50',
            ),
        );
        return $fields;
    }
    function TableProduct()
    {
        $fields = array(
            'product_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'product_name' => array(
                'type' => 'NVARCHAR',
                'constraint' => '100',
            ),
            'note' => array(
                'type' => 'NVARCHAR',
                'constraint' => '50',
            ),
            'linkable' => array(
                'type' => 'BIT',
            ),
            'parent_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
        );
        return $fields;
    }
    function TableWorker()
    {
        $fields = array(
            'worker_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'worker_name' => array(
                'type' => 'NVARCHAR',
                'constraint' => '100',
            ),
            'note' => array(
                'type' => 'NVARCHAR',
                'constraint' => '50',
            ),
            'group_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
        );
        return $fields;
    }
    function TableNguyenLieu()
    {
        $fields = array(
            'id' => array(
                'type' => 'BIGINT',
                'auto_increment' => TRUE
            ),
            'lo_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'product_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'weight' => array(
                'type' => 'decimal',
                'constraint' => '7,3',
            ),
            'date' => array(
                'type' => 'date',
            ),
            'time' => array(
                'type' => 'time',
                'constraint' => '0',
            ),
        );
        return $fields;
    }
    function TableDinhHinh()
    {
        $fields = array(
            'id' => array(
                'type' => 'BIGINT',
                'auto_increment' => TRUE
            ),
            'lo_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'product_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'basket_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'worker_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'weight_int' => array(
                'type' => 'decimal',
                'constraint' => '7,3',
            ),
            'weight_out' => array(
                'type' => 'decimal',
                'constraint' => '7,3',
            ),
            'date' => array(
                'type' => 'date',
            ),
            'time_in' => array(
                'type' => 'time',
                'constraint' => '0',
            ),
            'time_out' => array(
                'type' => 'time',
                'constraint' => '0',
            ),
        );
        return $fields;
    }
    function TableFillet()
    {
        $fields = array(
            'id' => array(
                'type' => 'BIGINT',
                'auto_increment' => TRUE
            ),
            'lo_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'product_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'basket_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'worker_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'weight_int' => array(
                'type' => 'decimal',
                'constraint' => '7,3',
            ),
            'weight_out' => array(
                'type' => 'decimal',
                'constraint' => '7,3',
            ),
            'date' => array(
                'type' => 'date',
            ),
            'time_in' => array(
                'type' => 'time',
                'constraint' => '0',
            ),
            'time_out' => array(
                'type' => 'time',
                'constraint' => '0',
            ),
        );
        return $fields;
    }
}
