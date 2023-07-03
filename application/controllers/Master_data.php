<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Master_data extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// is_logged_in();
		$this->load->model('Master_data_model','master_data_model');
		// $this->load->library('pdf');
	}

	public function index(){
        redirect('dashboard');
	// 	$data['title'] = 'Daftar Dokumen';
	// 	$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

	// 	$data['dokumen'] = $this->dokumen->getAllData();
		
	// 	$this->load->view('templates/header', $data);
	// 	$this->load->view('templates/sidebar', $data);
	// 	$this->load->view('templates/topbar', $data);
	// 	$this->load->view('dokumen/index', $data);
	// 	$this->load->view('templates/footer');
	// }
		// $this->load->view('dokumen/imageupload_form');
	}

	public function unit_kerja() 
    {
        $data['title'] = 'Daftar Unit Kerja';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

		$data['events'] = $this->master_data_model->getAllUnitKerja();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('master_data/unit_kerja', $data);
		$this->load->view('templates/footer');
    }

	public function golongan() 
    {
        $data['title'] = 'Daftar Jabatan / Golongan';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

		$data['events'] = $this->master_data_model->getAllGolongan();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('master_data/golongan', $data);
		$this->load->view('templates/footer');
    }

	public function add_event(){
		$data['title'] = 'Tambah Tokoh';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		// $data['provinces'] = $this->master_data_model->getAllProvince();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('master_data/add_event', $data);
		$this->load->view('templates/footer');
	}

	public function do_add_event(){
		$kedb = [
			'title' => $this->input->post('title', true),
			'organizer' => $this->input->post('organizer', true),
			'location_at' => $this->input->post('location_at', true),
			'event_date' => date('Y-m-d\TH:i:s', strtotime($this->input->post('event_date'))),
			'created_dt' => date('Y-m-d'),
			'created_by' => $this->session->userdata('name')
		];

		$this->db->insert('events',$kedb);

		redirect(base_url().'master_data/event');
	}

	public function edit_event(){
		$data['title'] = 'Edit Event';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$id = $this->input->get('id');

		$data['event'] = $this->master_data_model->getEventById($id);

		// $data['provinces'] = $this->master_data_model->getAllProvince();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('master_data/edit_event', $data);
		$this->load->view('templates/footer');
	}

	public function do_edit_event(){
		$id = $this->input->post('id', true);
		$kedb = [
			'title' => $this->input->post('title', true),
			'organizer' => $this->input->post('organizer', true),
			'location_at' => $this->input->post('location_at', true),
			'event_date' => date('Y-m-d\TH:i:s', strtotime($this->input->post('event_date'))),
			'created_dt' => date('Y-m-d'),
			'created_by' => $this->session->userdata('name')
		];

		$this->db->where('id',$id);
		$this->db->update('events',$kedb);

		redirect(base_url().'master_data/event');
	}

	public function do_delete_event(){
		$id = $this->input->get('id');

		if ($id){
			$this->db->where('id',$id);
			$this->db->delete('events');
		}
		redirect(base_url().'master_data/event');
	}

	public function kategori() 
    {
        $data['title'] = 'Daftar Kategori';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['categories'] = $this->master_data_model->getAllCategory();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('master_data/kategori', $data);
		$this->load->view('templates/footer');
    }

	public function do_add_kategori(){
		$kedb = [
			'tipe' => $this->input->post('tipe', true),
			'nama_kategori' => $this->input->post('nama_kategori', true),
			'created_dt' => date('Y-m-d'),
			'created_by' => $this->session->userdata('name')
		];

		$this->db->insert('kategori',$kedb);

		redirect(base_url().'master_data/kategori');
	}

	public function do_delete_kategori(){
		$id = $this->input->get('id');

		if ($id){
			$this->db->where('id',$id);
			$this->db->delete('kategori');
		}
		redirect(base_url().'master_data/kategori');
	}

	public function instansi() 
    {
        $data['title'] = 'Daftar Instansi & lokasi event';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['instansi'] = $this->master_data_model->getAllInstansi();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('master_data/instansi', $data);
		$this->load->view('templates/footer');
    }

	public function add_instansi(){
		$data['title'] = 'Tambah Instansi';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['provinces'] = $this->master_data_model->getAllProvince();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('master_data/add_instansi', $data);
		$this->load->view('templates/footer');
	}

	public function do_add_instansi(){
		$kedb = [
			'tipe' => $this->input->post('tipe', true),
			'nama_instansi' => $this->input->post('nama_instansi', true),
			'no_telp' => $this->input->post('no_telp', true),
			'alamat' => $this->input->post('alamat', true),
			'kelurahan' => $this->input->post('kelurahan',true),
			'kecamatan' => $this->input->post('kecamatan',true),
			'kabupaten' => $this->input->post('kabupaten',true),
			'provinsi' => $this->input->post('provinsi',true),
			'created_dt' => date('Y-m-d'),
			'created_by' => $this->session->userdata('name')
		];

		$this->db->insert('instansi',$kedb);

		redirect(base_url().'master_data/instansi');
	}

	public function do_add_edit_unit_kerja(){

		$id = $this->input->post('id', true);
		$id_user = $this->session->userdata('id_user');
		$kedb = [
			// 'id_user' => $id_user,
			'unit_kerja' => $this->input->post('unit_kerja', true),
			'tingkatan' => $this->input->post('tingkatan', true),
			// 'created_dt' => date('Y-m-d'),
			// 'created_by' => $this->session->userdata('name')
		];

		if ($id == "") {
			$this->db->insert('unit_kerja',$kedb);
		} else {
			$this->db->where('id',$id);
			$this->db->update('unit_kerja',$kedb);
		}
		
		redirect(base_url().'master_data/unit_kerja');
	}

	public function do_delete_unit_kerja(){
		$id = $this->input->get('id');

		if ($id){
			$this->db->where('id',$id);
			$this->db->delete('unit_kerja');
		}
		redirect(base_url().'master_data/unit_kerja');
	}

	public function do_add_edit_golongan(){

		$id = $this->input->post('id', true);
		$id_user = $this->session->userdata('id_user');
		$kedb = [
			// 'id_user' => $id_user,
			'golongan' => $this->input->post('golongan', true),
			'bobot' => $this->input->post('tunjangan', true),
			// 'created_dt' => date('Y-m-d'),
			// 'created_by' => $this->session->userdata('name')
		];

		if ($id == "") {
			$this->db->insert('golongan',$kedb);
		} else {
			$this->db->where('id',$id);
			$this->db->update('golongan',$kedb);
		}
		
		redirect(base_url().'master_data/golongan');
	}

	public function do_delete_golongan(){
		$id = $this->input->get('id');

		if ($id){
			$this->db->where('id',$id);
			$this->db->delete('golongan');
		}
		redirect(base_url().'master_data/golongan');
	}
	
}