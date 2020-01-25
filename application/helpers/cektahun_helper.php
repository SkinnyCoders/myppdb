<?php
defined('BASEPATH') or exit('No direct script access allowed');

function getTahun()
{
	date_default_timezone_set('Asia/Jakarta');
	if (date('m') >'06') {
		return $tahun_now = date('Y');
	}else{
		return $tahun_now = date('Y')-1;
	}
}

function getIdTahun($tahun_now){
	$CI = &get_instance();

	$tahun = $CI->db->get_where('tahun_ajaran', ['tahun_mulai' => $tahun_now])->row_array();

	return $id_tahun = $tahun['id_tahun_ajaran'];
}