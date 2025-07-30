<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function index()
    {
        // panggil model Mtransaksi & function tampil
        $this->load->model('Mtransaksi');


        // Ambil segment untuk halaman aktif (pagination)
        $page = $this->uri->segment(3);
        $page = ($page == '') ? 0 : $page;
        $per_page = 5;

        $id_member = $this->session->userdata('idKonsumen');
        $data['tbl_order'] = $this->Mtransaksi->get_data($per_page, $page, $id_member);
        $data['total_rows'] = $this->Mtransaksi->jumlah_data();
        $data['per_page'] = $per_page;
        $data['page'] = $page;


        $this->load->view('home/layout/header');
        $this->load->view('transaksi/transaksi_tampil', $data);
        $this->load->view('home/layout/footer');
    }
}



// Transaksi = history pembelian saya