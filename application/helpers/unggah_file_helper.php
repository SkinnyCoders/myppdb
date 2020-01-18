<?php

/**
 * Uploads a file.
 *
 * @param      <type>  $name   The name
 * @param      <type>  $path   The path
 * @param      <type>  $size   The size
 *
 * @return     string  ( Nama dari file yang diunggah )
 */
function uploadFile($name, $path, $size)
{

    $CI = &get_instance();

    if (!empty($size)) {
        $ukuran = $size;
    } else {
        $ukuran = 2048; //2mb
    }

    $config['upload_path']          = $path;
    $config['allowed_types']        = 'pdf|doc|docx';
    $config['encrypt_name']         = TRUE;
    $config['overwrite']            = true;
    $config['max_size']             = $ukuran;

    $CI->load->library('upload', $config);

    if (!$CI->upload->do_upload($name)) {
        return 'default.png';
    } else {
        return $CI->upload->data('file_name');
    }
}
