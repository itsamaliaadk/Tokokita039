<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#halo
class Adminpanel extends CI_Controller {

	public function index(){
		$this->load->view('admin/login');
	}

	public function dashboard(){
		if(empty($this->session->userdata('userName'))){
			redirect('adminpanel');
		}
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/menu');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/layout/footer');
	}

	public function login(){
		$this->load->model('Madmin');
		$u= $this->input->post('username');
		$p= $this->input->post('password');
		
		
		$cek = $this->Madmin->cek_login($u, $p)->num_rows();

		if($cek==1){ 
			$data = $this->Madmin->cek_login($u, $p)->row();
		
			$data_session = array(
				'idAdmin' => $data->idAdmin,
				'userName' => $u,
				'status' => 'login'
			);
			$this->session->set_userdata($data_session);
			redirect('adminpanel/dashboard');
		} else {
			redirect('adminpanel');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('adminpanel');
	}

	public function edit_password(){

		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/menu');
		$this->load->view('admin/formEditPassword');
		$this->load->view('admin/layout/footer');
	}

	public function save_password(){
		$password_baru = $this->input->post('password');

		$this->load->model('Madmin');

		$dataUpdate = array(
			'password'=> $password_baru
		);

		
		$this->Madmin->update('tbl_admin', $dataUpdate, 'idAdmin', $this->session->userdata('idAdmin'));

		redirect('adminpanel/edit_password');
	}

	function rajaongkir(){
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/menu');
		$this->load->view('admin/formOngkir');
		$this->load->view('admin/layout/footer');
	}

	function search_kota(){
		$this->load->helper('toko');
		echo searchKota($this->input->get('kota'));
	}
}
