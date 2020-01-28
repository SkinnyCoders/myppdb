<?php 
defined('BASEPATH') or exit('No direct script access allowed');

	/**
	 * Sends a mail.
	 *
	 * @param      string   penerima email
	 * @param      string   status peserta
	 *
	 * @return     boolean  ( true | false )
	 */
	function send_mail($to, $status){
		$CI = &get_instance();
        $config = [
            'protocol' => "smtp",
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'myppdbofficial@gmail.com',
            'smtp_pass' => 'admanilham',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        ];

        $CI->load->library('email', $config);
        $CI->email->set_newline("\r\n");

        $CI->email->from('myppdbofficial@gmail.com', 'PPDB');
        $CI->email->to("$to");

        $CI->email->subject('Penerimaan Peserta Didik Baru');
        $CI->email->message("Anda dinyatakan $status pada proses penerimaan peserta didik baru!, silahkan cek akun anda untuk keterangan lebih lanjut. Terimakasih");

        if ($CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }