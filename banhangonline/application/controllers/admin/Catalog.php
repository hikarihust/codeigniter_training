<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Catalog extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('catalog_model');
	}

	/*
	 * Lay ra danh sach danh muc
	 */
	public function index(){
		$list = $this->catalog_model->get_list();
		$total = $this->catalog_model->get_total();

		$this->data['list'] = $list;
		$this->data['total'] = $total;

		// Lay ra noi dung cua bien message
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;

		// load view
		$this->data['temp'] = 'admin/catalog/index';
		$this->load->view('admin/main', $this->data);
	}

	/*
	 * Them danh muc moi
	 */
	public function add(){
		// Load ra thu vien validate du lieu
		$this->load->library('form_validation');

		// Neu ma co du lieu post len thi kiem tra
		if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Tên', 'required');
			$this->form_validation->set_rules('sort_order', 'Thứ tự hiển thị', 'required|greater_than[0]');

			// Nhập liệu chính xác
			if ($this->form_validation->run()) {
				// Them vao csdl
				$name = $this->input->post('name');
				$parent_id = $this->input->post('parent_id');
				$sort_order = $this->input->post('sort_order');
				
				// Luu du lieu can them
				$this->data = array(
					'name' => $name,
					'parent_id' => $parent_id,
					'sort_order' => intval($sort_order)
				);
				// Them moi vao csdl
				if ($this->catalog_model->create($this->data)) {
					// Tao ra noi dung thong bao
					$this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
				}else{
					$this->session->set_flashdata('message', 'Thêm mới dữ liệu không thành công');
				}
				// Chuyen toi trang danh sach 
				redirect(admin_url('catalog'));
			}
		}

		// Lay ra danh sach danh muc cha
		$input = array(
			'where' => array('parent_id' => '0')
		);
		$list = $this->catalog_model->get_list($input);
		$this->data['list'] = $list;

		$this->data['temp'] = 'admin/catalog/add';
		$this->load->view('admin/main', $this->data);	
	}

	/*
	 * Cap nhat danh muc
	 */
	public function edit(){
		// Load ra thu vien validate du lieu
		$this->load->library('form_validation');

		// Lay id cua danh muc
		$id = $this->uri->rsegment('3');
		$info = $this->catalog_model->get_info($id);
		if (!$info) {
			// Tao ra noi dung thong bao
			$this->session->set_flashdata('message', 'Khong ton tai danh muc nay');
			redirect(admin_url('catalog'));
		}
		$this->data['info'] = $info;
		// Neu ma co du lieu post len thi kiem tra
		if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Tên', 'required');
			$this->form_validation->set_rules('sort_order', 'Thứ tự hiển thị', 'required|greater_than[0]');

			// Nhập liệu chính xác
			if ($this->form_validation->run()) {
				// Them vao csdl
				$name = $this->input->post('name');
				$parent_id = $this->input->post('parent_id');
				$sort_order = $this->input->post('sort_order');
				
				// Luu du lieu can them
				$this->data = array(
					'name' => $name,
					'parent_id' => $parent_id,
					'sort_order' => intval($sort_order)
				);
				// Them moi vao csdl
				if ($this->catalog_model->update($id, $this->data)) {
					// Tao ra noi dung thong bao
					$this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
				}else{
					$this->session->set_flashdata('message', 'Cập nhật dữ liệu không thành công');
				}
				// Chuyen toi trang danh sach 
				redirect(admin_url('catalog'));
			}
		}

		// Lay ra danh sach danh muc cha
		$input = array(
			'where' => array('parent_id' => '0')
		);
		$list = $this->catalog_model->get_list($input);
		$this->data['list'] = $list;

		$this->data['temp'] = 'admin/catalog/edit';
		$this->load->view('admin/main', $this->data);	
	}

	/*
	 * Xoa danh muc
	 */
	public function delete(){
		// Lay id cua danh muc
		$id = $this->uri->rsegment('3');
		$info = $this->catalog_model->get_info($id);
		if (!$info) {
			// Tao ra noi dung thong bao
			$this->session->set_flashdata('message', 'Khong ton tai danh muc nay');
			redirect(admin_url('catalog'));
		}
		// Xoa danh muc
		$this->catalog_model->delete($id);
		$this->session->set_flashdata('message', 'Xoa danh muc thanh cong');
		redirect(admin_url('catalog'));
	}
}