<?php
Class Login extends MY_Controller{

	public function index(){
		$this->load->library('form_validation');
		if($this->input->post()){
			$this->form_validation->set_rules('login', 'Login', 'callback_check_login');
			if ($this->form_validation->run()) {
				$this->session->set_userdata('login', true);

				redirect(admin_url('home'));
			}
		}
		$this->load->view('admin/login/index');
	}

	// Kiem tra username va password co chinh xac khong
	public function check_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password = md5($password);

		$this->load->model('admin_model');
		$where = array(
			'username' => $username,
			'password' => $password
		);
		if($this->admin_model->check_exists($where)){
			return true;
		}
		$this->form_validation->set_message(__FUNCTION__, 'Không đăng nhập thành công');
		return false;
	}
}