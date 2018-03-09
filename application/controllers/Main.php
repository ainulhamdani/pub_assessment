<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
        if($this->session->userdata('level')=="admin"){
            $this->load->view("admin/home");
        }else{
        	$this->load->view("user/home");
        }
	}

}