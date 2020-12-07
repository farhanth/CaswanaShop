<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
	}

	public function index()
	{
		$this->load->library('pagination');

		if ($this->uri->segment(1) !='user' && empty($this->input->get('search')) && empty($this->input->get('kategori'))) {
			$this->session->set_userdata('keyword', "");
			$this->session->set_userdata('kategori', "");
		}

		if ($this->input->get('search')) {
			$data['keyword'] = $this->input->get('search');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else{
			$data['keyword'] = $this->session->userdata('keyword');
		}

		if ($this->input->get('kategori')) {
			$this->session->set_userdata('keyword', "");
			$data['kategori'] = $this->input->get('kategori');
			$this->session->set_userdata('kategori', $data['kategori']);
		} else{
			$data['kategori'] = $this->session->userdata('kategori');
		}


		if ($this->uri->segment(3) == NULL && empty($this->input->get('search')) && empty($this->input->get('kategori'))) {
			$this->session->set_userdata('keyword', "");
			$this->session->set_userdata('kategori', "");
		}

		$this->db->join('kategori','kategori.id_kategori = sepeda.id_kategori');
		if ($data['kategori'] != NULL) {
			$this->db->where('kategori', $data['kategori']);
		}

		if ($data['keyword'] != NULL) {
			$this->db->like('merk', $data['keyword']);
		}

		if ($data['kategori'] && $data['keyword']) {
			$this->db->where('kategori', $data['kategori']);
			$this->db->like('merk', $data['keyword']);
		}
		$query = $this->db->get('sepeda');
		$config['total_rows'] = $query->num_rows();

		$data['total_rows'] = $config['total_rows'];
		$config['per_page'] = 6;

		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(3);

		$data ['produk'] = $this->M_user->get_produk_all($config['per_page'], $data['start'], $this->session->userdata('kategori'), $this->session->userdata('keyword'));

		$data['kategori'] = $this->M_user->get_kategori();
		
		$this->load->view('home', $data);
	}

	public function produk($id)
	{
		$data['produk'] = $this->M_user->get_produk($id);
		$this->load->view('produk', $data);
		if (isset($_POST['keranjang'])) {
			if ($this->session->userdata('login') == '1') {
				$this->M_user->tambah_keranjang();
			} else{
				$this->session->set_flashdata('belum_login', '1');
				redirect('login','refresh');
			}
		}
	}

	public function keranjang()
	{
		if ($this->session->userdata('login') == '1') {
			$data['keranjang'] = $this->M_user->get_keranjang($this->session->userdata('id_user'));
			$this->load->view('keranjang', $data);
			if (isset($_POST['id_keranjang'])) {
				$this->M_user->delete_keranjang($this->input->post('id_keranjang'));
			}
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('login','refresh');
		}
	}

	public function tambah($id, $jumlah)
	{
		if ($this->session->userdata('login') == '1') {
			$this->M_user->edit_tambah_keranjang($id, $jumlah);
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('login','refresh');
		}
	}

	public function kurang($id, $jumlah)
	{
		if ($this->session->userdata('login') == '1') {
			$this->M_user->edit_kurang_keranjang($id, $jumlah);
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('login','refresh');
		}
	}

	public function checkout()
	{
		if ($this->session->userdata('login') == '1') {
			$data['keranjang'] = $this->M_user->get_keranjang($this->session->userdata('id_user'));
			$data['user'] = $this->M_user->get_user($this->session->userdata('id_user'));
			$this->load->view('checkout', $data);
			if (isset($_POST['bayar'])) {
				$this->M_user->invoice();
			}
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('login','refresh');
		}
	}

	public function pembelian()
	{
		if ($this->session->userdata('login') == '1') {
			$data['no_invoice'] = $this->M_user->get_no_invoice($this->session->userdata('id_user'));
			$this->load->view('pembelian', $data);
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('login','refresh');
		}
	}

	public function detail_invoice($no_invoice)
	{
		if ($this->session->userdata('login') == '1') {
			$data['invoice'] = $this->M_user->get_detail_invoice($no_invoice);
			$data['no_invoice'] = $this->M_user->get_detail_no_invoice($no_invoice);
			$this->load->view('detail_invoice', $data);
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('login','refresh');
		}
	}

	public function bukti_transfer($no_invoice)
	{
		if ($this->session->userdata('login') == '1') {
			$data['no_invoice'] = $no_invoice;
			$this->load->view('bukti_transfer', $data);
			
			if (isset($_POST['upload'])) {
				$id = uniqid('item', TRUE);

				$config['upload_path'] = 'bukti_transfer';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '100000';
				$config['file_ext_tolower'] = TRUE;
				$config['file_name'] = str_replace('.','_',$id);

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('gambar')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());
				}else{
					$filename = $this->upload->data('file_name');
					$this->M_user->bukti_transfer($no_invoice, $filename);
				}
			}
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('login','refresh');
		}
	}

	public function download($file){
		if ($this->session->userdata('login') == '1') {
			$this->load->helper(array('url','download'));
			force_download('bukti_transfer/'.$file,NULL);
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('login','refresh');
		}
	}

	public function kontak()
	{
		$this->load->view('kontak');
	}

	public function login()
	{
		if ($this->session->userdata('login') == '1') {
			if ($this->session->userdata == 'user') {
				redirect('User','refresh');
			}
			elseif ($this->session->userdata == 'admin') {
				redirect('Admin','refresh');
			}
		} else{
			$this->load->view('login');
			if (isset($_POST['login'])) {
				$this->_login();
			}
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			if (password_verify($password, $user['password'])) {
				$this->session->set_userdata('login', '1');
				$this->session->set_userdata('id_user', $user['id_user']);
				$this->session->set_userdata('nama_lengkap', $user['nama_lengkap']);
				$this->session->set_userdata('level', $user['level']);
				if ($user['level'] == 'user') {
					redirect('user','refresh');
				}
				elseif ($user['level'] == 'admin') {
					redirect('admin','refresh');
				}
			}
		} else{
			$this->session->set_flashdata('salah_login', '1');
			redirect('login','refresh');
		}
	}

	public function logout(){
		session_destroy();
		redirect('','refresh');
	}

	public function register()
	{
		$this->load->view('register');
		if (isset($_POST['daftar'])) {
			$this->M_user->register();
		}
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */