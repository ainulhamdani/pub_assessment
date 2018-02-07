<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model("UserModel");
    }

	public function index()
	{
		if(empty($this->session->userdata('id_user'))&&$this->session->userdata('user_valid') == FALSE) {
            redirect('welcome/login');
        }
        if($this->session->userdata('level')=="admin"){
        	$data['users'] = $this->UserModel->getUsers();
        	$this->load->view("admin/user",$data);
        }else{
        	$this->load->view("user/main");
        }
	}

}