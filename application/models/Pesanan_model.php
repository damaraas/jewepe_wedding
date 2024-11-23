<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pesanan_model extends CI_Model
{
    public function construct()
    {
        parent::__construct(); 
        $this->load->database();
    }

    public function get_all_pesanan()
    {
        $this->db->select('*');
        $this->db->from('tb_pesanan tbo');
        $this->db->join('tb_katalog tbc', 'tbc.id_katalog = tbo.id_katalog');
        $this->db->order_by('tbo.updated_at', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_all_laporan()
    {
        $this->db->select('id_pesanan, tbo.id_katalog, gambar, judul_katalog, harga, status_pesanan, Count(*) As jumlah_pesanan');
        $this->db->from('tb_pesanan tbo');
        $this->db->join('tb_katalog tbc', 'tbc.id_katalog = tbo.id_katalog');
        $this->db->group_by('tbo.id_katalog');
        $this->db->order_by('tbo.updated_at', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_count_pesanan($status_pesanan)
    {
        $this->db->select('*');
        $this->db->from('tb_pesanan tbo');
        $this->db->join('tb_katalog tbc', 'tbc.id_katalog = tbo.id_katalog');
        if($status_pesanan != 'all') {
            $this->db->where('tbo.status_pesanan', $status_pesanan);
        }
        $query = $this->db->get();
        return $query;
    }

    public function cek_data_pesanan($id, $email, $tanggal_wedding)
    {
        $this->db->select('*');
        $this->db->from('tb_pesanan tbo');
        $this->db->join('tb_katalog tbc', 'tbc.id_katalog = tbo.id_katalog');
        $this->db->where('tbo.id_katalog', $id);
        $this->db->where('tbo.email', $email);
        $this->db->where('tbo.tanggal_wedding', $tanggal_wedding);
        $this->db->order_by('tbo.updated_at', 'DESC');
        $query = $this->db->get();
        return $query;
    }


    public function get_pesanan_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tb_pesanan tbo');
        $this->db->join('tb_katalog tbc', 'tbc.id_katalog = tbo.id_katalog');
        $this->db->where('tbo.id_pesanan', $id);
        $query = $this->db->get();
        return $query;
    }

    public function insert($data) {
        return $this->db->insert('tb_pesanan', $data);
    }

    public function update($id, $data) {
        $this->db->where('id_pesanan', $id);
        $query = $this->db->update('tb_pesanan', $data);
        return $query;
    }

    public function delete_by_id($id) {
        $this->db->where('id_pesanan', $id);
        $query = $this->db->delete('tb_pesanan');
        return $query;
    }
}