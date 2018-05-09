<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BotModel extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    private $BOT = ['Bot 1'=>'one','Bot 2'=>'two','Bot 3'=>'three'];
    private $URL = "https://karma.goodbot.ai/trigger/";
    // private $URL = "http://beats.sid-indonesia.org/bot/test/";

    public function schedule($datas){
        $db = $this->load->database('bot', TRUE);
        $insert = [];
        foreach ($datas as $key => $value) {
            $url = $this->URL.$this->BOT[$key];
            foreach ($value['values'] as $contact) {
                $date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP( $contact['D'] ));
                array_push($insert, [
                    "fb_id"=>$contact['B'],
                    "fb_name"=>$contact['A'],
                    "time"=>str_replace(".", ":", $contact['C']),
                    "date"=>$date,
                    "bot_type"=>$key
                ]);
            }
        }
        $db->insert_batch('schedule', $insert);
    }

    public function getScheduleDate(){
        $db = $this->load->database('bot', TRUE);
        return $db->query("SELECT schedule.date FROM schedule GROUP BY schedule.date")->result();
    }

    public function getSchedule($date){
        $db = $this->load->database('bot', TRUE);
        return $db->query("SELECT * FROM schedule WHERE schedule.date='$date' ORDER BY schedule.time")->result();
    }

    public function getSchedule2($date,$time){
        $db = $this->load->database('bot', TRUE);
        return $db->query("SELECT * FROM schedule WHERE schedule.date='$date' AND schedule.time < '$time' AND schedule.is_sent=0 ORDER BY schedule.time")->result();
    }

    public function setIsSent($ids,$date,$time){
        $db = $this->load->database('bot', TRUE);
        $db->update_batch("schedule",$ids,"id");
    }

    public function run_schedule(){
        $date = date('Y-m-d');
        $time = date('h:m:s');
        $users = $this->getSchedule2($date,$time);
        $ids = $this->run($users);
        if(!empty($ids)) $this->setIsSent($ids,$date,$time);
    }

    public function run($datas){
        $ids = [];
        foreach ($datas as $key => $value) {
            $url = $this->URL.$this->BOT[$value->bot_type];
            $data = ['contact_name'=>$value->fb_name,'urn'=>'facebook:'.$value->fb_id];
            $response = $this->post_curl($url,$data);
            $response = json_decode($response);
            if($response->text=="Successfully triggered messenger message"){
                array_push($ids, ["id"=>$value->id,"is_sent"=>1]);
            }
        }
        return $ids;
    }

    private function post_curl($url,$data){
        $post = json_encode($data);
        // var_dump($url);
        // var_dump($post);
        $headers = [
            'Content-Type: application/json'
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST , 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // execute!
        $response = curl_exec($ch);
        if(!$response){
            $response = '{"text":"error"}';
        }
        curl_close($ch);
        return $response;
    }

}