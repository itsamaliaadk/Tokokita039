<?php
defined('BASEPATH') or exit('No direct script access allowed');

class voucher extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Madmin');
	}

	public function index()
	{
		if (empty($this->session->userdata('userName'))) {
			redirect('adminpanel');
		}
		$data['voucher'] = $this->Madmin->get_all_data('tbl_voucher')->result();
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/menu');
		$this->load->view('admin/voucher/tampil_voucher', $data);
		$this->load->view('admin/layout/footer');
	}

	public function add()
	{
		if (empty($this->session->userdata('userName'))) {
			redirect('adminpanel');
		}
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/menu');
		$this->load->view('admin/voucher/formAdd');
		$this->load->view('admin/layout/footer');
	}

	public function save()
	{
		if (empty($this->session->userdata('userName'))) {
			redirect('adminpanel');
		}
		$kodeVoucher = $this->input->post('kdVoucher');
		$tglBerakhir = $this->input->post('tglBerakhir');
		$nominalDiskon = $this->input->post('nominalDskn');
		$dataInput = array('kode_voucher' => $kodeVoucher, 'tgl_berakhir' => $tglBerakhir, 'nominal_discount' => $nominalDiskon);
		$this->Madmin->insert('tbl_voucher', $dataInput);
		redirect('voucher');
	}

	public function get_by_id($id)
	{
		if (empty($this->session->userdata('userName'))) {
			redirect('adminpanel');
		}
		$dataWhere = array('id_voucher' => $id);
		$data['voucher'] = $this->Madmin->get_by_id('tbl_voucher', $dataWhere)->row_object();
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/menu');
		$this->load->view('admin/voucher/formEditVoucher', $data);
		$this->load->view('admin/layout/footer');
	}


	public function edit()
	{
		if (empty($this->session->userdata('userName'))) {
			redirect('adminpanel');
		}
		$id = $this->input->post('id');
		$kodeVoucher = $this->input->post('kode_voucher');
		$tglBerakhir = $this->input->post('tglBerakhir');
		$nominalDiskon = $this->input->post('nominalDskn');
		$dataUpdate = array('kode_voucher' => $kodeVoucher, 'tgl_berakhir' => $tglBerakhir, 'nominal_discount' => $nominalDiskon);
		$this->Madmin->update('tbl_voucher', $dataUpdate, 'id_voucher', $id);
		redirect('voucher');
	}

	public function delete($id)
	{
		if (empty($this->session->userdata('userName'))) {
			redirect('adminpanel');
		}
		$this->Madmin->delete('tbl_voucher', 'id_voucher', $id);
		redirect('voucher');
	}
}
