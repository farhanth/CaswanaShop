<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
	function register(){
		$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

		$data = [
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'email' => $this->input->post('email'),
			'password' => $password,
			'no_tlp' => $this->input->post('no_tlp'),
			'jk' => $this->input->post('jk'),
			'level' => 'user'
		];

		$this->db->insert('user', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('register', 'berhasil');
			redirect('login','refresh');
		}
	}

	function get_kategori(){
		return $this->db->get('kategori')->result_array();
	}

	function get_produk_all($limit, $start, $kategori = null, $keyword = null){
		$this->db->join('kategori','kategori.id_kategori = sepeda.id_kategori');
		if ($kategori) {
			$this->db->where('kategori', $kategori);
		}

		if ($keyword) {
			$this->db->like('merk', $keyword);
		}

		if ($kategori && $keyword) {
			$this->db->where('kategori', $kategori);
			$this->db->like('merk', $keyword);
		}

		return $this->db->get('sepeda', $limit, $start)->result_array();
	}

	function get_produk($id){
		$this->db->select('*');
		$this->db->from('sepeda');		
		$this->db->join('kategori','kategori.id_kategori = sepeda.id_kategori');
		$this->db->where('id_sepeda', $id);
		return $this->db->get()->row_array();
	}

	function tambah_keranjang(){
		$data = [
			'id_sepeda' => $this->input->post('id_sepeda'),
			'id_user' => $this->session->userdata('id_user'),
			'jumlah' => $this->input->post('jumlah')
		];

		$this->db->insert('keranjang', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('keranjang', 'berhasil');
			redirect('produk/'.$this->input->post('id_sepeda'),'refresh');
		}
	}

	function get_keranjang($id){
		$this->db->join('sepeda','sepeda.id_sepeda = keranjang.id_sepeda');
		$this->db->join('user','user.id_user = keranjang.id_user');
		return $this->db->get_where('keranjang', ['keranjang.id_user' => $id])->result_array();
	}

	function delete_keranjang($id){
		$this->db->where('id_keranjang', $id);
		$this->db->delete('keranjang');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('keranjang', 'dihapus');
			redirect('user/keranjang','refresh');
		}
	}

	function edit_tambah_keranjang($id, $jumlah){
		$data = [
			'jumlah' => $jumlah += 1
		];
		$this->db->where('id_keranjang', $id);
		$this->db->update('keranjang', $data);
		redirect('user/keranjang','refresh');
	}

	function edit_kurang_keranjang($id, $jumlah){
		if ($jumlah == 1) {
			$jumlah = 1;
		} else{
			$jumlah -= 1;
		}
		$data = [
			'jumlah' => $jumlah
		];
		$this->db->where('id_keranjang', $id);
		$this->db->update('keranjang', $data);
		redirect('user/keranjang','refresh');
	}

	function get_user($id){
		return $this->db->get_where('user', ['id_user' => $id])->row_array();
	}

	function invoice(){
		$digits = 7;
		$jumlah_barang = count($this->input->post('merk'));
		$no_invoice = "INV".rand(pow(10, $digits-1), pow(10, $digits)-1);
		for ($i=0; $i < $jumlah_barang ; $i++) {
			$data = [
				'id_user' => $this->session->userdata('id_user'),
				'no_invoice' => $no_invoice,
				'merk' => $this->input->post("merk[$i]"),
				'harga_barang_total' => $this->input->post("harga[$i]"),
				'harga_invoice_total' => $this->input->post("harga_total"),
				'jumlah' => $this->input->post("jumlah[$i]"),
				'nama_lengkap_penerima' => $this->input->post('nama_lengkap'),
				'email_penerima' => $this->input->post('email'),
				'no_tlp_penerima' => $this->input->post('no_tlp'),
				'area' => $this->input->post('area'),
				'alamat_lengkap' => $this->input->post('alamat_lengkap'),
				'kode_pos' => $this->input->post('kode_pos'),
				'nama_rek' => $this->input->post('nama_rek'),
				'no_rek' => $this->input->post('no_rek'),
				'status' => 'Menunggu Pembayaran'
			];
			$this->db->insert('invoice', $data);
		}
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->delete('keranjang');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('invoice', 'checkout');
			redirect('pembelian','refresh');
		}
	}

	function get_no_invoice($id){
		$this->db->join('user','user.id_user = invoice.id_user');
		$this->db->distinct('no_invoice');
        $this->db->group_by('no_invoice');
		return $this->db->get_where('invoice', ['invoice.id_user' => $id])->result_array();
	}

	function get_detail_invoice($no_invoice){
		return $this->db->get_where('invoice', ['no_invoice' => $no_invoice])->result_array();
	}

	function get_detail_no_invoice($no_invoice){
		$this->db->distinct('no_invoice');
        $this->db->group_by('no_invoice');
		return $this->db->get_where('invoice', ['no_invoice' => $no_invoice])->row_array();
	}

	function bukti_transfer($no_invoice, $filename){
		$data = [
			'status' => 'Menunggu Verifikasi',
			'bukti_transfer' => $filename
		];
		$this->db->where('no_invoice', $no_invoice);
		$this->db->update('invoice', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('bukti_transfer', 'berhasil');
			redirect('pembelian','refresh');
		}
	}
}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */