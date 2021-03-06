<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AssessModel extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    public function getAssessments($cond="1"){
    	return $this->db->query("SELECT * FROM assessment WHERE ".$cond)->result();
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

    public function getTasksNum($id,$is_active){
        if($is_active){
            return $this->db->query("SELECT * FROM task WHERE assessment_id=$id AND is_active=$is_active")->num_rows();
        }else{
            return $this->db->query("SELECT * FROM task WHERE assessment_id=$id")->num_rows();
        }
    }


    public function getUnansweredTasks($assessid,$userid){
        return $this->db->query("SELECT * FROM task WHERE assessment_id=$assessid AND is_active=1 AND id NOT IN (SELECT task_id FROM answer WHERE assessment_id='$assessid' AND userid='$userid') ORDER BY RAND()")->row();
    }

    public function getUnansweredTasksNum($assessid,$userid){
        return $this->db->query("SELECT * FROM task WHERE assessment_id=$assessid AND is_active=1 AND id NOT IN (SELECT task_id FROM answer WHERE assessment_id='$assessid' AND userid='$userid') ORDER BY RAND()")->num_rows();
    }

    public function getQuestion($id){
        return $this->db->query("SELECT * FROM assessment_question WHERE assessment_id='$id'")->row();
    }

    public function getAnswers($id,$userid){
        return $this->db->query("SELECT task_id FROM answer WHERE assessment_id='$id' AND userid='$userid'")->result();
    }

    public function saveAnswer($data){
        $userid = $data['conf']['userid'];
        $assessment_id = $data['conf']['assessment_id'];
        $task_id = $data['conf']['task_id'];
        $version = $data['version'];
        unset($data['conf']);
        $data = json_encode($data);
        $timestamp = date('Y-m-d H:i:s');
        $this->db->query("INSERT INTO answer (userid,assessment_id,task_id,version,timestamp,answer) VALUES('$userid',$assessment_id,$task_id,$version,'$timestamp','$data')");
    }

}