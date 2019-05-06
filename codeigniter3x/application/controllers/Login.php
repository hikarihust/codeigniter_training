<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function load_form()
    {
        // Load view
        $this->load->view('login_view');
    }

    // Hàm load form login
    public function form()
    {
        // Data cần truyền qua view
        $data = array(
            'title' => 'Đây là trang login',
            'message' => 'Nhập Thông Tin Đăng Nhập'
        );
  
        // Load view và truyền data qua view
        $this->load->view('login_form', $data);
    }
}