<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Install extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $config = array(
            'dsn'    => '',
            'hostname' => '.',
            'username' => 'sa',
            'password' => 'mentauto@',
            'database' => 'my_db',
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
        $db2 = $this->load->database($config, true);
        $this->myforge = $this->load->dbforge($db2, TRUE);
        if ($this->myforge->create_database('my_db')) {
            echo 'Database created!';
        }
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
