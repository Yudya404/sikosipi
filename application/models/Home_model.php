<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function getAllPengumuman()
    {
        $query = $this->db->query("SELECT * FROM pengumuman peng JOIN pegawai p ON peng.id_pegawai=p.id_pegawai");
        return $query->result_array();
    }
    public function getPengumumanById($id)
    {
        $query = $this->db->query("SELECT * FROM pengumuman peng JOIN pegawai p ON peng.id_pegawai=p.id_pegawai where peng.id_pengumuman = $id");
        return $query->result_array();
    }
}
