<?php 

/**
 * 
 */
class m_home extends CI_model
{

	public function get_specific_pengumuman($spesific) {
        $this->db->where($spesific);
        $this->db->order_by('tgl_pengumuman', 'DESC');
        return $this->db->get('pengumuman')->result_array();
    }

    public function get_yayasan() {
        $this->db->order_by('id_yayasan', 'DESC');
        return $this->db->get('yayasan')->row_array();
    }

    public function get_all_jenjang_pendidikan() {
        return $this->db->get('jenjang_pendidikan')->result_array();
    }

    public function get_specific_peserta($condition){
        $this->db->where($condition);
        $data = $this->db->get('peserta');
        return $data->row_array();
    }

    public function update_last_login_peserta($id_peserta, $data){
        $this->db->where('id_peserta', $id_peserta);
        $this->db->update('peserta', $data);
    }

    public function getProfil(){
        return $this->db->get('profil_sekolah')->row_array();
    } 

    public function addProfil($data){
        return $this->db->insert('profil_sekolah', $data);
    }

    public function updateProfil($data){
        return $this->db->update('profil_sekolah', $data);
    }

    public function addArchive($data){
        return $this->db->insert('penghargaan', $data);
    }

    public function getArchive(){
        return $this->db->get('penghargaan')->result_array();
    }

    public function getAllFacility(){
        return $this->db->get('fasilitas')->result_array();
    }
}


 ?>