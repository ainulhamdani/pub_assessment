<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PsychoModel extends CI_Model {

	function __construct() {
        parent::__construct();
		$this->db = $this->load->database('psychomotor', TRUE);
    }

    public function getAssessments($cond="1"){
    	return $this->db->query("SELECT * FROM assessment WHERE ".$cond." GROUP BY assessment_id ORDER BY time_start")->result();
    }

    public function getAssessment($id){
    	return $this->db->query("SELECT * FROM assessment WHERE id='$id'")->row();
    }

    public function getTasks($assessid){
    	return $this->db->query("SELECT * FROM assessment WHERE assessment_id='$assessid'")->result();
    }

    public function getTask($assessid,$taskid){
    	return $this->db->query("SELECT * FROM block WHERE assessment_id='$assessid' AND task_id='$taskid' ORDER BY timestamp")->result();
    }

    public function showTask($assessid,$taskid){
    	$datas = $this->getTask($assessid,$taskid);
    	$res = [];
    	for ($i=0; $i < 10; $i++) { 
    		for ($j=0; $j < 10; $j++) { 
    			$res[$i][$j] = "white";
    		}
    	}
    	foreach ($datas as $key => $data) {
    		$res[(int)$data->pos_x][(int)$data->pos_y] = $data->color;
    	}

    	echo('<table class="table table-bordered"><tbody>');
    	for ($i=0; $i < 10; $i++) { 
    		echo('<tr>');
    		for ($j=0; $j < 10; $j++) { 
    			if($res[$i][$j]=="red"){
    				echo('<td class="bg-danger">');
    			}elseif($res[$i][$j]=="blue"){
    				echo('<td class="bg-primary">');
    			}elseif($res[$i][$j]=="yellow"){
    				echo('<td class="bg-warning">');
    			}else{
	    			echo('<td class="table-light">');
    			}
    			echo('</td>');
    		}
    		echo('</tr>');
    	}
    	echo('</tbody></table>');
    }

}