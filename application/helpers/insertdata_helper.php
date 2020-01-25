<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Uploads an image.
 *
 * @param      String  	$name   The name
 * @param      String  	$path   The path
 * @param      Int		$size   The size
 *
 * @return     string  ( Nama dari file yang diunggah )
 */
function insertData($table, $data)
{
	$CI = &get_instance();

	$insert = $CI->db->insert($table, $data);
	if ($insert) {
		return true;
	}else{
		return false;
	}
}