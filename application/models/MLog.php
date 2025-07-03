<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MLog extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function log_action($table, $data, $action, $user = 'system')
    {
        $log_table = $table . '_Copy';

        // Tạo bảng 
        if (!$this->db->table_exists($log_table)) {
            $fields = $this->db->field_data($table);
            $columns = [];
            $existing_columns = [];
            foreach ($fields as $field) {
                $columns[] = "{$field->name} {$field->type}" .
                    ($field->max_length ? "({$field->max_length})" : "");
                $existing_columns[] = $field->name;
            }
            if (!in_array('action', $existing_columns)) {
                $columns[] = "[action] VARCHAR(10)";
            }
            $columns[] = "[user_name] NVARCHAR(100)";   
            $columns[] = "[action_time] DATETIME DEFAULT GETDATE()";

            $sql = "CREATE TABLE $log_table (" . implode(", ", $columns) . ")";
            $this->db->query($sql);
        }

        // Ghi dữ liệu
        $data['action'] = $action;
        $data['user_name'] = $user;
        $data['action_time'] = date('Y-m-d H:i:s');

        if (!$this->db->insert($log_table, $data)) {
            log_message('error', 'Không thể ghi log vào bảng ' . $log_table);
        }
    }
}