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

    public function run($datas){
        foreach ($datas as $key => $value) {
            $url = $this->URL.$this->BOT[$key];
            foreach ($value['values'] as $contact) {
                $data = ['contact_name'=>$contact['A'],'urn'=>'facebook:'.$contact['B']];
                $response = $this->post_curl($url,$data);
                var_dump($data);
                var_dump($response);
            }
        }
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
        // if(!$response){
        //     die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        // }
        // curl_close($ch);
        return $response;
    }

}