<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Informasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        getAuth(2);

        $this->load->model('m_pendaftaran');
    }

    public function index()
    {
    	$data['title'] = 'Daftar Informasi';
    	$data['informasi'] = $this->db->get('informasi')->result_array();

    	getViews($data, 'v_admin/v_informasi');
    }

    public function tambah()
    {
    	$data['title'] = 'Daftar Informasi';

    	$this->form_validation->set_rules('info','Judul Informasi','required|trim',['required' => '{field} tidak boleh kosong']);
    	$this->form_validation->set_rules('des','Deskripsi','required|trim',['required' => '{field} tidak boleh kosong']);

    	if ($this->form_validation->run() == FALSE) {
    		getViews($data, 'v_admin/v_add_informasi');
    	}else{

    		if (!empty($_FILES['foto']['name'])) {
    			$file = $this->_uploadFile();
    		}else{
    			$file = '';
    		}

    		$data = [
    			'judul_informasi' => $this->input->post('info', true),
    			'deskripsi_informasi' => $this->input->post('des', true),
    			'file_informasi' => $file
    		];

    		if (insertData('informasi', $data)) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('admin/informasi');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('admin/informasi');
    		}
    	}
    }

    public function update(){
    	$id_informasi = $_POST['id'];

    	$this->form_validation->set_rules('info','Judul Informasi','required|trim',['required' => '{field} tidak boleh kosong']);
    	$this->form_validation->set_rules('des','Deskripsi','required|trim',['required' => '{field} tidak boleh kosong']);

    	if ($this->form_validation->run() == FALSE) {
    		$this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                redirect('admin/informasi');
    	}else{
    		$file_old = $this->db->get_where('informasi', ['id_informasi' => $id_informasi])->row_array();
    		$file_old = $file_old['file_informasi'];

    		if (!empty($_FILES['foto']['name'])) {
    			$file = $this->_uploadFile();
    			if ($file !== false) {
    				unlink('assets/uploads/berkas_info/'.$file_old);
    			}
    		}else{
    			$file = $file_old;
    		}

    		$data = [
    			'judul_informasi' => $this->input->post('info', true),
    			'deskripsi_informasi' => $this->input->post('des', true),
    			'file_informasi' => $file
    		];

    		$update = $this->db->update('informasi', $data, ['id_informasi' => $id_informasi]);

    		if ($update) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                redirect('admin/informasi');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                redirect('admin/informasi');
    		}
    	}

    }

    public function get_data(){
    	if (isset($_POST['id'])) {
    		$id = $_POST['id'];
    		$info = $this->db->get_where('informasi', ['id_informasi' => $id])->row_array();

    		$data = [
    			'id_informasi' => $info['id_informasi'],
    			'judul_informasi' => $info['judul_informasi'],
    			'deskripsi_informasi' => $info['deskripsi_informasi'],
    			'file_informasi' => base_url('assets/uploads/berkas_info/'.$info['file_informasi'])
    		];

    		echo json_encode($data);
    	}
    }

    public function delete($id){
    	$file = $this->db->get_where('informasi', ['id_informasi' => $id])->row_array();
    	$file = $file['file_informasi'];
    	$delete = $this->db->delete('informasi', ['id_informasi' => $id]);
    	
    	if ($delete) {
    		if (!empty($file)) {
    			unlink('assets/uploads/berkas_info/'.$file);
    		}
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Maaf, data gagal dihapus');
    		http_response_code(500);
    	}
    }

    private function _uploadFile()
    {
        $config['upload_path']          = './assets/uploads/berkas_info/';
        $config['allowed_types']        = 'jpg|png|pdf|doc|docx';
        $config['encrypt_name']         = TRUE;
        $config['overwrite']            = true;
        $config['max_size']             = 2048; //2mb

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            return false;
        } else {
            return $this->upload->data('file_name');
        }
    }
}