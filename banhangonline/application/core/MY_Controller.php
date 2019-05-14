<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class MY_Controller extends CI_Controller{

	// Bien gui du lieu sang ben view
	public $data = array();
	public function __construct(){
		// ke thua tu CI_Controller
		parent::__construct();

		// Lay ra phan doan tren URL
		$controller = $this->uri->segment(1);
		switch ($controller) {
			case 'admin':
				{
					// Xu ly cac du lieu khi truy cap vao admin
					$this->load->helper('admin');
					$this->_check_login();
					break;
				}
				
			default:
				{
					// Xy ly du lieu o trang ngoai
					break;
				}				
		}
	}

	/*
	 *	Kiem tra trang thai cua admin
	 */

	private function _check_login(){
		$controller = $this->router->fetch_class();
		$controller = strtolower($controller);

		$login = $this->session->userdata('login');
		// Neu chua dang nhap ma truy cap vao 1 controller khac controller login
		if (!$login && $controller !== 'login') {
			redirect(admin_url('login'));
		}
		// Neu ma admin da dang nhap thi khong cho vao trang login nua
		if ($login && $controller === 'login') {
			redirect(admin_url('home'));
		}
	}
}