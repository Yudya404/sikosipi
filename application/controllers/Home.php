<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index()
    {
        $data['title'] = 'SIKOSIPI';
        $this->load->view('home/header', $data);
        $this->load->view('home/index');
    }
}
