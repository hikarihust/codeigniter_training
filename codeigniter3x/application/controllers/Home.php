<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Home extends CI_Controller {
    // Hàm khởi tạo
    public function __construct() {
        // Gọi đến hàm khởi tạo của cha
        parent::__construct();
    }

    public function user(){
        $this->load->model('user_model');
        $user = $this->user_model->get_list();
        echo "<pre>";
        print_r($user);
    }

    public function create_user(){
        $this->load->model('user_model');
        $this->user_model->create();
    }

    public function update_user(){
        $this->load->model('user_model');
        $user_id = 19;
        $this->user_model->update($user_id);
    }

    public function delete_user(){
    	$this->load->model('user_model');
        $this->user_model->delete();
    }
}