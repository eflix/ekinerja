<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function getAllUser(){
		$query = "SELECT a.*,b.kelas_jabatan,c.unit_kerja,c.tingkatan FROM user a
		LEFT OUTER JOIN kelas_jabatan b ON (a.id_kelas_jabatan = b.id)
		LEFT OUTER JOIN unit_kerja c ON (a.id_unit_kerja = c.id)";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function getUserById($id){
		return $query = $this->db->get_where('user',['id'=>$id])->row();
	}

	public function getAllUnitKerja(){
		return $query = $this->db->get('unit_kerja')->result();
	}

	public function getAllGolongan(){
		return $query = $this->db->get('golongan')->result();
	}

	public function getAllKelasJabatan(){
		return $query = $this->db->get('kelas_jabatan')->result();
	}

	public function getUserByNip($nip){
		return $query = $this->db->get_where('user',['nip'=>$nip])->row();
	}

	public function getKelasJabatanByJabatan($kelas_jabatan){
		return $query = $this->db->get_where('kelas_jabatan',['kelas_jabatan'=>$kelas_jabatan])->row();
	}

	public function getUnitKerjaByUnitKerja($unit_kerja){
		return $query = $this->db->get_where('unit_kerja',['lower(unit_kerja)'=>strtolower($unit_kerja)])->row();
	}

}

?>