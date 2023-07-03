<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// is_logged_in();
		$this->load->model('User_model','user_model');
	}

	public function index(){
		$data['title'] = 'Daftar User';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
		
		// var_dump($data['user'])

		$data['users'] = $this->user_model->getAllUser();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function add(){
		$data['title'] = 'Tambah User';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

		$data['users'] = $this->user_model->getAllUser();
		$data['unit_kerja'] = $this->user_model->getAllUnitKerja();
		$data['golongan'] = $this->user_model->getAllGolongan();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/add', $data);
		$this->load->view('templates/footer');
	}

	public function do_add_user(){
		$kedb['nama'] = $this->input->post('nama');
		$kedb['tempat_lahir'] = $this->input->post('tempat_lahir');
		$kedb['nip'] = $this->input->post('nip');
		$kedb['tanggal_lahir'] = $this->input->post('tanggal_lahir');
		$kedb['jabatan'] = $this->input->post('jabatan');
		$kedb['id_golongan'] = $this->input->post('golongan');
		$kedb['id_unit_kerja'] = $this->input->post('unit_kerja');
		$kedb['role_id'] = $this->input->post('role_id');
		$kedb['is_active'] = $this->input->post('is_active');
		$kedb['password'] = password_hash($this->input->post('password'),PASSWORD_DEFAULT);

		$this->db->insert('user',$kedb);

		redirect(base_url().'user');
	}

	public function edit(){
		$data['title'] = 'Edit User';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

		$id = $this->input->get('id');

		if ($id) {
			$data['detail_user'] = $this->user_model->getUserById($id);

			$data['unit_kerja'] = $this->user_model->getAllUnitKerja();
			$data['golongan'] = $this->user_model->getAllGolongan();
	
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			redirect(base_url().'user');
		}
	}

	public function do_edit_user(){
		$id = $this->input->post('id');
		$kedb['nama'] = $this->input->post('nama');
		$kedb['tempat_lahir'] = $this->input->post('tempat_lahir');
		$kedb['nip'] = $this->input->post('nip');
		$kedb['tanggal_lahir'] = $this->input->post('tanggal_lahir');
		$kedb['jabatan'] = $this->input->post('jabatan');
		$kedb['id_golongan'] = $this->input->post('golongan');
		$kedb['id_unit_kerja'] = $this->input->post('unit_kerja');
		$kedb['role_id'] = $this->input->post('role_id');
		$kedb['is_active'] = $this->input->post('is_active');

		if ($this->input->post('password')) {
			$kedb['password'] = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
		}

		$this->db->where('id',$id);
		$this->db->update('user',$kedb);

		redirect(base_url().'user');
	}

	public function do_delete_user(){
		$id = $this->input->get('id');

		if ($id){
			$this->db->where('id',$id);
			$this->db->delete('user');

		}
		redirect(base_url().'user');
	}

}

?>