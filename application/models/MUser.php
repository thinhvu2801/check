<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MUser extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function checkUsername($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) return true;
        else return false;
    }
    public function insert($data)
    {
        $this->db->insert('users', $data);
    }
    public function delete($username)
    {
        $this->db->where('username', $username);
        $this->db->delete('users');
    }
    public function elementsRead()
    {
        $this->db->where("id", 1);
        $query = $this->db->get('Elements');
        return $query->row();
    }
    public function role_read()
    {
        $this->db->where('active','1');
		$this->db->order_by('active','desc');
		$query=$this->db->get('Role');
    	return $query->result();
    }
    public function read($admin = 0)
    {
        if ($admin == 0)
            $this->db->where('admin', $admin);
        $query = $this->db->get('users');
        return $query->result();
    }
    public function readByUsername($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->row();
    }
    public function update_role($username, $role)
    {
        $this->db->where('username', $username);
        $this->db->update('users', array('role' => $role));
    }
    public function changepassword($oldpass, $newpass)
    {
        $this->load->helper('security');
        if ($this->checkpass($oldpass)) {
            $this->db->where('id', $this->session->userdata("user_id"));
            $this->db->update('users', array('password' => do_hash($newpass, 'md5')));
            echo "Cập nhật mật khẩu thành công!";
        } else
            echo "Mật khẩu cũ không khớp!";
    }
    public function checkpass($oldpass)
    {
        $this->load->helper('security');
        $this->db->where('id', $this->session->userdata("user_id"));
        $this->db->where('password', do_hash($oldpass, 'md5'));
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) return true;
        return false;
    }
    public function validate()
    {
        $this->load->helper('security');
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $pas= $row->password;
            if ((do_hash($password, 'md5') ==$pas )) {
                $data = array(
                    'user_id' => $row->id,
                    'username' => $row->username,
                    'serial_number' => $row->serial_number,
                    'role' => $row->role,
                    'admin' => $row->admin
                );
                $this->session->set_userdata($data);

                return true;
            }
            return false;
        }
    }
}
