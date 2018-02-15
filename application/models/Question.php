<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    public function getQuestion($id){
        return $this->db->query("SELECT * FROM assessment_question WHERE assessment_id='$id' ORDER BY version DESC")->row();
    }

    public function showQuestion($id,$taskid,$version){
    	$q = $this->getQuestion($id);
    	$this->load->library('PHPExcell');
    	$res = $this->loadExcel("asset/questions/".$id."_".$q->version.".xlsx");
        echo('<style>input[type="radio"] {
            -ms-transform: scale(1.5); /* IE 9 */
            -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
            transform: scale(1.5);
        }
        input[type="checkbox"] {
            -ms-transform: scale(1.5); /* IE 9 */
            -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
            transform: scale(1.5);
        }</style>');
    	echo('<form method="post" class="form-control" action="'.base_url().'assessment/savegrade">');

        foreach ($res['survey'] as $key => $question) {
        	$type = explode(' ', $question['type']);
        	if(count($type)>1) $listname = $type[1];
        	$type = $type[0];
        	$var_name = $question['name'];$relevant = "";
            if(isset($question['relevant'])){
                $relevant = 'data-relevant="'.$question['relevant'].'"';
            }
        	$question = $question['label'];
            
    		echo('<div id="'.$var_name.'" class="card question" '.$relevant.'>');
    		echo('<div class="card-body">');
    		echo('<div class="row form-group">');
    		echo('<div class="col-md-12 col-sm-12 col-12 text-justify">'.$question.'</div>');
    		echo('<div class="col-md-12 col-sm-12 col-12">');
    		// echo('<br>');
        	if($type=='text'){
        		echo('<input class="form-control" type="text" name="'.$var_name.'" required /></div>');
        	}elseif($type=='select_one'){
        		foreach ($res['choices'][$listname] as $key => $list) {
                    echo('<div class="form-check">');
        			echo('<input id="'.$list['name'].'-input" class="form-check-input" type="radio" value="'.$list['name'].'" name="'.$var_name.'" />');
                    echo('<label class="form-check-label" for="'.$list['name'].'-input" >'.$list['label'].'</label>');
                    echo('</div>');
        		}
        		echo('</div>');
        	}elseif($type=='select_multiple'){
        		foreach ($res['choices'][$listname] as $key => $list) {
                    echo('<div class="form-check">');
                    echo('<input id="'.$list['name'].'-input" class="form-check-input" type="checkbox" value="'.$list['name'].'" name="'.$var_name.'[]" />');
                    echo('<label class="form-check-label" for="'.$list['name'].'-input" >'.$list['label'].'</label>');
                    echo('</div>');
        		}
        		echo('</div>');
        	}
    		echo('</div>');
    		echo('</div>');
    		echo('</div>');
        }
        echo('<input type="hidden" name="version" value="'.$version.'" />');
        echo('<input type="hidden" name="conf[assessment_id]" value="'.$id.'" />');
        echo('<input type="hidden" name="conf[userid]" value="'.$this->session->userdata('userid').'" />');
        echo('<input type="hidden" name="conf[task_id]" value="'.$taskid.'" />');
        echo('<br><div class="row form-group">
		    		<div class="col-md-3-offset-3 col-sm-12 col-12">
				      <button type="submit" class="btn btn-primary btn-block">Save</button>
				    </div>
				</div>');
        echo('</form>');

    }

    public function loadExcel($file){
    	$this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        $fileObject->setActiveSheetIndexByName("survey");
        $surveyTemp = array();

        //get only the Cell Collection
        $cell_collection = $fileObject->getActiveSheet()->getCellCollection();

        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $fileObject->getActiveSheet()->getCell($cell)->getColumn();
            $row = $fileObject->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $fileObject->getActiveSheet()->getCell($cell)->getValue();

            if ($row == 0) {
                continue;
            } else {
                $surveyTemp[$row-1][$column] = $data_value;
            }
        }
        $header = reset($surveyTemp);
        $survey = [];
        foreach ($surveyTemp as $key1 => $values) {
        	if($values==$header) continue;
        	$valueTemp = [];
        	foreach ($values as $key2 => $value) {
        		$valueTemp[$header[$key2]] = $value;
        	}
        	$survey[$key1] = $valueTemp;
        }

        $fileObject->setActiveSheetIndexByName("choices");
        $choicesTemp = array();

        //get only the Cell Collection
        $cell_collection = $fileObject->getActiveSheet()->getCellCollection();

        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $fileObject->getActiveSheet()->getCell($cell)->getColumn();
            $row = $fileObject->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $fileObject->getActiveSheet()->getCell($cell)->getValue();

            if ($row == 0) {
                continue;
            } else {
                $choicesTemp[$row-1][$column] = $data_value;
            }
        }

        $header = reset($choicesTemp);
        $choicesTemp2 = [];
        foreach ($choicesTemp as $key1 => $values) {
        	if($values==$header) continue;
        	$valueTemp = [];
        	foreach ($values as $key2 => $value) {
        		$valueTemp[$header[$key2]] = $value;
        	}
        	$choicesTemp2[$key1] = $valueTemp;
        }

        $choices = [];
        foreach ($choicesTemp2 as $key => $value) {
        	if(!array_key_exists($value['list name'], $choices)) $choices[$value['list name']] = [];
        	array_push($choices[$value['list name']], $value);
        }

        $res['survey'] = $survey;
        $res['choices'] = $choices;
        return $res;
    }
}