<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function index()
    {
        redirect('auth/loginPegawai', 'refresh');
    }

    public function loginPegawai()
    {
        if ($this->session->userdata('level') == "pegawai") {
            redirect('pegawai', 'refresh');
        } 
		
        $data['title'] = 'Login Pegawai';
        $this->load->view('auth/pegawai/header', $data);
        $this->load->view('auth/pegawai/login');
    }

    public function prosesLoginPegawai()
    {
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars(MD5($this->input->post('password')));

        $cekLogin = $this->auth_model->loginPegawai($username, $password);

        if ($cekLogin) {
            foreach ($cekLogin as $row);
            $this->session->set_userdata('id_pegawai', $row->id_pegawai);
            $this->session->set_userdata('username', $row->username);
            $this->session->set_userdata('nama_pegawai', $row->nama_pegawai);
            $this->session->set_userdata('email', $row->email);
            $this->session->set_userdata('kategori', $row->kategori);
            $this->session->set_userdata('level', "pegawai");
            redirect('pegawai');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Username Atau Paswword Yang Anda Masukkan Salah, Harap Coba Kembali! </div>');
            redirect('home/index');
        }
    }

    public function logout()
	{
		$this->session->sess_destroy();
		redirect('home/index', 'refresh');
	}
}
