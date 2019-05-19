<?php
Class Upload extends MY_Controller{

	public function index(){
		if ($this->input->post("submit")) {
			// // echo dirname($_SERVER["SCRIPT_FILENAME"]);
			// // Khai bao bien cau hinh
			// $config = array(
			// 	'upload_path' => './upload/user',	// Thu muc chua file
			// 	'allowed_types' => 'jpg|png|gif',	// Dinh dang file duoc phep tai
			// 	'max_size' => '500',	// Dung luong toi da
			// 	'max_width'	=> '1028',	// Chieu rong toi da
			// 	'max_height' => '1028'	// Chieu cao roi da
			// );
			// // Load thu vien upload
			// $this->load->library('upload', $config);

			// // Load thu vien upload
			// if ($this->upload->do_upload('image')) {
			// 	// Chua mang thong tin upload thanh cong
			// 	$data = $this->upload->data();
			// 	// In ra cau truc du lieu file da upload
			// 	pre($data);
			// }else{
			// 	// Hien thi loi neu co
			// 	$error = $this->upload->display_errors();
			// 	echo $error;
			// }

			$this->load->library('upload_library');
			$upload_path = './upload/user';
			$data = $this->upload_library->upload($upload_path, 'image');
			pre($data);
		}

		$this->data['temp'] = 'admin/upload/index';
		$this->load->view('admin/main', $this->data);
	}

	public function upload_file(){
		if ($this->input->post("submit") && !empty($_FILES['image_list']['name'])) {
			$this->load->library('upload_library');
			$upload_path = './upload/user';
			$data = $this->upload_library->upload_file($upload_path, 'image_list');
			pre($data);
		}

		$this->data['temp'] = 'admin/upload/upload_file';
		$this->load->view('admin/main', $this->data);
	}
}