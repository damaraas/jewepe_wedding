<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Katalog_model extends CI_Model
{
    public function construct()
    {
        parent::__construct(); 
        $this->load->database();
    }

    public function get_all_katalog()
    {
        $this->db->select('*');
        $this->db->from('tb_katalog tbc');
        $this->db->join('tb_users thu', 'thu.id_user = tbc.id_user');
        $this->db->order_by('tbc.updated_at', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_all_katalog_landing()
    {
        $this->db->select('*');
        $this->db->from('tb_katalog tbc');
        $this->db->join('tb_users thu', 'thu.id_user = tbc.id_user');
        $this->db->where('tbc.status', 'publish');
        $this->db->order_by('tbc.updated_at', 'DESC');
        $query = $this->db->get();
        return $query;
    }


    public function get_katalog_by_id()
    {
        $this->db->select('*');
        $this->db->from('tb_katalog tbc');
        $this->db->join('tb_users thu', 'thu.id_user = tbc.id_user');
        $this->db->order_by('tbc.id_katalog', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function insert($data) {
        return $this->db->insert('tb_katalog', $data);
    }

    public function update($id, $data) {
        $this->db->where('id_katalog', $id);
        return $this->db->update('tb_katalog', $data);
    }

    public function delete_by_id($id) {
        $this->db->where('id_katalog', $id);
        return $this->db->delete('tb_katalog');
    }
}