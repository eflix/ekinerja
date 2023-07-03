<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function getAllUser(){
		$query = "SELECT a.*,b.golongan,c.unit_kerja,c.tingkatan FROM user a
		LEFT OUTER JOIN golongan b ON (a.id_golongan = b.id)
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

}

?>