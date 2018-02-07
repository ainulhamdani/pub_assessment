<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		if(empty($this->session->userdata('id_user'))&&$this->session->userdata('user_valid') == FALSE) {
            redirect('welcome/login');
        }

        redirect('main');
	}

	public function login(){
        if(!empty($this->session->userdata('id_user'))&&$this->session->userdata('user_valid') != FALSE) {
            redirect('');
        }
        if($_POST) {
            $this->db->where('username', $_POST['username']);
            $this->db->where('password', md5($_POST['password']));
            $this->db->from('users');
            $result = $this->db->get()->row();
            if(!empty($result)) {
                if($result->is_active){
                    $data = [
                        'userid' => $result->userid,
                        'username' => $result->username,
                        'level' => $result->level,
                        'user_valid' => true
                    ];
     
                    $this->session->set_userdata($data);
                    $this->db->query("UPDATE users SET last_login=current_timestamp WHERE userid = '".$result->userid."'");
                    if($this->input->post('url')!=""){
                        redirect($this->input->post('url'));
                    }else redirect('');
                }else{
                    $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert"><center>Username tidak aktif! Harap menghubungi HR</center></div>');
                    redirect('welcome/login');
                }
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert"><center>Username or password is wrong!</center></div>');
                redirect('welcome/login');
            }
        }
 
        $this->load->view("login");
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('');
    }
}
