<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	var $object;
    function __construct(){
        parent::__construct();
        $this->object = "user";
    }
	public function login($mes="")
	{
		if($this->session->userdata("username"))  redirect(base_url());
		$data = array('mes'=>$mes,'base_url'=>base_url());
		$this->view->parse('user/login',$data);
	}
	public function insert(){
		if(isset($_POST["username"])){
			$this->load->model("MUser");
			$this->load->helper('security');
			if($this->MUser->checkUsername($_POST["username"]))
        		$this->permission("Tài khoản đã tồn tại!");
        	else{
				if ($_POST["password"]!=""){
					if ($_POST["password"]==$_POST["repassword"]){
						$data = array('username' => $_POST["username"],'hoten'=>$_POST["hoten"],'password'=>do_hash($_POST["password"],'md5'));
						$this->MUser->insert($data);
						redirect(base_url()."user/permission");
					}else{
						$this->permission("Mật khẩu không khớp!");
					}
				}
        		else{
					$this->permission("Không để trống mật khẩu!");
				}
        	}
		}
	}
	public function permission($mes=""){
		if(!$this->session->userdata("username"))  redirect(base_url());
		$this->load->model("MUser");
		$users = $this->MUser->read(0);
		$data = array(
            'action' =>'permission',
            'template' => 'user/permission',
            'data' => array('users'=>$users,'mes'=>$mes)
        );
		$this->load->view("home",$data);
	}
	public function role(){
		$username = $_POST["username"];
		$this->load->model("MUser");
		$result=$this->MUser->readByUsername($username);
		$role_list = $this->MUser->role_read();
		if (!empty($result)){
			$role_str = $result->role;
			$role=explode(',',$role_str);
			$this->view->parse('user/role',array('role_list' => $role_list,'role' => $role,'admin'=>$result->admin));
		}
	}
	public function update_role(){
		if (isset($_POST["username"])){
			$username = $_POST["username"];
			$this->load->model("MUser");
			if (count($_POST["role"])>0){
				$role = implode(",",$_POST["role"]);
				$this->MUser->update_role($username,$role);
			}
			else{
				$this->MUser->delete($username);
				redirect(base_url().$this->object);
			}
		}else{
			redirect(base_url().$this->object);
		}
	}
	public function license(){
		$file_name = "system\core\License.php";
		if (isset($_POST["key"])){
			$key = $_POST["key"];
			$decode = json_decode(base64_decode($key));
			if (empty($decode->expired)){
				$data = array('mes'=>"Key không đúng!",'base_url'=>base_url());
				$this->load->view('license',$data);
			}
			else{
				$myfile = fopen($file_name, "w") or die("Unable to open file!");
				fwrite($myfile, $key);
				fclose($myfile);
				$data = array('mes'=>"Đã nhập key! Vui lòng tải lại trang!",'base_url'=>base_url());
				$this->load->view('license',$data);
			}
		}else{
			$myfile = fopen($file_name, "r");
			$contents = fread($myfile, filesize($file_name));
			$de = base64_decode($contents);
			$obj = json_decode($de);
			$date1=date_create($obj->expired);
            $today=date_create(date("Y-m-d"));
            $diff=date_diff($today,$date1);
			$count = $diff->format("%R%a");
			if ($count>18000)
				$mes = "Hệ thống cân thống kê sử dụng vĩnh viễn.";
			else $mes = $obj->message;
			$data = array('mes'=>$mes,'base_url'=>base_url());
			$this->load->view('license',$data);
		}
	}
	public function changepassword(){
		if (isset($_POST['oldpass'])){
			$this->load->model("MUser");
			$this->MUser->changepassword($_POST['oldpass'],$_POST['newpass']);
			//$this->logout();
		}else redirect(base_url());
		
	}
	public function validate(){
		$this->load->model("MUser");
		if ($this->MUser->validate()){
			redirect(base_url());
		}
		else $this->login("Sai tên đăng nhập hoặc mật khẩu!");
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url()."user/login");
	}
}
