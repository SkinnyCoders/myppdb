<?php

/**
 * 
 */
class m_peserta extends CI_model
{
    public function getDataDiri($id_peserta)
    {
        $this->db->select('data_diri.id_data_diri, nama_lengkap, nisn, tempat_lahir, tgl_lahir, jenis_kelamin, alamat_rumah, no_hp, agama');
        $this->db->from('data_diri');
        $this->db->join('peserta', 'peserta.id_data_diri = data_diri.id_data_diri');
        $this->db->where('peserta.id_peserta', $id_peserta);
        return $this->db->get()->row_array();
    }

    public function getAllDataPeserta($id_peserta)
    {
        $this->db->select('*');
        $this->db->from('peserta');
        $this->db->join('data_diri', 'data_diri.id_data_diri=peserta.id_data_diri');
        $this->db->join('data_ortu', 'data_ortu.id_ortu=peserta.id_ortu');
        $this->db->join('data_sekolah_asal', 'data_sekolah_asal.id_data_sekolah_asal=peserta.id_sekolah_asal');
        $this->db->where('id_peserta', $id_peserta);
        return $this->db->get()->row_array();
    }

    public function updateData($data, $id)
    {
        return $this->db->update('data_diri', $data, ['id_data_diri' => $id]);
    }

    public function cekNISN($data)
    {
        return $this->db->get_where('data_diri', ['nisn' => $data])->num_rows();
    }

    public function cekDataBerkas($id)
    {
        $query = $this->db->get_where('peserta', ['id_peserta' => $id])->row_array();
        if ($query['id_berkas'] == NULL) {
            return false;
        } else {
            return true;
        }
    }

    public function updateDataBerkasPeserta($data, $id)
    {
        $this->db->set('id_berkas', $data);
        $this->db->where('id_peserta', $id);
        return $this->db->update('peserta');
    }

    public function getBerkas($id)
    {
        $this->db->select('data_berkas.id_berkas, ijazah_terakhir,  skhun, kartu_keluarga,  keterangan_sehat, pas_foto');
        $this->db->from('data_berkas');
        $this->db->join('peserta', 'peserta.id_berkas = data_berkas.id_berkas');
        return $this->db->get()->row_array();
    }

    public function getDataOrtu($id)
    {
        $this->db->select('data_ortu.*');
        $this->db->from('data_ortu');
        $this->db->join('peserta', 'peserta.id_ortu=data_ortu.id_ortu');
        return $this->db->get()->row_array();
    }

    public function updatePesertaOrtu($id_ortu, $id)
    {
        $this->db->set('id_ortu', $id_ortu);
        $this->db->where('id_peserta', $id);
        return $this->db->update('peserta');
    }

    public function getDataSekolah($id)
    {
        $this->db->select('data_sekolah_asal.*');
        $this->db->from('data_sekolah_asal');
        $this->db->join('peserta', 'peserta.id_sekolah_asal=data_sekolah_asal.id_data_sekolah_asal');
        return $this->db->get()->row_array();
    }

    public function updatePesertaSekolah($id_sekolah, $id){
        $this->db->set('id_sekolah_asal', $id_sekolah);
        $this->db->where('id_peserta', $id);
        return $this->db->update('peserta');
    }

    public function cekStatus($id){
        $this->db->select('pendaftaran.status_kelulusan');
        $this->db->from('peserta');
        $this->db->join('pendaftaran', 'pendaftaran.id_pendaftaran=peserta.id_pendaftaran');
        $this->db->where('peserta.id_peserta', $id);
        return $this->db->get()->row_array();
    }

    public function cekPencadangan($id){
        $this->db->select('status_pencadangan');
        $this->db->from('peserta');
        $this->db->join('pendaftaran', 'pendaftaran.id_pendaftaran=peserta.id_pendaftaran');
        $this->db->join('pencadangan', 'pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran');
        $this->db->where('peserta.id_peserta', $id);
        $this->db->where('status_pencadangan', 'true');
        return $this->db->get()->num_rows();
    }
}
