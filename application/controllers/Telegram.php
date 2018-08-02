<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telegram extends CI_Controller {

	function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar");
    }

	public function index()
	{
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('user_valid') == FALSE) {
            redirect('welcome/login');
        }
        if($this->session->userdata('level')!="admin"){
            redirect('');
        }
        $this->load->view("admin/telegram/home");
	}

	public function message($u="",$user=""){
		if(empty($this->session->userdata('id_user'))&&$this->session->userdata('user_valid') == FALSE) {
            redirect('welcome/login');
        }
        if($this->session->userdata('level')!="admin"){
            redirect('');
        }
		$this->load->model('TelegramModel','TG');
		if($u==""){
			$fuser = $this->TG->getUser();
			redirect('telegram/message/u/'.$fuser->user_id);
		}

		$fuser = $this->TG->getUser($user);
		$data['active_user'] = $fuser;
		$data['users'] = $this->TG->getUsers();
		$data['messages'] = $this->TG->getMessages($fuser->user_id);
        $this->load->view("admin/telegram/message",$data);
	}

	public function message_send(){
		if(empty($this->session->userdata('id_user'))&&$this->session->userdata('user_valid') == FALSE) {
            redirect('welcome/login');
        }
        if($this->session->userdata('level')!="admin"){
            redirect('');
        }
		if($_POST) {
			$message = urlencode($this->input->post('message'));
			$user_id = $this->input->post('user_id');
			$url = $this->input->post('url');
			$webhook_url = WEBHOOK_SEND_URL."/".BOT_TOKEN."/".$message."/".$user_id;
			$handle = curl_init($webhook_url);
        	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
			$response = curl_exec($handle);
			if(!$response){
				die('Error: "' . curl_error($handle) . '" - Code: ' . curl_errno($handle));
			}
			$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
        	curl_close($handle);
			redirect($url);
		}
	}

}
