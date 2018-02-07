<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AssessModel extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    public function getAssessments(){
    	return $this->db->query("SELECT * FROM assessment")->result();
    }

    public function getAssessment($id){
    	return $this->db->query("SELECT * FROM assessment WHERE id='$id'")->row();
    }

    public function addAssessment($name,$details,$type){
    	return $this->db->query("INSERT INTO assessment (name,details,type) VALUES('$name','$details',$type)");
    }

    public function editAssessment($id,$name,$details,$type){
    	return $this->db->query("UPDATE assessment SET name='$name',details='$details',type=$type WHERE id=$id");
    }

    public function addTask($id,$code,$type){
    	if($type==1){
	    	$this->db->query("INSERT INTO images (img_code) VALUES('$code')");
	    	$this->db->query("INSERT INTO task (assessment_id,img_id) VALUES('$id','$code')");
    	}elseif($type==2){
	    	$this->db->query("INSERT INTO texts (text_code) VALUES('$code')");
	    	$this->db->query("INSERT INTO task (assessment_id,text_id) VALUES('$id','$code')");
    	}
    }

    public function getTasks($id){
    	return $this->db->query("SELECT * FROM task WHERE assessment_id=$id")->result();
    }

    public function getQuestion($id){
    	return $this->db->query("SELECT * FROM assessment_question WHERE id='$id'")->row();
    }

}