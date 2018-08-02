<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TelegramModel extends CI_Model {

	function __construct() {
        parent::__construct();
		$this->db = $this->load->database('telegram', TRUE);
    }

	function getUsers(){
		return $this->db->query("SELECT * FROM users")->result();
	}

	function getUser($id=""){
		if($id==""){
			return $this->db->query("SELECT * FROM users limit 1")->row();
		}
		return $this->db->query("SELECT * FROM users WHERE user_id=$id")->row();
	}

	function getMessages($id){
		return $this->db->query("SELECT * FROM messages WHERE chat_id=$id ORDER BY id,dates ASC")->result();
	}

}
