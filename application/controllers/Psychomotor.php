<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Psychomotor extends CI_Controller {

	public function saveAssessment(){
		if($this->input->raw_input_stream!=""){
			$assessment = json_decode($this->security->xss_clean($this->input->raw_input_stream));
			try {
				date_default_timezone_set("Asia/Makassar");
				$db = $this->load->database('psychomotor', TRUE);
				if(!isset($assessment->assessment_id)) throw new Exception("Error Processing Request", 1);
				if(!isset($assessment->task_id)) throw new Exception("Error Processing Request", 1);
				if(!isset($assessment->time_start)) throw new Exception("Error Processing Request", 1);
				if(!isset($assessment->time_end)) throw new Exception("Error Processing Request", 1);
				$db->query("INSERT INTO assessment (assessment_id,task_id,time_start,time_end) VALUES('$assessment->assessment_id','$assessment->task_id','$assessment->time_start','$assessment->time_end')");
				$this->output->set_status_header(201);
				
			} catch (Exception $e) {
				$this->output->set_status_header(500);
				
				
			}
		}else{
			$this->output->set_status_header(204);
		}
		
	}

	public function saveBlock(){
		if($this->input->raw_input_stream!=""){
			$block = json_decode($this->security->xss_clean($this->input->raw_input_stream));
			try {
				date_default_timezone_set("Asia/Makassar");
				$db = $this->load->database('psychomotor', TRUE);
				if(!isset($block->assessment_id)) throw new Exception("Error Processing Request", 1);
				if(!isset($block->task_id)) throw new Exception("Error Processing Request", 1);
				if(!isset($block->username)) throw new Exception("Error Processing Request", 1);
				if(!isset($block->color)) throw new Exception("Error Processing Request", 1);
				if(!isset($block->pos_x)) throw new Exception("Error Processing Request", 1);
				if(!isset($block->pos_y)) throw new Exception("Error Processing Request", 1);
				if(!isset($block->timestamp)) throw new Exception("Error Processing Request", 1);
				$db->query("INSERT INTO block (assessment_id,task_id,username,color,pos_x,pos_y,timestamp) VALUES('$block->assessment_id','$block->task_id','$block->username','$block->color','$block->pos_x','$block->pos_y','$block->timestamp')");
				$this->output->set_status_header(201);
				
			} catch (Exception $e) {
				$this->output->set_status_header(500);
				
				
			}
		}else{
			$this->output->set_status_header(204);
		}
		
	}

}