<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiSell extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("idKonsumen")) {
            $this->session->set_flashdata('pesan_gagal', 'Anda harus login');
            redirect('', 'refresh');
        }
    }

    public function index()
    {
        // menampilkan transaksi member

    }

    public function history()
    {
        $idKonsumen = $this->session->userdata('idKonsumen');
        $this->load->model('Madmin');
        $this->load->model('Mtransaksi');
        $data['history'] = $this->Madmin->get_history_penjualan($idKonsumen);
        $this->load->view('home/layout/header');
        $this->load->view('home/produk/history_penjualan', $data);
        $this->load->view('home/layout/footer');
    }
}
