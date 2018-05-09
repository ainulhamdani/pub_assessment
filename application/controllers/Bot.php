<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bot extends CI_Controller {

	function __construct() {
        parent::__construct();
        
    }

	public function index()
	{
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('user_valid') == FALSE) {
            redirect('welcome/login');
        }
        if($this->session->userdata('level')!="admin"){
            redirect('');
        }
        $this->load->view("admin/bot/home");
	}

    public function upload(){
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('user_valid') == FALSE) {
            redirect('welcome/login');
        }
        if($this->session->userdata('level')!="admin"){
            redirect('');
        }
        $this->load->view("admin/bot/upload");
    }

    public function schedule(){
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('user_valid') == FALSE) {
            redirect('welcome/login');
        }
        if($this->session->userdata('level')!="admin"){
            redirect('');
        }
        $this->load->model('BotModel');
        $date = $this->uri->segment(3);
        if($date == null){
            $data['dates'] = $this->BotModel->getScheduleDate();
            $this->load->view("admin/bot/schedule",$data);
        }else{
            $data['schedules'] = $this->BotModel->getSchedule($date);
            $this->load->view("admin/bot/schedule_detail",$data);
        }
        
    }

    public function save_schedule(){
        set_time_limit(1000);
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('user_valid') == FALSE) {
            redirect('welcome/login');
        }
        if($this->session->userdata('level')!="admin"){
            redirect('');
        }
        $sheets = ['Bot 1','Bot 2','Bot 3'];
        $config['upload_path']          = './asset/temp/';
        $config['allowed_types']            = 'xlsx|xls';
        $config['remove_spaces']            = TRUE;
        $config['overwrite']                = TRUE;

        $this->load->library('upload',$config);
        if($this->upload->do_upload('userfile')){
            $up_data = $this->upload->data();
            $this->load->library('PHPExcell');
            $objPHPExcel = PHPExcel_IOFactory::load($up_data['full_path']);
            foreach ($sheets as $sheet) {
                unset($header);
                $arr_data = [];
                $objPHPExcel->setActiveSheetIndexByName($sheet);
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                foreach ($cell_collection as $cell) {
                    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                    if ($row == 1) {
                        $header[$row][$column] = $data_value;
                    } else {
                        $arr_data[$row][$column] = $data_value;
                    }
                }
                $data_excel[$sheet]['header'] = $header;
                $data_excel[$sheet]['values'] = $arr_data;
            }
            unlink($up_data['full_path']);
            $this->load->model('BotModel');
            $this->BotModel->schedule($data_excel);
            redirect('bot/schedule');

        }else{
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);
        }
    }

    public function template(){
        $this->load->library('PHPExcell');
        $file = FCPATH."asset/temp/schedule_temp.xlsx";
        $fileObject = PHPExcel_IOFactory::load($file);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="schedule_template.xlsx"'); 
        header('Cache-Control: max-age=0'); 
        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
    }

    public function test(){
        if($this->input->raw_input_stream!=""){
            $data = $this->security->xss_clean($this->input->raw_input_stream);
            $db = $this->load->database('psychomotor', TRUE);
            $db->query("INSERT INTO test (data) VALUES('$data')");
        }
    }

    public function bot(){
        if($this->input->raw_input_stream!=""){
            $this->load->model('Uuid');
            $data = $this->security->xss_clean($this->input->raw_input_stream);
            $db = $this->load->database('bot', TRUE);
            $uid = $this->Uuid->v4();
            $db->query("INSERT INTO message_events (uid,payload) VALUES('$uid','$data')");
            $this->output->set_status_header(200);
        }else{
            $this->output->set_status_header(204);
        }
    }

}