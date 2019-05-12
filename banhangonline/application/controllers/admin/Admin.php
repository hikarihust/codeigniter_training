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
		$this->data['temp'] = 'admin/admin/index';
		$this->load->view('admin/main', $this->data);
	}
}