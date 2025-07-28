<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mtransaksi extends CI_Model
{

    // pagination
    public function jumlah_data()
    {
        return $this->db->count_all('tbl_order');
    }

    public function get_data($limit, $start, $id_member)
    {
        $this->db->select('*');
        $this->db->where('idKonsumen', $id_member);
        $this->db->limit($limit, $start);
        return $this->db->get('tbl_order')->result_array();
    }

    function tampil()
    {
        $q = $this->db->get('tbl_order');
        $d = $q->result_array();
        return $d;
    }

    function transaksi_member_jual($id_member_jual)
    {
        $this->db->where('idKonsumen', $id_member_jual);
        $q = $this->db->get('tbl_order');
        $d = $q->row_array();
        return $d;
    }

    function transaksi_member_beli($id_member_beli)
    {
        $this->db->where('idToko', $id_member_beli);
        $q = $this->db->get('tbl_order');
        $d = $q->row_array();
        return $d;
    }

    function detail($idOrder)
    {
        $this->db->where('idOrder', $idOrder);
        $q = $this->db->get('tbl_order');
        $d = $q->row_array();
        return $d;
    }

    function transaksi_detail($idOrder)
    {
        $this->db->where('idOrder', $idOrder);
        $q = $this->db->get('tbl_detail_order');
        $d = $q->row_array();
        return $d;
    }
}
