<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		if(empty($this->session->userdata('id_user'))&&$this->session->userdata('user_valid') == FALSE) {
            redirect('welcome/login');
        }
        if($this->session->userdata('level')=="admin"){
        	$this->load->view("admin/main");
        }else{
        	$this->load->view("user/main");
        }
	}

}