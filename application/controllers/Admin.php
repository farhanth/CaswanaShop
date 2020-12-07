<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin');
	}

	public function logout(){
		session_destroy();
		redirect('login','refresh');
	}

	public function list_user()
	{
		if ($this->session->userdata('login') == '1' && $this->session->userdata('level') == 'admin') {
			$data['title'] = 'List User - Caswanashop';
			$data['user'] = $this->M_admin->get_user();
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/list_user');
			$this->load->view('admin/template/footer');
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('user','refresh');
		}
	}

	public function delete_user()
	{
		if ($this->session->userdata('login') == '1' && $this->session->userdata('level') == 'admin') {
			$this->M_admin->delete_user($this->input->post('id_user'));
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('user','refresh');
		}
	}

	public function edit_user($id)
	{
		if ($this->session->userdata('login') == '1' && $this->session->userdata('level') == 'admin') {
			$data['title'] = 'Edit User - Caswanashop';
			$data['user'] = $this->M_admin->get_edit_user($id);
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/edit_user');
			$this->load->view('admin/template/footer');
			if (isset($_POST['edit'])) {
				$this->M_admin->edit_user();
			}
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('user','refresh');
		}
	}

	public function list_kategori()
	{
		if ($this->session->userdata('login') == '1' && $this->session->userdata('level') == 'admin') {
			$data['title'] = 'List Kategori - Caswanashop';
			$data['kategori'] = $this->M_admin->get_kategori();
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/list_kategori');
			$this->load->view('admin/template/footer');
			if (isset($_POST['tambah'])) {
				$this->M_admin->tambah_kategori();
			}
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('user','refresh');
		}
	}

	public function delete_kategori()
	{
		if ($this->session->userdata('login') == '1' && $this->session->userdata('level') == 'admin') {
			$this->M_admin->delete_kategori($this->input->post('id_kategori'));
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('user','refresh');
		}
	}

	public function edit_kategori()
	{
		if ($this->session->userdata('login') == '1' && $this->session->userdata('level') == 'admin') {
			$this->M_admin->edit_kategori($this->input->post('id_kategori'));
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('user','refresh');
		}
	}

	public function list_sepeda()
	{
		if ($this->session->userdata('login') == '1' && $this->session->userdata('level') == 'admin') {
			$data['title'] = 'List Sepeda - Caswanashop';
			$data['sepeda'] = $this->M_admin->get_sepeda();
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/list_sepeda');
			$this->load->view('admin/template/footer');
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('user','refresh');
		}
	}

	public function tambah_sepeda()
	{
		if ($this->session->userdata('login') == '1' && $this->session->userdata('level') == 'admin') {
			$data['title'] = 'Tambah Sepeda - Caswanashop';
			$data['kategori'] = $this->M_admin->get_kategori();
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/tambah_sepeda');
			$this->load->view('admin/template/footer');
			
			if (isset($_POST['tambah'])) {
				$id = uniqid('item', TRUE);

				$config['upload_path'] = 'upload';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '100000';
				$config['file_ext_tolower'] = TRUE;
				$config['file_name'] = str_replace('.','_',$id);

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('gambar')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('admin/list_sepeda','refresh');
				}else{
					$filename = $this->upload->data('file_name');
					$this->M_admin->tambah_sepeda($filename);
				}
			}
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('user','refresh');
		}
	}

	public function edit_sepeda($id)
	{
		if ($this->session->userdata('login') == '1' && $this->session->userdata('level') == 'admin') {
			$data['title'] = 'Edit Sepeda - Caswanashop';
			$data['kategori'] = $this->M_admin->get_kategori();
			$data['sepeda'] = $this->M_admin->get_edit_sepeda($id);
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/edit_sepeda');
			$this->load->view('admin/template/footer');
			
			if (isset($_POST['edit'])) {
				if ($_FILES['gambar']['size'] > 0 && $_FILES['gambar']['error'] == 0) {
					$post = $this->M_admin->get_edit_sepeda($id);

					$config['upload_path'] = 'upload';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['max_size'] = '100000';
					$config['file_ext_tolower'] = TRUE;
					$config['overwrite'] = TRUE;
					$config['file_name'] = $post['gambar'];

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('gambar')) {
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('admin/list_sepeda','refresh');
					}else{
						$this->M_admin->edit_sepeda($id);
						$this->session->set_flashdata('pesan', 'diubah');
						redirect('admin/list_sepeda','refresh');
					}
				}else{
					$this->M_admin->edit_sepeda($id);
				}
			}
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('user','refresh');
		}
	}

	public function delete_sepeda()
	{
		if ($this->session->userdata('login') == '1' && $this->session->userdata('level') == 'admin') {
			$this->M_admin->delete_sepeda($this->input->post('id_sepeda'));
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('user','refresh');
		}
	}

	public function list_keranjang()
	{
		if ($this->session->userdata('login') == '1' && $this->session->userdata('level') == 'admin') {
			$data['title'] = 'List Keranjang - Caswanashop';
			$data['keranjang'] = $this->M_admin->get_keranjang();
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/list_keranjang');
			$this->load->view('admin/template/footer');
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('user','refresh');
		}
	}

	public function invoice()
	{
		if ($this->session->userdata('login') == '1' && $this->session->userdata('level') == 'admin') {
			$data['title'] = 'Invoice Pembelian - Caswanashop';
			$data['invoice'] = $this->M_admin->get_no_invoice();
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/invoice');
			$this->load->view('admin/template/footer');
			if (isset($_POST['status'])) {
				$this->M_admin->edit_status_invoice();
			}
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('user','refresh');
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

	public function detail_invoice($no_invoice)
	{
		if ($this->session->userdata('login') == '1' && $this->session->userdata('level') == 'admin') {
			$data['title'] = 'Detail Invoice';
			$data['invoice'] = $this->M_admin->get_detail_invoice($no_invoice);
			$data['no_invoice'] = $this->M_admin->get_detail_no_invoice($no_invoice);
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/detail_invoice');
			$this->load->view('admin/template/footer');
		} else{
			$this->session->set_flashdata('belum_login', '1');
			redirect('login','refresh');
		}
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */