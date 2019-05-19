<?php
Class Upload_library{
	public $CI;
	public function __construct(){
		$this->CI = & get_instance();
	}

	/*
	 * Upload file
	 * @$upload_path: Duong dan luu file
	 * @$file_name: Ten cua the input upload file 
	 */
	public function upload($upload_path = '', $file_name){
		$config = $this->config($upload_path);
		$this->CI->load->library('upload', $config);
		if ($this->CI->upload->do_upload($file_name)) {
			$data = $this->CI->upload->data();
		}else{
			// Khong upload thanh cong
			$data = $this->CI->upload->display_errors();
		}

		return $data;
	}

	/*
	 * Upload nhieu file file
	 * @$upload_path: Duong dan luu file
	 * @$file_name: Ten cua the input upload file 
	 */
	public function upload_file($upload_path = '', $file_name){
		// Lay thong tin cau hinh upload
		$config = $this->config($upload_path);
		$count = count($_FILES['image_list']['name']);	// Lay tong so file duoc upload

		$image_list = array();	// Luu ten cac file anh upload thanh cong
		for ($i=0; $i < $count ; $i++) { 
			$_FILES['userfile']['name'] = $_FILES['image_list']['name'][$i];	// Khai bao ten cua file thu i
			$_FILES['userfile']['type'] = $_FILES['image_list']['type'][$i];	// Khai bao kieu cua file thu i
			$_FILES['userfile']['tmp_name'] = $_FILES['image_list']['tmp_name'][$i];	// Khai bao duong dan tam cua file thu 
			$_FILES['userfile']['error'] = $_FILES['image_list']['error'][$i];	// Khai bao loi cua file thu i
			$_FILES['userfile']['size'] = $_FILES['image_list']['size'][$i];	// Khai bao size cua file thu i
			
			// Load thu vien upload va cau hinh
			$this->CI->load->library('upload', $config);

			// Thuc hien upload tung file
			if ($this->CI->upload->do_upload()) {
				// Neu upload thanh cong thi luu toan bo du lieu
				$data = $this->CI->upload->data();
				// In ra cau truc du lieu file da upload
				$image_list[] = $data['file_name'];
			}
		}
		return $image_list;
	}

	/*
	 * Cau hinh upload file
	 */
	private function config($upload_path = ''){
		$config = array(
			'upload_path' => $upload_path,	// Thu muc chua file
			'allowed_types' => 'jpg|png|gif',	// Dinh dang file duoc phep tai
			'max_size' => '500',	// Dung luong toi da
			'max_width'	=> '1028',	// Chieu rong toi da
			'max_height' => '1028'	// Chieu cao roi da
		);

		return $config;
	}
}