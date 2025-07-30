<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Madmin');

		$this->load->library('cart');

		$params = array('server_key' => 'SB-Mid-server-hu8bMj_Ty7gN7voHYLZqLiDi', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
	}

	public function index()
	{
		$data['produk'] = $this->Madmin->get_produk()->result();
		$data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
		$this->load->view('home/layout/header', $data);
		$this->load->view('home/layanan');
		$this->load->view('home/home');
		$this->load->view('home/layout/footer');
	}

	public function detail_produk($idProduk)
	{
		$dataWhere = array('idProduk' => $idProduk);
		$data['produk'] = $this->Madmin->get_by_id('tbl_produk', $dataWhere)->row_object();
		$data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
		$this->load->view('home/layout/header', $data);
		$this->load->view('home/detail_produk', $data);
		$this->load->view('home/layout/footer');
	}

	public function add_cart($idProduk)
	{
		if (empty($this->session->userdata('idKonsumen'))) {
			echo "<script>alert('Anda harus login dulu untuk add cart');history.back()</script>";
			exit();
		}

		$dataWhere = array('idProduk' => $idProduk);
		$produk = $this->Madmin->get_by_id('tbl_produk', $dataWhere)->row_object();
		$kota = $this->Madmin->get_kota_penjual($produk->idToko)->row_object();


		$this->session->set_userdata('idKotaAsal', $kota->idKota);
		$this->session->set_userdata('kotaAsal', $kota->alamat);
		$this->session->set_userdata('idTokoPenjual', $produk->idToko);

		$data = array(
			'id' => $produk->idProduk,
			'qty' => 1,
			'price' => $produk->harga,
			'name' => $produk->namaProduk,
			'image' => $produk->foto
		);

		$this->cart->insert($data);
		redirect("main/cart");
	}

	public function cart()
	{
		if (empty($this->session->userdata('idKonsumen'))) {
			echo "<script>alert('Anda harus login dulu untuk add cart');history.back()</script>";
			exit();
		}

		$data['kota_asal'] = $this->session->userdata('idKotaAsal');
		$data['kota_tujuan'] = $this->session->userdata('idKotaTujuan');

		$data['cartItems'] = $this->cart->contents();
		$data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
		$data['total'] = $this->cart->total();

		$this->load->view('home/layout/header', $data);
		$this->load->view('home/cart', $data);
		$this->load->view('home/layout/footer');
	}

	public function delete_cart($rowid)
	{
		$remove = $this->cart->remove($rowid);
		redirect("main/cart");
	}

	public function register()
	{
		$this->load->view('home/layout/header');
		$this->load->view('home/register');
		$this->load->view('home/layout/footer');
	}

	public function getProvince()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"BzxlGtll01dab13b477ce625AZP7qoGq"
			),
		));
		$response = curl_exec($curl);

		$err = curl_error($curl);

		curl_close($curl);
		$data = json_decode($response, true);
		echo "<option value=''>Pilih Provinsi</option>";
		for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
			echo "<option value='" . $data['rajaongkir']['results'][$i]['province_id'] . "'>" . $data['rajaongkir']['results'][$i]['province'] . "</option>";
		}
	}

	public function getCity($keyword)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=" . $keyword . "&limit=5&offset=0",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: BzxlGtll01dab13b477ce625AZP7qoGq"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$data = json_decode($response, true);
		echo "<option value=''>Pilih Kota</option>";
		for ($i = 0; $i < count($data['data']); $i++) {
			echo "<option value='" . $data['data'][$i]['id'] . "'>" . $data['data'][$i]['label'] . "</option>";
		}
	}

	public function save_reg()
	{
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$telpon = $this->input->post('telpon');
		$idKota = $this->input->post('city');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$alamat = $this->input->post('alamat');

		$dataInput = array('username' => $username, 'password' => $password, 'idKota' => $idKota, 'namaKonsumen' => $nama, 'alamat' => $alamat, 'email' => $email, 'tlpn' => $telpon, 'statusAktif' => 'Y');
		$this->Madmin->insert('tbl_member', $dataInput);
		//echo "OK";
		echo "<script>alert('Register member berhasil!');</script>";
		redirect('main');
	}

	public function login()
	{
		$this->load->view('home/layout/header');
		$this->load->view('home/login');
		$this->load->view('home/layout/footer');
	}

	public function login_member()
	{
		$this->load->model('Madmin');
		$u = $this->input->post('username');
		$p = $this->input->post('password');

		$cek = $this->Madmin->cek_login_member($u, $p)->num_rows();
		$result = $this->Madmin->cek_login_member($u, $p)->row_object();

		if ($cek == 1) {
			$data_session = array(
				'idKonsumen' => $result->idKonsumen,
				'idKotaTujuan' => $result->idKota,
				'kotaTujuan' => $result->alamat,
				'Member' => $u,
				'status' => 'login'
			);
			$this->session->set_userdata($data_session);
			redirect('main/dashboard');
		} else {
			redirect('main/login');
		}
	}

	public function dashboard()
	{
		$idKonsumen = $this->session->userdata('idKonsumen');
		$data['konsumen'] = $this->db->get_where('tbl_member', ['idKonsumen' => $idKonsumen])->row();

		$this->load->view('home/layout/header');
		$this->load->view('home/dashboard', $data);
		$this->load->view('home/layout/footer');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('main/login');
	}

	public function proses_transaksi()
	{
		$dataWhere = array('idKonsumen' => $this->session->userdata('idKonsumen'));
		$member = $this->Madmin->get_by_id('tbl_member', $dataWhere)->row_object();
		$this->load->helper('toko');

		$kota_asal = $this->session->userdata('idKotaAsal');
		$kota_tujuan = $this->session->userdata('idKotaTujuan');

		$city = getDetailCity($kota_tujuan);
		$id_kota_tujuan = isset($city['data'][0]['id']) ? $city['data'][0]['id'] : null;

		$city = getDetailCity($kota_asal);
		$id_kota_asal = isset($city['data'][0]['id']) ? $city['data'][0]['id'] : null;

		// Ambil dari input
		$ongkir_value = $this->input->post('ongkir');
		$diskon_value = $this->input->post('diskon');

		// Antisipasi jika null
		$ongkir_value = $ongkir_value ?? 0;
		$diskon_value = $diskon_value ?? 0;

		$grand_total = $this->cart->total() + $ongkir_value - $diskon_value;

		$dataInput = array(
			'idKonsumen' => $member->idKonsumen,
			'idToko' => $this->session->userdata('idTokoPenjual'),
			'tglOrder' => date("Y-m-d"),
			'statusOrder' => "Belum Bayar",
			'kurir' => "JNE OKE",
			'ongkir' => $ongkir_value,
			'diskon' => $diskon_value,
			'grand_total' => $grand_total
		);

		// tambah detail order 
		$this->Madmin->insert('tbl_order', $dataInput);
		$insert_id = $this->db->insert_id();
		foreach ($this->cart->contents() as $item) {
			$data_detail = array(
				'idOrder' => $insert_id,
				'idProduk' => $item['id'],
				'jumlah' => $item['qty'],
				'harga' => $item['price']
			);
			$this->Madmin->insert('tbl_detail_order', $data_detail);
		}


		$transaction_details = array(
			'order_id' => $insert_id,
			'gross_amount' => $grand_total,
		);

		$item_details = [];
		foreach ($this->cart->contents() as $item) {
			$item_details[] = array(
				'id' => $item["id"],
				'price' => $item["price"],
				'quantity' => $item["qty"],
				'name' => $item["name"]
			);
		}

		$item_details[] = array(
			'id' => 'ONGKIR',
			'price' => $ongkir_value,
			'quantity' => 1,
			'name' => "Ongkos Kirim JNE Oke"
		);

		if ($diskon_value > 0) {
			$item_details[] = array(
				'id' => 'DISKON',
				'price' => -$diskon_value,
				'quantity' => 1,
				'name' => "Voucher Diskon"
			);
		}


		// Optional
		$billing_address = array(
			'first_name'    => $member->namaKonsumen,
			'last_name'     => "",
			'address'       => $member->alamat,
			'city'          => $member->alamat,
			'postal_code'   => "",
			'phone'         => $member->tlpn,
			'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
			'first_name'    => $member->namaKonsumen,
			'last_name'     => "",
			'address'       => $member->alamat,
			'city'          => $member->alamat,
			'postal_code'   => "",
			'phone'         => $member->tlpn,
			'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
			'first_name'    => $member->namaKonsumen,
			'last_name'     => "",
			'email'         => $member->email,
			'phone'         => $member->tlpn,
			'billing_address'  => $billing_address,
			'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'hour',
			'duration'  => 2
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	public function finish()
	{
		$result = json_decode($this->input->post('result_data'));

		if ($result->transaction_status == "settlement") {
			$id = $result->order_id;
			$dataUpdate = array('statusOrder' => "Dikemas");
			$this->Madmin->update('tbl_order', $dataUpdate, 'idOrder', $id);
			redirect('/');
		}
	}

	// add voucher diskon
	public function add_voucher()
	{
		$kode = $this->input->post('kode_voucher');
		$this->db->where('kode_voucher', $kode);
		$voucher = $this->db->get('tbl_voucher')->row();

		if ($voucher) {
			$now = date('Y-m-d');
			if ($voucher->tgl_berakhir >= $now) {
				// simpan diskon & kode voucher ke session
				$this->session->set_userdata('kode_voucher', $kode);
				$this->session->set_userdata('diskon', $voucher->nominal_discount);

				echo json_encode([
					'status' => 'valid',
					'nominal_discount' => $voucher->nominal_discount
				]);
			} else {
				echo json_encode(['status' => 'expired']);
			}
		} else {
			echo json_encode(['status' => 'invalid']);
		}
	}
}
