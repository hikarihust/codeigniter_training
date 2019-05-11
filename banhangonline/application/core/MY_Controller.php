<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class MY_Controller extends CI_Controller{
	public function __construct(){
		// ke thua tu CI_Controller
		parent::__construct();

		// Lay ra phan doan tren URL
		$controller = $this->uri->segment(1);
		switch ($controller) {
			case 'admin':
				{
					// Xu ly cac du lieu khi truy cap vao admin
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
		
	}
}