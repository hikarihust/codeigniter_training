<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class User_model extends MY_Model{
	public function __construct(){
		parent::__construct();
		$this->table = 'user';
	}
}