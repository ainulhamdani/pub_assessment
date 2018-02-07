<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    public function getUsers(){
    	return $this->db->query("SELECT * FROM users WHERE level!='admin'")->result();
    }

    public function getUser($id){
    	return $this->db->query("SELECT * FROM users WHERE userid='$id'")->row();
    }

}