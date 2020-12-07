<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
	
	function get_user(){
		return $this->db->get_where('user', ['level' => 'user'])->result_array();
	}

	function get_edit_user($id){
		return $this->db->get_where('user', ['id_user' => $id])->row_array();
	}
	
	function delete_user($id){
		$this->db->where('id_user', $id);
		$this->db->delete('user');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('pesan', 'dihapus');
			redirect('admin/list_user','refresh');
		}
	}

	function edit_user(){
		$ganti_password = strlen($this->input->post('password'));
		if ($ganti_password == 0) {
			$data = [
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'email' => $this->input->post('email'),
				'no_tlp' => $this->input->post('no_tlp'),
				'jk' => $this->input->post('jk'),
				'level' => 'user'
			];
			$this->db->where('id_user', $this->input->post('id_user'));
			$this->db->update('user', $data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('pesan', 'diubah');
				redirect('admin/list_user','refresh');
			}
		} else{
			$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$data = [
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'email' => $this->input->post('email'),
				'password' => $password,
				'no_tlp' => $this->input->post('no_tlp'),
				'jk' => $this->input->post('jk'),
				'level' => 'user'
			];
			$this->db->where('id_user', $this->input->post('id_user'));
			$this->db->update('user', $data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('pesan', 'diubah');
				redirect('admin/list_user','refresh');
			}
		}
	}

	function get_kategori(){
		$this->db->distinct();
		$this->db->order_by('kategori', 'asc');
		return $this->db->get('kategori')->result_array();
	}

	public function countAllPeoples(){
		return $this->db->get('peoples')->num_rows();
	}

	function tambah_kategori(){
		$data = [
			'kategori' => $this->input->post('nama_kategori')
		];

		$this->db->insert('kategori', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('pesan', 'ditambah');
			redirect('admin/list_kategori','refresh');
		}
	}

	function delete_kategori($id){
		$this->db->where('id_kategori', $id);
		$this->db->delete('kategori');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('pesan', 'dihapus');
			redirect('admin/list_kategori','refresh');
		}
	}

	function edit_kategori(){
		$data = [
			'kategori' => $this->input->post('edit_nama_kategori')
		];
		$this->db->where('id_kategori', $this->input->post('id_kategori'));
		$this->db->update('kategori', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('pesan', 'diubah');
			redirect('admin/list_kategori','refresh');
		}
	}

	function get_sepeda(){
		$this->db->select('*');
		$this->db->from('sepeda');		
		$this->db->join('kategori','kategori.id_kategori = sepeda.id_kategori');
		return $this->db->get()->result_array();
	}

	function tambah_sepeda($filename){
		$data = [
			'id_kategori' => $this->input->post('kategori'),
			'merk' => $this->input->post('merk'),
			'harga' => $this->input->post('harga'),
			'deskripsi' => $this->input->post('deskripsi'),
			'spesifikasi' => $this->input->post('spesifikasi'),
			'gambar' => $filename
		];

		$this->db->insert('sepeda', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('pesan', 'ditambah');
			redirect('admin/list_sepeda','refresh');
		}
	}

	function get_edit_sepeda($id){
		return $this->db->get_where('sepeda', ['id_sepeda' => $id])->row_array();
	}

	public function edit_sepeda($id){
		$data = [
			'id_kategori' => $this->input->post('kategori'),
			'merk' => $this->input->post('merk'),
			'harga' => $this->input->post('harga'),
			'deskripsi' => $this->input->post('deskripsi'),
			'spesifikasi' => $this->input->post('spesifikasi')
		];
		$this->db->where('id_sepeda', $id);
		$this->db->update('sepeda', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('pesan', 'diubah');
			redirect('admin/list_sepeda','refresh');
		}
	}

	function delete_sepeda($id){
		$this->db->where('id_sepeda', $id);
		$this->db->delete('sepeda');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('pesan', 'dihapus');
			redirect('admin/list_sepeda','refresh');
		}
	}

	function get_keranjang(){
		$this->db->join('sepeda','sepeda.id_sepeda = keranjang.id_sepeda');
		$this->db->join('user','user.id_user = keranjang.id_user');
		return $this->db->get('keranjang')->result_array();
	}

	function get_no_invoice(){
		$this->db->join('user','user.id_user = invoice.id_user');
		$this->db->distinct('no_invoice');
        $this->db->group_by('no_invoice');
		return $this->db->get('invoice')->result_array();
	}

	function edit_status_invoice(){
		for ($i=0; $i < count($this->input->post('status')) ; $i++) {
			$data = [
				'status' => $this->input->post("status[$i]")
			];
			$this->db->where('no_invoice', $this->input->post("no_invoice[$i]"));
			$this->db->update('invoice', $data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('status', 'diubah');
				redirect('admin/invoice','refresh');
			}
		}
	}

	function get_detail_invoice($no_invoice){
		return $this->db->get_where('invoice', ['no_invoice' => $no_invoice])->result_array();
	}

	function get_detail_no_invoice($no_invoice){
		$this->db->distinct('no_invoice');
        $this->db->group_by('no_invoice');
		return $this->db->get_where('invoice', ['no_invoice' => $no_invoice])->row_array();
	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */