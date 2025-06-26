<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ChangeDB extends CI_Controller
{
    public function changedatabase()
    {
        if ($this->input->post()) {
            $database_name = trim($this->input->post('database_name'));
            if (!empty($database_name)) {
                $file_path = APPPATH . 'config/database.php';
                $file_content = file_get_contents($file_path);
                $pattern = "/'database' => '.*?'(?=,\s*'dbdriver' => 'sqlsrv')/";
                $replacement = "'database' => '$database_name'";
                $new_content = preg_replace($pattern, $replacement, $file_content);
                if (file_put_contents($file_path, $new_content) !== false) {
                    $this->db->close();
                    $this->db->database = $database_name;
                    try {
                        $this->db->reconnect();
                        $this->session->set_userdata('current_database', $database_name);
                        redirect('user/logout');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('error', 'database error');
                        redirect('changedb/changedatabase');
                    }
                } else {
                    $this->session->set_flashdata('error', 'database error');
                    redirect('changedb/changedatabase');
                }
            } else {
                $this->session->set_flashdata('error', 'database error');
                redirect('changedb/changedatabase');
            }
        }
        $data = [
            'base_url' => base_url(),
            'action' => 'changedatabase',
            'template' => 'database_form',
            'error' => $this->session->flashdata('error'),
        ];
        $this->load->view('home', $data);
    }

    public function get_databases()
    {
        $serverName = "SEI\SQL_2025";
        $connectionInfo = [
            "UID" => "sa",
            "PWD" => "123456",
            "Database" => "master"
        ];
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        if (!$conn) {
            echo json_encode(['status' => 'error', 'message' => 'Không thể kết nối đến SQL Server']);
            return;
        }
        $sql = "SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')";
        $stmt = sqlsrv_query($conn, $sql);
        $databases = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $databases[] = $row['name'];
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        echo json_encode(['status' => 'success', 'data' => $databases]);
    }
}