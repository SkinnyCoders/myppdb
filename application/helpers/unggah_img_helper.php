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
function uploadImage($name, $path, $size)
{
    $CI = &get_instance();

    if (!empty($size)) {
        $ukuran = $size;
    } else {
        $ukuran = 2048; //2mb
    }

    $config['upload_path']          = $path;
    $config['allowed_types']        = 'gif|jpg|png';
    $config['encrypt_name']         = TRUE;
    $config['overwrite']            = true;
    $config['max_size']             = $ukuran; //2mb

    $CI->load->library('upload', $config);

    if (!$CI->upload->do_upload($name)) {
        return 'default.png';
    } else {
        return $CI->upload->data('file_name');
    }
}
