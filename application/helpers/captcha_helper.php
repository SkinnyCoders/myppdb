<?php
defined('BASEPATH') or exit('No direct script access allowed');

function get_Captcha(){
        $CI = &get_instance();
        $recaptchaResponse = trim($CI->input->post('g-recaptcha-response'));
        $userIp=$CI->input->ip_address();
        $secret = $CI->config->item('google_secret');
        $url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp;
     
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
             
        $status= json_decode($output, true);
        return $status['success'];
}

