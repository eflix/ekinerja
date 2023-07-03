<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// is_logged_in();
		$this->load->model('Admin_model','admin_model');
	}

	public function index() {
		$data['title'] = 'Dashboard E - Kinerja Pegawai';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
		
		// $total_responden = $this->admin_model->getDataChartTotalResponden();
		// $data['list_total_responden'] = json_encode([(int)$total_responden->total,(int)$total_responden->survey,(int)$total_responden->not_survey]);

		// $data['event_due_date'] = $this->admin_model->getEventDueDate();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function role() {
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role', $data);
		$this->load->view('templates/footer');
	}

	public function roleAccess($role_id) {
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

		$data['role'] = $this->db->get_where('user_role',['id' => $role_id])->row_array();

		$this->db->where('id !=',1);
		$data['menu'] = $this->db->get('user_menu')->result_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	public function changeAccess(){
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if($result->num_rows() < 1){
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Access Changed</div>');
	}

	public function identitas(){
		$data['title'] = 'Identitas';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

		$data['is'] = $this->db->get_where('identitas_surat',['is_id' => 1])->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/identitas', $data);
			$this->load->view('templates/footer');
	}

	public function ubahIdentitas (){
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

		$config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = 1500;

        $this->load->library('upload', $config);

        $data = array('image_metadata' => $this->upload->data());
 		
 		if (isset($data['image_metadata']['file_name'])){
 			if (!$this->upload->do_upload('profile_pic')) 
	        {
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Gagal Ubah Identitas!</div>');
	        } 
	        else 
	        {
	            $data = array('image_metadata' => $this->upload->data());
	            $dataIdentitas = [
	            	'is_logo' => $data['image_metadata']['file_name']
	            ];

	            $this->db->where('is_id',1);
        		$this->db->update('identitas_surat',$dataIdentitas);
	            
	        }
 		}
        // ubah identitas data
        $dataIdentitas = [
            	'is_alamat' => $this->input->post('alamat', true),
				'is_kepala_desa' => $this->input->post('kepalaDesa', true),
				'is_desa' => $this->input->post('desa', true),
				'is_kelurahan' => $this->input->post('kelurahan', true),
				'is_kecamatan' => $this->input->post('kecamatan', true),
				'is_kabupaten' => $this->input->post('kabupaten', true),
				'is_provinsi' => $this->input->post('provinsi', true)
            ];

        $this->db->where('is_id',1);
        $this->db->update('identitas_surat',$dataIdentitas);

        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil Ubah Identitas!</div>');

        redirect('admin/identitas');
	}

	public function profile(){
		$data['title'] = 'Profile Pegawai';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
		$idUser = $this->session->userdata('id_user');

		$data['pegawai'] = $this->admin_model->getUserPegawai($idUser);

		// $data['is'] = $this->db->get_where('identitas_surat',['is_id' => 1])->row_array();

		if($this->input->post('password')){
			$id = $this->input->post('id');
			$kedb['password'] = password_hash($this->input->post('password'),PASSWORD_DEFAULT);

			$this->db->where('id',$id);
			$this->db->update('user',$kedb);
			
			redirect('admin/profile');
		} else {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/profile', $data);
			$this->load->view('templates/footer');
		}
	}


}