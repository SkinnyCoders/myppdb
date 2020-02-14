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

function updateData($table, $data, $id, $value_id)
{
	$CI = &get_instance();

	$update = $CI->db->update($table, $data, [$id => $value_id]);
	if ($update) {
		return true;
	}else{
		return false;
	}
}

function deleteData($table, $id, $value_id){
	$CI = &get_instance();

	$delete = $CI->db->delete($table, [$id => $value_id]);

	if ($delete) {
		return true;
	}else{
		return false;
	}
}