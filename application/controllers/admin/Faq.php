<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Faq extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuth(2);

        //load whatever you want bitch!!
        $this->load->model('m_users');
    }

    public function index(){
    	$data = [
    		'title' => 'FAQ',
    		'faq' => $this->db->get('faq')->result_array()
    	];

    	getViews($data,'v_admin/v_faq');
    }

    public function tambah(){
    	$data['title'] = 'Tambah FAQ';

    	$this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required|trim', ['required' => '{field} tidak boleh kosong']);
    	$this->form_validation->set_rules('jawaban', 'Jawaban', 'required|trim', ['required' => '{field} tidak boleh kosong']);

    	if ($this->form_validation->run() == FALSE) {
    		getViews($data, 'v_admin/v_add_faq');
    	}else{
    		$data = [
    			'pertanyaan' => $this->input->post('pertanyaan', true),
    			'jawaban' => $this->input->post('jawaban', true)
    		];

    		if (insertData('faq', $data)) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('admin/faq');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('admin/faq');
    		}
    	}
    }

    public function update(){
    	if (isset($_POST['id_get_update'])) {
    		$id = $_POST['id_get_update'];

    		$data = $this->db->get_where('faq', ['id_faq' => $id])->row_array();

    		echo json_encode($data);
    	}

    	if (isset($_POST['simpan'])) {
    		$data = [
    			'pertanyaan' => $this->input->post('pertanyaan', true),
    			'jawaban' => $this->input->post('jawaban', true)
    		];

    		$insert = $this->db->update('faq', $data, ['id_faq' => $this->input->post('id')]);

    		if ($insert) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                redirect('admin/faq');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                redirect('admin/faq');
    		}
    	}
    }

    public function delete($id){
    	$delete = $this->db->delete('faq', ['id_faq'=> $id]);

    	if ($delete) {
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Selamat, data gagal dihapus');
    		http_response_code(404);
    	}
    }
}