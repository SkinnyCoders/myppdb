<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function getViews($data, $konten){
	$CI =& get_instance();

	$CI->load->view('templates/admin_header', $data);
	$CI->load->view($konten, $data);
	$CI->load->view('templates/admin_footer');

	return true;
}