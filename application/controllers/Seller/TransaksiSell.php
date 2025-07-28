<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiSell extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->user_error("idKonsumen")) {
            $this->session->set_flashdata('pesan_gagal', 'Anda harus login');
            redirect('', 'refresh');
        }
    }

    public function index()
    {
        // menampilkan transaksi member

    }
}
