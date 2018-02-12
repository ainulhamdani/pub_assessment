<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessment extends CI_Controller {

	function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('user_valid') == FALSE) {
            redirect('welcome/login');
        }
        date_default_timezone_set("Asia/Makassar"); 
        $this->load->model("AssessModel");
    }

	public function index()
	{
        if($this->session->userdata('level')=="admin"){
        	$data['assessments'] = $this->AssessModel->getAssessments();
        	$this->load->view("admin/assess/main",$data);
        }else{
            $data['assessments'] = $this->AssessModel->getAssessments("is_active = 1");
        	$this->load->view("user/assess/main",$data);
        }
	}

	public function create(){
		if($this->session->userdata('level')=="admin"){
        	$data['assessments'] = $this->AssessModel->getAssessments();
        	$this->load->view("admin/assess/create",$data);
        }else{
        	$this->load->view("user/main");
        }
	}

	public function edit($id=""){
		if($id=="") redirect('assessment');
		if($this->session->userdata('level')=="admin"){
        	$data['assessment'] = $this->AssessModel->getAssessment($id);
        	$this->load->view("admin/assess/edit",$data);
        }else{
        	$this->load->view("user/main");
        }
	}

    public function detail($id=""){
        if($id=="") redirect('assessment');
        if($this->session->userdata('level')=="admin"){
            $data['assessment'] = $this->AssessModel->getAssessment($id);
            $data['question'] = $this->AssessModel->getQuestion($id);
            $data['tasks'] = $this->AssessModel->getTasks($id);
            $this->load->view("admin/assess/detail",$data);
        }else{
            $this->load->view("user/main");
        }
    }

    public function info($id=""){
        if($id=="") redirect('assessment');
        if($this->session->userdata('level')=="admin"){
            // $this->load->view("admin/assess/main");
        }else{
            $data['assessment'] = $this->AssessModel->getAssessment($id);
            $data['question'] = $this->AssessModel->getQuestion($id);
            $data['tasks'] = $this->AssessModel->getTasks($id);
            $this->load->view("user/assess/detail",$data);
        }
    }

    public function grade($id=""){
        if($id=="") redirect('assessment');
        if($this->session->userdata('level')=="admin"){
            // $this->load->view("admin/assess/main");
        }else{
            $this->load->model("Question");
            $data['assessment'] = $this->AssessModel->getAssessment($id);
            $data['question'] = $this->AssessModel->getQuestion($id);
            $answer = $this->AssessModel->getAnswers($id,$this->session->userdata('userid'));
            $data['task'] = $this->AssessModel->getUnansweredTasks($id,$answer);
            $this->load->view("user/assess/grade",$data);
        }
    }

    public function savegrade(){
        $id = '';
        if($_POST){
            $id = $id = $this->input->post('conf[assessment_id]');
            $this->AssessModel->saveAnswer($_POST);
        }
        redirect('assessment/grade/'.$id);
    }

    public function add_task($id=""){
        if($id=="") redirect('assessment');

        if($this->session->userdata('level')=="admin"){
            $data['assessment'] = $this->AssessModel->getAssessment($id);
            $this->load->view("admin/assess/add",$data);
        }else{
            $this->load->view("user/main");
        }
    }

    public function savetask(){
        if($this->session->userdata('level')=="admin"){
            $id = $this->input->post('id');
            $type = $this->input->post('type');
            $code = strtolower($this->input->post('code'));
            $config['upload_path']          = './asset/uploads/';
            $config['allowed_types']        = 'gif|jpg|jpeg|png';
            $config['file_name']            = $code.".jpg";
            $config['file_ext_tolower']     = TRUE;
            $config['max_size']             = 10000;
            $config['max_width']            = 2048;
            $config['max_height']           = 2048;

            $this->load->library('upload');
            $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('value'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    $this->AssessModel->addTask($id,$code,$type);
                    redirect("assessment/detail/".$id);
            }
        }else{
            $this->load->view("user/main");
        }
    }

}