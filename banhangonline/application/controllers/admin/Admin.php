<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Admin extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	// public function create(){
	// 	$this->data = array(
	// 		'username' => 'admin1',
	// 		'password' => 'admin1',
	// 		'name' => 'Hoc PHP'
	// 	);

	// 	if($this->admin_model->create($this->data)){
	// 		echo "Them thanh cong";
	// 	}else{
	// 		echo "Khong them thanh cong";
	// 	}
	// }

	// public function update(){
	// 	$id = 8;
	// 	$this->data = array(
	// 		'username' => 'admin2',
	// 		'password' => 'admin2',
	// 		'name' => 'Hoc PHP 2'
	// 	);
	// 	if ($this->admin_model->update($id, $this->data)) {
	// 		echo "Cap nhat thanh cong";
	// 	}else{
	// 		echo "Cap nhat khong thanh cong";
	// 	}
	// }

	// public function delete(){
	// 	$id = 8;
	// 	if($this->admin_model->delete($id)){
	// 		echo "Xoa thanh cong";
	// 	}else{
	// 		echo "Xoa khong thanh cong";
	// 	}
	// }

	// public function get_info(){
	// 	$id = 1;
	// 	$info = $this->admin_model->get_info($id, 'username, password');
	// 	echo "<pre>";
	// 	print_r($info);
	// }

	// public function get_list(){
	// 	$input = array(
			// 'where' => array('id' => 1),
			// 'limit' => array(1, 0),
			// 'order' => array('id', 'desc')
			// 'order' => array('username', 'asc')
	// 		'like' => array('name', 'mod')
	// 	);
	// 	$list = $this->admin_model->get_list($input);
	// 	echo "<pre>";
	// 	print_r($list);
	// }

	//--------------------------------------------------------------
	/*
	*	Lay danh sach admin
	*/
	public function index(){
		$input = array();
		$list = $this->admin_model->get_list($input);
		$total = $this->admin_model->get_total();

		$this->data['list'] = $list;
		$this->data['total'] = $total;
		// Lay ra noi dung cua bien message
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;
		$this->data['temp'] = 'admin/admin/index';
		$this->load->view('admin/main', $this->data);
	}
	/*
	*	Kiem tra username da ton tai chua
	*/
	public function check_username(){
		$username = $this->input->post('username');
		$where = array('username' => $username);
		// Kiem tra xem username da ton tai chua
		if ($this->admin_model->check_exists($where)) {
			// Tra ve thong bao loi
			$this->form_validation->set_message(__FUNCTION__, '{field} đã tồn tại');
			return false;
		}
		return true;
	}
	/*
	*	Them moi quan tri vien
	*/
	public function add(){
		$this->load->library('form_validation');
		$this->load->helper('form');

		// Neu ma co du lieu post len thi kiem tra
		if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
			$this->form_validation->set_rules('username', 'Tài khoản đăng nhập', 'required|callback_check_username');
			$this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
			$this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'required|matches[password]');

			// Nhập liệu chính xác
			if ($this->form_validation->run()) {
				// Them vao csdl
				$name = $this->input->post('name');
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				
				$this->data = array(
					'name' => $name,
					'username' => $username,
					'password' => md5($password)
				);
				if ($this->admin_model->create($this->data)) {
					// Tao ra noi dung thong bao
					$this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
				}else{
					$this->session->set_flashdata('message', 'Thêm mới dữ liệu không thành công');
				}
				// Chuyen toi trang danh sach quan tri vien
				redirect(admin_url('admin'));
			}
		}
		$this->data['temp'] = 'admin/admin/add';
		$this->load->view('admin/main', $this->data);	
	}

	/*
	*	Ham chinh sua thong tin quan tri vien
	*/
	public function edit(){
		// Lay ra id cua quan tri vien can chinh sua
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		$this->load->library('form_validation');
		// Lay thong tin cua quan tri vien
		$info = $this->admin_model->get_info($id);
		if(!$info){
			$this->session->set_flashdata('message', 'Không tồn tại quản trị viên này');
			redirect(admin_url('admin'));
		}
		$this->data['info'] = $info;
		if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
			$this->form_validation->set_rules('username', 'Tài khoản đăng nhập', 'required|callback_check_username');

			$password = $this->input->post('password');
			if ($password) {
				$this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
				$this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'required|matches[password]');
			}
			if ($this->form_validation->run()) {
				// Them vao csdl
				$name = $this->input->post('name');
				$username = $this->input->post('username');
				
				$this->data = array(
					'name' => $name,
					'username' => $username,
				);
				// Neu thay doi password thi moi gan du lieu
				if ($password) {
					$this->data['password'] = md5($password);
				}

				if ($this->admin_model->update($id, $this->data)) {
					// Tao ra noi dung thong bao
					$this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
				}else{
					$this->session->set_flashdata('message', 'Cập nhật dữ liệu không thành công');
				}
				// Chuyen toi trang danh sach quan tri vien
				redirect(admin_url('admin'));
			}
		}

		$this->data['temp'] = 'admin/admin/edit';
		$this->load->view('admin/main', $this->data);	
	}

	/*
	*	Ham de xoa du lieu
	*/
	public function delete(){
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		// Lay ra thong tin cua quan tri vien
		$info = $this->admin_model->get_info($id);
		if(!$info){
			$this->session->set_flashdata('message', 'Không tồn tại quản trị viên này');
			redirect(admin_url('admin'));
		}
		// Thuc hien xoa
		$this->admin_model->delete($id);
		$this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
		redirect(admin_url('admin'));
	}

	/*
	*	Thuc hien dang xuat
	*/
	public function logout(){
		if ($this->session->userdata('login')) {
			$this->session->unset_userdata('login');
		}
		redirect(admin_url('login'));
	}
}