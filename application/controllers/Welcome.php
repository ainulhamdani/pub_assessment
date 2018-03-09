<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("UserModel");
    }

	public function index()
	{
        redirect('main');
	}

	public function login(){
        if(!empty($this->session->userdata('userid'))&&$this->session->userdata('user_valid') != FALSE) {
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

    public function register(){
        if(!empty($this->session->userdata('userid'))&&$this->session->userdata('user_valid') != FALSE) {
            redirect('');
        }
        $this->load->view("register");
    }

    public function register_do(){
        if(!empty($this->session->userdata('userid'))&&$this->session->userdata('user_valid') != FALSE) {
            redirect('');
        }
        if($_POST) {
            $this->load->model("Uuid");
            $uuid = $this->Uuid->v4();
            $id = $this->input->post('id');
            $fullname = $this->input->post('fullname');
            $imageurl = $this->input->post('imageurl');
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $source = $this->input->post('source');
            $token = $this->input->post('token');

            $gender = $this->input->post('gender');
            $birthdate = $this->input->post('birthdate');
            $education = $this->input->post('education');
            $occupation = $this->input->post('occupation');
            $status = $this->input->post('status');


            if($this->UserModel->isEmailExist($email)){
                $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert"><center>Email already used!</center></div>');
                redirect('welcome/register');
            }
            if($this->UserModel->isUsernameExist($username)){
                $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert"><center>Username already exist!</center></div>');
                redirect('welcome/register');
            }else{
                if($source=="google"){
                    $this->UserModel->addUser($uuid,$username,$password,$fullname,$email,$imageurl);
                    $this->UserModel->addUserInfo($uuid,$gender,$birthdate,$education,$occupation,$status);
                    $this->UserModel->addGoogleAuth($uuid,$id);
                }elseif($source=="facebook"){
                    $this->UserModel->addUser($uuid,$username,$password,$fullname,$email,$imageurl);
                    $this->UserModel->addUserInfo($uuid,$gender,$birthdate,$education,$occupation,$status);
                    $this->UserModel->addFacebookAuth($uuid,$id);
                }else{
                    $this->UserModel->addUser($uuid,$username,$password,$fullname,$email,$imageurl);
                    $this->UserModel->addUserInfo($uuid,$gender,$birthdate,$education,$occupation,$status);
                }
                $data = [
                    'userid' => $uuid,
                    'username' => $username,
                    'level' => 'user',
                    'user_valid' => true
                ];
                $this->session->set_userdata($data);
            }
        }
        redirect('');

    }

    public function oauth2callback(){
        if(!empty($this->session->userdata('userid'))&&$this->session->userdata('user_valid') != FALSE) {
            redirect('');
        }
        if($_POST) {
            $id = $this->input->post('id');
            $fullname = $this->input->post('fullname');
            $imageurl = $this->input->post('imageurl');
            $email = $this->input->post('email');
            $token = $this->input->post('token');

            // echo($token);

            $result = $this->UserModel->checkGoogleToken($id);

            if(!empty($result)) {
                $user = $this->UserModel->getUser($result->user_id);
                if($user->is_active){
                    $data = [
                        'userid' => $user->userid,
                        'username' => $user->username,
                        'level' => $user->level,
                        'user_valid' => true
                    ];
     
                    $this->session->set_userdata($data);
                    $this->db->query("UPDATE users SET last_login=current_timestamp WHERE userid = '".$user->userid."'");
                    if($this->input->post('url')!=""){
                        $res['code'] = 202;
                        $res['detail'] = "There is user";
                        $res['url'] = $this->input->post('url');
                        echo(json_encode($res));
                    }else {
                        $res['code'] = 200;
                        $res['detail'] = "There is user";
                        echo(json_encode($res));
                    }
                }else{
                    $res['code'] = 403;
                    $res['detail'] = "User Inactive";
                    echo(json_encode($res));
                }
            } else {
                $res['code'] = 404;
                $res['detail'] = "There is no user";
                echo(json_encode($res));
            }
        }
    }

    public function fboauth2(){
        if(!empty($this->session->userdata('userid'))&&$this->session->userdata('user_valid') != FALSE) {
            redirect('');
        }
        if($_POST) {
            $id = $this->input->post('id');
            $fullname = $this->input->post('fullname');
            $imageurl = $this->input->post('imageurl');
            $email = $this->input->post('email');
            $token = $this->input->post('token');

            $result = $this->UserModel->checkFacebookToken($id);

            if(!empty($result)) {
                $user = $this->UserModel->getUser($result->user_id);
                if($user->is_active){
                    $data = [
                        'userid' => $user->userid,
                        'username' => $user->username,
                        'level' => $user->level,
                        'user_valid' => true
                    ];
     
                    $this->session->set_userdata($data);
                    $this->db->query("UPDATE users SET last_login=current_timestamp WHERE userid = '".$user->userid."'");
                    if($this->input->post('url')!=""){
                        $res['code'] = 202;
                        $res['detail'] = "There is user";
                        $res['url'] = $this->input->post('url');
                        echo(json_encode($res));
                    }else {
                        $res['code'] = 200;
                        $res['detail'] = "There is user";
                        echo(json_encode($res));
                    }
                }else{
                    $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert"><center>Username tidak aktif! Harap menghubungi HR</center></div>');
                    redirect('welcome/login');
                }
            } else {
                $res['code'] = 404;
                $res['detail'] = "There is no user";
                echo(json_encode($res));
            }
        }
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('');
    }
}
