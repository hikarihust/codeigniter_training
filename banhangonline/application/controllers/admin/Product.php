<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Product extends MY_Controller{
	public function __construct(){
		parent::__construct();
		// load ra file model
		$this->load->model('product_model');
	}

	/*
	 * Hien thi danh sach san pham
	 */
	public function index(){
		// Lay ra tong so luong tat ca cac san pham trong website
		$total_rows = $this->product_model->get_total();
		$this->data['total_rows'] = $total_rows;
		// Load ra thu vien phan trang
		$this->load->library('pagination');
		$config = array(
			'total_rows' => $total_rows,    // Tong tat ca cac san pham tren web
			'base_url' => admin_url('product/index'),	// link hien thi ra danh sach ssan pham
			'per_page' => 5,	// So luong san pham hien thi tren 1 trang
			'uri_segment' => 4,	// Phan doan hien thi ra so trang hien thi tren url
			'next_link'	=> 'Trang kế tiếp',
			'pre_link'	=> 'Trang trước'
		);
		//	Khoi tao cac cau hinh phan trang
		$this->pagination->initialize($config);

		$segment = $this->uri->segment(4);
		$segment = intval($segment);
		$input = array();
		$input = array(
			'limit' => array($config['per_page'], $segment)
		);
		// Kiem tra co thuc hien loc khong
		$id = $this->input->get('id');
		$id = intval($id);
		if (isset($id) && ($id > 0)) {
			$input['where']['id'] = $id;
		}

		$name = $this->input->get('name');
		if (isset($name) && $name) {
			$input['like'] = array('name', $name);
		}

		$catalog_id = $this->input->get('catalog');
		$catalog_id = intval($catalog_id);
		if (isset($catalog_id) && ($catalog_id > 0)) {
			$input['where']['catalog_id'] = $catalog_id;
		}
		// Lay ra danh sach san pham
		$list = $this->product_model->get_list($input);
		$this->data['list'] = $list;

		// Lay danh sach danh muc san pham
		$this->load->model('catalog_model');
		$input = array(
			'where' => array('parent_id' => 0)
		);
		$catalogs = $this->catalog_model->get_list($input);
		foreach ($catalogs as $row) {
			$input = array('parent_id' => $row->id);
			$subs = $this->catalog_model->get_list($input);
			$row->subs = $subs;
		}
		$this->data['catalogs'] = $catalogs;

		// Lay ra noi dung cua bien message
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;

		// load view
		$this->data['temp'] = 'admin/product/index';
		$this->load->view('admin/main', $this->data);
	}
}