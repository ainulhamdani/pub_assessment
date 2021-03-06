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

    public function addUser($userid,$username,$password,$fullname,$email,$imageurl){
    	$this->db->query("INSERT INTO users (userid,username,password,fullname,email,profile_pict) VALUES('$userid','$username','$password','$fullname','$email','$imageurl')");
    }

    public function addUserInfo($userid,$gender,$birthdate,$education,$occupation,$status){
    	$this->db->query("INSERT INTO user_info (user_id,gender,birthdate,education,occupation,marital_status) VALUES('$userid','$gender','$birthdate','$education','$occupation','$status')");
    }

    public function addGoogleAuth($userid,$token){
    	$this->db->query("INSERT INTO user_google_auth VALUES('$userid','$token')");
    }

    public function addFacebookAuth($userid,$token){
    	$this->db->query("INSERT INTO user_facebook_auth VALUES('$userid','$token')");
    }

    public function checkGoogleToken($token){
    	return $this->db->query("SELECT * FROM user_google_auth WHERE google_token='$token'")->row();
    }

    public function checkFacebookToken($token){
    	return $this->db->query("SELECT * FROM user_facebook_auth WHERE facebook_token='$token'")->row();
    }

    public function isUsernameExist($uname){
    	return $this->db->query("SELECT username FROM users WHERE username='$uname'")->num_rows()?true:false;
    }

    public function isEmailExist($email){
    	return $this->db->query("SELECT email FROM users WHERE email='$email'")->num_rows()?true:false;
    }

}