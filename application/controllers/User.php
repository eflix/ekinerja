<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// is_logged_in();
		$this->load->model('User_model','user_model');
		$this->load->library('session');
	}

	public function index(){
		$data['title'] = 'Daftar User';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

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
		$data['kelas_jabatan'] = $this->user_model->getAllKelasJabatan();

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
		$kedb['id_kelas_jabatan'] = $this->input->post('id_kelas_jabatan');
		$kedb['jabatan'] = $this->input->post('jabatan');
		$kedb['pangkat_golongan'] = $this->input->post('pangkat_golongan');
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
			$data['kelas_jabatan'] = $this->user_model->getAllKelasJabatan();
	
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
		$kedb['id_kelas_jabatan'] = $this->input->post('id_kelas_jabatan');
		$kedb['jabatan'] = $this->input->post('jabatan');
		$kedb['pangkat_golongan'] = $this->input->post('pangkat_golongan');
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

	public function import(){
		$data['title'] = 'Import Data Pegawai';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

		// $data['users'] = $this->user_model->getAllUser();
		// $data['unit_kerja'] = $this->user_model->getAllUnitKerja();
		// $data['golongan'] = $this->user_model->getAllGolongan();
		// $data['kelas_jabatan'] = $this->user_model->getAllKelasJabatan();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/import', $data);
		$this->load->view('templates/footer');
	}

	public function do_import_user(){
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

		// if(isset($_POST['berkas_excel'])){
			// echo "1";
			$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			
			if(isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
			 
				$arr_file = explode('.', $_FILES['berkas_excel']['name']);
				$extension = end($arr_file);
			 
				if('csv' == $extension) {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				} else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				}
			 
				$spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
				 
				$sheetData = $spreadsheet->getActiveSheet()->toArray();


				$success = 0;
				$failed = 0;
				$isSet = 0;

				$rowData = count($sheetData)-1;

				// var_dump($sheetData[0]);
				for($i = 1;$i < count($sheetData);$i++)
				{
					$tanggal_lahir = strtotime(trim($sheetData[$i]['4']));
					$new_tglLahir = date('Y-m-d',$tanggal_lahir);
					$kedb['nama'] = trim($sheetData[$i]['1']);
					$kedb['nip'] = trim($sheetData[$i]['2']);
					$kedb['tempat_lahir'] = trim($sheetData[$i]['3']);
					$kedb['tanggal_lahir'] = $new_tglLahir;
					$kedb['jenis_kelamin'] = trim($sheetData[$i]['5']);
					$kedb['pangkat_golongan'] = trim($sheetData[$i]['6']);
					$kedb['jabatan'] = trim($sheetData[$i]['9']);
					$kedb['role_id'] = 2;
					$kedb['is_active'] = 1;
					$kedb['password'] = password_hash(trim($sheetData[$i]['2']),PASSWORD_DEFAULT);

					$kelas_jabatan = trim($sheetData[$i]['7']);
					$unit_kerja = trim($sheetData[$i]['8']);

					$cekDuplicate = $this->user_model->getUserByNip($kedb['nip']);

					if ($cekDuplicate) {
						$isSet++;
					} else {
						$kelas_jabatan = $this->user_model->getKelasJabatanByJabatan($kelas_jabatan);

						if ($kelas_jabatan) {
							$kedb['id_kelas_jabatan'] = $kelas_jabatan->id;
						} else {
							$kedb['id_kelas_jabatan'] = 0;
						}

						$unit_kerja = $this->user_model->getUnitKerjaByUnitKerja($unit_kerja);

						if ($unit_kerja) {
							$kedb['id_unit_kerja'] = $unit_kerja->id;
						} else {
							$kedb['id_unit_kerja'] = 0;
						}

						$this->db->insert('user',$kedb);
						$insert_id = $this->db->insert_id();

						if ($insert_id) {
							$success++;
						} else {
							$failed++;
						}
					}
					// var_dump($kedb);
					// echo "<br />";
					
					$msg = "Import Data Selesai. Total data : $rowData, sukses : $success, gagal : $failed, Sudah ada : $isSet";

					$this->session->set_flashdata('message',$msg);

					redirect(base_url()."user");
				}
			}
		// }
		// $id = $this->input->post('id');
		// $kedb['nama'] = $this->input->post('nama');
		// $kedb['tempat_lahir'] = $this->input->post('tempat_lahir');
		// $kedb['nip'] = $this->input->post('nip');
		// $kedb['tanggal_lahir'] = $this->input->post('tanggal_lahir');
		// $kedb['id_kelas_jabatan'] = $this->input->post('id_kelas_jabatan');
		// $kedb['jabatan'] = $this->input->post('jabatan');
		// $kedb['pangkat_golongan'] = $this->input->post('pangkat_golongan');
		// $kedb['id_unit_kerja'] = $this->input->post('unit_kerja');
		// $kedb['role_id'] = $this->input->post('role_id');
		// $kedb['is_active'] = $this->input->post('is_active');

		// if ($this->input->post('password')) {
		// 	$kedb['password'] = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
		// }

		// $this->db->where('id',$id);
		// $this->db->update('user',$kedb);

		// redirect(base_url().'user');
	}

}

?>