<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Hello extends CI_Controller {
    // Hàm khởi tạo
    public function __construct() {
        // Gọi đến hàm khởi tạo của cha
        parent::__construct();
    }

    public function index($message = '') {
        echo 'Hello Controller ' . $message;;
    }

    public function other(){
        echo 'Other Controller';
    }
}